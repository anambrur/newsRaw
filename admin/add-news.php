<?php
ob_start();
session_start();
include('includes/config.php');
include('includes/resizeLib.php');

// Error reporting configuration
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Constants
define('DRAFT_KEY', 'news_draft_' . basename(__FILE__));

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



// After your other includes in add-news.php
function handleFileUpload($fileInput, $uploadDir, $allowedExtensions)
{
    // Skip file requirement for drafts
    if (!isset($_FILES[$fileInput])) {
        return [false, "No file uploaded"];
    }

    $file = $_FILES[$fileInput];

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            return [false, "No file selected"];
        }
        return [false, "File upload error: " . $file['error']];
    }

    // Get file info
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate extension
    if (!in_array($fileExt, $allowedExtensions)) {
        return [false, "Invalid file format. Only " . implode(', ', $allowedExtensions) . " allowed."];
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
        return [false, "Invalid file content. File doesn't match its extension."];
    }

    // Validate file size (5MB max)
    if ($fileSize > 5242880) {
        return [false, "File size exceeds 5MB limit."];
    }

    // Check upload directory
    if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
        return [false, "Upload directory doesn't exist or isn't writable."];
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

// Process form submission (only for non-draft submissions)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Validate CSRF token for main form submission
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Security error: Invalid CSRF token.";
    } else {
        // Get post ID if exists
        $postId = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

        // Sanitize and validate inputs
        $posttitle = trim($_POST['posttitle']);
        $catid = intval($_POST['category']);
        $postdetails = trim($_POST['postdescription']);
        $subtitle = trim($_POST['subtitle']);
        $source = trim($_POST['source']);
        $photocap = trim($_POST['photocap']);
        $seoshort = trim($_POST['seoshort']);
        $imageseo = trim($_POST['imageseo']);
        $seomkey = trim($_POST['seomkey']);

        // Initialize reporter variables
        $reporter = null;
        $reporterName = null;

        if (isset($_POST['useStaticReporter']) && $_POST['useStaticReporter'] === 'on') {
            $reporterName = trim($_POST['static_reporter']);
            if (empty($reporterName)) {
                $error = "Please enter a reporter name";
            }
        } else {
            $reporter = isset($_POST['reporter']) ? intval($_POST['reporter']) : null;
            if ($reporter === null || $reporter === 0) {
                $error = "Please select a valid reporter from the dropdown";
            }
        }

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

        // Set Is_Active based on scheduling
        if (!empty($scheduledPublish)) {
            $status = (strtotime($scheduledPublish) <= time()) ? 1 : 3;
        } else {
            $status = 1; // Default to published
        }

        // Validate required fields
        if (empty($posttitle) || empty($catid) || empty($postdetails)) {
            $error = "Please fill all required fields.";
        }

        if (empty($error)) {
            // Handle file upload
            $imgnewfile = null;
            $uploadSuccess = true;
            $date = date('Y-m-d H:i:s');

            if (isset($_FILES['postimage']) && $_FILES['postimage']['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                list($uploadSuccess, $uploadResult) = handleFileUpload('postimage', 'images/postimages/', $allowedExtensions);

                if (!$uploadSuccess) {
                    $error = $uploadResult;
                } else {
                    $imgnewfile = $uploadResult;
                }
            } elseif ($postId > 0) {
                // If updating and no new image, keep the existing one
                $existing = mysqli_query($con, "SELECT PostImage FROM tblposts WHERE id = $postId");
                if ($existing && mysqli_num_rows($existing) > 0) {
                    $row = mysqli_fetch_assoc($existing);
                    $imgnewfile = $row['PostImage'];
                }
            } else {
                $error = "Please select an image for the post";
            }

            if (empty($error)) {
                // Check for duplicate titles (only for published posts)
                $checkQuery = mysqli_prepare($con, "SELECT id FROM tblposts WHERE PostTitle = ? AND id != ?");
                mysqli_stmt_bind_param($checkQuery, 'si', $posttitle, $postId);
                mysqli_stmt_execute($checkQuery);
                mysqli_stmt_store_result($checkQuery);

                if (mysqli_stmt_num_rows($checkQuery) > 0) {
                    $error = "Post title already exists. Please choose a different one.";
                }

                if (empty($error)) {
                    if ($postId > 0) {
                        // Update existing post (convert draft to published)
                        $updateQuery = mysqli_prepare(
                            $con,
                            "UPDATE tblposts SET 
                                PostTitle = ?, 
                                CategoryId = ?, 
                                PostDetails = ?, 
                                PostUrl = ?, 
                                Is_Active = ?, 
                                On_Slider = ?, 
                                On_Sportlingt = ?, 
                                On_Article = ?, 
                                On_Gfeed = ?, 
                                On_Save = ?,
                                PostImage = ?,
                                repoter = ?, 
                                reporterName = ?, 
                                source = ?, 
                                subtitle = ?, 
                                photocap = ?, 
                                seoshort = ?, 
                                imageseo = ?, 
                                seomkey = ?,  
                                ScheduledPublish = ?,
                                IsAutosave = 0
                            WHERE id = ?"
                        );

                        // Prepare parameters
                        $params = [
                            $posttitle,        // s string
                            $catid,            // i
                            $postdetails,      // s
                            $url,              // s
                            $status,           // i
                            $On_Slider,        // i
                            $On_Sportlingt,    // i
                            $On_Article,       // i
                            $On_Gfeed,         // i
                            $On_Save,          // i
                            $imgnewfile,       // s
                            $reporter,         // i
                            $reporterName,     // s
                            $source,           // s
                            $subtitle,         // s
                            $photocap,         // s
                            $seoshort,         // s
                            $imageseo,         // s
                            $seomkey,          // s
                            $scheduledPublish, // s
                            $postId            // i
                        ];

                        // Create type string
                        $types = 'sissiiiiiisissssssssi';

                        mysqli_stmt_bind_param($updateQuery, $types, ...$params);

                        if (mysqli_stmt_execute($updateQuery)) {
                            $msg = "Post successfully updated";
                            // Clear local draft after successful publish
                            echo '<script>localStorage.removeItem("' . DRAFT_KEY . '");</script>';

                            // Create thumbnail if new image was uploaded
                            if ($imgnewfile) {
                                try {
                                    $resizeObj = new resize("images/postimages/" . $imgnewfile);
                                    $resizeObj->resizeImage(300, 200, 'exact');
                                    $resizeObj->saveImage("images/thumb/" . $imgnewfile, 100);
                                } catch (Exception $e) {
                                    error_log("Thumbnail creation failed: " . $e->getMessage());
                                }
                            }
                        } else {
                            $error = "Database error: " . mysqli_error($con);
                        }
                    } else {
                        // Insert new post
                        $insertQuery = mysqli_prepare(
                            $con,
                            "INSERT INTO tblposts 
                            (PostTitle, CategoryId, PostDetails, PostUrl, Is_Active, On_Slider, 
                             On_Sportlingt, On_Article, On_Gfeed, On_Save, PostImage, repoter, reporterName, source, subtitle, photocap, seoshort, imageseo, seomkey, PostingDate, UpdationDate, ScheduledPublish, IsAutosave) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                        );

                        mysqli_stmt_bind_param(
                            $insertQuery,
                            'sisssiiiiisissssssssssi',
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
                            $reporterName,
                            $source,
                            $subtitle,
                            $photocap,
                            $seoshort,
                            $imageseo,
                            $seomkey,
                            $date,
                            $date,
                            $scheduledPublish,
                            0 // Not an autosave
                        );

                        if (mysqli_stmt_execute($insertQuery)) {
                            $postId = mysqli_insert_id($con);
                            $msg = "Post successfully published";

                            // Create thumbnail if image was uploaded
                            if ($imgnewfile) {
                                try {
                                    $resizeObj = new resize("images/postimages/" . $imgnewfile);
                                    $resizeObj->resizeImage(300, 200, 'exact');
                                    $resizeObj->saveImage("images/thumb/" . $imgnewfile, 100);
                                } catch (Exception $e) {
                                    error_log("Thumbnail creation failed: " . $e->getMessage());
                                }
                            }
                        } else {
                            $error = "Database error: " . mysqli_error($con);
                        }
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

        #staticReporterContainer {
            margin-top: 10px;
        }

        .form-check {
            margin-bottom: 10px;
        }

        /* Auto-save notification */
        .alert.alert-info,
        .alert.alert-danger {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Save status indicator */
        #save-status {
            position: fixed;
            bottom: 10px;
            left: 10px;
            z-index: 9999;
            background: white;
            padding: 5px 10px;
            border-radius: 3px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 13px;
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
                                        <input type="hidden" name="post_id" id="post_id" value="">

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

                                    <!-- Checkbox to toggle static reporter -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="useStaticReporter" name="useStaticReporter">
                                        <label class="form-check-label" for="useStaticReporter">Use custom reporter name</label>
                                    </div>

                                    <!-- Select2 Dropdown (default) -->
                                    <div id="reporterDropdownContainer">
                                        <select class="form-control select2" name="reporter" id="reporter" required>
                                            <option value="">Select Reporter</option>
                                            <?php
                                            $rets = mysqli_query($con, "SELECT * FROM reporter WHERE deleted='false'");
                                            while ($result = mysqli_fetch_array($rets)) {
                                                echo '<option value="' . htmlspecialchars($result['reporterID']) . '">'
                                                    . htmlspecialchars($result['name']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Static Reporter Input (hidden by default) -->
                                    <div id="staticReporterContainer" style="display: none;">
                                        <input type="text" class="form-control" id="staticReporter" name="static_reporter"
                                            placeholder="Enter reporter name">
                                    </div>
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
                                <button type="button" id="saveDraftBtn" class="btn btn-primary waves-effect waves-light">Save as Draft</button>
                                <button type="button" id="resetFormBtn" class="btn btn-danger waves-effect waves-light">Reset Form</button>
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

    <!-- SweetAlert2 JS -->
    <script src="assets/js/sweetalert2@11.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote
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

            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select Reporter",
                allowClear: true
            });

            // Toggle between dropdown and static reporter
            $('#useStaticReporter').change(function() {
                if ($(this).is(':checked')) {
                    $('#reporterDropdownContainer').hide();
                    $('#staticReporterContainer').show();
                    $('#reporter').val('').removeAttr('required');
                } else {
                    $('#reporterDropdownContainer').show();
                    $('#staticReporterContainer').hide();
                    $('#reporter').attr('required', 'required');
                    $('#staticReporter').val('');
                }
            });

            // Auto-save system implementation
            const DRAFT_KEY = '<?php echo DRAFT_KEY; ?>';
            let autoSaveInterval;
            const AUTO_SAVE_INTERVAL = 30000; // 30 seconds
            let isAutoSaving = false;
            let lastSavedData = null;
            let changeTimer;
            let typingTimer;

            // Function to collect form data
            function collectFormData() {
                return {
                    post_id: $('#post_id').val(),
                    posttitle: $('#posttitle').val(),
                    category: $('#category').val(),
                    postdescription: $('.summernote').summernote('code'),
                    subtitle: $('#subtitle').val(),
                    source: $('#source').val(),
                    photocap: $('#photocap').val(),
                    seoshort: $('#seoshort').val(),
                    imageseo: $('#imageseo').val(),
                    seomkey: $('#seomkey').val(),
                    test: $('#test3').is(':checked') ? 'value1' : '',
                    sport: $('#test4').is(':checked') ? 'value1' : '',
                    article: $('#test5').is(':checked') ? 'value1' : '',
                    googlefeed: $('#test6').is(':checked') ? 'value1' : '',
                    saveme: $('#test7').is(':checked') ? 'value1' : '',
                    scheduled_publish: $('#scheduled_publish').val(),
                    useStaticReporter: $('#useStaticReporter').is(':checked') ? 'on' : '',
                    static_reporter: $('#staticReporter').val(),
                    reporter: $('#reporter').val()
                };
            }

            // Function to check if form has changes
            function hasFormChanged() {
                const currentData = JSON.stringify(collectFormData());
                return lastSavedData !== currentData;
            }

            // Show auto-save notification
            function showAutoSaveNotification(message, isError = false) {
                const notification = $(`<div class="alert ${isError ? 'alert-danger' : 'alert-info'}" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
                    ${message}
                </div>`);

                $('body').append(notification);
                setTimeout(() => notification.fadeOut(500, () => notification.remove()), 3000);
            }

            // Save to local storage
            function saveToLocalDraft() {
                const formData = collectFormData();
                localStorage.setItem(DRAFT_KEY, JSON.stringify(formData));
                console.log('Draft saved locally');
            }

            // Load from local storage
            function loadFromLocalDraft() {
                const draft = localStorage.getItem(DRAFT_KEY);
                if (draft) {
                    const data = JSON.parse(draft);

                    // Restore form fields
                    $('#post_id').val(data.post_id || '');
                    $('#posttitle').val(data.posttitle);
                    $('#category').val(data.category);
                    $('.summernote').summernote('code', data.postdescription);
                    $('#subtitle').val(data.subtitle);
                    $('#source').val(data.source);
                    $('#photocap').val(data.photocap);
                    $('#seoshort').val(data.seoshort);
                    $('#imageseo').val(data.imageseo);
                    $('#seomkey').val(data.seomkey);
                    $('#test3').prop('checked', data.test === 'value1');
                    $('#test4').prop('checked', data.sport === 'value1');
                    $('#test5').prop('checked', data.article === 'value1');
                    $('#test6').prop('checked', data.googlefeed === 'value1');
                    $('#test7').prop('checked', data.saveme === 'value1');
                    $('#scheduled_publish').val(data.scheduled_publish);
                    $('#useStaticReporter').prop('checked', data.useStaticReporter === 'on');
                    $('#staticReporter').val(data.static_reporter);
                    $('#reporter').val(data.reporter);

                    showAutoSaveNotification('Recovered unsaved draft from local storage');

                    // Update last saved data
                    lastSavedData = JSON.stringify(data);

                    // Update UI to show we're editing a draft
                    updateDraftUI(true);
                } else {
                    updateDraftUI(false);
                }
            }

            // Update UI based on draft status
            function updateDraftUI(isDraft) {
                if (isDraft) {
                    $('button[name="submit"]').text('Published Post');
                    $('#draft-status').text('Editing draft').show();
                } else {
                    $('button[name="submit"]').text('Publish Post');
                    $('#draft-status').hide();
                }
            }

            // Clear local draft
            function clearLocalDraft() {
                localStorage.removeItem(DRAFT_KEY);
                updateDraftUI(false);
            }

            // Auto-save function
            function autoSaveDraft() {
                if (isAutoSaving) {
                    console.log('Auto-save already in progress');
                    return;
                }

                if (!hasFormChanged()) {
                    console.log('No changes detected, skipping auto-save');
                    return;
                }

                console.log('Starting auto-save...');
                isAutoSaving = true;
                updateSaveStatus(true);

                // First save to localStorage
                saveToLocalDraft();
                console.log('Local draft saved');

                // Prepare FormData
                const formData = new FormData();
                const data = collectFormData();

                console.log('Collected form data:', data);

                Object.keys(data).forEach(key => {
                    formData.append(key, data[key]);
                });

                const fileInput = document.getElementById('postimage');
                if (fileInput.files.length > 0) {
                    console.log('Including file in upload:', fileInput.files[0].name);
                    formData.append('postimage', fileInput.files[0]);
                } else {
                    console.log('No file selected - sending without file');
                    formData.append('postimage', '');
                }

                console.log('Sending to server...');

                // $.ajax({
                //     url: 'autosave-post.php',
                //     type: 'POST',
                //     data: formData,
                //     processData: false,
                //     contentType: false,
                //     success: function(response, status, xhr) {
                //         console.log('Server response:', response);

                //         if (response && response.success) {
                //             // Update the post_id if this is a new draft
                //             if (response.post_id && !$('#post_id').val()) {
                //                 $('#post_id').val(response.post_id);
                //                 // Update local storage with the post_id
                //                 const draft = localStorage.getItem(DRAFT_KEY);
                //                 if (draft) {
                //                     const data = JSON.parse(draft);
                //                     data.post_id = response.post_id;
                //                     localStorage.setItem(DRAFT_KEY, JSON.stringify(data));
                //                 }
                //                 updateDraftUI(true);
                //             }

                //             lastSavedData = JSON.stringify(data);
                //             showAutoSaveNotification(response.message || 'Draft saved');
                //         } else {
                //             showAutoSaveNotification(response?.message || 'Draft save failed', true);
                //         }
                //     },
                //     error: function(xhr, status, error) {
                //         console.error('AJAX error:', {
                //             status: xhr.status,
                //             error: error,
                //             responseText: xhr.responseText
                //         });
                //         showAutoSaveNotification('Saved locally (server unavailable)', true);
                //     },
                //     complete: function() {
                //         console.log('Auto-save completed');
                //         isAutoSaving = false;
                //         updateSaveStatus(false);
                //     }
                // });
            }

            // Update save status indicator
            function updateSaveStatus(isSaving, isError = false) {
                const indicator = $('#save-status');
                if (isSaving) {
                    indicator.html('<i class="fa fa-spinner fa-spin"></i> Saving...').css('color', 'orange');
                } else if (isError) {
                    indicator.html('<i class="fa fa-warning"></i> Saved locally').css('color', '#ff9800');
                } else {
                    indicator.html('<i class="fa fa-check"></i> All changes saved').css('color', 'green');
                }
                setTimeout(() => indicator.html(''), 5000);
            }

            // Initialize auto-save
            function initAutoSave() {
                // Start auto-save interval
                // autoSaveInterval = setInterval(autoSaveDraft, AUTO_SAVE_INTERVAL);

                // // Also save when leaving the page
                // $(window).on('beforeunload', function(e) {
                //     if (hasFormChanged()) {
                //         saveToLocalDraft();

                //         const data = collectFormData();
                //         const formData = new FormData();

                //         Object.keys(data).forEach(key => {
                //             formData.append(key, data[key]);
                //         });

                //         if (navigator.sendBeacon) {
                //             navigator.sendBeacon('autosave-post.php', formData);
                //         }

                //         return 'You have unsaved changes. A draft has been saved locally.';
                //     }
                // });

                // // Store initial data
                // lastSavedData = JSON.stringify(collectFormData());
            }

            // Manual draft save button
            $('#saveDraftBtn').click(function() {
                // autoSaveDraft();
            });

            // Form submission handler
            $('form[name="addpost"]').submit(function(e) {
                // Validate reporter selection
                if ($('#useStaticReporter').is(':checked')) {
                    $('#reporter').val('');
                    if ($('#staticReporter').val().trim() === '') {
                        alert('Please enter a reporter name');
                        e.preventDefault();
                        return false;
                    }
                } else {
                    if ($('#reporter').val() === '' || $('#reporter').val() === '0') {
                        alert('Please select a reporter from the dropdown');
                        e.preventDefault();
                        return false;
                    }
                }

                // Clear draft if this is a publish action
                clearLocalDraft();
                return true;
            });

            // Add save status indicator to DOM
            $('form[name="addpost"]').prepend('<div id="save-status" style="position: fixed; bottom: 10px; left: 10px; z-index: 9999; background: white; padding: 5px 10px; border-radius: 3px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); font-size: 13px;"></div>');

            // Add draft status indicator
            $('form[name="addpost"]').prepend('<div id="draft-status" style="display: none; position: fixed; bottom: 40px; left: 10px; z-index: 9999; background: #e3f2fd; padding: 5px 10px; border-radius: 3px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); font-size: 13px;"></div>');

            // Load any existing draft on page load
            loadFromLocalDraft();

            // Initialize the auto-save system
            initAutoSave();

            // Auto-save when summernote content changes (with delay)
            $('.summernote').on('summernote.change', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    if (hasFormChanged()) {
                        // autoSaveDraft();
                    }
                }, 5000); // Save 5 seconds after last change
            });

            // Save when other form fields change (with debounce)
            $('input, select, textarea').not('.summernote').on('change input', function() {
                clearTimeout(changeTimer);
                changeTimer = setTimeout(() => {
                    if (hasFormChanged()) {
                        // autoSaveDraft();
                    }
                }, 2000);
            });

            // Also save periodically regardless of changes (every 5 minutes)
            // setInterval(saveToLocalDraft, 300000);


            // Enhanced reset function with SweetAlert
            function resetForm() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will clear all form data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset it!',
                    cancelButtonText: 'No, keep changes',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Clear local storage
                        localStorage.removeItem(DRAFT_KEY);

                        // Reset form fields
                        $('form[name="addpost"]')[0].reset();
                        $('.summernote').summernote('code', '');
                        $('#post_id').val('');
                        $('#output').attr('src', '');

                        // Reset checkboxes
                        $('#test3, #test4, #test5, #test6, #test7').prop('checked', false);

                        // Reset reporter fields
                        $('#useStaticReporter').prop('checked', false);
                        $('#reporterDropdownContainer').show();
                        $('#staticReporterContainer').hide();
                        $('#reporter').val('').trigger('change');
                        $('#staticReporter').val('');

                        // Reset last saved data
                        lastSavedData = JSON.stringify(collectFormData());

                        // Update UI
                        updateDraftUI(false);
                        updateSaveStatus(false);

                        // Show success message
                        Swal.fire(
                            'Reset!',
                            'Your form has been reset.',
                            'success'
                        );
                    }
                });
            }

            // Add click handler for the reset button
            $('#resetFormBtn').click(resetForm);
        });
    </script>
</body>

</html>