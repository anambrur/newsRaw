<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
header('location:index.php');
}
else{
if(isset($_POST['update']))
{
$name=$_POST['name'];
$homemetadescription=$_POST['homemetadescription'];
$homemetakeyword=$_POST['homemetakeyword'];
$url=$_POST['url'];
$urlwww=$_POST['urlwww'];
$detailspagekeyword=$_POST['detailspagekeyword'];
$footertext=$_POST['footertext'];
$footcopyright=$_POST['footcopyright'];

$query=mysqli_query($con,"update settings set name ='$name'");
$query=mysqli_query($con,"update settings set homemetadescription ='$homemetadescription'");
$query=mysqli_query($con,"update settings set homemetakeyword ='$homemetakeyword'");
$query=mysqli_query($con,"update settings set url ='$url'");
$query=mysqli_query($con,"update settings set urlwww ='$urlwww'");
$query=mysqli_query($con,"update settings set detailspagekeyword ='$detailspagekeyword'");
$query=mysqli_query($con,"update settings set footertext ='$footertext'");
$query=mysqli_query($con,"update settings set footcopyright ='$footcopyright'");

$query=mysqli_query($con,"update settings set url  ='$url'");

if($query)
{
$msg="Wetget updated ";
}
else{
$error="Something went wrong . Please try again.";
}
}
if(isset($_GET['siteview'])){
    mysqli_query($con,"UPDATE tblposts SET views=0");
    mysqli_query($con,"UPDATE settings SET views=0");
    header("Location: site_config.php");
}
?>
    <!DOCTYPE html>
    <html lang="en">
  <head>
    <title>Site Settings</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Gradient Able is trending dashboard template made using Bootstrap 5 design framework. Gradient Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies."
    />
    <meta
      name="keywords"
      content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard"
    />
    <meta name="author" content="codedthemes" />
    <link href="https://fonts.cdnfonts.com/css/solaimanlipi" rel="stylesheet">
    <style>
    @import url('https://fonts.cdnfonts.com/css/solaimanlipi');
    </style>
    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon" />

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
    <?php include('includes/leftsidebar.php');?>
</nav>
<!-- [ Sidebar Menu ] end -->
 <!-- [ Header Topbar ] start -->
    <?php include('includes/topheader.php');?>
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
                                    <h4 class="mb-0">Site Config</h4>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <ul class="breadcrumb">
                                    <li class="breadcrumb-item"
                                      ><a href="../dashboard/index.html"><i class="ph ph-house"></i></a >
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">Settings</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Site Config</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        </br>
                
                        <!-- [ Main Content ] start -->
                                
                        <div class="page-header">
                          <div class="page-block card mb-0">
                            <div class="card-body">
                                
                            <div class="row">
                            <div class="col-sm-6">
                                <!--Success Message-->
                                <?php if($msg){ ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                </div>
                                <?php } ?>
                                <!--Error Message-->
                                <?php if($error){ ?>
                                <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        $query=mysqli_query($con,"SELECT * FROM settings WHERE id = 1");
                        while($row=mysqli_fetch_array($query))
                        {
                        ?>
                        <div class="row">
                            <div class="col-md-12 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
                                        <h1>Home Page SEO Setup</h1> 
                                        <div class="form-group m-b-20">
                                         <p style="font-size:18px">Home Page SEO Meta Title</p>
                                         <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlentities($row['name']);?>" required>
                                        </div>
                                        
                                        <div class="form-group m-b-20">
                                         <p style="font-size:18px">Home Page SEO Meta Description</p>
                                         <input type="text" class="form-control" id="homemetadescription" name="homemetadescription" value="<?php  echo htmlentities($row['homemetadescription']);?>" required>
                                        </div>
                                        
                                        <div class="form-group m-b-20">
                                         <p style="font-size:18px">Home Page SEO Meta Keyword</p>
                                         <input type="text" class="form-control" id="homemetakeyword" name="homemetakeyword" value="<?php  echo htmlentities($row['homemetakeyword']);?>" required>
                                        </div>
                                        
                                        <div class="form-group m-b-20">
                                         <p style="font-size:18px">Home Page SEO Site Url With HTTPS</p>
                                         <input type="text" class="form-control" id="url" name="url" value="<?php  echo htmlentities($row['url']);?>" required>
                                        </div>
                                        
                                        <div class="form-group m-b-20">
                                         <p style="font-size:18px">Home Page SEO Site Url With WWW</p>
                                         <input type="text" class="form-control" id="urlwww" name="urlwww" value="<?php  echo htmlentities($row['urlwww']);?>" required>
                                        </div>
                                        
                                        <div class="form-group m-b-20">
                                         <p style="font-size:18px">Details Page SEO Meta Keyword</p>
                                         <input type="text" class="form-control" id="detailspagekeyword" name="detailspagekeyword" value="<?php  echo htmlentities($row['detailspagekeyword']);?>" required>
                                        </div>
                                        
                                        <div class="form-group m-b-20">
                                         <p style="font-size:18px">Footer Text</p>
                                         <input type="text" class="form-control" id="footertext" name="footertext" value="<?php  echo htmlentities($row['footertext']);?>" required>
                                        </div>
                                        
                                        <div class="form-group m-b-20">
                                         <p style="font-size:18px">Footer CopyRight</p>
                                         <input type="text" class="form-control" id="footcopyright" name="footcopyright" value="<?php  echo htmlentities($row['footcopyright']);?>" required>
                                        </div>

                                            <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Save</button>
                                            <a href="site_config.php?siteview=true" class="btn btn-danger waves-effect waves-light">Reset Page Views</a>
                                        </div>
                                        </div> <!-- end p-20 -->
                                        </div> <!-- end col -->
                                    </div>
                                    <?php } ?>
                                    
            
                                    <?php
                                        $query=mysqli_query($con,"SELECT * FROM settings WHERE id = 1");
                                        while($row=mysqli_fetch_array($query))
                                        {
                                    ?>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-12 col-md-offset-1" >
                                                    <div class="p-6">
                                                        <div class="">
                                                            <h1>Website Logo Favicon Setup</h1> 
                                                            <form name="addpost" method="post">
                                                            <div class="row">
                                                                <div class="col-sm-12" style="background-color: #f8f8f8;padding: 20px;">
                                                                    <div class="card-box">
                                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Hedder-Top Logo</b></h4>  
                                                                        <img style="margin: 16px" src="../images/<?php echo htmlentities($row['hedderlogo']);?>" width="100"/>
                                                                        <br />
                                                                        <a class="btn btn-success waves-effect waves-light" href="x-settings-hadder-logo-update.php">UPDATE</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </br>
                                                            <div class="row">
                                                                <div class="col-sm-12" style="background-color: #f8f8f8;padding: 20px;">
                                                                    <div class="card-box">
                                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Website Favicon</b></h4>
                                                                    <img style="margin: 16px" src="../images/<?php echo htmlentities($row['favicon']);?>" width="50px"/>
                                                                    <br />
                                                                    <a class="btn btn-success waves-effect waves-light" href="x-settings-favicon-update.php">UPDATE</a>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            </br>
                                                            <div class="row">
                                                                <div class="col-sm-12" style="background-color: #f8f8f8;padding: 20px;">
                                                                    <div class="card-box">
                                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Footer-Bottom Logo</b></h4>
                                                                        <img style="margin: 16px" src="../images/<?php echo htmlentities($row['footerlogo']);?>" width="100"/>
                                                                        <br />
                                                                        <a class="btn btn-success waves-effect waves-light" href="x-settings-footer-logo-update.php">UPDATE</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </br>
                                            </div>
                                            </div> <!-- end p-20 -->
                                            </div> <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                        <?php } ?>
                            </div> <!-- container -->
                    
                    
                    
                              <div class="card-body"> </div>
                            </div>
                          </div>
                          <!-- [ sample-page ] end -->
                        </div>
                        <!-- [ Main Content ] end -->
                      </div>
                    </div>
                    <!-- [ Main Content ] end -->
                <?php include('includes/footer.php');?>

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

        jQuery(document).ready(function(){

            $('.summernote').summernote({
                    height: 240,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
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