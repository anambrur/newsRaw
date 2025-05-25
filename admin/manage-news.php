<?php
ob_start();
session_start();
include('includes/config.php');
error_reporting(0);

// Define status constants
define('STATUS_ACTIVE', 1);
define('STATUS_DRAFT', 2);
define('STATUS_SCHEDULED', 3);
define('STATUS_BIN', 4);

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
  exit();
}

// Function to build query string while preserving existing parameters
function getQueryString($exclude = [])
{
  $params = [];
  foreach ($_GET as $key => $value) {
    if (!in_array($key, $exclude)) {
      $params[$key] = $value;
    }
  }
  return $params ? '?' . http_build_query($params) : '';
}

// Handle delete action first
if (isset($_GET['action']) && $_GET['action'] == 'del') {
  $postid = intval($_GET['pid']);
  $query = mysqli_query($con, "UPDATE tblposts SET Is_Active=" . STATUS_BIN . " WHERE id='$postid'");

  if ($query) {
    $_SESSION['msg'] = "Post moved to trash";
  } else {
    $_SESSION['error'] = "Something went wrong. Please try again.";
  }

  // Clear buffer before redirect
  ob_end_clean();
  header("Location: manage-news.php" . getQueryString(['pid', 'action']));
  exit();
}

// Handle status filter if set
// $statusFilter = "";
// if (isset($_GET['status']) && in_array($_GET['status'], [STATUS_ACTIVE, STATUS_DRAFT, STATUS_SCHEDULED])) {
//   $statusFilter = " AND tblposts.Is_Active = " . intval($_GET['status']);
// }

$statusFilter = " AND tblposts.Is_Active != " . STATUS_BIN; // Default: Exclude bin items
if (isset($_GET['status']) && in_array($_GET['status'], [STATUS_ACTIVE, STATUS_DRAFT, STATUS_SCHEDULED, STATUS_BIN])) {
    if ($_GET['status'] == STATUS_BIN) {
        // When specifically viewing bin, show only bin items
        $statusFilter = " AND tblposts.Is_Active = " . STATUS_BIN;
    } else {
        // When viewing other statuses, show only that status
        $statusFilter = " AND tblposts.Is_Active = " . intval($_GET['status']);
    }
}

// Number of posts per page
$postsPerPage = 10;

// Get current page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $postsPerPage;

// Search query - use prepared statements for security
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchCondition = "";
if ($searchQuery != '') {
  $searchCondition = " AND (tblposts.PostTitle LIKE ? OR tblcategory.CategoryName LIKE ?)";
}

// Get total number of posts for pagination
$totalQueryStr = "SELECT COUNT(*) as total FROM tblposts 
                 LEFT JOIN tblcategory ON tblcategory.id=tblposts.CategoryId 
                 LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId=tblposts.SubCategoryId 
                 WHERE 1=1 $statusFilter";

if ($searchQuery != '') {
  $totalQueryStr .= $searchCondition;
  $stmt = mysqli_prepare($con, $totalQueryStr);
  $searchParam = "%$searchQuery%";
  mysqli_stmt_bind_param($stmt, "ss", $searchParam, $searchParam);
  mysqli_stmt_execute($stmt);
  $totalResult = mysqli_stmt_get_result($stmt);
  $totalRow = mysqli_fetch_assoc($totalResult);
} else {
  $totalResult = mysqli_query($con, $totalQueryStr);
  $totalRow = mysqli_fetch_assoc($totalResult);
}

$totalPosts = $totalRow['total'];
$totalPages = ceil($totalPosts / $postsPerPage);

// Get posts for current page
$queryStr = "SELECT tblposts.id as postid, tblposts.PostTitle as title, tblposts.PostImage, 
            tblposts.views, tblposts.Is_Active as status, tblposts.ScheduledPublish,
            tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory 
            FROM tblposts 
            LEFT JOIN tblcategory ON tblcategory.id=tblposts.CategoryId 
            LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId=tblposts.SubCategoryId 
            WHERE 1=1 $statusFilter";

