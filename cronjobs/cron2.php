<?php

mysql_query("DELETE FROM tbl_referdata WHERE parent=0");
function getAccountCodeQuery()
{
	$query= "SELECT cd.code_referrer as parent,act.accounts_id as child FROM tbl_accounts as act JOIN tbl_code as cd WHERE act.code_id=cd.code_value";	
	return $query;
}

function getUserToCron($caa)
{
	#$caa = $caa - 1;
	$q = mysql_query("SELECT accounts_id FROM tbl_accounts WHERE bonus_cron='$caa' ORDER by accounts_id ASC LIMIT 1") or die(mysql_error());
	return mysql_fetch_assoc($q);
}
function countrows($query)
{
	return mysql_num_rows(mysql_query($query));
}
function cronlevel_toadd($data,$level,$mainparent)
{
	$parent = $data['accounts_id'];
    $query = "SELECT cd.code_referrer as parent,act.accounts_id as child FROM tbl_accounts as act JOIN tbl_code as cd WHERE act.code_id=cd.code_value AND cd.code_referrer='$parent' AND act.accounts_id NOT IN(SELECT child FROM tbl_referdata WHERE parent='$mainparent' AND act.accounts_id!=cd.code_referrer)";
	if(countrows($query)>0)
	{
		$rows = mysql_query($query);
		while($row=mysql_fetch_assoc($rows))
		{
			$parent_row = $mainparent;
			$child_row = $row['child'];
			$parent_row2 = $row['parent'];
			if($parent_row!=$child_row && countrows("SELECT id FROM tbl_referdata WHERE parent='$parent_row' AND child='$child_row'")==0)
			{
			$sqlx = "INSERT INTO tbl_referdata SET parent='$parent_row',parent_main='$parent_row2',child='$child_row',level='$level'";
			echo "$sqlx<br>";			
			mysql_query("INSERT INTO tbl_referdata SET parent='$parent_row',parent_main='$parent_row2',child='$child_row',level='$level'");				
			}

		}
		
	}
	return mysql_query($query);
}

function cronlevel_toedit($data,$level)
{
	$parent = $data['accounts_id'];
	$level = $level - 1;
    $query = "SELECT child FROM tbl_referdata WHERE parent='$parent' AND level='$level'";
	return mysql_query($query);
}


$curlevel = $_GET['level'];
$cron1edit = cronlevel_toedit(getUserToCron($curlevel),$curlevel);
$userdata = getUserToCron($curlevel);
 
while($row=mysql_fetch_assoc($cron1edit))
{
		$child = $row['child'];
		$data = array();
		$data['accounts_id'] = $child;
		cronlevel_toadd($data,$curlevel,$userdata['accounts_id']);
}
mysql_query("UPDATE tbl_accounts SET bonus_cron=bonus_cron + 1 WHERE accounts_id='".$userdata['accounts_id']."'");

if($userdata['accounts_id']=='')
{
	echo " # ";
	//do when no accounts related.
}
else
{
	echo "Processing:".$userdata['accounts_id']; 
}

?>
