<?php require_once 'db.php'; require_once "functions/limit.php";
$result = $db->prepare("UPDATE settings SET views=views+1 WHERE id = 1 ");
$result->execute();
?>
<?php
session_start();
include('includes/config.php');
$Id = intval($_GET['nid']);
$query=mysqli_query($con,"UPDATE tblposts SET views=views+1 WHERE id = $Id ");
if (empty($_SESSION['token'])) {
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
}
if(isset($_POST['submit']))
{
if (!empty($_POST['csrftoken'])) {
if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
$name=$_POST['name'];
$email=$_POST['email'];
$comment=$_POST['comment'];
$st1='0';
$postid=intval($_GET['nid']);
$query=mysqli_query($con,"insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
if($query):
echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>";
unset($_SESSION['token']);
else :
echo "<script>alert('Something went wrong. Please try again.');</script>";
endif;
}}}
?>
<!DOCTYPE html>
<html>
<head>
    
<?php
$sql = "SELECT On_Save FROM tblposts WHERE id =  ".$_GET['nid'];
$result = $con->query($sql)->fetch_assoc();
if($result['On_Save']==1){
?>
<html lang="en" oncontextmenu="return false">
<style>
/* Prevent text selection of a <body> element in all major browsers */
body {
-youbkit-touch-callout: none;
/* iOS Safari */
-youbkit-user-select: none;
/* Chrome 6.0+, Safari 3.1+, Edge & Opera 15+ */
-moz-user-select: none;
/* Firefox */
-ms-user-select: none;
/* IE 10+ and Edge */
user-select: none;
/* Non-prefixed version,
currently supported by Chrome and Opera */
}
</style>
<?php }else{?>
<html lang="en">
<?php     
}
?>
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM settings WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>
<link type="image/x-icon" rel="shortcut icon" href="images/<?php echo $row['favicon']; ?>">
<link type="image/x-icon" rel="icon" href="images/<?php echo $row['favicon']; ?>">
<?php } ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0&appId=251160766572596&autoLogAppEvents=1" nonce="Z0zbQuBN"></script>
<!-- facebook comment start-->
<style>
.top_banner_wrap {display: none;}
.ytp-impression-link {display: none;}
.html5-video-player a {display: none;}
</style>
<!-- Post Seo Start-->
    <?php
    $sql = "SELECT PostTitle, PostDetails, seoshort, seomkey, PostImage  FROM tblposts WHERE id = $Id ";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php   echo $row["PostTitle"]; ?></title>
    <meta name="title" content="<?php   echo $row["PostTitle"]; ?>" />
    <meta name="description" content="<?php echo strip_tags(truncate($row['PostDetails'],90,400)); ?>" />
    <meta name="keywords" content="আজকের সিলেট সিলেট থেকে প্রকাশিত একটি জনপ্রিয় অনলাইন সংবাদপত্র, অনলাইনে সর্বশেষ বাংলা খবর। অনলাইন সর্বশেষ বাংলা খবর, প্রবন্ধ - খেলাধুলা, বিনোদন, ব্যবসা, শিক্ষা, মতামত, জীবনধারা, ছবি, ভিডিও, ভ্রমণ, জাতীয়, বিশ্ব ইত্যাদি" />
    <meta name="url" content="" />
    <meta property="og:site_name" content="Ajker Sylhet" />
    <meta property="og:title" content="<?php   echo $row["PostTitle"]; ?>" />
    <meta property="og:description" content="<?php echo strip_tags(truncate($row['PostDetails'],90,400)); ?>" />
    <meta property="og:url" content="" />
    <meta property="og:locale" content="bn-BD" />
    <meta property="og:image" content="https://ajkersylhet.com/admin/images/postimages/<?php echo htmlentities($row['PostImage']);?>" />
    <meta property="og:type" content="News" />
    <meta name="twitter:card" content="https://ajkersylhet.com/admin/images/postimages/<?php echo htmlentities($row['PostImage']);?>">
    <meta name="twitter:site" content="Ajker Sylhet">
    <meta name="twitter:title" content="<?php   echo $row["PostTitle"]; ?>">
    <meta name="twitter:description" content="<?php echo strip_tags(truncate($row['PostDetails'],90,400)); ?>">
    <meta name="twitter:image" content="https://ajkersylhet.com/admin/images/postimages/<?php echo htmlentities($row['PostImage']);?>">
    <meta name="Author™" content="Ajker Sylhet" />
    <meta name="Designer™" content="IT Factory Bangladesh" />
    <meta name="coverage" content="Worldwide" />
    <meta name="distribution" content="Global" />
    <meta name="rating" content="General" />
    <meta name="revisit-after" content="1 days" />
    <meta name="robots" content="index,follow" />
    <?php } }  ?>