if ($searchQuery != '') {
  $queryStr .= $searchCondition;
  $queryStr .= " ORDER BY tblposts.id DESC LIMIT ?, ?";
  $stmt = mysqli_prepare($con, $queryStr);
  $searchParam = "%$searchQuery%";
  mysqli_stmt_bind_param($stmt, "ssii", $searchParam, $searchParam, $offset, $postsPerPage);
  mysqli_stmt_execute($stmt);
  $query = mysqli_stmt_get_result($stmt);
} else {
  $queryStr .= " ORDER BY tblposts.id DESC LIMIT $offset, $postsPerPage";
  $query = mysqli_query($con, $queryStr);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Manage Posts | Gradient Able Dashboard Template</title>
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
        <div class="col-sm-12">
          <div class="card" style="padding: 25px;">
            <?php if (isset($_SESSION['msg'])) { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['msg'];
                unset($_SESSION['msg']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php } ?>
            <?php if (isset($_SESSION['error'])) { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php } ?>

            <div class="row m-b-20">
              <div class="col-lg-5">
                <form method="GET" action="manage-news.php" class="row">
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="search" placeholder="Search posts by title or category" value="<?php echo htmlspecialchars($searchQuery); ?>">
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-primary" type="submit">Search</button>
                  </div>
                </form>
              </div>
              <div class="col-lg-5">
                <form method="GET" action="manage-news.php" class="row">
                  <div class="col-md-8">
                    <select name="status" class="form-control" onchange="this.form.submit()">
                      <option value="">All Statuses</option>
                      <option value="<?php echo STATUS_ACTIVE; ?>" <?php echo (isset($_GET['status']) && $_GET['status'] == STATUS_ACTIVE) ? 'selected' : ''; ?>>Active</option>
                      <option value="<?php echo STATUS_DRAFT; ?>" <?php echo (isset($_GET['status']) && $_GET['status'] == STATUS_DRAFT) ? 'selected' : ''; ?>>Draft</option>
                      <option value="<?php echo STATUS_SCHEDULED; ?>" <?php echo (isset($_GET['status']) && $_GET['status'] == STATUS_SCHEDULED) ? 'selected' : ''; ?>>Scheduled</option>
                      <option value="<?php echo STATUS_BIN; ?>" <?php echo (isset($_GET['status']) && $_GET['status'] == STATUS_BIN) ? 'selected' : ''; ?>>Deleted</option>
                    </select>
                  </div>

                  <div class="col-md-4">
                    <?php if (isset($_GET['search']) || isset($_GET['status'])) { ?>
                      <a href="manage-posts.php" class="btn btn-secondary">Reset</a>
                    <?php } ?>
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
                  $rowcount = mysqli_num_rows($query);
                  if ($rowcount == 0) {
                  ?>
                    <tr>
                      <td colspan="6" align="center">
                        <h3 style="color:red">No record found</h3>
                      </td>
                    <tr>
                      <?php
                    } else {
                      while ($row = mysqli_fetch_array($query)) {
                      ?>
                    <tr>
                      <td><img src="images/thumb/<?php echo htmlspecialchars($row['PostImage']); ?>" style="width: 90px;height: 50px;"></td>
                      <td><b>
                          <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['title']); ?></p>
                        </b></td>
                      <td>
                        <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['category']) ?></p>
                      </td>
                      <?php if ($_SESSION['role'] == 'admin') { ?>
                        <td>
                          <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['views']) ?></p>
                        </td>
                      <?php } ?>

                      <td>
                        <?php if ($row['status'] != STATUS_BIN): ?>
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
                        <a href="../news-details?nid=<?php echo htmlentities($row['postid']); ?>" target="_blank" class="btn btn-sm btn-info">View</a>
                        <a href="edit-news.php?pid=<?php echo htmlentities($row['postid']); ?>" class="btn btn-sm btn-primary">Edit</a>
                        <?php if ($row['status'] != STATUS_BIN): ?>
                          <a href="manage-news.php?pid=<?php echo htmlentities($row['postid']); ?>&action=del" onclick="return confirm('Your News will be moved to trash')" class="btn btn-sm btn-danger">Move To Bin</a>
                        <?php else: ?>
                          <a href="restore-post.php?pid=<?php echo htmlentities($row['postid']); ?>" class="btn btn-sm btn-success">Restore</a>
                        <?php endif; ?>
                      </td>
                    </tr>
                <?php
                      }
                    } ?>
                </tbody>
              </table>

              <!-- Pagination -->
              <!-- Pagination -->
              <div class="row mt-3">
                <div class="col-md-12">
                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                      <?php
                      // Build query parameters for pagination links
                      $queryParams = [];
                      if (isset($_GET['status']) && $_GET['status'] != '') {
                        $queryParams['status'] = $_GET['status'];
                      }
                      if (isset($_GET['search']) && $_GET['search'] != '') {
                        $queryParams['search'] = $_GET['search'];
                      }

                      if ($page > 1):
                        $queryParams['page'] = $page - 1;
                        $prevLink = 'manage-posts.php?' . http_build_query($queryParams);
                      ?>
                        <li class="page-item">
                          <a class="page-link" href="<?php echo $prevLink; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                      <?php else: ?>
                        <li class="page-item disabled">
                          <span class="page-link">&laquo;</span>
                        </li>
                      <?php endif; ?>

                      <?php
                      // Show page numbers
                      $startPage = max(1, $page - 2);
                      $endPage = min($totalPages, $page + 2);

                      for ($i = $startPage; $i <= $endPage; $i++):
                        $queryParams['page'] = $i;
                        $pageLink = 'manage-posts.php?' . http_build_query($queryParams);
                      ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                          <a class="page-link" href="<?php echo $pageLink; ?>"><?php echo $i; ?></a>
                        </li>
                      <?php endfor; ?>

                      <?php if ($page < $totalPages):
                        $queryParams['page'] = $page + 1;
                        $nextLink = 'manage-posts.php?' . http_build_query($queryParams);
                      ?>
                        <li class="page-item">
                          <a class="page-link" href="<?php echo $nextLink; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      <?php else: ?>
                        <li class="page-item disabled">
                          <span class="page-link">&raquo;</span>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </nav>
                  <div class="text-center">
                    <small>Showing <?php echo ($offset + 1); ?> to <?php echo min($offset + $postsPerPage, $totalPosts); ?> of <?php echo $totalPosts; ?> entries</small>
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
  <?php include('includes/footer.php'); ?>

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
        height: 240,
        minHeight: null,
        maxHeight: null,
        focus: false
      });

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
        var oldStatus = selectElement.data('previous');

        selectElement.prop('disabled', true);

        $.ajax({
          url: 'update-post-status.php',
          type: 'POST',
          data: {
            post_id: postId,
            new_status: newStatus
          },
          dataType: 'json',
          success: function(response) {
            selectElement.prop('disabled', false);

            if (response.success === true) {
              showAlert('success', 'Status updated successfully!');
              // Reload the page to reflect changes
              setTimeout(function() {
                window.location.reload();
              }, 1500);
            } else {
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
</body>

</html>