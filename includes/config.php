<?php
$con = mysqli_connect(FDB_SERVER,FDB_USERNAME,FDB_PASSWORD,FDB_NAME);
$con->set_charset("utf8");
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>