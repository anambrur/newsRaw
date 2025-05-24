<?php
// Start output buffering at the very beginning
ob_start();

session_start();
include('includes/config.php');

// Define status constants
define('STATUS_ACTIVE', 1);
define('STATUS_DRAFT', 2);
define('STATUS_SCHEDULED', 3);
define('STATUS_BIN', 4);

// Check authentication
if (strlen($_SESSION['login']) == 0) {
    ob_end_clean(); // Clean buffer before redirect
    header('location:index.php');
    exit();
}

// Process restoration
if (isset($_GET['pid'])) {
    $postid = intval($_GET['pid']);
    $query = mysqli_query($con, "UPDATE tblposts SET Is_Active=".STATUS_DRAFT." WHERE id='$postid'");
    
    if ($query) {
        $_SESSION['msg'] = "Post restored successfully";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again. Error: " . mysqli_error($con);
    }
    
    // Clean output buffer before redirect
    ob_end_clean();
    
    // Build redirect URL - prefer the status parameter if coming from bin
    $redirect_url = 'manage-news.php?status='.STATUS_BIN;
    
    // If we have a valid referer and it's from our domain, use it
    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) !== false) {
        $redirect_url = $_SERVER['HTTP_REFERER'];
    }
    
    header("Location: $redirect_url");
    exit();
}

// If no PID parameter, redirect to manage-news.php
ob_end_clean();
header("Location: manage-news.php");
exit();
?>