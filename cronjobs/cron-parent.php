<?php
/* CRON FOR DIRECT INDIRECT BONUS */
include("../connect.php");
$cron = "SELECT bonus_cron FROM tbl_accounts GROUP by bonus_cron ORDER by bonus_cron ASC LIMIT 1";
$cron_query = mysql_query($cron);
$cron_row = mysql_fetch_assoc($cron_query);

$bonus = $cron_row['bonus_cron'];
echo "Current Level:".$bonus."<br>";
$_GET['level'] = $bonus;
if($bonus==16)
{
	mysql_query("UPDATE tbl_accounts SET bonus_cron = 1");
	exit();
}
if($bonus==1)
{
	include("cron1.php");
}
else
{
	include("cron2.php");
}
?>