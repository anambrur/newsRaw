<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
if (isset($_POST['login'])) {

  // Getting username/ email and password
  $uname = $_POST['username'];
  $password = $_POST['password'];
  // Fetch data from database on the basis of username/email and password
  $sql = mysqli_query($con, "SELECT AdminUserName,AdminEmailId,AdminPassword,role FROM tbladmin WHERE (AdminUserName='$uname' || AdminEmailId='$uname')");
  $num = mysqli_fetch_array($sql);
  if ($num > 0) {
    $hashpassword = $num['AdminPassword']; // Hashed password fething from database
    //verifying Password
    if (password_verify($password, $hashpassword)) {
      $_SESSION['login'] = $_POST['username'];
      $_SESSION['role'] = $num['role'];
      echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
      echo "<script>alert('Wrong Password');</script>";
    }
  }
  //if username or email not found in database
  else {
    echo "<script>alert('User not registered with us');</script>";
  }
}
// $password='12345';
// $options = ['cost' => 12];
// echo $hashedpass=password_hash($password, PASSWORD_BCRYPT, $options);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    IT Factory Admin Login
  </title>
  <!-- [Favicon] icon -->
  <link rel="icon" href="assets/images/favicon.svg" type="image/x-icon" />
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
</head>


<body style="background-color:#20547b">

  <div class="auth-main v1 bg-grd-primary">
    <div class="auth-wrapper">

      <div class="auth-form" method="post">
        <div class="card my-5">
          <div class="card-body">
            <div class="text-center">
              <img src="assets/images/itfactory-login-logo.png" alt="images" class="img-fluid mb-4" style="width: 150px;" />
              <h4 class="f-w-500 mb-1">IT Factory Admin Panel</h4>
              <p class="mb-4">You can contact us for your website development.<a href="https://bditfactory.com" class="link-primary ms-1">Book Appointment</a></p>
            </div>

            <form class="form-horizontal" method="post">

              <div class="form-group ">
                <div class="col-xs-12">
                  <input class="form-control" type="text" required="" name="username" placeholder="Username or email" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <input class="form-control" type="password" name="password" required="" placeholder="Password" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <input class="form-control" type="" name="" placeholder="OPT Here" autocomplete="off">
                </div>
              </div>

              <div class="field-group">
                <div><input type="checkbox" name="remember" id="remember" value="1" <?php if (isset($_COOKIE["index"])) { ?> checked <?php } ?> />
                  <label for="remember-me">Remember me</label>
                </div>

                <div class="form-group text-center m-t-10">
                  <div class="col-xs-12">
                    <button class="btn btn-primary" type="submit" name="login">Log In</button>
                  </div>
                </div>

            </form>

            <div class="clearfix"></div>

          </div>

          <div class="saprator my-3">
            <span>Or continue with</span>
          </div>


          <div class="text-center">
            <ul class="list-inline mx-auto mt-3 mb-0">
              <li class="list-inline-item">
                <a href="https://www.facebook.com/" class="avtar avtar-s rounded-circle bg-facebook" target="_blank">
                  <i class="fab fa-facebook-f text-white"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://twitter.com/" class="avtar avtar-s rounded-circle bg-twitter" target="_blank">
                  <i class="fab fa-twitter text-white"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://myaccount.google.com/" class="avtar avtar-s rounded-circle bg-googleplus" target="_blank">
                  <i class="fab fa-google text-white"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>



  </div>
  </div>

  <script>
    var resizefunc = [];
  </script>

  <!-- jQuery  -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/detect.js"></script>
  <script src="assets/js/fastclick.js"></script>
  <script src="assets/js/jquery.blockUI.js"></script>
  <script src="assets/js/waves.js"></script>
  <script src="assets/js/jquery.slimscroll.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>

  <!-- App js -->
  <script src="assets/js/jquery.core.js"></script>
  <script src="assets/js/jquery.app.js"></script>

</body>

</html>