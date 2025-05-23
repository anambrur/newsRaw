<?php require_once 'db.php'; require_once "functions/limit.php"; ?>
<?php
@session_start();
error_reporting(0);
include('includes/config.php');
require_once "functions/limit.php";
if($_GET['catid']!=''){
$_SESSION['catid']=intval($_GET['catid']);
$Id = intval($_GET['catid']);
}
?>
<!DOCTYPE html>
<html>
  <head>
        <?php
        $db->exec("set names utf8");
        $result = $db->prepare("SELECT * FROM settings WHERE id = 1");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $name = $row['name'];
        $url = $row['url'];
        } ?>
    <!-- Cetegory Page Seo Start-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title> 
        <?php
        $sql = "SELECT CategoryName  FROM tblcategory WHERE id = $Id ";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo $row["CategoryName"];
        }
        }
        ?> বিভাগ ||  <?php echo $name ?>
        </title>
        <meta name="title" content="<?php
        $sql = "SELECT CategoryName  FROM tblcategory WHERE id = $Id ";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo $row["CategoryName"];
        }
        }
        ?> বিভাগ || <?php echo $name ?>" />
        <meta name="description" content="আজকের সিলেট থেকে প্রকাশিত একটি জনপ্রিয় অনলাইন পত্রিকা, সিলেটে সরকারি অনুমোদন প্রাপ্ত প্রথম অনলাইন পত্রিকা, সিলেটের তথ্য বিশ্বজুড়ে পৌঁছে দেওয়া  আমাদের একমাত্র লক্ষ্য" />
        <meta name="keywords" content="আজকেরসিলেট, অনলাইন, সংবাদপত্র, বাংলা, খবর, জাতীয়, রাজনীতি,সমগ্রদেশ, জীবনধারা, ছবি, ভিডিও, সিলেট, মৌলভীবাজার, সুনামগঞ্জ, হবিগঞ্জ, প্রবাস, চাকরি-বাকরি, লাইফ স্টাইল, তথ্য প্রযুক্তি" />
        <meta name="url" content="www.ajkersylhet.com" />
        <meta property="og:site_name" content="Ajker Sylhet" />
        <meta property="og:title" content="<?php
        $sql = "SELECT CategoryName  FROM tblcategory WHERE id = $Id ";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo $row["CategoryName"];
        }
        }
        ?> বিভাগ || <?php echo $name ?>" />
        <meta property="og:description" content=" আজকেরসিলেট  সিলেট থেকে প্রকাশিত একটি জনপ্রিয় অনলাইন সংবাদপত্র, অনলাইনে সর্বশেষ বাংলা খবর। অনলাইন সর্বশেষ বাংলা খবর, প্রবন্ধ - খেলাধুলা, বিনোদন, ব্যবসা, শিক্ষা, মতামত, জীবনধারা, ছবি, ভিডিও, ভ্রমণ, জাতীয়, বিশ্ব ইত্যাদি।" />
        <meta property="og:url" content="www.ajkersylhet.com" />
        <meta property="og:locale" content="bn-BD" />
        <meta property="og:image" content="https://ajkersylhet.com/sitecover.jpg" />
        <meta property="og:type" content="News Website" />
        <meta name="twitter:card" content="https://ajkersylhet.com/sitecover.jpg">
        <meta name="twitter:site" content="Ajker Sylhet">
        <meta name="twitter:title" content="<?php
        $sql = "SELECT CategoryName  FROM tblcategory WHERE id = $Id ";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo $row["CategoryName"];
        }
        }
        ?> বিভাগ || <?php echo $name ?>">
        <meta name="twitter:description" content=" আজকেরসিলেট সিলেট থেকে প্রকাশিত একটি জনপ্রিয় অনলাইন সংবাদপত্র, অনলাইনে সর্বশেষ বাংলা খবর। অনলাইন সর্বশেষ বাংলা খবর, প্রবন্ধ - খেলাধুলা, বিনোদন, ব্যবসা, শিক্ষা, মতামত, জীবনধারা, ছবি, ভিডিও, ভ্রমণ, জাতীয়, বিশ্ব ইত্যাদি।">
        <meta name="twitter:image" content="https://ajkersylhet.com/sitecover.jpg">
        <meta name="Author™" content="Ajker Sylhet" />
        <meta name="Designer™" content="IT Factory Bangladesh" />
        <meta http-equiv="refresh" content="600" />
        <meta name="pagerank™" content="10" />
        <meta name="alexa" content="100" />
        <meta name="coverage" content="Worldwide" />
        <meta name="distribution" content="Global" />
        <meta name="rating" content="General" />
        <meta name="revisit-after" content="7 days" />
        <meta name="robots" content="index,follow" />
    <!-- Cetegory Page Seo End-->
    <?php require_once 'parts/head.php'; ?>
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
            <hr style="margin-top: 0px; margin-bottom: 0px; ">
            <h2 class="text-left" style="background:#000; font-size:25px; color:#ff0008; padding:5px;">

            <?php
            $sql = "SELECT CategoryName  FROM tblcategory WHERE id = $Id ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            echo $row["CategoryName"];
            }
            }
            ?> বিভাগের সব খবর
            </h2>
            <hr style="margin-top: 0px; margin-bottom: 10px; ">
            
          </div>
          
           <div class="row">

              <?php
              if (isset($_GET['pageno'])) {
              $pageno = $_GET['pageno'];
              } else {
              $pageno = 1;
              }
              $no_of_records_per_page = 12;
              $offset = ($pageno-1) * $no_of_records_per_page;
              $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
              $result = mysqli_query($con,$total_pages_sql);
              $total_rows = mysqli_fetch_array($result)[0];
              $total_pages = ceil($total_rows / $no_of_records_per_page);
              $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,
              tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory,
              tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.CategoryId='".$_SESSION['catid']."' and tblposts.Is_Active=1 order by tblposts.id desc LIMIT $offset, $no_of_records_per_page");
              $rowcount=mysqli_num_rows($query);
              if($rowcount==0)
              {
              echo "<center>কোন খবর নেই !</center>";
              }
              else {
              while ($row=mysqli_fetch_array($query)) {
              $text = $row ['postdetails'];
              $string = limit_words($text,15);
              ?>
              
              
              
            
                 
            <div class="col-sm-3 col-md-3 col-lg-3">
                <a style="display:block; min-height:250px;" href="news-details?nid=<?php echo $row ['pid']; ?>">
                    <img style="margin-bottom:10px margin-bottom:20px"  width="100%" src="admin/images/thumb/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo $row['posttitle']; ?>">
                        <div class="card-body">
                        
                        <h5 style="color:#000000" class="card-title">
                            <?php echo $row ['posttitle']; ?>
                        </h5>
                        </div>
                </a>
                
            </div>
            <?php } } ?>
            <hr>
            <hr>
              
               </div>  
              <center> <ul class="pagination justify-content-center mb-4">
                <li class="page-item"><a href="?catid=<?php echo $_GET['catid']; ?>&&pageno=1"  class="page-link">প্রথম পৃষ্ঠা</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                  <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?catid=".$_GET['catid']."&&pageno=".($pageno - 1); } ?>" class="page-link">আগের পৃষ্ঠা</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                  <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?catid=".$_GET['catid']."&&pageno=".($pageno + 1); } ?> " class="page-link">পরবর্তী পৃষ্ঠা</a>
                </li>
                <li class="page-item"><a href="?catid=<?php echo $_GET['catid']; ?>&&pageno=<?php echo $total_pages; ?>" class="page-link">শেষ পৃষ্ঠা</a></li>
              </ul></center>
            </div>
    
    
    
          </div>
        </section>
        <?php require_once 'parts/footer.php'; ?>
      </div>
      <?php require_once 'parts/scripts.php'; ?>
    </body>
  </html>
