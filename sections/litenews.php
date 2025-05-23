<!--Main body Line Srart-->  

<!--led Section Srart -->
<div class="TopHomeSection">  

<div class="container">
<div style="padding-bottom:10px" calss="col-md-12">    
<!-- Local Ad Baner Ad Bottom Start --> 
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>     
<img class="img-responsive" src="images/<?php echo $row['baneradbottom']; ?>" alt="Ajker Sylhet Local Ad"width="100%" height="100px"> 
<?php } ?> 
<!-- Local Ad Baner Ad Bottom End -->   
</div>


<!-- Led Sub Lead Start -->   
<div class="row">
<div class="col-lg-6 col-sm-12 border-right-inner1">
<div class="row">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE On_Slider = 1 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for ($i = 0;$row = $result->fetch();$i++) {
$text = $row['PostDetails'];
$escape = limit_words($text, 35);
?>
<div class="col-lg-8 col-12 border-right-inner1">
<div class="DLeadNews">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/postimages/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
<div class="Desc">
<h1 class="Title TitleBold"><span class="spnSubHead"><?php echo htmlentities($row['subtitle']);?></span>
<br>
<?php echo $row['PostTitle']; ?>
</h1>
<div class="Brief">
<p>
<?php echo strip_tags(truncate($row['PostDetails'],200,400)); ?>
</p>
</div>
</div>
</a>
</div>
</div>
<?php } ?>

<div class="col-lg-4 col-12"><div class="DLeadSide">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE On_Slider = 1 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for ($i = 0;$row = $result->fetch();$i++) {
$text = $row['PostDetails'];
$escape = limit_words($text, 35);
?>
<div class="DLeadNewsList">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/thumb/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure>
</div>
<div class="Desc"><h2 class="Title TitleBold"><?php echo $row['PostTitle']; ?></h2></div>
</a>
</div>
<?php } ?>
</div>
</br>
</div>
  
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE On_Sportlingt = 1 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 3");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="col-lg-4 col-sm-12 d-flex border-right-inner1">
<div class="DInternationalList align-self-stretch">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-3 col-5">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure></div>
</div>
<div class="col-lg-12 col-sm-9 col-7">
<div class="Desc">
<h3 class="Title TitleBold"><?php echo $row['PostTitle']; ?></h3>
<div class="Brief">
</div>
</div>
</div>
</div>
</a>
</div>
</div>
<?php } ?>
</div>
</div>

<!--Sport Light Start -->
<div class="col-lg-3 col-12">
<a href="category.php?catid=1"><h2>
<div class="SecTitle mt-0 mb-3"><h2>সিলেটজুড়ে</h2></div>
</a>
<section class="DLPSTab2 mt-0">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 1 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 6");
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
</div>
<!--Sport Light Start -->

<!--Popular News Start-->
<div class="col-lg-3 col-12">
<section class="DLPSTab2 mt-0">
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
<!--<a href="category.php?catid=1"><h2>
<div class="SecTitle mt-1 mb-1"><h2>আমাদের ফেসবুক</h2></div>
<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAkerSylhetMultimedia&tabs=timeline&width=290&height=70&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="290" height="70" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
</a>-->
<a href="category.php?catid=24"> 
<img class="img-responsive" src="ramjan.jpeg" alt="Jainta Barta Local Ad" width="100%" height="55px">
</a> 

<?php 
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 24 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 2");
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
</div>
<!--Popular News End-->
</div>
</div>
<!-- Led Sub Lead End -->   











<!--Special Section Start-->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM settings WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$live = $row['live'];
$on_live = $row['on_live'];
$back_color = $row['back_color'];
$font_color = $row['font_color'];
 } ?>