<!-- Post Seo End-->
<?php require_once 'parts/head.php'; ?>
</head>
<body>
<?php require 'includes/header.php'; ?>

<div class="container">
<section>
<div class="row">

<!-- News Body Start -->

<div class="col-lg-9 col-sm-12 rowresize atPrint100" style="flex: 0 0 74%;max-width: 74%;">
</br> 
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
<!-- Vertical 2024 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8251316324344093"
     data-ad-slot="8380617501"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<!-- Local Ad Post Top Start --> 
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['posttop']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Ad Post Top End -->
<?php
$pid=intval($_GET['nid']);
$query=mysqli_query($con,"SELECT tblposts.PostTitle AS posttitle, tblposts.subtitle AS subtitle, tblposts.PostImage, photocap AS photocap, tblcategory.CategoryName AS category,tblcategory.id AS cid,tblsubcategory.Subcategory AS subcategory,tblposts.PostDetails AS postdetails,tblposts.PostingDate AS postingdate,tblposts.PostUrl AS url,reporter.name as reporter_name,reporter.photo as reporter_photo, tblposts.source FROM tblposts left join tblcategory ON tblcategory.id=tblposts.CategoryId left join  tblsubcategory ON  tblsubcategory.SubCategoryId=tblposts.SubCategoryId left join reporter ON tblposts.repoter=reporter.reporterID where tblposts.id='$pid'");
while ($row=mysqli_fetch_array($query)) {
?>
<div class="DDetailsTitle">
<h4>
<?php echo htmlentities($row['subtitle']);?>
</h4>
<h1>
<?php echo htmlentities($row['posttitle']);?>
</h1>
</div>
<div class="AdditionalInfo">
<div class="row">
<div class="col-sm-8 text-left">
<div class="DescTitle">
<span class="ColorBox"></span>
<h2>
<?php echo htmlentities($row['reporter_name']);?>
</h2>
</div>
<div class="pDate">
<p>প্রকাশিত: <?php echo BanglaConverter::en2bn(date('d/m/Y H:i:s', strtotime($row['postingdate']))); ?></p>
</div>
</div>
<div class="col-sm-4">
<div class="DSocialTop"><div class="addthis_inline_share_toolbox_27te"></div></div>
</div>
</div>
</div>
<article class="DDetailsContent">
<div class="row">
<div class="col-sm-12" vtype="">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
<!-- Vertical 2024 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8251316324344093"
     data-ad-slot="8380617501"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<img src="admin/images/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" title="<?php echo htmlentities($row['posttitle']);?>" class="img-fluid img100 TopImg">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
<!-- Vertical 2024 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8251316324344093"
     data-ad-slot="8380617501"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<p class="DDetailsCaption">
<?php echo htmlentities($row['photocap']);?>
</p>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
<!-- Vertical 2024 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8251316324344093"
     data-ad-slot="8380617501"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>
<div class="row">
<div class="col-lg-10 col-12 offset-lg-1">
<div id="contentDetails">
<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_facebook_messenger"></a>
</div>
<script>
var a2a_config = a2a_config || {};
a2a_config.num_services = 4;
</script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->  
</br>
<p>
<?php
$pt=$row['postdetails'];
echo  (substr($pt,0));?>
</p> 
<p style="font-size:12px; color:#989898">
<?php echo htmlentities($row['source']);?>
</p> 
<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_facebook_messenger"></a>
</div>
<script>
var a2a_config = a2a_config || {};
a2a_config.num_services = 4;
</script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->  

</div>
<div class="DSocialTop2">
<div class="addthis_inline_share_toolbox_27te">
</div>
</div>
<?php
$db->exec("set names utf8");
$result = $db->prepare("select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$Related = $row["cid"];
}
?>
<!--<div class="CommentsSection">
<div class="row DMarginT30">
<div class="col-sm-12">
<div class="fb-comments" data-href="https://ajkersylhet.com/news-details.php?nid=<?php echo $_GET['nid']; ?>" data-numposts="3"></div>
</div>
</div>
</div>-->
<?php } ?>  

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
<!-- Vertical 2024 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8251316324344093"
     data-ad-slot="8380617501"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<!-- Local Ad Post Bottom Start --> 
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['postbottom']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Ad Post Bottom End -->
</div>
</div>
</article>  

