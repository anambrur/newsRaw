<?php include_once("functions/english_bangla.php"); ?>
<!doctype html>
<html lang="en">
<!--Head Line Start-->
<head>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
<?php
    $db->exec("set names utf8");
    $result = $db->prepare("SELECT * FROM settings WHERE id = 1");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    $name = $row['name'];
    $url = $row['url'];
    } ?>
    <?php
    $db->exec("set names utf8");
    $result = $db->prepare("SELECT * FROM settings WHERE id = 1");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    ?>
        <link rel="icon" type="image/png" href="images/<?php echo $row['favicon']; ?>"/>
<?php } ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<script async src="css-js/common/hb.js" type="e18c05d0688a614e23c19650-text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script language=javascript>document.write(unescape('%3Clink%20rel%3D%22stylesheet%22%20type%3D%22text/css%22%20href%3D%22css-js/bootstrap/css/bootstrap.min.css%22%3E%3Clink%20rel%3D%22stylesheet%22%20type%3D%22text/css%22%20href%3D%22ajax/libs/font-awesome/5.15.3/css/all.min.css%22%20referrerpolicy%3D%22no-referrer%22%20/%3E%3Clink%20rel%3D%22stylesheet%22%20type%3D%22text/css%22%20href%3D%22common/css/itFactory.css%22%3E%3Clink%20rel%3D%22stylesheet%22%20type%3D%22text/css%22%20href%3D%22ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css%22%20/%3E%3Clink%20rel%3D%22stylesheet%22%20type%3D%22text/css%22%20href%3D%22common/css/Kiron.css%22%3E%3Clink%20rel%3D%22stylesheet%22%20type%3D%22text/css%22%20href%3D%22ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css%22%20/%3E'))</script>
</head>
<!--Head Line End-->
