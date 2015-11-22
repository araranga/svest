<?php
/* CRON FOR PERSONAL BONUS */
include("../connect.php");
include("../function.php");
$dateny = dateny();
$query = "SELECT * ,(SELECT SUM(points) FROM tbl_buyproduct_history WHERE buyprod.accounts_id=accounts_id and buyprod.gendate_end=gendate_end) as totalpoints FROM tbl_buyproduct_history as buyprod WHERE gendate_end='".$dateny."' AND is_paid='' GROUP by accounts_id,gendate_end HAVING totalpoints >= 400";
//echo $query;
$q = mysql_query($query);
while($row=mysql_fetch_array($q))
{
	addmoneybonus($row['accounts_id'],personalbonus($row['totalpoints']));
	mysql_query("UPDATE tbl_buyproduct_history SET is_paid='1' WHERE gendate_end='$dateny' AND accounts_id='".$row['accounts_id']."'");
	//echo $row['id']."<Br>";
}
?> 