<div style="display: 
<?php 
if($on_live == 0)
{echo 'none';}
else{echo 'block';}
?>"  class="container">
<div style="background-color:#<?php echo $back_color; ?>"class="SPSecTitle">
<a href="category.php?catid=10">
<h2 style="font-size:30px; text-align:center">
<i class="fa fa-arrow-right" aria-hidden="true"></i> <class="TitleIcon"> <?php echo $live; ?> <i class="fa fa-arrow-left" aria-hidden="true"></i>
</h2>
</a>
</div>
<div style="background-color:#<?php echo $back_color; ?>; padding:15px" class="DInternational">
<div class="row">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 22 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 8");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="col-lg-3 col-sm-12 d-flex border-right-inner1">
<div class="DInternationalList align-self-stretch">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div style="padding-top:15px" class="col-lg-12 col-sm-3 col-5">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure></div>
</div>
<div class="col-lg-12 col-sm-9 col-7">
<div class="Desc">
<h3 style="color:#<?php echo $font_color; ?>"class="Title TitleBold"><?php echo $row['PostTitle']; ?></h3>
<div class="Brief">
<p style="color:#<?php echo $font_color; ?>">
<?php echo strip_tags(truncate($row['PostDetails'],200,400)); ?>&nbsp;
</p></div>
</div>
</div>
</div>
</a>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<!--Special Section End-->






<!--Big 2 Part Section Start -->  

<div class="container">
</br>



<div style="padding-bottom:10px" class="row">    
 <div class="col-lg-6 col-md-12">
<!-- Local Ad Led Bottom One Start -->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['lbone']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Ad Led Bottom One End -->
</div>
              
                          
<div class="col-lg-6 col-md-12">
<!-- Local Ad Led Bottom Two Start -->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['lbtwo']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Ad Led Bottom Two End -->
</div>
</div>
</br>



<div class="row">
<!--Big 2 Part Part 1 Start -->
<div class="col-lg-6 col-sm-12 border-right-inner1">
<a href="category.php?catid=2"><h2>
<div class="SecTitle mt-0 mb-3"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> মহানগর</h2></div>
</a>
<div class="row">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 2 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="col-lg-12 col-12 border-right-inner1">
<div class="DLeadNews">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/postimages/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
<div class="Desc">
<h1 class="Title TitleBold"><span class="spnSubHead"><?php echo htmlentities($row['subtitle']);?></span>
<br>
<?php echo $row['PostTitle']; ?>
</h1>
<div class="Brief">
<p>
<?php echo strip_tags(truncate($row['PostDetails'],200,400)); ?>
</p>
</div>
</div>
</a>
</div>
</div>
<?php } ?>

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 2 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 4");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="col-lg-6 col-sm-12 d-flex border-right-inner1">
<div class="DInternationalList align-self-stretch">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-3 col-5">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure></div>
</div>
<div class="col-lg-12 col-sm-9 col-7">
<div class="Desc">
<h3 class="Title TitleBold"><?php echo $row['PostTitle']; ?></h3>
</div>
</div>
</div>
</a>
</div>
</div>
<?php } ?>

</div>
</div>
<!--Big 2 Part Part 1 End -->



<!--Big 2 Part Part 2 Start -->
<div class="col-lg-6 col-sm-12 border-right-inner1">
<a href="category.php?catid=3"><h2>
<div class="SecTitle mt-0 mb-3"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> জাতীয়</h2></div>
</a>
<div class="row">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 3 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="col-lg-12 col-12 border-right-inner1">
<div class="DLeadNews">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/postimages/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
<div class="Desc">
<h1 class="Title TitleBold"><span class="spnSubHead"><?php echo htmlentities($row['subtitle']);?></span>
<br>
<?php echo $row['PostTitle']; ?>
</h1>
<div class="Brief">
<p>
<?php echo strip_tags(truncate($row['PostDetails'],200,400)); ?>
</p>
</div>
</div>
</a>
</div>
</div>
<?php } ?>



<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 3 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 4");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="col-lg-6 col-sm-12 d-flex border-right-inner1">
<div class="DInternationalList align-self-stretch">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-3 col-5">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure></div>
</div>
<div class="col-lg-12 col-sm-9 col-7">
<div class="Desc">
<h3 class="Title TitleBold"><?php echo $row['PostTitle']; ?></h3>
</div>
</div>
</div>
</a>
</div>
</div>
<?php } ?>

</div>
</div>
<!--Big 2 Part Part 2 End -->
</div>
</div>


 

<section class="utf_featured_post_area pt-4 no-padding"> 
<div class="container">
<div style="padding-bottom:10px" class="row">    
 <div class="col-lg-6 col-md-12">
