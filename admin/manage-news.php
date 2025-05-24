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
  exit();
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'del') {
  $postid = intval($_GET['pid']);
  $query = mysqli_query($con, "UPDATE tblposts SET Is_Active=" . STATUS_DELETED . " WHERE id='$postid'");
  if ($query) {
    $_SESSION['msg'] = "Post moved to trash";
  } else {
    $_SESSION['error'] = "Something went wrong. Please try again.";
  }
  header("Location: manage-news.php");
  exit();
}

// Handle status filter if set
$statusFilter = "";
if (isset($_GET['status']) && in_array($_GET['status'], [STATUS_ACTIVE, STATUS_DRAFT, STATUS_SCHEDULED, STATUS_DELETED])) {
  $statusFilter = " AND tblposts.Is_Active = " . intval($_GET['status']);
}

// Number of posts per page
$postsPerPage = 10;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Manage News | Admin Panel</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="https://fonts.cdnfonts.com/css/solaimanlipi" rel="stylesheet">
  <style>
    @import url('https://fonts.cdnfonts.com/css/solaimanlipi');
  </style>
  <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../assets/css/plugins/jsvectormap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/fonts/tabler-icons.min.css" />
  <link rel="stylesheet" href="assets/fonts/feather.css" />
  <link rel="stylesheet" href="assets/fonts/fontawesome.css" />
  <link rel="stylesheet" href="assets/fonts/material.css" />
  <link rel="stylesheet" href="assets/css/style.css" id="main-style-link" />
  <link rel="stylesheet" href="assets/css/style-preset.css" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    select.post-status {
      padding: 5px;
      border-radius: 4px;
      border: 1px solid #ddd;
      cursor: pointer;
      width: 120px;
    }

    .status-filter {
      margin-bottom: 15px;
    }

    .status-filter a {
      margin-right: 10px;
      padding: 5px 10px;
      border-radius: 4px;
    }

    .status-filter a.active {
      background: #4b38b3;
      color: white;
    }

    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
      margin: 0 5px;
      padding: 5px 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      display: inline-block;
      margin-bottom: 5px;
    }

    .pagination a.active {
      background: #4b38b3;
      color: white;
      border-color: #4b38b3;
    }

    a[disabled="disabled"] {
      pointer-events: none;
      opacity: 0.6;
    }

    .swal2-popup {
      font-size: 1.6rem !important;
    }
  </style>
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
            <div class="row">
              <div class="col-sm-12">
                <div class="demo-box m-t-20">
                  <!-- Status Filter -->
                  <div class="status-filter">
                    <strong>Filter by Status: </strong>
                    <a href="manage-news.php" class="<?php echo !isset($_GET['status']) ? 'active' : ''; ?>">All</a>
                    <a href="manage-news.php?status=<?php echo STATUS_ACTIVE; ?>" class="<?php echo (isset($_GET['status']) && $_GET['status'] == STATUS_ACTIVE) ? 'active' : ''; ?>">Active</a>
                    <a href="manage-news.php?status=<?php echo STATUS_DRAFT; ?>" class="<?php echo (isset($_GET['status']) && $_GET['status'] == STATUS_DRAFT) ? 'active' : ''; ?>">Draft</a>
                    <a href="manage-news.php?status=<?php echo STATUS_SCHEDULED; ?>" class="<?php echo (isset($_GET['status']) && $_GET['status'] == STATUS_SCHEDULED) ? 'active' : ''; ?>">Scheduled</a>
                    <a href="manage-news.php?status=<?php echo STATUS_DELETED; ?>" class="<?php echo (isset($_GET['status']) && $_GET['status'] == STATUS_DELETED) ? 'active' : ''; ?>">Trash</a>
                  </div>


                  <div class="row m-b-20">
                    <div class="col-lg-5">
                      <form method="GET" action="manage-news.php">
                        <?php if (isset($_GET['status'])): ?>
                          <input type="hidden" name="status" value="<?php echo htmlspecialchars($_GET['status']); ?>">
                        <?php endif; ?>
                        <div class="input-group">
                          <input type="text" class="form-control" name="search" placeholder="Search posts by title or category" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
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
                            <th>Views</th>
                          <?php } ?>
                          <th>Status</th>
                          <th style="text-align:center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $page = isset($_GET['page']) ? max(0, intval($_GET['page'])) : 0;
                        $offset = $page * $postsPerPage;
                        $searchQuery = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

                        $searchCondition = "";
                        if (!empty($searchQuery)) {
                          $searchCondition = " AND (tblposts.PostTitle LIKE '%$searchQuery%' OR tblcategory.CategoryName LIKE '%$searchQuery%')";
                        }

                        $query = mysqli_query($con, "SELECT tblposts.id as postid, tblposts.PostTitle as title, 
                                                    tblposts.PostImage, tblposts.views, tblposts.Is_Active as status, 
                                                    tblposts.ScheduledPublish, tblcategory.CategoryName as category, 
                                                    tblsubcategory.Subcategory as subcategory 
                                                    FROM tblposts 
                                                    LEFT JOIN tblcategory ON tblcategory.id=tblposts.CategoryId 
                                                    LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId=tblposts.SubCategoryId 
                                                    WHERE 1=1 $statusFilter $searchCondition 
                                                    ORDER BY tblposts.id DESC 
                                                    LIMIT $offset, $postsPerPage");

                        if (mysqli_num_rows($query) == 0) {
                        ?>
                          <tr>
                            <td colspan="<?php echo ($_SESSION['role'] == 'admin') ? 6 : 5; ?>" align="center">
                              <h3 style="color:red">No records found</h3>
                            </td>
                          </tr>
                          <?php
                        } else {
                          while ($row = mysqli_fetch_array($query)) {
                          ?>
                            <tr id="post-row-<?php echo $row['postid']; ?>">
                              <td><img src="images/thumb/<?php echo htmlspecialchars($row['PostImage']); ?>" style="width: 90px;height: 50px;"></td>
                              <td><b>
                                  <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['title']); ?></p>
                                </b></td>
                              <td>
                                <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['category']); ?></p>
                              </td>
                              <?php if ($_SESSION['role'] == 'admin') { ?>
                                <td>
                                  <p style="font-family: 'SolaimanLipi', sans-serif; font-size:18px"><?php echo htmlentities($row['views']); ?></p>
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
                              <td style="text-align:center">
                                <?php if ($row['status'] != STATUS_DELETED): ?>
                                  <a href="../news-details?nid=<?php echo $row['postid']; ?>" target="_blank" class="btn btn-info">View</a>
                                  <a href="edit-news.php?pid=<?php echo $row['postid']; ?>" class="btn btn-primary">Edit</a>
                                  <a href="manage-news.php?pid=<?php echo $row['postid']; ?>&action=del" onclick="return confirm('Move this news to trash?')" class="btn btn-danger">Trash</a>
                                <?php else: ?>
                                  <a href="restore-post.php?pid=<?php echo $row['postid']; ?>" class="btn btn-success">Restore</a>
                                  <a href="delete-post-permanent.php?pid=<?php echo $row['postid']; ?>" onclick="return confirm('Permanently delete this post?')" class="btn btn-danger">Delete</a>
                                <?php endif; ?>
                              </td>
                            </tr>
                        <?php
                          }
                        }
                        ?>
                      </tbody>
                    </table>

                    <?php
                    // Pagination
                    $countQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM tblposts WHERE 1=1 $statusFilter $searchCondition");
                    $totalRows = mysqli_fetch_assoc($countQuery)['total'];
                    $pageCount = ceil($totalRows / $postsPerPage);

                    if ($pageCount > 1) {
                      echo '<div class="pagination">';

                      // Previous link
                      if ($page > 0) {
                        echo '<a href="manage-news.php?page=' . ($page - 1);
                        if (isset($_GET['status'])) echo '&status=' . $_GET['status'];
                        if (isset($_GET['search'])) echo '&search=' . $_GET['search'];
                        echo '">Previous</a>';
                      } else {
                        echo '<a href="javascript:void(0)" disabled>Previous</a>';
                      }

                      // Page links - show limited numbers with ellipsis
                      $maxPagesToShow = 5;
                      $startPage = max(0, $page - floor($maxPagesToShow / 2));
                      $endPage = min($pageCount - 1, $startPage + $maxPagesToShow - 1);

                      if ($startPage > 0) {
                        echo '<a href="manage-news.php?page=0';
                        if (isset($_GET['status'])) echo '&status=' . $_GET['status'];
                        if (isset($_GET['search'])) echo '&search=' . $_GET['search'];
                        echo '">1</a>';
                        if ($startPage > 1) echo '<span>...</span>';
                      }

                      for ($i = $startPage; $i <= $endPage; $i++) {
                        echo '<a href="manage-news.php?page=' . $i;
                        if (isset($_GET['status'])) echo '&status=' . $_GET['status'];
                        if (isset($_GET['search'])) echo '&search=' . $_GET['search'];
                        echo '"' . ($i == $page ? ' class="active"' : '') . '>' . ($i + 1) . '</a>';
                      }

                      if ($endPage < $pageCount - 1) {
                        if ($endPage < $pageCount - 2) echo '<span>...</span>';
                        echo '<a href="manage-news.php?page=' . ($pageCount - 1);
                        if (isset($_GET['status'])) echo '&status=' . $_GET['status'];
                        if (isset($_GET['search'])) echo '&search=' . $_GET['search'];
                        echo '">' . $pageCount . '</a>';
                      }

                      // Next link
                      if ($page < $pageCount - 1) {
                        echo '<a href="manage-news.php?page=' . ($page + 1);
                        if (isset($_GET['status'])) echo '&status=' . $_GET['status'];
                        if (isset($_GET['search'])) echo '&search=' . $_GET['search'];
                        echo '">Next</a>';
                      } else {
                        echo '<a href="javascript:void(0)" disabled>Next</a>';
                      }

                      echo '</div>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body"></div>
          </div>
        </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <?php include('includes/footer.php'); ?>

  <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/detect.js"></script>
  <script src="assets/js/fastclick.js"></script>
  <script src="assets/js/jquery.blockUI.js"></script>
  <script src="assets/js/waves.js"></script>
  <script src="assets/js/jquery.slimscroll.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="../plugins/switchery/switchery.min.js"></script>
  <script src="../plugins/summernote/summernote.min.js"></script>
  <script src="../plugins/select2/js/select2.min.js"></script>
  <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>
  <script src="assets/pages/jquery.blog-add.init.js"></script>
  <script src="assets/js/jquery.core.js"></script>
  <script src="assets/js/jquery.app.js"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- AJAX Script for Status Update -->
  <script>
    $(document).ready(function() {
      // SweetAlert toast notification
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

      $('.post-status').change(function() {
        var postId = $(this).data('post-id');
        var newStatus = $(this).val();
        var selectElement = $(this);

        // Store old status for reverting if needed
        var oldStatus = selectElement.val();

        selectElement.prop('disabled', true);

        $.ajax({
          url: 'update-post-status.php',
          type: 'POST',
          data: {
            post_id: postId,
            new_status: newStatus
          },
          success: function(response) {
            selectElement.prop('disabled', false);

            if (response.success) {
              console.log('Status updated successfully!');
              showAlert('success', 'Status updated successfully!');
            } else {
              console.log("error")
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
</body>

</html>