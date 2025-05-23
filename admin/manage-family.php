<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{


// Code for Forever deletionparmdel
if($_GET['presid'])
{
    $id=intval($_GET['presid']);
    $query=mysqli_query($con,"delete from  tblfamily  where id='$id'");
    $delmsg="Member deleted forever";
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
                                    <h4 class="mb-0">Manager Family</h4>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <ul class="breadcrumb">
                                    <li class="breadcrumb-item"
                                      ><a href="../dashboard/index.html"><i class="ph ph-house"></i></a
                                    ></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">Our Family</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Manager Family</li>
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
                                
                                
                                
                                <?php if($delmsg){ ?>
                                <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($delmsg);?></div>
                                <?php } ?>
                                
                                
                                </div>

                                <div class="col-sm-12">
                                        <div class="demo-box m-t-20">
                                            
                                            <div class="table-responsive">
                                                <table class="table m-0 table-colored-bordered table-bordered-primary" id="myTable">
                                                    <thead>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>Member Photo</th>
                                                    <th>Member Name</th>
                                                    <th>Member Position</th>
                                                    <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    <?php
                                                    $query=mysqli_query($con,"SELECT * FROM tblfamily");
                                                    $rowcount=mysqli_num_rows($query);
                                                    if($rowcount==0)
                                                    {
                                                    ?>
                                                    <tr>
                                                    
                                                    <td colspan="4" align="center"><h3 style="color:red">No record found</h3></td>
                                                    <tr>
                                                    <?php
                                                    } else {
                                                        $i=0;
                                                    while($row=mysqli_fetch_array($query))
                                                    {
                                                    ?>
                                                     <tr> 
                                                    <td><p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo ++$i ?></p></td>
                                                    <td> <img  src="images/family/<?php echo $row['MemberPhoto']; ?>" style="width: 90px;height: 50px;"> </td>  
                                                    <td><b><p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['MemberName']);?></p></b></td>
                                                    <td><b><p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['MyPosition']);?></p></b></td>
                                                    
                                                    <td>
                                                    <a href="edit-family.php?pid=<?php echo htmlentities($row['id']);?>"><button type="button" class="btn btn-primary">Edit</button></a>
                                                        &nbsp;
                                                        <a href="manage-family.php?presid=<?php echo htmlentities($row['id']);?>&&action=perdel" onclick="return confirm('Do you really want to delete ?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                                     </td>
                                                     </tr>
                                                    <?php } }?>
        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                          </div>
                        </div>
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