<!-- Local Ad Home Ad One Start -->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['homeadone']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Ad Home Ad One End -->
</div>
              
                          
<div class="col-lg-6 col-md-12">
<!-- Local Ad Home Ad Two Start -->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['homeadtwo']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Ad Home Ad Two End -->
</div>
</div>
</div>
</br>
</section>



<!--Big 2 Part Section Start -->
<!--Rajniti Section Start-->

 


<div class="DHighlightedSection">
<div class="container">
<div class="row">

<div class="col-lg-12 col-12 border-right-inner1"> 
<a href="category.php?catid=4"><h2>
<div class="SecTitle mt-0 mb-3"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> রাজনীতি</h2></div>
</aa>
<div class="row">

<div class="col-lg-6 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 4 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DHighLightTop">
<div class="col-sm-12 thumbnail">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/postimages/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure>
</div>
<div class="Desc">
<h3 class="Title"><?php echo $row['PostTitle']; ?></h3>
<div class="Brief"><p>
<?php echo strip_tags(truncate($row['PostDetails'],200,400)); ?>
</p>
</div>
</div>
</a>
</div>
</div>
<?php } ?>
</div>

<div class="col-lg-3 col-sm-12">
<div class="DHighLightedList2">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 4 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 4");
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

</div>
</div>


<div class="col-lg-3 col-sm-12">
<div class="DHighLightedList2">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 4 AND Is_Active = 1 ORDER BY id DESC LIMIT 5, 4");
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

</div>
</div>

</div>
</div>

</div>
</div>
</div>
<!--Rajniti Section End-->

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

<!--Video Part Start-->
<div style="display:none"class="VideoGalleryBG"> 
<div class="container">
<div class="SPSecTitle2">
<a href="#"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> ভিডিও গ্যালারি</h2></a>
</div>
<div class="DVideoGalleryTop">
<div class="row">

<div class="col-lg-5 col-12 d-flex">
<?php
    $db->exec("set names utf8");
    $result = $db->prepare("SELECT * FROM tblvideo ORDER BY id DESC LIMIT 0, 1");
    $result->execute();
    for ($i = 0;$row = $result->fetch();$i++) {
?>
<div class="DVideoGalleryTopItem align-self-stretch">
<div class="ImgBlock">
<div class="Imgresize">
<iframe width="100%" height="260" src="<?php echo $row['VideoLink']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>

</div>
<div class="Desc">
<h3 class="Title">
<?php echo $row['ImageTitle']; ?>
</h3>
</div>
</div>
<?php } ?>
</div>

<div class="col-lg-7 col-12">
<div class="DVideoGalleryTop2">
<div class="row">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblvideo ORDER BY id DESC LIMIT 1, 6");
$result->execute();
for ($i = 0;$row = $result->fetch();$i++) {
?>
<div class="col-lg-4 col-sm-6 col-6 d-flex">
<div class="DVideoGalleryTop2List align-self-stretch">
<a href="multimedia/video/404.html">
<div class="DImgBlock">
<div class="Imgresize">
<iframe width="100%" height="115" src="<?php echo $row['VideoLink']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
</div>
<div class="Desc">
<h3 class="Title">
<?php echo $row['ImageTitle']; ?>
 </h3>
</div>
</a>
</div>
</div>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--Video Part End-->


<section class="utf_featured_post_area pt-4 no-padding"> 
<div class="container">
<div style="padding-bottom:10px" class="row">    
 <div class="col-lg-6 col-md-12">
<!-- Local Home Ad Three Start -->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['homeadthree']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Home Ad Three End -->
</div>
              
                          
<div class="col-lg-6 col-md-12">
<!-- Local Home Ad Four Start -->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['homeadfour']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Home Ad Four End -->
</div>
</div>
</div>
</section>




<!--11th Part Start-->
<div class="container">
<div class="row MT30">
<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=5">
<h2><i class="fa fa-newspaper" aria-hidden="true"></i> আন্তর্জাতিক</h2>
</a>
</div>


<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 5 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>"> 
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>

<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 5 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>

<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
    
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture>
</figure>
</div>
</div>

<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2>
</div>
</div>

</div>
</a>
</div>
<?php } ?>
</div>




</div>

<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=11"><h2> <i class="fa fa-newspaper" aria-hidden="true"></i> প্রবাস </h2>
</a>
</div>


