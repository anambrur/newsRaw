<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
header('location:index.php');
}
else{
?>
   
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

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



    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
          
        <!-- [ Main Content ] start -->
        <div class="row">
          <div class="col-md-6 col-xl-3">
            <div class="card bg-grd-primary order-card">
              <div class="card-body">
                <h6 class="text-white">Categories Listed</h6>
                <?php $query=mysqli_query($con,"select * from tblcategory where Is_Active=1");
                    $countcat=mysqli_num_rows($query);
                ?>
                <h2 class="text-end text-white"><i class="feather icon-shopping-cart float-start"></i><span><?php echo htmlentities($countcat);?></span> </h2>
                <p class="m-b-0">Total Categories<span class="float-end"><?php echo htmlentities($countcat);?> </span></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card bg-grd-success order-card">
              <div class="card-body">
                <h6 class="text-white">News In Draft</h6>
                <?php $query=mysqli_query($con,"select * from tblposts where Is_Active=0");
                    $countposts=mysqli_num_rows($query);
                ?>
                <h2 class="text-end text-white"><i class="feather icon-tag float-start"></i><span><?php echo htmlentities($countposts);?></span> </h2>
                <p class="m-b-0">Total Draft News<span class="float-end"><?php echo htmlentities($countposts);?></span></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card bg-grd-warning order-card">
              <div class="card-body">
                <h6 class="text-white">Total User</h6>
                <?php $query=mysqli_query($con,"select * from tbladmin where Is_Active=1");
                    $countcat=mysqli_num_rows($query);
                ?>
                <h2 class="text-end text-white"><i class="feather icon-repeat float-start"></i><span><?php echo htmlentities($countcat);?></span></h2>
                <p class="m-b-0">Total User<span class="float-end"><?php echo htmlentities($countcat);?></span></p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-xl-3">
            <div class="card bg-grd-danger order-card">
              <div class="card-body">
                <h6 class="text-white">Total Visitor</h6>
                <h2 class="text-end text-white"><i class="feather icon-award float-start"></i><span>1158963</span></h2>
                <p class="m-b-0">This Month<span class="float-end">56156</span></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-7">
            <div class="card">
              <div class="card-header">
                <h5>Server Loction Backup</h5>
              </div>
              <div class="card-body">
                <div id="world-map-markers" class="set-map" style="height: 365px"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-5">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h5>New Order From United States</h5>
                <div class="dropdown">
                  <a
                    class="avtar avtar-xs btn-link-secondary dropdown-toggle arrow-none"
                    href="#"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    ><i class="material-icons-two-tone f-18">more_vert</i></a
                  >
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">View</a>
                    <a class="dropdown-item" href="#">Edit</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="media align-items-center">
                  <div class="avtar avtar-s bg-light-primary flex-shrink-0">
                    <i class="ph ph-money f-20"></i>
                  </div>
                  <div class="media-body ms-3">
                    <p class="mb-0 text-muted">This Month Visitor</p>
                    <h5 class="mb-0">249.95</h5>
                  </div>
                </div>
                <div id="earnings-users-chart"></div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <div class="media align-items-center">
                      <div class="avtar avtar-s bg-grd-primary flex-shrink-0">
                        <i class="ph ph-money f-20 text-white"></i>
                      </div>
                      <div class="media-body ms-2">
                        <p class="mb-0 text-muted">Total Profit</p>
                        <h6 class="mb-0">$1,783</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="media align-items-center">
                      <div class="avtar avtar-s bg-grd-success flex-shrink-0">
                        <i class="ph ph-shopping-cart text-white f-20"></i>
                      </div>
                      <div class="media-body ms-2">
                        <p class="mb-0 text-muted">Product Sold</p>
                        <h6 class="mb-0">15,830</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    
    <!-- [ Main Content ] end -->
<?php include('includes/footer.php');?>

<?php } ?>
