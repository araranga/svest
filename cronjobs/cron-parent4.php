<?php
/* GENERATIONAL BONUS */
include("../connect.php");
include("../function.php");
$dateny = dateny();
$query = "SELECT *,(SELECT SUM(points) FROM tbl_buyproduct_history WHERE referdata.child=accounts_id and gendate_end='$dateny') as totalpoints,(SELECT SUM(points) FROM tbl_buyproduct_history WHERE referdata.parent=accounts_id and gendate_end='$dateny') as totalpoints_parent FROM tbl_referdata as referdata WHERE id NOT IN (SELECT id FROM tbl_referdata_payout WHERE gendate='$dateny') HAVING totalpoints>=400 AND totalpoints_parent>=400 LIMIT 10";

$q = mysql_query($query);
while($row=mysql_fetch_array($q))
{
	$level = getlevelgen($row['child'],$row['level']);
	echo "Total Rebates:".reward_gen($level) * $row['totalpoints'];
	echo "<br>";
	echo "Rebates:".reward_gen($level);
	echo "<br>";
	echo "Monthly P:".$row['totalpoints'];
	echo "<br>";
	echo "Level:".$level.">>".$row['level'];	
	echo "<hr>";
	addmoneybonus($row['parent'],reward_gen($level) * $row['totalpoints']);
	mysql_query("INSERT INTO tbl_referdata_payout SET id='".$row['id']."',gendate='$dateny'");
}
?>