<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 11 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>




<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 11 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2>
</div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>

<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=8"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> অর্থনীতি</h2>
</a>
</div>



<div class="col-lg-12 col-sm-12 border-right-inner1"> 
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 8 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>



<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 8 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2></div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>









<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=21"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> মুক্তমত</h2>
</a>
</div>



<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 21 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>



<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 21 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 4");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2></div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>



</div>
</div>
<!--11th Part End-->


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


<section class="utf_featured_post_area pt-4 no-padding"> 
<div class="container">
<div style="padding-bottom:10px" class="row">    
 <div class="col-lg-6 col-md-12">
<!-- Local Home Ad Five Start -->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['homeadfive']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Home Ad Five End -->
</div>
              
                          
<div class="col-lg-6 col-md-12">
<!-- Local Home Ad Six Start -->
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?> 
<img class="img-responsive" src="images/<?php echo $row['homeadsix']; ?>" alt=""width="100%">
<?php } ?>
<!-- Local Home Ad Six End -->
</div>
</div>
</div>
</section>

<!--4th Part Start-->
<div class="container">
<div class="SPSecTitle">
<a href="category.php?catid=10"><h2>
<i class="fa fa-arrow-right" aria-hidden="true"></i> <class="TitleIcon">ক্রীড়াঙ্গণ</h2>
</a>
</div>
<div class="DInternational">
<div class="row">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 10 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 4");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="col-lg-3 col-sm-12 d-flex border-right-inner1">
<div class="DInternationalList align-self-stretch">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-3 col-5">
<div class="Imgresize"><figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure></div>
</div>
<div class="col-lg-12 col-sm-9 col-7">
<div class="Desc">
<h3 class="Title TitleBold"><?php echo $row['PostTitle']; ?></h3>
<div class="Brief">
<p>
<?php echo strip_tags(truncate($row['PostDetails'],200,400)); ?>&nbsp;
</p></div>
</div>
</div>
</div>
</a>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<!--4th Part End-->




<!--11th Part Start-->
<div class="container">
<div class="row MT30">
<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=14">
<h2><i class="fa fa-newspaper" aria-hidden="true"></i> চাকুরীর খবর </h2>
</a>
</div>


<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 14 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>

<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 14 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>

<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
    
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture>
</figure>
</div>
</div>

<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2>
</div>
</div>

</div>
</a>
</div>
<?php } ?>
</div>




</div>

<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=7"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> সম্পাদকীয়</h2>
</a>
</div>


<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 7 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>




<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 7 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2>
</div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>

<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=20"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> স্বাস্থ্য</h2>
</a>
</div>



<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 20 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>



<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 20 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2></div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>









<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=19"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> সাহিত্য</h2>
</a>
</div>



<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 19 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>



<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 19 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2></div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>



</div>
</div>
<!--11th Part End-->
</br>











































<!--8th Part End-->

<!--9th Part End-->
<div style="background-color:#1d3649; padding-top:10px; padding-bottom:15px" class="container">
<div class="SPSecTitle">
<a href="category.php?catid=9">
<h2 style="color:#fff"> <i class="fa fa-arrow-right" aria-hidden="true"></i> <class="TitleIcon">বিনোদন</h2>
</a>
</div>

<div class="DEntertainment">
<div class="row">
<div class="col-lg-6 col-sm-12 colresize border-right-inner1" style="width:43%">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 9 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DEntertainmentTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/postimages/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure>
</div>
<div class="Desc">
<h3 class="Title LeadTitle TitleBold"><?php echo $row['PostTitle']; ?></h3>
<div class="Brief">
<p>
<?php echo strip_tags(truncate($row['PostDetails'],200,400)); ?>
</p>
</div>
</div>
</a>
</div>
<?php } ?>
</div>
<div class="col-lg-3 col-sm-12 colresize order-lg-first border-right-inner1" style="width:28.5%">
<div class="DEntertainmentList">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 9 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 4");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DEntertainmentListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 style="color:#fff"class="Title">
<?php echo $row['PostTitle']; ?>
</h2>
</div>
</div>
</div>
</a>
</div>
<?php } ?>
</div>
</div>
<div class="col-lg-3 col-sm-12 colresize" style="width:28.5%">
<div class="DEntertainmentList">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 9 AND Is_Active = 1 ORDER BY id DESC LIMIT 5, 4");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DEntertainmentListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 style="color:#fff" class="Title">   
<?php echo $row['PostTitle']; ?>
</h2>
</div>
</div>
</div>
</a>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>

























