<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once 'db.php';
require_once "functions/limit.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <!-- Home Page Seo Start-->
    <?php
    $db->exec("set names utf8");
    $result = $db->prepare("SELECT * FROM settings WHERE id = 1");
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
    ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo $row['name']; ?></title>
        <meta name="title" content="<?php echo $row['name']; ?>" />
        <meta name="description" content="<?php echo $row['homemetadescription']; ?>" />
        <meta name="keywords" content="<?php echo $row['homemetakeyword']; ?>" />
        <meta name="url" content="<?php echo $row['urlwww']; ?>" />
        <meta property="og:site_name" content="<?php echo $row['name']; ?>" />
        <meta property="og:title" content="<?php echo $row['name']; ?>" />
        <meta property="og:description" content="<?php echo $row['homemetadescription']; ?>" />
        <meta property="og:url" content="<?php echo $row['url']; ?>" />
        <meta property="og:locale" content="bn-BD" />
        <meta property="og:image" content="<?php echo $row['url']; ?>/sitecover.jpg" />
        <meta property="og:type" content="News Website" />
        <meta name="twitter:card" content="<?php echo $row['url']; ?>/sitecover.jpg">
        <meta name="twitter:site" content="<?php echo $row['name']; ?>">
        <meta name="twitter:title" content="<?php echo $row['name']; ?>">
        <meta name="twitter:description" content="<?php echo $row['homemetadescription']; ?>">
        <meta name="twitter:image" content="<?php echo $row['url']; ?>/sitecover.jpg">
        <meta name="Author™" content="<?php echo $row['name']; ?>" />
        <meta name="Designer™" content="IT Factory Bangladesh" />
        <meta name="coverage" content="Worldwide" />
        <meta name="distribution" content="Global" />
        <meta name="rating" content="General" />
        <meta name="revisit-after" content="1 days" />
        <meta name="robots" content="index,follow" />
    <?php } ?>
    <!-- Home Page Seo End-->
    <?php require_once 'parts/head.php'; ?>

    <?php
    $db->exec("set names utf8");
    $result = $db->prepare("SELECT * FROM settings WHERE id = 1");
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
    ?>
    <?php } ?>

    <meta property="og:image" content="" />
</head>

<body style="background: #ffffff;">
    <?php require 'includes/header.php'; ?>
    <div style="background: #ffffff;">
        <?php require_once 'sections/litenews.php'; ?>
    </div>
    <?php require_once 'parts/footer.php'; ?>
    <?php require_once 'parts/scripts.php'; ?>
</body>

</html>