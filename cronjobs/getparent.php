<?php
/* GENERATIONAL BONUS */
include("../connect.php");
include("../function.php");
$dateny = dateny();


$level = 9;
$child = 1615;
$checker = 0;
function getparentgen($child,$level)
{
	$query = "SELECT parent FROM tbl_referdata WHERE level='$level' AND child='$child'";
	$row = mysql_fetch_array($query);
	return $row['parent'];
}

while($checker==0)
{
	
	$level--;
}


?>