<!--11th Part Start-->
<div class="container">
<div class="row MT30">
<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=6">
<h2><i class="fa fa-newspaper" aria-hidden="true"></i> এক্সক্লুসিভ</h2>
</a>
</div>


<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 6 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>

<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 6 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>

<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
    
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture>
</figure>
</div>
</div>

<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2>
</div>
</div>

</div>
</a>
</div>
<?php } ?>
</div>




</div>

<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=18"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> শিক্ষাঙ্গন</h2>
</a>
</div>


<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 18 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>




<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 18 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2>
</div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>

<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=16"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> ধর্ম ও জীবন</h2>
</a>
</div>



<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 16 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>



<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 16 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2></div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>









<div class="col-lg-3 col-sm-12">
<div class="SecTitle mt-0">
<a href="category.php?catid=17"><h2><i class="fa fa-newspaper" aria-hidden="true"></i> বিচিত্র সংবাদ </h2>
</a>
</div>



<div class="col-lg-12 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 17 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div style="padding-top:10px" class="DCountryTop">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure></div>
</div>

<h2 style="padding-top:20px; font-size:25px" class="Title">
<?php echo $row['PostTitle']; ?>
</h2>

</div>
</a>
</div>
<?php } ?>
</div>



<div class="DCatStyle1List">

<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 17 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DCatStyle1ListItem">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="row">
<div class="col-lg-5 col-sm-3 col-5">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img data-src="admin/images/thumb/<?php echo $row['PostImage']; ?>" src="images/site/no-img.png" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 Ratio Ratio16x9 ImgRatio"></picture></figure>
</div>
</div>
<div class="col-lg-7 col-sm-9 col-7">
<div class="Desc">
<h2 class="Title">
<?php echo $row['PostTitle']; ?>
</h2></div>
</div>
</div>
</a>
</div>
<?php } ?>

</div>
</div>



</div>
</div>
<!--11th Part End-->









<!--2nd Part End-->
<div class="DHighlightedSection">
<div class="container">
<div class="row">

<div class="col-lg-9 col-12 border-right-inner1">
<a href="category.php?catid=12"><h2>
<div class="SecTitle mt-0 mb-3"><h2>লাইফ-স্টাইল</h2></div>
</aa>
<div class="row">

<div class="col-lg-8 col-sm-12 border-right-inner1">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 12 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$text = $row['PostDetails'];
$escape = limit_words($text, 12);
?>
<div class="DHighLightTop">
<div class="col-sm-12 thumbnail">
<a href="news-details?nid=<?php echo $row['id']; ?>">
<div class="Imgresize">
<figure class="ImgViewer"><picture class="FixingRatio"><img src="admin/images/postimages/<?php echo $row['PostImage']; ?>" alt="<?php echo $row['PostTitle']; ?>" title="<?php echo $row['PostTitle']; ?>" class="img-fluid img100 ImgRatio"></picture></figure>
</div>
<div class="Desc">
<h3 class="Title"><?php echo $row['PostTitle']; ?></h3>
<div class="Brief"><p>
<?php echo strip_tags(truncate($row['PostDetails'],200,400)); ?>
</p>
</div>
</div>
</a>
</div>
</div>
<?php } ?>
</div>

<div class="col-lg-4 col-sm-12">
<div class="DHighLightedList2">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 12 AND Is_Active = 1 ORDER BY id DESC LIMIT 1, 4");
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

</div>
</div>

</div>
</div>

<!--Side Bar Start-->

<div class="col-lg-3 col-12">
<a href="category.php?catid=15"><h2>
<div class="SecTitle mt-0 mb-3"><h2>প্রেস বক্স</h2></div>
</a>
<section class="DLPSTab2 mt-0">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE CategoryId = 23 AND Is_Active = 1 ORDER BY id DESC LIMIT 0, 4");
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
</div>
<!--Side Bar End-->

</div>
</div>
</div>
<!--2nd Part End-->





</div>
</main>