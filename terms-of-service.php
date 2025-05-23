<?php require_once 'db.php';
require_once "functions/limit.php";
$result = $db->prepare("UPDATE settings SET views=views+1 WHERE id = 1 ");
$result->execute();
?>
<?php
session_start();
include('includes/config.php');
$Id = intval($_GET['nid']);
$query = mysqli_query($con, "UPDATE tblposts SET views=views+1 WHERE id = $Id ");
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));
}
if (isset($_POST['submit'])) {
    if (!empty($_POST['csrftoken'])) {
        if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];
            $st1 = '0';
            $postid = intval($_GET['nid']);
            $query = mysqli_query($con, "insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
            if ($query):
                echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>";
                unset($_SESSION['token']);
            else :
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            endif;
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once 'parts/head.php'; ?>
    <?php
    $sql = "SELECT PostTitle, PostImage  FROM tblposts WHERE id = $Id ";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>



            <meta property="og:type" content="article" />
            <meta property="og:image" content="<?php echo $url; ?>admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" />
    <?php }
    }  ?>

    <?php
    $db->exec("set names utf8");
    $result = $db->prepare("SELECT * FROM tblseo WHERE id = 1");
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        echo $row['data'];
    }
    ?>
    <?php
    $db->exec("set names utf8");
    $result = $db->prepare("SELECT * FROM tblseo WHERE id = 2");
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        echo $row['data'];
    }
    ?>
    <title>
        Terms of Service
    </title>

</head>

<body>
    <div id="main-wrapper">
        <?php require 'includes/header.php'; ?>

        <section id="feature_category_section" class="feature_category_section single-page section_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="single_content_layout">
                            <div class="item feature_news_item">

                                <?php
                                $pagetype = 'conditions';
                                $query = mysqli_query($con, "select PageTitle,Description from tblpages where PageName='$pagetype'");
                                while ($row = mysqli_fetch_array($query)) {

                                ?>
                                    <div class="item_wrapper pd">
                                        <div class="news_item_title">
                                            <h1 style="font-size:30px !important;"><?php echo htmlentities($row['PageTitle']) ?></h1>
                                        </div>

                                        <div class="item_content">
                                            <h2 style="font-size:25px !important; color:#646464; text-align:center">
                                                <?php echo $row['Description']; ?>
                                            </h2>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
        </section>
        <?php require_once 'parts/footer.php'; ?>
        <?php require_once 'parts/scripts.php'; ?>
</body>

</html>