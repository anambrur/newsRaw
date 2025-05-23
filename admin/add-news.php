<?php 
session_start();
include('includes/config.php');
include('includes/resizeLib.php');
error_reporting(0);

function imageGenerator($input, $overlay, $output)
{
    $png = imagecreatefrompng($overlay);

    $file_parts = pathinfo($input);

    switch ($file_parts['extension']) {

        case "gif":
            $image = imagecreatefromgif($input);
            break;

        case "jpg":
            $image = imagecreatefromjpeg($input);
            break;

        case "webp":
            $image = imagecreatefromwebp($input);
            break;

        case "jpeg":
            $image = imagecreatefromjpeg($input);
            break;

        case "png":
            $image = imagecreatefrompng($input);
            break;
    }


    list($width, $height) = getimagesize($input);
    list($newwidth, $newheight) = getimagesize($overlay);
    $out = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($out, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
    imagejpeg($out, $output, 100);
}


if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else{

// For adding post  
    if(isset($_POST['submit']))
    {
        $posttitle= str_replace("'", "\'", $_POST['posttitle']);
        $catid=$_POST['category'];
        $postdetails= str_replace("'", "\'", $_POST['postdescription']);
        $reporter=$_POST['reporter'];
        $subtitle=$_POST['subtitle'];
        $source=$_POST['source'];
        $photocap=$_POST['photocap'];
        $seoshort=$_POST['seoshort'];
        $imageseo=$_POST['imageseo'];
        $seomkey=$_POST['seomkey'];
        $arr = explode(" ",$posttitle);
        $url=implode("-",$arr);
        $imgfile=$_FILES["postimage"]["name"];
// get the image extension
/*$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));*/
        $path = $_FILES['postimage']['name'];
        $extension=pathinfo($path, PATHINFO_EXTENSION);
// allowed extensions
        $allowed_extensions = array("jpg","jpeg","png","gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
  

        if(!in_array($extension,$allowed_extensions))
        {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        }
        else
        {
//rename the image file  
            $imgnewfile="news_image_". md5($imgfile).time().'.'.$extension;
			$simgnewfile=uniqid($simgfile).'.'.$sextension;
// Code for move image into directory
            move_uploaded_file($_FILES["postimage"]["tmp_name"],"images/postimages/".$imgnewfile);

            $status=1;


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
        
        
           
        
        $date=date('Y-m-d h:i:s');
        //if title already exists
            $query = mysqli_query($con, "select * from tblposts where PostTitle='$posttitle'");
            $count = mysqli_num_rows($query);
            if ($count > 0) {
                $error = "Post title already exists. Please choose a different one.";

            } else {
                $query=mysqli_query($con,"INSERT INTO tblposts (PostTitle,CategoryId,PostDetails,PostUrl,Is_Active,On_Slider,On_Sportlingt,On_Article,On_Gfeed,On_Save,PostImage,repoter,source,subtitle,photocap,seoshort,imageseo,seomkey,PostingDate) VALUES('$posttitle','$catid','$postdetails','$url','$status','$On_Slider','$On_Sportlingt','$On_Article','$On_Gfeed','$On_Save','$imgnewfile',$reporter,'$source','$subtitle','$photocap','$seoshort','$imageseo','$seomkey','$date')");

                $resizeObj = new resize("images/postimages/" . $imgnewfile);
                $resizeObj->resizeImage(300, 200, 'exact');
                $resizeObj->saveImage("images/thumb/" . $imgnewfile, 100);
                if ($query) {
                $msg = "Post successfully added ";
                 
   
                } else {
                    $error = "Something went wrong . Please try again.";
                }
            }

        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <title>Add News</title>
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
        <style>  
            .form-group label {
        font-size: 20px
        }
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
                                    <h4 class="mb-0">Add Post</h4>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <ul class="breadcrumb">
                                    <li class="breadcrumb-item"
                                      ><a href="../dashboard/index.html"><i class="ph ph-house"></i></a
                                    ></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">News Room</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Add Post</li>
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
                                                <strong>Well done!</strong>
                                                <?php echo htmlentities($msg);?>
                                            </div>
                                            <?php } ?>
                    
                                            <!--Error Message-->
                                            <?php if($error){ ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh snap!</strong>
                                                    <?php echo htmlentities($error);?>
                                                </div>
                                            <?php } ?>
                    
                    
                                    </div>
                                </div>
                    
                    
                                <div class="row">
                    
                                    <div class="col-md-8">
                                        <div class="p-6">
                                            <div class="">
                                                <form name="addpost" method="post" enctype="multipart/form-data">
                                                    <div class="form-group m-b-20">
                                                        <p style="font-size:18px">Post Title</p>
                                                        <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Enter title" required>
                                                    </div>
                                                    <div class="form-group m-b-20">
                                                        <p style="font-size:18px">Post Sub Title</p>
                                                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Enter sub title">
                                                    </div>
                                                    <div class="form-group m-b-20">
                                                        <p style="font-size:18px">Bottom Source</p>
                                                        <input type="text" class="form-control" id="posttitle" name="source" placeholder="Enter source" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                                <p>
                                                                    <input type="checkbox" id="test3" name="test" value="value1">
                                                                    <label for="test3">Add To Led </label>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                                <p>
                                                                    <input type="checkbox" id="test4" name="sport" value="value1">
                                                                    <label for="test4">Add To Sub Led</label>
                                                                </p>
                                                            </div>
                                                        </div>
                    
                                                        <div class="col-sm-4">
                                                            <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                                <p>
                                                                    <input type="checkbox" id="test5" name="article" value="value1">
                                                                    <label for="test5">Add To Articles</label>
                                                                </p>
                                                            </div>
                                                        </div>
                    
                                                        <div class="col-sm-4">
                                                            <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                                <p>
                                                                    <input type="checkbox" id="test6" name="googlefeed" value="value1">
                                                                    <label for="test6">Add To Feed</label>
                                                                </p>
                                                            </div>
                                                        </div>
                    
                    
                                                        <div class="col-sm-4">
                                                            <div class="card" style="padding-left: 20px;padding-top: 15px;background-color: #f3f3f3;">
                                                                <p>
                                                                    <input type="checkbox" id="test7" name="saveme" value="value1">
                                                                    <label for="test7">Save Me</label>
                                                                </p>
                                                            </div>
                                                        </div>
                    
                                                    </div>
                                                    </br>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="card-box">
                                                                <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                                                <textarea class="summernote" name="postdescription" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- end p-20 -->
                                    </div>
                                    <!-- end col -->
                    
                    
                    
                                    <div class="col-md-4">
                    
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group m-b-20">
                    
                                                    <p style="font-size:18px">Select News Image</p>
                                                    <input type="file" id="postimage" name="postimage" accept="image/*" onchange="loadFile(event)" required>
                                                    <img style="max-width: 100%" id="output" />
                                                    <script>
                                                        var loadFile = function(event) {
                                                            var output = document.getElementById('output');
                                                            output.src = URL.createObjectURL(event.target.files[0]);
                                                            output.onload = function() {
                                                              URL.revokeObjectURL(output.src) // free memory
                                                            }
                                                          };
                                                    </script>
                                                </div>
                    
                                                <div class="form-group m-b-20">
                                                    <p style="font-size:18px">Photo Caption</p>
                                                    <input type="text" class="form-control" id="photocap" name="photocap" placeholder="Photo Caption">
                                                </div>
                    
                    
                                                <div class="form-group m-b-20">
                                                    <p style="font-size:18px">Category</p>
                                                    <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                                                        <option value="">Select Category </option>
                                                        <?php
                                                                    $ret=mysqli_query($con,"select id,CategoryName from  tblcategory where Is_Active=1");
                                                                    while($result=mysqli_fetch_array($ret))
                                                                    {    
                                                                        ?>
                                                            <option value="<?php echo htmlentities($result['id']);?>">
                                                                <?php echo htmlentities($result['CategoryName']);?>
                                                            </option>
                                                            <?php } ?>
                    
                                                    </select>
                    
                                                    <style type="text/css">
                                                    </style>
                                                </div>
                    
                    
                                                <div class="form-group m-b-20">
                                                    <p style="font-size:18px">Reporter</p>
                                                    <select class="form-control" name="reporter" id="category" required>
                                                        <option value="">Select Reporter </option>
                                                        <?php
                                                                        $rets=mysqli_query($con,"select * from  reporter where deleted='false'");
                                                                        while($result=mysqli_fetch_array($rets))
                                                                        {    
                                                                            ?>
                                                            <option value="<?php echo htmlentities($result['reporterID']);?>">
                                                                <?php echo htmlentities($result['name']);?>
                                                            </option>
                                                            <?php } ?>
                    
                                                    </select>
                                                </div>
                                                <hr>
                                                <h4 style="color:#2b71b4"> Advance SEO (Optional) </h4>
                                                <hr>
                                                <div class="form-group m-b-20">
                                                    <p style="font-size:18px">SEO Post Short Details</p>
                                                    <input type="text" class="form-control" id="seoshort" name="seoshort" placeholder="Enter SEO Post Short Details">
                                                </div>
                    
                                                <div class="form-group m-b-20">
                    
                                                    <p style="font-size:18px">SEO Post Image Name</p>
                                                    <input type="text" class="form-control" id="imageseo" name="imageseo" placeholder="Enter SEO Post Image Name">
                                                </div>
                    
                    
                                                <div class="form-group m-b-20">
                                                    <p style="font-size:18px">SEO Meta Key Word</p>
                                                    <input type="text" class="form-control" id="seomkey" name="seomkey" placeholder="Enter SEO Meta Key Word">
                                                </div>
                    
                                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Publish Post</button>
                                                <button type="button" class="btn btn-danger waves-effect waves-light">Delete Data</button>
                                                </form>
                                            </div>
                    
                    
                                        </div>
                                    </div>
                                    <!-- Add Post Side Bar -->
                    
                                </div>
                    
                                <!-- end row -->
                    
                    
                    
                    
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
