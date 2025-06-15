<?php
session_start();
include('includes/config.php');
include('includes/resizeLib.php');

// Error reporting configuration
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/autosave_errors.log');

// Check authentication
if (empty($_SESSION['login'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Session expired']);
    exit;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Initialize variables
$msg = $error = '';
$posttitle = $catid = $postdetails = $reporter = $subtitle = $source = $photocap = '';
$seoshort = $imageseo = $seomkey = $imgnewfile = '';
$On_Slider = $On_Sportlingt = $On_Article = $On_Gfeed = $On_Save = 0;
$postId = 0;

// Function to safely handle file uploads (same as in your main file)
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

// Process the auto-save request
try {
    // Get post ID if exists
    $postId = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

    // Sanitize and validate inputs
    $posttitle = trim($_POST['posttitle'] ?? '');
    $catid = intval($_POST['category'] ?? 0);
    $postdetails = trim($_POST['postdescription'] ?? '');
    $subtitle = trim($_POST['subtitle'] ?? '');
    $source = trim($_POST['source'] ?? '');
    $photocap = trim($_POST['photocap'] ?? '');
    $seoshort = trim($_POST['seoshort'] ?? '');
    $imageseo = trim($_POST['imageseo'] ?? '');
    $seomkey = trim($_POST['seomkey'] ?? '');

    // Initialize reporter variables
    $reporter = null;
    $reporterName = null;

    if (isset($_POST['useStaticReporter']) && $_POST['useStaticReporter'] === 'on') {
        $reporterName = trim($_POST['static_reporter'] ?? '');
    } else {
        $reporter = isset($_POST['reporter']) ? intval($_POST['reporter']) : null;
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

    // Set status to draft (2) for auto-save
    $status = 2; // Draft status
    $isAutosave = 1;

    // Handle file upload
    $imgnewfile = null;
    $uploadSuccess = true;
    $date = date('Y-m-d H:i:s');

    // Handle file upload only if a file was actually uploaded
    if (isset($_FILES['postimage']) && $_FILES['postimage']['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        list($uploadSuccess, $uploadResult) = handleFileUpload('postimage', 'images/postimages/', $allowedExtensions);

        if (!$uploadSuccess) {
            throw new Exception($uploadResult);
        }
        $imgnewfile = $uploadResult;
    }

    // For drafts, don't check for duplicate titles
    if ($postId > 0) {
        // Update existing draft
        $query = "UPDATE tblposts SET 
            PostTitle = ?, 
            CategoryId = ?, 
            PostDetails = ?, 
            PostUrl = ?, 
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
            IsAutosave = ?
        WHERE id = ?";

        $updateQuery = mysqli_prepare($con, $query);

        // Prepare parameters
        $params = [
            $posttitle,        // s
            $catid,            // i
            $postdetails,      // s
            $url,              // s
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
            $isAutosave,       // i
            $postId            // i
        ];

        // Build type string
        $types = 'sissiiiiisissssssssii';

        // Bind parameters
        mysqli_stmt_bind_param($updateQuery, $types, ...$params);

        if (!mysqli_stmt_execute($updateQuery)) {
            throw new Exception("Database error: " . mysqli_error($con));
        }

        $msg = "Draft updated successfully";
    } else {
        // Insert new draft
        $insertQuery = mysqli_prepare(
            $con,
            "INSERT INTO tblposts 
    (PostTitle, CategoryId, PostDetails, PostUrl, Is_Active, On_Slider, 
     On_Sportlingt, On_Article, On_Gfeed, On_Save, PostImage, repoter, reporterName, source, subtitle, photocap, seoshort, imageseo, seomkey, PostingDate, UpdationDate, ScheduledPublish, IsAutosave) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        // Type string explanation:
        // s = string, i = integer
        // Count the number of parameters - should match the number of ? above
        mysqli_stmt_bind_param(
            $insertQuery,
            'sisssiiiiisissssssssssi', // 23 characters for 23 parameters
            $posttitle,        // s
            $catid,            // i
            $postdetails,      // s
            $url,              // s
            $status,           // s (Is_Active could be string or integer depending on your DB)
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
            $date,             // s
            $date,             // s
            $scheduledPublish, // s
            $isAutosave        // i
        );

        if (!mysqli_stmt_execute($insertQuery)) {
            throw new Exception("Database error: " . mysqli_error($con));
        }

        $postId = mysqli_insert_id($con);
        $msg = "Draft saved successfully";
    }

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

    // Return success response
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => $msg,
        'post_id' => $postId
    ]);
    exit;
} catch (Exception $e) {
    // Return error response
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'post_id' => $postId
    ]);
    exit;
}
