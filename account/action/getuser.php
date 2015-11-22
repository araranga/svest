<?php
session_start();
require_once("../../connect.php");
require_once("../../function.php");
$user  = $_POST['id'];
$table = "tbl_accounts";
$query = "SELECT username,firstname,lastname,birthdate,gender,occupation,civilstatus,address,mobile,email,telno FROM $table WHERE accounts_id='$user'";
$q = mysql_query($query);
$row = mysql_fetch_assoc($q);
?>
<style>
@media screen and (max-width: 767px) {
	.imgx
	{
	width:50%;
	}
}
</style>
<a href='javascript:void(0)' onclick='closepopup()' style='float:right;'><i class="fa fa-times"></i>Close me</a>
<br style='clear:both;'>
<div style='text-align:center;'><img class='imgx' src='assets/img/<?php echo strtolower($row['gender']);?>.png'/></div>
<center>
<table>
<?php

	foreach($row as $key=>$val)
	{
?>
<tr><td><strong><?php echo ucfirst($key);?>:</strong></td><td><?php echo $val;?></td></tr>
<?php
	}
?>
</table>
</center>