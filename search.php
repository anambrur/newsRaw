<?php require_once 'db.php';
require_once "functions/limit.php"; ?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'parts/head.php'; ?>
  <title>সার্চ | <?php echo $name ?></title>
</head>

<body>
  <div id="main-wrapper">
    <?php require 'includes/header.php'; ?>





    <section id="feature_category_section" class="feature_category_section single-page section_wrapper">
      <div class="container">
        </br></br>
        <div class="row">
          <div class="col-md-12">
            <div class="item_caregory gr">
              <h2 class="text-center" style="font-size:25px; padding: 10px;">
                অনুসন্ধানের ফলাফল
              </h2>
              <hr>
              <hr>
            </div>

            <div class="row">

              <?php
              if ($_POST['searchtitle'] != '') {
                $st = $_SESSION['searchtitle'] = $_POST['searchtitle'];
              }
              $st;

              if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
              } else {
                $pageno = 1;
              }
              $no_of_records_per_page = 8;
              $offset = ($pageno - 1) * $no_of_records_per_page;
              $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
              $result = mysqli_query($con, $total_pages_sql);
              $total_rows = mysqli_fetch_array($result)[0];
              $total_pages = ceil($total_rows / $no_of_records_per_page);
              $query = mysqli_query($con, "select tblposts.id as pid,tblposts.id as id,tblposts.PostImage as postimage,tblposts.PostTitle as posttitle,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.PostTitle like '%$st%' and tblposts.Is_Active=1 LIMIT $offset, $no_of_records_per_page");
              $rowcount = mysqli_num_rows($query);
              if ($rowcount == 0) {
                echo "<center style='margin-bottom:200px;'>কোন খবর পাওয়া যায় নি !</center>";
              } else {
                while ($row = mysqli_fetch_array($query)) {
              ?>


                  <div class="col-sm-3 col-md-3 col-lg-3">
                    <a style="display:block; min-height:250px;" href="news-details.php?nid=<?php echo $row['pid']; ?>">
                      <img style="margin-bottom:10px margin-bottom:20px" width="100%" src="admin/images/thumb/<?php echo $row['postimage']; ?>" alt="<?php echo $row['posttitle']; ?>">
                      <div class="card-body">

                        <h5 style="color:#000000" class="card-title">
                          <?php echo $row['posttitle']; ?>
                        </h5>
                        <?php echo BanglaConverter::en2bn($row['postingdate']); ?>
                      </div>
                    </a>

                  </div>






                <?php } ?>
                <center>
                  <ul class="pagination justify-content-center mb-4">
                    <li class="page-item"><a href="?pageno=1" class="page-link">প্রথম পৃষ্ঠা</a></li>
                    <li class="<?php if ($pageno <= 1) {
                                  echo 'disabled';
                                } ?> page-item">
                      <a href="<?php if ($pageno <= 1) {
                                  echo '#';
                                } else {
                                  echo "?pageno=" . ($pageno - 1);
                                } ?>" class="page-link">আগের পৃষ্ঠা</a>
                    </li>
                    <li class="<?php if ($pageno >= $total_pages) {
                                  echo 'disabled';
                                } ?> page-item">
                      <a href="<?php if ($pageno >= $total_pages) {
                                  echo '#';
                                } else {
                                  echo "?pageno=" . ($pageno + 1);
                                } ?> " class="page-link">পরবর্তী পৃষ্ঠা</a>
                    </li>
                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">শেষ পৃষ্ঠা</a></li>
                  </ul>
                </center>
              <?php } ?>

            </div>
          </div>
        </div>






      </div>
  </div>
  </section>
  <?php require_once 'parts/footer.php'; ?>
  <?php require_once 'parts/scripts.php'; ?>
</body>

</html>