</div>  
<!-- News Body End -->
<!-- Side bar Start -->
<div class="col-lg-3 col-md-12 col-sm-12 hidden-print rowresize" style="flex:0 0 26%;max-width:26%;">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
<!-- Square Add 2024 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8251316324344093"
     data-ad-slot="1487906090"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>


<a href="category.php?catid=1"><h2>
<div class="SecTitle mt-4 mb-1"><h2>সিলেটজুড়ে  </h2></div>
</a>
<section class="DLPSTab2 mt-0">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 1 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 5");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DHighLightedListItem2">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/thumb/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h3 class="Title"><?php echo $row['PostTitle']; ?></h3>
</div>
</div>
</div>
</a>
</div>
<?php } ?>
</section>

<!-- Local Ad Post Sidebar Top Start --> 
</br>
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['sidetop']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Ad Post Sidebar Top End -->
<section class="DLPSTab2">
<div class="panel panel-default">
<div class="panel-heading">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" data-bs-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">সর্বশেষ</a>
</li>
<li class="nav-item">
<a class="nav-link" data-bs-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">সর্বাধিক</a>
</li>
</ul>
</div>
<div class="panel-body PanelHeight">
<div class="tab-content">
<div class="tab-pane active" id="tabs-1" role="tabpanel">
<div class="DLatestNews longEnough mCustomScrollbar" data-mcs-theme="dark">
<?php require_once("functions/latest_news.php"); ?>
</div>
</div>
<div class="tab-pane" id="tabs-2" role="tabpanel">
<div class="DLatestNews longEnough mCustomScrollbar" data-mcs-theme="dark">
<?php require_once("functions/popular_news.php"); ?>
</div>
</div>
</div>
</div>
</div>
<div class="allnews"><a href="topnews.php"> শীর্ষ সংবাদ  <i class="fa fa-angle-double-right"></i></a></div>
</section>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
     
     
     
<a href="category.php?catid=2"><h2>
<div class="SecTitle mt-1 mb-1"><h2>মহানগর </h2></div>
</a>
<section class="DLPSTab2 mt-0">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 2 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 5");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DHighLightedListItem2">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/thumb/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h3 class="Title"><?php echo $row['PostTitle']; ?></h3>
</div>
</div>
</div>
</a>
</div>
<?php } ?>
</section>



<!-- Square Add 2024 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8251316324344093"
     data-ad-slot="1487906090"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</br>
<!-- Local Ad Post Sidebar Bottom Start --> 
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['sidebottom']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Ad Post Sidebar Bottom End -->
</div>
</div>
<div class="row">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8251316324344093"
     crossorigin="anonymous"></script>
<!-- Vertical 2024 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8251316324344093"
     data-ad-slot="8380617501"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<div class="col-sm-12">
<div class="DReadMore hidden-print">
<p class="catTitle"><span class="ColorBox"></span> আরো পড়ুন &nbsp;</p>
<div class="row">
<?php
$db->exec("set names utf8");
$result = $db->prepare("select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$Related = $row["cid"];
}
?>
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = '$Related' ORDER BY id DESC LIMIT 1, 4");
$result->execute();
for ($i = 0;$row = $result->fetch();$i++) {
$text = $row['PostTitle'];
$escape = limit_words($text, 4);
?>
<div class="col-lg-3 col-md-6 col-6 d-flex">
<div class="DReadMoreList align-self-stretch">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/thumb/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
<p><?php echo $row['PostTitle']; ?></p>
</a>
</div>
</div>
<?php
} ?>
</div>
</div>
</div>
</div>
</section>
</div>
<script>
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}
function closeSearch() {
document.getElementById("myOverlay").style.display = "none";
}
function getShareCount(){
url = $(".url").val();
api_url = 'https://graph.facebook.com/v3.0/?id='+url+'&fields=og_object{engagement}&access_token=251160766572596|f22781abbcabcaf640aa18a36dbbcb44';
$.ajax({
url:api_url,
type:'get',
success:function(res){
count = res.og_object.engagement.count;
text = res.og_object.engagement.social_sentence;
$(".result").html('<h3>'+count+' Shares<br>'+text+'</h3>');
closeSearch();
}
});
}
</script>
<?php require_once 'parts/footer.php'; ?>
<?php require_once 'parts/scripts.php'; ?>
</body>
</html>