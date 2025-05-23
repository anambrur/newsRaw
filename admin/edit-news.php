<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
header('location:index.php');
}
else{
if(isset($_POST['update']))
{
$posttitle= str_replace("'", "\'", $_POST['posttitle']);
$subtitle=$_POST['subtitle'];
$catid=$_POST['category'];
$postdetails= str_replace("'", "\'", $_POST['postdescription']);
$repoter=$_POST['reporter'];
$source=$_POST['source'];
$seoshort=$_POST['seoshort'];
$imageseo=$_POST['imageseo'];
$seomkey=$_POST['seomkey'];
$photocap=$_POST['photocap'];
$postingdate=$_POST['PostingDate'];
$arr = explode(" ",$posttitle);
$url=implode("-",$arr);
$status=1;
$postid=intval($_GET['pid']);


if ($_POST['test'] == 'value1'){
$On_Slider =1;
}else{
$On_Slider=0 ;
}


if ($_POST['sport'] == 'value1'){
$On_Sportlingt =1;
}else{
$On_Sportlingt=0 ;
}

if ($_POST['article'] == 'value1'){
$On_Article =1;
}else{
$On_Article=0 ;
}

if ($_POST['googlefeed'] == 'value1'){
$On_Gfeed =1;
}else{
$On_Gfeed=0 ;
}

if ($_POST['saveme'] == 'value1'){
$On_Save =1;
}else{
$On_Save=0 ;
}
  


      //if title already exists without current id
        $query = mysqli_query($con, "SELECT * FROM tblposts WHERE PostTitle='$posttitle' and id!='$postid' ");
        $count = mysqli_num_rows($query);
        if ($count > 0) {
            $error = "Post title already exists. Please choose a different one.";
        }else{
            $query=mysqli_query($con,"UPDATE tblposts SET PostTitle='$posttitle',CategoryId='$catid',PostDetails='$postdetails',PostingDate='$postingdate',PostUrl='$url',Is_Active='$status',On_Sportlingt='$On_Sportlingt',On_Slider='$On_Slider',On_Article='$On_Article',On_Gfeed='$On_Gfeed',On_Save='$On_Save',repoter=$repoter,source='$source',subtitle='$subtitle',photocap='$photocap',seoshort='$seoshort',imageseo='$imageseo',seomkey='$seomkey' WHERE id='$postid'");        
            if ($query) {
                $msg = "Post updated ";

                //current website domain
                $domain = $_SERVER['HTTP_HOST'];

                //get post url
                $posturl = 'https://'.$domain . "/template.php?nid=" . $postid;
                //get file content from link and crete a html file on news folder

                $file = file_get_contents($posturl);

                //create a folder on news folder
                @mkdir("../news/" . $postid, 0777, true);

                //put file cocontent
                file_put_contents("../news/" . $postid . "/index.html", $file);
    
    
            } else {
                $error = "Something went wrong . Please try again.";
            }
        }

       
    }
    ?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <title>Edit Post</title>
        <!-- [Meta] -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
          name="description"
          content="Gradient Able is trending dashboard template made using Bootstrap 5 design framework. Gradient Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies."
        />
        <meta
          name="keywords"
          content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard"
        />
        <meta name="author" content="codedthemes" />
    
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
        
        <!-- Old Admin Head Code Start -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" /
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <!-- Old Admin Head Code Start -->
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
            <?php include('includes/leftsidebar.php');?>
        </nav>
        <!-- [ Sidebar Menu ] end -->
         <!-- [ Header Topbar ] start -->
            <?php include('includes/topheader.php');?>
        <!-- [ Header ] end -->

        
        
        
          <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

                <!-- Start content -->
                
                
                <!-- [ Main Content ] start -->
                    <div class="pc-container">
                    <div class="pc-content" style="padding-top: 1px;background-color: #f3f3f3;">
                        
                        
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                          <div class="page-block card mb-0">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col-md-12">
                                  <div class="page-header-title border-bottom pb-2 mb-2">
                                    <h4 class="mb-0">Edit Post</h4>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <ul class="breadcrumb">
                                    <li class="breadcrumb-item"
                                      ><a href="../dashboard/index.html"><i class="ph ph-house"></i></a
                                    ></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">News Room</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Edit Post</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- [ breadcrumb ] end -->  
                          
                          
                          
                          
                          
                        <!-- [ Add Post Option ] Start -->
                        <div class="page-header">
                        <div class="page-block card mb-0">
                            <div class="card-body">
                    
     
                                <div class="row">
                            <div class="col-sm-6">
                                <!--Success Message-->
                                <?php if($msg){ ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                </div>
                                <?php } ?>
                                <!--Error Message-->
                                <?php if($error){ ?>
                                <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>    
                                <?php } ?>
                            </div>  
                        </div>        
                        <?php
                        $postid=intval($_GET['pid']);
                        $query=mysqli_query($con,"select tblposts.id as postid,tblposts.PostImage, tblposts.On_Slider,tblposts.PostingDate, tblposts.On_Sportlingt, tblposts.On_Article, tblposts.On_Gfeed, tblposts.On_Save, tblposts.PostTitle as title,tblposts.PostDetails,tblcategory.CategoryName as category,tblcategory.id as catid,tblsubcategory.SubCategoryId as subcatid,tblsubcategory.Subcategory as subcategory,tblposts.repoter,tblposts.source,tblposts.subtitle,tblposts.photocap,tblposts.seoshort,tblposts.imageseo,tblposts.seomkey from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$postid' and tblposts.Is_Active=1 ");
                        while($row=mysqli_fetch_array($query))
                        {
                        ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Post Title</label>
                                                <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['title']);?>" name="posttitle" placeholder="Enter title" required>
                                            </div>
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Post Sub Title</label>
                                                <input type="text" class="form-control" id="subtitle" value="<?php echo htmlentities($row['subtitle']);?>" name="subtitle" placeholder="Enter sub title">
                                            </div>
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Bottom Source</label>
                                                <input type="text" class="form-control" id="source" value="<?php echo htmlentities($row['source']);?>" name="source" placeholder="Enter source" required>
                                            </div>
                                            

                                            


                                            
                                            <?php
                                            if ( $row['On_Slider'] == 1) {
                                            $On_Slider = "checked";
                                            }
                                            ?>
                                            
                                            <?php
                                            if ( $row['On_Sportlingt'] == 1) {
                                            $On_Sportlingt = "checked";
                                            }
                                            ?>
                                            
                                            <?php
                                            if ( $row['On_Article'] == 1) {
                                            $On_Article = "checked";
                                            }
                                            ?>
                                            
                                            <?php
                                            if ( $row['On_Gfeed'] == 1) {
                                            $On_Gfeed = "checked";
                                            }
                                            ?>
                                            
                                            <?php
                                            if ( $row['On_Save'] == 1) {
                                            $On_Save = "checked";
                                            }
                                            ?>
                
                                            <div class="row">
                                               
                                                    <div class="col-sm-6">
                                                    <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                        <p>
                                                            <input type="checkbox" id="test3" name="test" value="value1" <?php echo $On_Slider ?>>
                                                            <label for="test3">Add To Led </label>
                                                        </p>
                                                    </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                        <p>
                                                            <input type="checkbox" id="test4" name="sport" value="value1" <?php echo $On_Sportlingt ?>>
                                                            <label for="test4">Add To Sub Led</label>
                                                        </p>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                    <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                        <p>
                                                            <input type="checkbox" id="test5" name="article" value="value1" <?php echo $On_Article ?>>
                                                            <label for="test5">Add To Articles</label>
                                                        </p>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                    <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                        <p>
                                                            <input type="checkbox" id="test6" name="googlefeed" value="value1" <?php echo $On_Gfeed ?>>
                                                            <label for="test6">Add To Feed</label>
                                                        </p>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                    <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                        <p>
                                                            <input type="checkbox" id="test7" name="saveme" value="value1" <?php echo $On_Save ?>>
                                                            <label for="test7">Save Me</label>
                                                        </p>
                                                    </div>
                                                    </div>
                                            </div>
                                         
      
      
      
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                                        <textarea class="summernote" name="postdescription" required><?php echo htmlentities($row['PostDetails']);?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                        </div> <!-- end p-20 -->
                                        </div> <!-- end col -->
                                        
                                        
                                         
                                        <div class="col-md-4">
                                            
                                            <div class="row">    
                                                <div class="col-sm-12">
                                                    <h4 class="header-title"><b>Current News Image</b></h4>
                                                    <div class="card-box">
                                                        <img src="images/postimages/<?php echo htmlentities($row['PostImage']);?>" width="100%"/>
                                                        <br/><br/>
                                                        <a href="change-image.php?pid=<?php echo htmlentities($row['postid']);?>">Update News Image</a>
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="form-group m-b-20">  
                                                    <label for="exampleInputEmail1">Date</label>
                                                    <input type="datetime-local" class="form-control" id="photocap" value="<?php echo htmlentities($row['PostingDate']);?>" name="PostingDate" placeholder="Enter Date"> 
                                            </div>
                                            
                                            
                                            <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Photo Caption</label>
                                                    <input type="text" class="form-control" id="photocap" value="<?php echo htmlentities($row['photocap']);?>" name="photocap" placeholder="Enter Photo Caption"> 
                                            </div>
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Category</label>
                                                <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                                                    <option value="<?php echo htmlentities($row['catid']);?>"><?php echo htmlentities($row['category']);?></option>
                                                    <?php
                                                    // Feching active categories
                                                    $ret=mysqli_query($con,"select id,CategoryName from  tblcategory where Is_Active=1");
                                                    while($result=mysqli_fetch_array($ret))
                                                    {
                                                    ?>
                                                    <option value="<?php echo htmlentities($result['id']);?>" ><?php echo htmlentities($result['CategoryName']);?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Reporter</label>
                                                <select class="form-control" name="reporter" id="category" required>
                                                    <option value="">Select Reporter </option>
                                                    <?php
                                                
                                                    $rets=mysqli_query($con,"select * from  reporter where deleted='false'");
                                                    while($result=mysqli_fetch_array($rets))
                                                    {    
                                                        ?>
                                                        <option value="<?php echo htmlentities($result['reporterID']);?>" <?php if($row['repoter']==$result['reporterID']){ echo "selected";} ?>><?php echo htmlentities($result['name']);?></option>
                                                        <?php } ?>

                                                    </select> 
                                            </div>

                
                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">SEO Post Short Details</label>
                                                    <input type="text" class="form-control" id="seoshort" value="<?php echo htmlentities($row['seoshort']);?>" name="seoshort" placeholder="Enter SEO Shorts"> 
                                                </div>
                                                    
                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">SEO Post Image Name</label>
                                                    <input type="text" class="form-control" id="imageseo" value="<?php echo htmlentities($row['imageseo']);?>" name="imageseo" placeholder="Enter SEO Image Name"> 
                                                </div>
                                                    
                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">SEO Meta Key Word</label>
                                                    <input type="text" class="form-control" id="seomkey" value="<?php echo htmlentities($row['seomkey']);?>" name="seomkey" placeholder="Enter SEO Post Keyword"> 
                                                </div>
                                              
                                            <?php } ?>
                                            <button type="submit" name="update" class="btn btn-success waves-effect waves-light"> Update Post </button>
      
                                        </div>
                                    </div>
                    
                    
                    
                    
                            </div>
                        </div>
                    </div>
                <!-- [ Add Post Option ] End -->
                
                
                <!-- [ Main Content ] start -->
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                         
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
                        <!-- [ Main Content ] end -->
                      </div>
                    </div>
                    <!-- [ Main Content ] end -->
                    
                    

           <?php include('includes/footer.php');?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->




         
    


    </body>
</html>
<?php } ?>
