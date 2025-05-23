<?php 
session_start();
include('includes/config.php');

error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}else{

// For adding post  
    if(isset($_POST['name']))
    {
        if(isset($_POST['reporterID'])){
            if($_FILES["photo"]["name"]!=''){
                $imgfile=$_FILES["photo"]["name"];
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        $imgnewfile=md5($imgfile).$extension;
        move_uploaded_file($_FILES["photo"]["tmp_name"],"images/reporterphoto/".$imgnewfile);
        $_POST['photo']=$imgnewfile;
    }else{
        unset($_POST['photo']);
    }
            $query=$orm->update('reporter',$_POST,'reporterID='.$_POST['reporterID']);
        }else{
            $imgfile=$_FILES["photo"]["name"];
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        $imgnewfile=md5($imgfile).$extension;
        move_uploaded_file($_FILES["photo"]["tmp_name"],"images/reporterphoto/".$imgnewfile);
        $_POST['photo']=$imgnewfile;
            $query=$orm->insert('reporter',$_POST);
        }

        if($query>0)
        {
            $msg="Changes successfully saved ";
        }
        else{
            $error="Something went wrong . Please try again.";    
        } 
        // header('Location: reporter.php');
    }
    $orm->select('*');
    $orm->from('reporter');
    $orm->order_by('reporterID','desc');
    $orm->where('deleted','=','false');
    $list=$orm->result();

if(isset($_GET['id'])){
    $orm->select('*');
    $orm->from('reporter');
    $orm->where('reporterID','=',$_GET['id']);
    $edit=$orm->row();
}
if(isset($_GET['delete'])){
    $orm->delete('reporter','reporterID='.$_GET['delete']);
    header('Location: reporter.php');
}
    ?>
   <html lang="en">
  <head>
    <title>Add Repoter</title>
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
                                    <h4 class="mb-0">Add Repoter</h4>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <ul class="breadcrumb">
                                    <li class="breadcrumb-item"
                                      ><a href="../dashboard/index.html"><i class="ph ph-house"></i></a
                                    ></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">Repoter</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Add Repoter</li>
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
                            
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="p-6">
                                        <div class="">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <?php if(isset($edit)){ ?>
                                                <input type="hidden" name="reporterID" value="<?php echo @$edit['reporterID'] ?>">
                                                <?php } ?>
                                             <div class="form-group m-b-20">
                                                <p style="font-size:18px">Reporter Name</p>
                                                <input type="text" class="form-control"  name="name" placeholder="Enter Name" required value="<?php echo @$edit['name'] ?>">
                                            </div>
                                            <div class="form-group m-b-20">
                                                <p style="font-size:18px">Photo</p>
                                                <input type="file" class="form-control"  name="photo" placeholder="Enter Name" required>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Add Repoter</button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                        </form>
                                    </div>
                                    <hr>
                                    </div>
                                </div>
                            </div> <!-- end p-20 -->
                                
                                
                                
                                
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