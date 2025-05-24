<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Define status constants
define('STATUS_ACTIVE', 1);
define('STATUS_DRAFT', 2);
define('STATUS_SCHEDULED', 3);
define('STATUS_DELETED', 4);

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  if ($_GET['action'] = 'del') {
    $postid = intval($_GET['pid']);
    $query = mysqli_query($con, "update tblposts set Is_Active=0 where id='$postid'");
    if ($query) {
      $msg = "Post deleted ";
    } else {
      $error = "Something went wrong . Please try again.";
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
      <?php include('includes/leftsidebar.php'); ?>
    </nav>
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    <?php include('includes/topheader.php'); ?>
    <!-- [ Header ] end -->

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
                    <h4 class="mb-0">Manage News</h4>
                  </div>
                </div>
                <div class="col-md-12">
                  <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.html"><i class="ph ph-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0)">News Room</a></li>
                    <li class="breadcrumb-item" aria-current="page">Manage News</li>
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
                <div class="col-sm-12">
                  <div class="demo-box m-t-20">

                    <div class="row m-b-20">
                      <div class="col-lg-5">
                        <form method="GET" action="manage-news.php">
                          <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search posts by title or category" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit" style="height: 50px;">Search</button>
                            </span>
                          </div>
                        </form>
                      </div>
                    </div>

                    <div class="table-responsive">
                      <table class="table m-0 table-colored-bordered table-bordered-primary" id="myTableb">
                        <thead>
                          <tr>
                            <th>Post Image</th>
                            <th>Post Title</th>
                            <th>Category</th>
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                              <th>View</th>
                            <?php } ?>
                            <th>Status</th>
                            <th style="text-align:center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                          } else {
                            $page = 0;
                          }
                          $offset = $page * 20;
                          $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

                          $searchCondition = "";
                          if ($searchQuery != '') {
                            $searchCondition = " AND (tblposts.PostTitle LIKE '%$searchQuery%' OR tblcategory.CategoryName LIKE '%$searchQuery%')";
                          }

                          if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                          } else {
                            $page = 0;
                          }
                          $offset = $page * 20;

                          $query = mysqli_query($con, "SELECT tblposts.id as postid, tblposts.PostTitle as title, tblposts.PostImage, tblposts.views, tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory 
                                                                              FROM tblposts 
                                                                              LEFT JOIN tblcategory ON tblcategory.id=tblposts.CategoryId 
                                                                              LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId=tblposts.SubCategoryId 
                                                                              WHERE tblposts.Is_Active=1 $searchCondition 
                                                                              ORDER BY tblposts.id DESC 
                                                                              LIMIT $offset,20");


                          $rowcount = mysqli_num_rows($query);
                          if ($rowcount == 0) {
                          ?>
                            <tr>
                              <td colspan="4" align="center">
                                <h3 style="color:red">No record found</h3>
                              </td>
                            <tr>
                              <?php
                            } else {
                              $i = 0;
                              while ($row = mysqli_fetch_array($query)) {
                              ?>
                            <tr>
                              <td> <img src="images/thumb/<?php echo $row['PostImage']; ?>" style="width: 90px;height: 50px;"> </td>
                              <td><b>
                                  <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"> <?php echo htmlentities($row['title']); ?> </p>
                                </b></td>
                              <td>
                                <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"> <?php echo htmlentities($row['category']) ?></p>
                              </td>
                              <?php if ($_SESSION['role'] == 'admin') { ?>
                                <td>
                                  <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['views']) ?></p>
                                </td>
                              <?php } ?>

                              <td>
                                <?php if ($row['status'] != STATUS_DELETED): ?>
                                  <select class="post-status" data-post-id="<?php echo $row['postid']; ?>">
                                    <option value="<?php echo STATUS_ACTIVE; ?>" <?php echo $row['status'] == STATUS_ACTIVE ? 'selected' : ''; ?>>Active</option>
                                    <option value="<?php echo STATUS_DRAFT; ?>" <?php echo $row['status'] == STATUS_DRAFT ? 'selected' : ''; ?>>Draft</option>
                                    <option value="<?php echo STATUS_SCHEDULED; ?>" <?php echo $row['status'] == STATUS_SCHEDULED ? 'selected' : ''; ?>>Scheduled</option>
                                  </select>
                                <?php else: ?>
                                  <span>Deleted</span>
                                <?php endif; ?>
                                <?php if ($row['status'] == STATUS_SCHEDULED && !empty($row['ScheduledPublish'])): ?>
                                  <br><small>Scheduled for: <?php echo date('M j, Y H:i', strtotime($row['ScheduledPublish'])); ?></small>
                                <?php endif; ?>
                              </td>
                              <td>
                                <a href="../news-details?nid=<?php echo htmlentities($row['postid']); ?>" target="_blank"><button type="button" class="btn btn-sm btn-info">View</button></a>&nbsp;
                                <a href="edit-news.php?pid=<?php echo htmlentities($row['postid']); ?>"><button type="button" class="btn btn-sm btn-primary">Edit</button></a>&nbsp;
                                <a href="manage-posts.php?pid=<?php echo htmlentities($row['postid']); ?>&&action=del" onclick="return confirm('Your News Move In Recycle Bin')"> <button type="button" class="btn btn-sm btn-danger">Move To Bin</button></a>
                              </td>
                            </tr>
                        <?php }
                            } ?>

                        </tbody>
                      </table>
                      <?php
                      $qa = mysqli_query($con, "select tblposts.id as postid,tblposts.PostTitle as title,tblposts.views,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 ORDER BY tblposts.id DESC");
                      $all = mysqli_num_rows($qa);
                      $pageCount = (int)($all / 20);
                      ?>
                      <style type="text/css">
                        a[disabled="disabled"] {
                          pointer-events: none;
                        }
                      </style>
                      <div style="text-align: center;padding-top: 20px;">
                        <?php if ($page == 0) { ?>
                          <a href="javascript:void(0)" disabled="disabled"><button type="button" class="btn btn-primary">Previous Page</button></a>
                        <?php } else { ?>
                          <a href="manage-posts.php?page=<?php echo $page - 1 ?>">Previous Page</a>
                        <?php } ?>


                        <?php if ($page < $pageCount) { ?>
                          <a href="manage-posts.php?page=<?php echo $page + 1 ?>"><button type="button" class="btn btn-primary"> Next Page</button></a>
                        <?php } else { ?>
                          <a href="javascript:void(0)" disabled="disabled"><button type="button" class="btn btn-primary"> Next Page</button></a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


        function showAlert(icon, title) {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });

          Toast.fire({
            icon: icon,
            title: title
          });
        }

        $('.post-status').focus(function() {
          $(this).data('previous', $(this).val());
        });

        $('.post-status').change(function() {
          var postId = $(this).data('post-id');
          var newStatus = $(this).val();
          var selectElement = $(this);

          console.log('New status:', postId, newStatus);

          // Get old status from data
          var oldStatus = selectElement.data('previous');

          selectElement.prop('disabled', true);

          $.ajax({
            url: 'update-post-status.php',
            type: 'POST',
            data: {
              post_id: postId,
              new_status: newStatus
            },
            dataType: 'json', // <— this ensures response is parsed correctly
            success: function(response) {
              selectElement.prop('disabled', false);

              if (response.success === true) {
                showAlert('success', 'Status updated successfully!');
              } else {
                // Revert to old status
                selectElement.val(oldStatus);
                showAlert('error', response.message);
              }
            },
            error: function(xhr, status, error) {
              selectElement.prop('disabled', false);
              selectElement.val(oldStatus);
              showAlert('error', 'Error updating status. Please try again.');
              console.error('AJAX Error:', error);
            }
          });
        });
      });
    </script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>




  </body>

  </html>
<?php } ?>