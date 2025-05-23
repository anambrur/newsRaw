<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
header('location:index.php');
}
else{
// For adding post
if(isset($_POST['submit']))
{
$membername=$_POST['membername'];
$arr = explode(" ",$membername);

$myposition=$_POST['myposition'];
$arr = explode(" ",$myposition);

$memberdetails=$_POST['memberdetails'];
$arr = explode(" ",$memberdetails);

$url=implode("-",$arr);
$imgfile=$_FILES["postimage"]["name"];
// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["postimage"]["tmp_name"],"images/family/".$imgnewfile);
$status=1;
$query=mysqli_query($con,"insert into tblfamily (MemberName, MyPosition, MemberDetails, MemberPhoto) values('$membername','$myposition','$memberdetails','$imgnewfile')");
if($query)
{
$msg="Image Added successfully added ";
}
else{
$error="Something went wrong . Please try again.";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <title>Add Family</title>
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
        
        <!-- Old Admin Head Code Start -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" /
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <!-- Old Admin Head Code Start -->
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
                      <div class="pc-content" style="padding-top: 1px;background-color: #f3f3f3;">
                          
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                          <div class="page-block card mb-0">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col-md-12">
                                  <div class="page-header-title border-bottom pb-2 mb-2">
                                    <h4 class="mb-0">Add Family</h4>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <ul class="breadcrumb">
                                    <li class="breadcrumb-item"
                                      ><a href="../dashboard/index.html"><i class="ph ph-house"></i></a
                                    ></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">Manage Family</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Add Family</li>
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
                            <div class="card" style="padding: 25px;">

                        
                                <div class="row">
                                    <div class="col-sm-6">     
                                        <!---Success Message--->
                                        <?php if($msg){ ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                        </div>
                                        <?php } ?>
                                        <!---Error Message--->
                                        <?php if($error){ ?>
                                        <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="p-6">
                                            <div class="">
                                        <form name="addpost" method="post" enctype="multipart/form-data">


                                            <div class="form-group m-b-20">
                                                <p style="font-size:18px">Member Name </p>
                                                <input type="text" class="form-control" id="membername" name="membername" placeholder="Enter Family Member Name" required>
                                            </div>
                                            
                                            <div class="form-group m-b-20">
                                                <p style="font-size:18px">Member Position </p>
                                                <input type="text" class="form-control" id="myposition" name="myposition" placeholder="Enter Family Member Position" required>
                                            </div>
                                            
                                            <div class="row">
                                            <div class="col-sm-12">
                                               <div class="card-box">
                                                <h4 class="m-b-30 m-t-0 header-title"><b>Member Details</b></h4>
                                                <textarea class="summernote" name="memberdetails" required></textarea>
                                            </div>
                                            </div>
                                            </div>
                                    
                                            <div class="row" style="padding-bottom: 15px;">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Member Photo</b></h4>
                                                        <input type="file" class="form-control" id="postimage" name="postimage"  required>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Add Family Member</button>
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
                    
                    

           <?php include('includes/footer.php');?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->




         
    


    </body>
</html>
<?php } ?>
