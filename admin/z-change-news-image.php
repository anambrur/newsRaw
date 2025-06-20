<?php
session_start();
include('includes/config.php');
include('includes/resizeLib.php');
error_reporting(0);

function imageGenerator($input, $overlay, $output)
{
    $png = imagecreatefrompng($overlay);

    $file_parts = pathinfo($input);

    switch ($file_parts['extension']) {

        case "gif":
            $image = imagecreatefromgif($input);
            break;

        case "jpg":
            $image = imagecreatefromjpeg($input);
            break;

        case "webp":
            $image = imagecreatefromwebp($input);
            break;

        case "jpeg":
            $image = imagecreatefromjpeg($input);
            break;

        case "png":
            $image = imagecreatefrompng($input);
            break;
    }


    list($width, $height) = getimagesize($input);
    list($newwidth, $newheight) = getimagesize($overlay);
    $out = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($out, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
    imagejpeg($out, $output, 100);
}


if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {

        $imgfile = $_FILES["postimage"]["name"];
        // get the image extension
        $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
        // allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            //rename the image file
            $imgnewfile = uniqid($imgfile) . $extension;
            // Code for move image into directory
            move_uploaded_file($_FILES["postimage"]["tmp_name"], "images/postimages/" . $imgnewfile);


            $postid = intval($_GET['pid']);
            $query = mysqli_query($con, "update tblposts set PostImage='$imgnewfile' where id='$postid'");
            $resizeObj = new resize("images/postimages/big-image/" . $imgnewfile);
            $resizeObj->resizeImage(200, 114, 'exact');
            $resizeObj->saveImage("images/postimages/thumbnail/" . $imgnewfile, 100);
            if ($query) {
                $msg = "News Feature Image updated ";
            } else {
                $error = "Something went wrong . Please try again.";
            }
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Change News Image</title>
        <!-- [Meta] -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
            name="description"
            content="Gradient Able is trending dashboard template made using Bootstrap 5 design framework. Gradient Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies." />
        <meta
            name="keywords"
            content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard" />
        <meta name="author" content="codedthemes" />
        <link href="https://fonts.cdnfonts.com/css/solaimanlipi" rel="stylesheet">
        <style>
            @import url('https://fonts.cdnfonts.com/css/solaimanlipi');
        </style>
        <!-- [Favicon] icon -->
        <link rel="icon" href="assets/images/favicon.svg" type="image/x-icon" />

        <!-- map-vector css -->
        <link rel="stylesheet" href="../assets/css/plugins/jsvectormap.min.css" />
        <!-- [Google Font : Poppins] icon -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

        <!-- [Tabler Icons] https://tablericons.com -->
        <link rel="stylesheet" href="assets/fonts/tabler-icons.min.css" />
        <!-- [Feather Icons] https://feathericons.com -->
        <link rel="stylesheet" href="assets/fonts/feather.css" />
        <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
        <link rel="stylesheet" href="assets/fonts/fontawesome.css" />
        <!-- [Material Icons] https://fonts.google.com/icons -->
        <link rel="stylesheet" href="assets/fonts/material.css" />
        <!-- [Template CSS Files] -->
        <link rel="stylesheet" href="assets/css/style.css" id="main-style-link" />
        <link rel="stylesheet" href="assets/css/style-preset.css" />

    </head>
    <!-- [Head] end -->
    <!-- [Body] Start -->

    <body data-pc-header="header-1" data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->
        <!-- [ Sidebar Menu ] start -->
        <nav class="pc-sidebar">
            <?php include('includes/leftsidebar.php'); ?>
        </nav>
        <!-- [ Sidebar Menu ] end -->
        <!-- [ Header Topbar ] start -->
        <?php include('includes/topheader.php'); ?>
        <!-- [ Header ] end -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <!-- Start content -->


        <!-- [ Main Content ] start -->
        <div class="pc-container">
            <div class="pc-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block card mb-0">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title border-bottom pb-2 mb-2">
                                        <h4 class="mb-0">News Image Change</h4>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="../dashboard/index.html"><i class="ph ph-house"></i></a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0)">Change Image</a></li>
                                        <li class="breadcrumb-item" aria-current="page">News Image Change</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->


                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- [ sample-page ] start -->
                    <div class="col-sm-12">
                        <div class="card" style="padding: 20px;">

                            <div class="row">
                                <div class="col-sm-6">
                                    <!---Success Message--->
                                    <?php if ($msg) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                        </div>
                                    <?php } ?>

                                    <!---Error Message--->
                                    <?php if ($error) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } ?>


                                </div>
                            </div>
                            <form name="addpost" method="post" enctype="multipart/form-data">
                                <?php
                                $postid = intval($_GET['pid']);
                                $query = mysqli_query($con, "select PostImage,PostTitle from tblposts where id='$postid' and Is_Active=1 ");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="p-6">
                                                <div class="" style="padding: 30px;">
                                                    <form name="addpost" method="post">
                                                        <div class="form-group m-b-20">
                                                            <label for="exampleInputEmail1">Post Title</label>
                                                            <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['PostTitle']); ?>" name="posttitle" readonly>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-box">
                                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Current Post Image</b></h4>
                                                                    <img src="images/postimages/big-image/<?php echo htmlentities($row['PostImage']); ?>" width="300" />
                                                                    <br />

                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="card-box">
                                                                <h4 class="m-b-30 m-t-0 header-title"><b>New Feature Image</b></h4>
                                                                <input type="file" class="form-control" id="postimage" name="postimage" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </br>
                                                    <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>
                                                    </form>
                                                </div>
                                            </div> <!-- end p-20 -->
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="card-body"> </div>
                        </div>
                    </div>
                    <!-- [ sample-page ] end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
        <!-- [ Main Content ] end -->
        <?php include('includes/footer.php'); ?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function() {

                $('.summernote').summernote({
                    height: 240, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>




    </body>

    </html>
<?php } ?>