<?php
session_start();
include('includes/config.php');

// Define status constants
define('STATUS_ACTIVE', 1);
define('STATUS_DRAFT', 2);
define('STATUS_SCHEDULED', 3);
define('STATUS_DELETED', 4);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit();
}

if (isset($_GET['pid'])) {
    $postid = intval($_GET['pid']);
    $query = mysqli_query($con, "UPDATE tblposts SET Is_Active=" . STATUS_DRAFT . " WHERE id='$postid'");
    if ($query) {
        $_SESSION['msg'] = "Post restored successfully";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    }
}

// Return to the previous page with all parameters
$referer = $_SERVER['HTTP_REFERER'] ?? 'manage-news.php';
header("Location: $referer");
exit();
?>