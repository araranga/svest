<?php
/* CRON FOR DIRECT/INDIRECT BONUS PAYOUT */
include("../connect.php");
include("../function.php");
$dateny = dateny();
$q = mysql_query("SELECT * FROM tbl_referdata WHERE level<=10 AND paid='' LIMIT 10");
while($row=mysql_fetch_array($q))
{
	addmoneybonus($row['parent'],reward($row['level']));
	mysql_query("UPDATE tbl_referdata SET paid='1' WHERE id='".$row['id']."'");
}
?>