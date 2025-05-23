<main>
<body>

<!--header Line Srart-->  
<header>
<div class="HeaderTopBar MobileHide">
<div class="container">
<div class="row">
<div class="col-lg-5 col-sm-12 col-5">


<?php require_once 'functions/current_time_date.php'; ?>


</div>
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM settings WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>
<div class="col-lg-3 col-sm-12 col-3">
</div>
<div class="col-lg-4 col-4 col-sm-12">
<div class="SocialIcon d-flex justify-content-end">
<ul>
<li class="BlogBtn"><a href="">নিবন্ধন নং : ৮১</a></li>
<li class="BlogBtn"><a href="">লাইভ</a></li>
<li class="BlogBtn"><a href="https://old.ajkersylhet.com/">পুরাতন সাইট</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="container MobileHide">
    
<div class="DLogoArea">
<div class="row">
      
<div class="col-lg-4">
<div class="DLogo d-flex justify-content-left">

<a href="<?php echo $row['url']; ?>">
<img src="images/<?php echo $row['hedderlogo']; ?>" alt="Web Title Here" title="<?php echo $row['name']; ?>" class="img-fluid img100" style="padding-top: 12px;">
</a>

</div>
</div> 
 
<div class="col-lg-8">
<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM ads WHERE id = 1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>
<img class="img-responsive" src="images/<?php echo $row['baneradtop']; ?>" alt="Ajker Sylhet Local Ad" width="100%" height="80px"> 
<?php } ?>
</div>
</div>
</div>

</div>

<div id="myHeader">
<div class="DHeaderNav MobileHide">
<div class="container">
<div class="row">
<div class="col-md-12">
<nav class="navbar navbar-expand-lg navbar-light bg-light">

<a href="<?php echo $row['url']; ?>" class="StickyLogo" rel="home">
<img src="images/<?php echo $row['hedderlogo']; ?>" title="Web Title Here" alt="Web Title Here" class="img-fluid img100">
</a>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav m-auto">
<li class="nav-item"><a class="nav-link" href="<?php echo $row['url']; ?>">প্রচ্ছদ </a></li>

<li class="nav-item"><a class="nav-link" href="category?catid=1">সিলেটজুড়ে</a></li>
<li class="nav-item"><a class="nav-link" href="category?catid=2">মহানগর</a></li>
<li class="nav-item"><a class="nav-link" href="category?catid=3">জাতীয়</a></li>
<li class="nav-item"><a class="nav-link" href="category?catid=4">রাজনীতি</a></li>
<li class="nav-item"><a class="nav-link" href="category?catid=5">আন্তর্জাতিক</a></li>
<li class="nav-item"><a class="nav-link" href="category?catid=8">অর্থনীতি </a></li>
<li class="nav-item"><a class="nav-link" href="category?catid=9">বিনোদন</a></li>
<li class="nav-item"><a class="nav-link" href="category?catid=10">ক্রীড়াঙ্গণ</a></li>
<li class="nav-item"><a class="nav-link" href="category?catid=11">প্রবাস</a></li>
<li class="nav-item"><a class="nav-link" href="about-us.php">যোগাযোগ</a></li>


<li class="nav-item dropdown position-static">
<a href="#" class="nav-link dropdown-toggle" id="mega1" data-bs-toggle="dropdown" aria-expanded="false">অন্যান্য <i class="fa fa-angle-down" aria-hidden="true"></i></a>
<div class="dropdown-menu w-100 top-auto" aria-labelledby="mega1">
<div class="container">
<div class="row w-100 pt-3 pb-3 pl-4" style="background-color: #fff;">

