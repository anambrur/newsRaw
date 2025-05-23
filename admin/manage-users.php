<?php 
session_start();
include('includes/config.php');

error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}else{

// For adding post  
    if(isset($_POST['AdminUserName']))
    {
        $options = ['cost' => 12];
        
        $_POST['Is_Active']=1;
        $_POST['CreationDate']=date('Y-m-d h:i:s');
        if(isset($_POST['id'])){
            if($_POST['AdminPassword']!=''){
                $_POST['AdminPassword']=password_hash($_POST['AdminPassword'], PASSWORD_BCRYPT, $options);
            }else{
                unset($_POST['AdminPassword']);
            }
            $query=$orm->update('tbladmin',$_POST,'id='.$_POST['id']);
        }else{
            $_POST['AdminPassword']=password_hash($_POST['AdminPassword'], PASSWORD_BCRYPT, $options);
            $query=$orm->insert('tbladmin',$_POST);
        }

        if($query>0){
            $msg="Changes successfully saved";
        }else{
            $error="Something went wrong . Please try again.";    
        } 
        // header('Location: reporter.php');
    }
    $orm->select('*');
    $orm->from('tbladmin');
    $orm->order_by('id','desc');
    $orm->where('Is_Active','=',1);
    $list=$orm->result();

if(isset($_GET['id'])){
    $orm->select('*');
    $orm->from('tbladmin');
    $orm->where('id','=',$_GET['id']);
    $edit=$orm->row();
}
if(isset($_GET['delete'])){
    $orm->delete('tbladmin','id='.$_GET['delete']);
    header('Location: manage-users.php');
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
                                    <h4 class="mb-0">Manage User</h4>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <ul class="breadcrumb">
                                    <li class="breadcrumb-item"
                                      ><a href="../dashboard/index.html"><i class="ph ph-house"></i></a
                                    ></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">User</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Manage User</li>
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
                            <div class="card">
                        
                            
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
                        
                        <div class="row" style="padding: 20px;">
                            <div class="col-md-12 col-md-offset-1">
                                <div class="p-6">
                             
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table m-0 table-colored-bordered table-bordered-primary" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=0; foreach ($list as $v) {?>
                                                    <tr>
                                                        <td><?php echo ++$i; ?></td>
                                                        <td><?php echo $v['AdminUserName'] ?></td>
                                                        <td><?php echo $v['AdminEmailId'] ?></td>
                                                        <td>
                                                            <a href="add-users.php?id=<?php echo $v['id'] ?>" class="btn btn-xs btn-success">Edit</a> | 
                                                            <a href="manage-users.php?delete=<?php echo $v['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                        
                                                    </tbody>
                                                </table>
                                    </div>
                                </div> <!-- end p-20 -->
                                </div> <!-- end col -->
                            </div>
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