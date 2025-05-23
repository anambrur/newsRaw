<?php
date_default_timezone_set('Asia/Dhaka');
require_once('../config.php');
require_once('../db.php');
include('Active_record.php');
$con = mysqli_connect(FDB_SERVER, FDB_USERNAME, FDB_PASSWORD, FDB_NAME);
$con->set_charset("utf8");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$orm = new Active_record(FDB_SERVER, FDB_USERNAME, FDB_PASSWORD, FDB_NAME);
?>


<?php
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM settings WHERE id = 1");
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {

    $url = $row['url'];
    $name = $row['name'];
}
?>
