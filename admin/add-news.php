<?php
session_start();
include('includes/config.php');
include('includes/resizeLib.php');

// Error reporting configuration
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check authentication
if (empty($_SESSION['login'])) {
    header('location:index.php');
    exit();
}

// Initialize variables
$msg = $error = '';
$posttitle = $catid = $postdetails = $reporter = $subtitle = $source = $photocap = '';
$seoshort = $imageseo = $seomkey = $imgnewfile = '';
$On_Slider = $On_Sportlingt = $On_Article = $On_Gfeed = $On_Save = 0;

// Function to safely handle file uploads
function handleFileUpload($fileInput, $uploadDir, $allowedExtensions)
{
    $errors = [];
    $file = $_FILES[$fileInput];

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "File upload error: " . $file['error'];
        return [false, implode(', ', $errors)];
    }

    // Get file info
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate extension
    if (!in_array($fileExt, $allowedExtensions)) {
        $errors[] = "Invalid file format. Only " . implode(', ', $allowedExtensions) . " allowed.";
    }

    // Validate MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $fileTmp);
    $allowedMimes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp'
    ];

    if (!in_array($mime, $allowedMimes)) {
        $errors[] = "Invalid file content. File doesn't match its extension.";
    }

    // Validate file size (e.g., 5MB max)
    if ($fileSize > 5242880) {
        $errors[] = "File size exceeds 5MB limit.";
    }

    // Check upload directory
    if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
        $errors[] = "Upload directory doesn't exist or isn't writable.";
    }

    if (!empty($errors)) {
        return [false, implode(', ', $errors)];
    }

    // Generate unique filename
    $newFileName = "news_image_" . md5($fileName . microtime()) . '.' . $fileExt;
    $destination = rtrim($uploadDir, '/') . '/' . $newFileName;

    // Move the file
    if (!move_uploaded_file($fileTmp, $destination)) {
        return [false, "Failed to move uploaded file."];
    }

    return [true, $newFileName];
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['submit']) || isset($_POST['draft']))) {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Security error: Invalid CSRF token.";
    } else {
        // Sanitize and validate inputs
        $posttitle = trim($_POST['posttitle']);
        $catid = intval($_POST['category']);
        $postdetails = trim($_POST['postdescription']);
        $reporter = intval($_POST['reporter']);
        $subtitle = trim($_POST['subtitle']);
        $source = trim($_POST['source']);
        $photocap = trim($_POST['photocap']);
        $seoshort = trim($_POST['seoshort']);
        $imageseo = trim($_POST['imageseo']);
        $seomkey = trim($_POST['seomkey']);

        // Generate URL slug
        $arr = explode(" ", $posttitle);
        $url = implode("-", $arr);

        // Checkboxes
        $On_Slider = isset($_POST['test']) && $_POST['test'] === 'value1' ? 1 : 0;
        $On_Sportlingt = isset($_POST['sport']) && $_POST['sport'] === 'value1' ? 1 : 0;
        $On_Article = isset($_POST['article']) && $_POST['article'] === 'value1' ? 1 : 0;
        $On_Gfeed = isset($_POST['googlefeed']) && $_POST['googlefeed'] === 'value1' ? 1 : 0;
        $On_Save = isset($_POST['saveme']) && $_POST['saveme'] === 'value1' ? 1 : 0;

        // Get scheduled publish time
        $scheduledPublish = null;
        if (!empty($_POST['scheduled_publish'])) {
            $scheduledPublish = date('Y-m-d H:i:s', strtotime($_POST['scheduled_publish']));
        }

        // Set Is_Active based on submission type and scheduling
        if (isset($_POST['draft'])) {
            $status = 2; // Draft status
        } elseif (!empty($scheduledPublish)) {
            $status = (strtotime($scheduledPublish) <= time()) ? 1 : 3;
        } else {
            $status = 1; // Default to published
        }

        // Validate required fields
        if (empty($posttitle) || empty($catid) || empty($postdetails) || empty($reporter)) {
            $error = "Please fill all required fields.";
        } else {
            // Handle file upload
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            list($uploadSuccess, $uploadResult) = handleFileUpload('postimage', 'images/postimages/', $allowedExtensions);

            if (!$uploadSuccess) {
                $error = $uploadResult;
            } else {
                $imgnewfile = $uploadResult;
                $date = date('Y-m-d h:i:s');

                // Check if post title already exists
                $checkQuery = mysqli_prepare($con, "SELECT id FROM tblposts WHERE PostTitle = ?");
                mysqli_stmt_bind_param($checkQuery, 's', $posttitle);
                mysqli_stmt_execute($checkQuery);
                mysqli_stmt_store_result($checkQuery);

                if (mysqli_stmt_num_rows($checkQuery) > 0) {
                    $error = "Post title already exists. Please choose a different one.";
                } else {
                    // Insert the new post
                    $insertQuery = mysqli_prepare(
                        $con,
                        "INSERT INTO tblposts 
                        (PostTitle, CategoryId, PostDetails, PostUrl, Is_Active, On_Slider, 
                         On_Sportlingt, On_Article, On_Gfeed, On_Save, PostImage, repoter, 
                         source, subtitle, photocap, seoshort, imageseo, seomkey, PostingDate, UpdationDate, ScheduledPublish) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                    );

                    mysqli_stmt_bind_param(
                        $insertQuery,
                        'sisssiiiiisisssssssss',
                        $posttitle,
                        $catid,
                        $postdetails,
                        $url,
                        $status,
                        $On_Slider,
                        $On_Sportlingt,
                        $On_Article,
                        $On_Gfeed,
                        $On_Save,
                        $imgnewfile,
                        $reporter,
                        $source,
                        $subtitle,
                        $photocap,
                        $seoshort,
                        $imageseo,
                        $seomkey,
                        $date,
                        $date,
                        $scheduledPublish
                    );

                    if (mysqli_stmt_execute($insertQuery)) {
                        $msg = "Post successfully " . ($status == 1 ? "published" : ($status == 2 ? "saved as draft" : "scheduled"));

                        // Create thumbnail
                        try {
                            $resizeObj = new resize("images/postimages/" . $imgnewfile);
                            $resizeObj->resizeImage(300, 200, 'exact');
                            $resizeObj->saveImage("images/thumb/" . $imgnewfile, 100);
                        } catch (Exception $e) {
                            error_log("Thumbnail creation failed: " . $e->getMessage());
                        }
                    } else {
                        $error = "Database error: " . mysqli_error($con);
                        error_log("Database error: " . mysqli_error($con));
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add News</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="News Management System" />
    <meta name="keywords" content="news, management, cms" />
    <meta name="author" content="Your Name" />

    <!-- Favicon -->
    <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon" />

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fonts/tabler-icons.min.css" />
    <link rel="stylesheet" href="assets/fonts/feather.css" />
    <link rel="stylesheet" href="assets/fonts/fontawesome.css" />
    <link rel="stylesheet" href="assets/fonts/material.css" />
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="assets/css/style-preset.css" />
    <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

    <style>
        .form-group label {
            font-size: 20px
        }

        .alert {
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body data-pc-header="header-1" data-pc-preset="preset-1" data-pc-sidebar-theme="light"
    data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- Pre-loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="pc-sidebar">
        <?php include('includes/leftsidebar.php'); ?>
    </nav>

    <!-- Header Topbar -->
    <?php include('includes/topheader.php'); ?>

    <!-- Main Content -->
    <div class="pc-container">
        <div class="pc-content" style="padding-top: 1px;background-color: #f3f3f3;">
            <!-- Breadcrumb -->
            <div class="page-header">
                <div class="page-block card mb-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title border-bottom pb-2 mb-2">
                                    <h4 class="mb-0">Add Post</h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/index.html"><i class="ph ph-house"></i></a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">News Room</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Add Post</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Post Form -->
            <div class="page-header">
                <div class="page-block card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php if ($msg): ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Success!</strong> <?php echo htmlspecialchars($msg); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($error): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error!</strong> <?php echo htmlspecialchars($error); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="p-6">
                                    <form name="addpost" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                        <div class="form-group m-b-20">
                                            <label>Post Title</label>
                                            <input type="text" class="form-control" id="posttitle" name="posttitle"
                                                placeholder="Enter title" value="<?php echo htmlspecialchars($posttitle); ?>" required>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label>Post Sub Title</label>
                                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                                placeholder="Enter sub title" value="<?php echo htmlspecialchars($subtitle); ?>">
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label>Bottom Source</label>
                                            <input type="text" class="form-control" id="source" name="source"
                                                placeholder="Enter source" value="<?php echo htmlspecialchars($source); ?>" required>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="test3" name="test" value="value1" <?php echo $On_Slider ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="test3">Add To Led</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="test4" name="sport" value="value1" <?php echo $On_Sportlingt ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="test4">Add To Sub Led</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="test5" name="article" value="value1" <?php echo $On_Article ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="test5">Add To Articles</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="test6" name="googlefeed" value="value1" <?php echo $On_Gfeed ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="test6">Add To Feed</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="test7" name="saveme" value="value1" <?php echo $On_Save ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="test7">Save Me</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label>Post Details</label>
                                            <textarea class="summernote" name="postdescription" required><?php echo htmlspecialchars($postdetails); ?></textarea>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group m-b-20">
                                    <label>Select News Image</label>
                                    <input type="file" id="postimage" name="postimage" accept="image/*" onchange="loadFile(event)" required>
                                    <img style="max-width: 100%; margin-top: 10px;" id="output" />
                                    <script>
                                        var loadFile = function(event) {
                                            var output = document.getElementById('output');
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src);
                                            }
                                        };
                                    </script>
                                </div>

                                <div class="form-group m-b-20">
                                    <label>Photo Caption</label>
                                    <input type="text" class="form-control" id="photocap" name="photocap"
                                        placeholder="Photo Caption" value="<?php echo htmlspecialchars($photocap); ?>">
                                </div>

                                <div class="form-group m-b-20">
                                    <label>Category</label>
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="">Select Category</option>
                                        <?php
                                        $ret = mysqli_query($con, "SELECT id, CategoryName FROM tblcategory WHERE Is_Active=1");
                                        while ($result = mysqli_fetch_array($ret)) {
                                            $selected = ($result['id'] == $catid) ? 'selected' : '';
                                            echo '<option value="' . htmlspecialchars($result['id']) . '" ' . $selected . '>'
                                                . htmlspecialchars($result['CategoryName']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group m-b-20">
                                    <label>Reporter</label>
                                    <select class="form-control" name="reporter" id="reporter" required>
                                        <option value="">Select Reporter</option>
                                        <?php
                                        $rets = mysqli_query($con, "SELECT * FROM reporter WHERE deleted='false'");
                                        while ($result = mysqli_fetch_array($rets)) {
                                            $selected = ($result['reporterID'] == $reporter) ? 'selected' : '';
                                            echo '<option value="' . htmlspecialchars($result['reporterID']) . '" ' . $selected . '>'
                                                . htmlspecialchars($result['name']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group m-b-20">
                                    <label>Schedule Post</label>
                                    <p>(Leave empty for immediate publishing)</p>
                                    <input type="datetime-local" class="form-control" id="scheduled_publish" name="scheduled_publish"
                                        value="<?php echo !empty($scheduledPublish) ? date('Y-m-d\TH:i', strtotime($scheduledPublish)) : ''; ?>">
                                </div>

                                <hr>
                                <h4 style="color:#2b71b4">Advanced SEO (Optional)</h4>
                                <hr>

                                <div class="form-group m-b-20">
                                    <label>SEO Post Short Details</label>
                                    <input type="text" class="form-control" id="seoshort" name="seoshort"
                                        placeholder="Enter SEO Post Short Details" value="<?php echo htmlspecialchars($seoshort); ?>">
                                </div>

                                <div class="form-group m-b-20">
                                    <label>SEO Post Image Name</label>
                                    <input type="text" class="form-control" id="imageseo" name="imageseo"
                                        placeholder="Enter SEO Post Image Name" value="<?php echo htmlspecialchars($imageseo); ?>">
                                </div>

                                <div class="form-group m-b-20">
                                    <label>SEO Meta Key Word</label>
                                    <input type="text" class="form-control" id="seomkey" name="seomkey"
                                        placeholder="Enter SEO Meta Key Word" value="<?php echo htmlspecialchars($seomkey); ?>">
                                </div>

                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Publish Post</button>
                                <button type="submit" name="draft" class="btn btn-primary waves-effect waves-light">Save as Draft</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <!-- JavaScript -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/summernote/summernote.min.js"></script>
    <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>
    <script src="../plugins/select2/js/select2.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
            });
        });
    </script>
</body>

</html>