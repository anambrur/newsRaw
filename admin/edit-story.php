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
$posttitle=$_POST['posttitle'];
$arr = explode(" ",$posttitle);
$url=implode("-",$arr);
$photostory=$_POST['photostory'];
$arr = explode(" ",$photostory);
$status=1;
$postid=intval($_GET['pid']);
$query=mysqli_query($con,"update tblstory set StoryTitle='$posttitle', PhotoStory='$photostory' where id='$postid'");
if($query)
{
$msg="Post updated ";
}
else{
$error="Something went wrong . Please try again.";
}
}
?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <title>Home | Gradient Able Dashboard Template</title>
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
                                    <h4 class="mb-0">Edit Story</h4>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <ul class="breadcrumb">
                                    <li class="breadcrumb-item"
                                      ><a href="../dashboard/index.html"><i class="ph ph-house"></i></a
                                    ></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">Photo Gallery</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Edit Story</li>
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
                        <?php
                        $postid=intval($_GET['pid']);
                        $query=mysqli_query($con,"SELECT * FROM tblstory WHERE id = '$postid' ");
                        while($row=mysqli_fetch_array($query))
                        {
                        ?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Photo Story Title</label>
                                                <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['StoryTitle']);?>" name="posttitle" placeholder="Enter title" required>
                                            </div>
                                            
                                           
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Photo Story Details</b></h4>
                                                        <textarea class="summernote" name="photostory" required><?php echo htmlentities($row['PhotoStory']);?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">  
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Story Photo</b></h4>
                                                        <img src="images/photostory/<?php echo htmlentities($row['StoryImage']);?>" width="300"/>
                                                        <br />
                                                        <a href="change-story.php?pid=<?php echo htmlentities($row['id']);?>">Update Story Photo</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update Photo Story</button>
                                        </div>
                                        </div> <!-- end p-20 -->
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                    <?php } ?>
                            
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
