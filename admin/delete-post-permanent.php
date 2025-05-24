<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit();
}

if (isset($_GET['pid'])) {
    $postid = intval($_GET['pid']);
    
    // First delete the post image
    $query = mysqli_query($con, "SELECT PostImage FROM tblposts WHERE id='$postid'");
    $row = mysqli_fetch_array($query);
    if ($row && !empty($row['PostImage'])) {
        $imagePath = "images/" . $row['PostImage'];
        $thumbPath = "images/thumb/" . $row['PostImage'];
        if (file_exists($imagePath)) unlink($imagePath);
        if (file_exists($thumbPath)) unlink($thumbPath);
    }
    
    // Then delete the post
    $query = mysqli_query($con, "DELETE FROM tblposts WHERE id='$postid'");
    if ($query) {
        $_SESSION['msg'] = "Post permanently deleted";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    }
    
    // Return to previous page with all parameters
    $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'manage-news.php?status='.STATUS_DELETED;
    header("Location: $redirect_url");
    exit();
}
?>