<div class="col-md-3">
<ul class="nav flex-column">
<li><a class="dropdown-item" href="category?catid=12">লাইফ-স্টাইল</a></li>
<li><a class="dropdown-item" href="category?catid=6">এক্সক্লুসিভ</a></li>
<li><a class="dropdown-item" href="category?catid=13">গণমাধ্যম</a></li>
<li><a class="dropdown-item" href="category?catid=14">চাকুরীর খবর</a></li>
<li><a class="dropdown-item" href="category?catid=15">তথ্য ও প্রযুক্তি</a></li>
<li><a class="dropdown-item" href="category?catid=16">ধর্ম ও জীবন</a></li>
<li><a class="dropdown-item" href="category?catid=17">বিচিত্র সংবাদ</a></li>
<li><a class="dropdown-item" href="category?catid=18">শিক্ষাঙ্গন</a></li>
<li><a class="dropdown-item" href="category?catid=7">সম্পাদকীয়</a></li>
<li><a class="dropdown-item" href="category?catid=19">সাহিত্য</a></li>
<li><a class="dropdown-item" href="category?catid=20">স্বাস্থ্য</a></li>

</ul>
</div>
</div>
</div>
</div>
</li>
<?php } ?>


<li class="menu-search">
<a class="nav-link-search" href="">
<i class="fa fa-search"></i>
</a>
</li>

</ul>
</div>
</nav>
</div>
</div>
</div>
</div>
</div>

<div class="search_block Hide MobileHide hidden-print">
<div class="container">
<div class="row">
<div class="col-xl pl-0 pr-0">
	<form class="navbar-form navbar-right" role="search" name="search" action="search.php" method="post">
        <div class="input-group">
        <input class="form-control" name="searchtitle" placeholder="সার্চ করুন..." name="q" type="text">
            <div class="input-group-btn">
              <button style="border-radius: 0px;" class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			  <a href="" class="close-search"><i class="fa fa-times"></i></a>
            </div>
        </div>
	</form>
</div>
</div>
</div>
</div>

<div id="myHeader2">
<div id="mobile-nav" class="MobileMenu MobileShow">
<div class="DMLogo d-flex h-100 align-items-center justify-content-center"><a href="https://ajkersylhet.com/"><img src="https://ajkersylhet.com/images/9c86482e30a12260a6d0bbbcb91e82ad.png" title="Web Title Here" alt="Web Title Here" class="img-fluid img100"></a></div>
<div class="d-flex h-100 align-items-center justify-content-start"><span onclick="if (!window.__cfRLUnblockHandlers) return false; myMenuBtnChng()" id="menu-button" class="menu-button fas fa-bars" data-cf-modified-e18c05d0688a614e23c19650-=""></span></div>
<div class=" d-flex h-100 align-items-center justify-content-end">
<div class="menu-search">
<a class="nav-link-search" href="">
<i class="fa fa-search"></i>
</a>
</div>
</div>
<div class="search_block Hide">
<div class="container">
<div class="col-xl p-0">
	<form class="navbar-form navbar-right" role="search" name="search" action="search.php" method="post">
        <div class="input-group">
        <input class="form-control" name="searchtitle" placeholder="সার্চ করুন..." name="q" type="text">
            <div class="input-group-btn">
              <button style="border-radius: 0px;" class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			  <a href="" class="close-search"><i class="fa fa-times"></i></a>
            </div>
        </div>
	</form>
</div>
</div>
</div>
<ul>
<li><a href="https://www.ajkersylhet.com/">প্রচ্ছদ</a></li>
<li><a href="category?catid=1">সিলেটজুড়ে</a></li>
<li><a href="category?catid=2">মহানগর</a></li>
<li><a href="category?catid=3">জাতীয়</a></li>
<li><a href="category?catid=4">রাজনীতি</a></li>
<li><a href="category?catid=5">আন্তর্জাতিক</a></li>
<li><a href="category?catid=8">অর্থনীতি</a></li>
<li><a href="category?catid=9">বিনোদন</a></li>
<li><a href="category?catid=10">ক্রীড়াঙ্গণ</a></li>
<li><a href="category?catid=111">প্রবাস</a></li>
<li><a href="about-us.php">যোগাযোগ</a></li>









<li class="parent">
<a href="#">আরও</a>
<ul class="SubMenuM">
</li>

<li><a href="">ছবি</a></li>
<li><a href="">ভিডিও গ্যালারি </a></li>

</ul>
</li>

</ul>
</div>
</div>
</header>
<!--header Line End--> 