<footer>

<div class="container">
<div class="row">
<div class="col-sm-12">

</div>
</div>
</div>

<div class="DFooterBg">
<div class="container">
<div class="row">
<div class="col-md-4 d-flex justify-content-start border-right-inner">
<div class="FooterLeft">
<div class="DSocialLink">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM settings WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>
<a href="<?php echo $row['url']; ?>">
<img src="images/<?php echo $row['footerlogo']; ?>" alt="Web Title Here" title="<?php echo $row['name']; ?>" class="img-fluid img100">
</a>
<?php } ?>
<p style="text-align:center; color:red"> 
    &copy ২০১১-২০২৪ |  আজকের সিলেট  কর্তৃক সর্বসত্ব &reg সংরক্ষিত
</p>
</div>
</div>
</div>
<div class="col-md-4 d-flex align-items-center border-right-inner"> 
<div class="AboutMenu">
<p>
    প্রধান সম্পাদক : এম. সাইফুর রহমান তালুকদার
</p>
</div>
</div>
<div class="col-md-4 d-flex align-items-center">
<div class="MoreInfo">
<p>
    <i class="fa fa-address-card" aria-hidden="true"></i> <span>সম্পাদকীয়, বার্তা ও বাণিজ্যিক কার্যালয় : কমন মার্কেট (৫ম তলা), বন্দরবাজার, সিলেট-৩১০০ </span>
</p>
<p style="font-size:19px">
    <i class="fa fa-mobile" aria-hidden="true"></i> <span> +৮৮ ০৯৬৪৯ ৭০০৬৮৫, +৮৮ ০১৮১৬ ৭০০৬৮৫</span></br>
    <i class="fa fa-envelope" aria-hidden="true"></i><span> report.ajkersylhet@gmail.com</span>
</p>

</div>
</div>
</div>
</div>
</div>
<div class="DFooterBottomBg">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<p>উন্নয়নে <a href="https://bditfactory.com/" target="_blank">বিডি আইটি ফ্যাক্টরি</a></p>
</div>
</div>
</div>
</div>
</footer>
<section>

<div class="container-fluid">
<div class="DScroll">
 
</div>
</div>
</section>
<div id="back_to_top" class="back_to_top on"><span class="go_up"><i style="" class="fa fa-arrow-up"></i></span></div><script type="e18c05d0688a614e23c19650-text/javascript" src="ajax/libs/jquery/3.6.0/jquery.min.js"></script><script type="e18c05d0688a614e23c19650-text/javascript" src="ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script><script type="e18c05d0688a614e23c19650-text/javascript" src="common/js/eMythMakers.js"></script><script type="e18c05d0688a614e23c19650-text/javascript" src="ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script type="e18c05d0688a614e23c19650-text/javascript">
//For Lazy Load
$(function(){
	//Custom fadeIn Duration
	$('img').loadScroll(300);
});
</script>
<script type="e18c05d0688a614e23c19650-text/javascript" src="jQuery.loadScroll.js"></script>
<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="e18c05d0688a614e23c19650-|49" defer=""></script>
</html>