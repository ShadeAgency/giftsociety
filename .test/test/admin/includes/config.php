<?php
define('DB_SERVER','');
define('DB_USER','shadecrm_test');
define('DB_PASS' ,'anubhavi00');
define('DB_NAME','shadecrm_test');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>