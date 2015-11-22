<?php
session_start();
require_once("../../connect.php");
require_once("../../function.php");
$email  = $_POST['email'];
$pass = $_POST['password'];
$table = "tbl_accounts";
$query = "SELECT * FROM $table WHERE email='$email' ";
$q = mysql_query($query);
$count = mysql_num_rows($q);
if($count>=1)
{
	echo 1;	
$row = mysql_fetch_assoc($q);	
$to = $row['email'];
$subject = "Password Retrieval";$txt =  "Username:".$row['username'];
$txt = $txt." Password:".$row['password'];
$headers = "From: noreply@sureinvest-oms.com" . "\r\n" .
"CC: sureinvest2015@gmail.com";
mail($to,$subject,$txt,$headers);	
}
if($count==0)
{
	echo $count;	
}
?>