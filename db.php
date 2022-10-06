
<?php
 error_reporting(E_ERROR | E_PARSE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con  = mysqli_connect("localhost","root","","twitter");
$select_db=mysqli_select_db($con,'twitter');
if(!con){
   die("Not Connected");
   
}
?>

