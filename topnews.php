<?php session_start();
require_once 'db.php';
require_once "functions/limit.php"; ?>
<!DOCTYPE html>
<html>

<head>
  <?php require_once 'parts/head.php'; ?>
  <title>JaintaBarta || জৈন্তাবার্তা</title>

  <?php
  $db->exec("set names utf8");
  $result = $db->prepare("SELECT * FROM settings WHERE id = 1");
  $result->execute();
  for ($i = 0; $row = $result->fetch(); $i++) {
  ?>
  <?php } ?>

  <meta property="og:image" content="" />
</head>










<body style="background: #ffffff;">
  <?php require 'includes/header.php'; ?>

  <div style="background: #ffffff;">
    <section id="feature_category_section" class="feature_category_section single-page section_wrapper">
      <div class="container">
        </br></br>
        <div class="row">
          <div class="col-md-12">
            <div class="item_caregory gr">
              <h2 class="text-center" style="font-size:25px; padding: 10px;">
                শীর্ষ সংবাদ
              </h2>
              <hr>
              <hr>
            </div>

            <div class="row">






              <?php
              $db->exec("set names utf8");
              $result = $db->prepare("SELECT * FROM tblposts WHERE On_Slider = 1 ORDER BY PostingDate DESC LIMIT 0, 12");
              $result->execute();
              for ($i = 0; $row = $result->fetch(); $i++) {
                $text = $row['PostDetails'];
                $escape = limit_words($text, 35);
              ?>
                <div class="col-sm-3 col-md-3 col-lg-3">
                  <a style="display:block; min-height:250px;" href="news-details?nid=<?php echo $row['id']; ?>">
                    <img style="margin-bottom:10px margin-bottom:20px" width="100%" src="admin/images/thumb/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo $row['posttitle']; ?>">
                    <div class="card-body">

                      <h5 style="color:#000000" class="card-title">
                        <?php echo $row['PostTitle']; ?>
                      </h5>
                    </div>
                  </a>

                </div>
              <?php } ?>




              <hr>
              <hr>

            </div>

          </div>



        </div>
    </section>













  </div>



  <?php require_once 'parts/footer.php'; ?>
  <?php require_once 'parts/scripts.php'; ?>
</body>

</html>