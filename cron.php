<?php
/*
RESET


TRUNCATE tbl_othertablebeta;
TRUNCATE tbl_reward;
UPDATE tbl_accounts SET curtbl='',balance=0,total_earnings=0,cron_status='';
*/
include("connect.php");
include("function.php");
$q = mysql_query("SELECT * FROM tbl_accounts WHERE cron_status='' LIMIT 0,45");
if(mysql_num_rows($q)==0)
{
	mysql_query("UPDATE tbl_accounts SET cron_status=''");
	exit();
}
while($cronrow=mysql_fetch_assoc($q))
{
mysql_query("UPDATE tbl_accounts SET cron_status='1' WHERE accounts_id='".$cronrow['accounts_id']."'");
$msg = "Done Cron:".implode(",",$cronrow);
	

echo $msg."---";


		$qx = mysql_query("SELECT * FROM tbl_code as a JOIN tbl_rate as b WHERE b.rate_id=a.code_package AND a.code_value='".$cronrow['code_id']."'");
		$qxrow = mysql_fetch_assoc($qx);	
		if($qxrow['rate_req']==3)
		{
		$limitsx = 7;
		}
		if($qxrow['rate_req']==4)
		{
		$limitsx = 15;
		}					
		if($qxrow['rate_req']==2)
		{
		$limitsx = 3;
		}	

		if($cronrow['curtbl']=='')
		{
		breakfree_child_wager(array($cronrow['accounts_id']),"wager",$limitsx);
		$cd = countdownlines_dashboard($_GET['wager']);
		}
		else
		{
		breakfree_child_wager_bonus(array($cronrow['accounts_id']),"wager",$limitsx,$cronrow['curtbl']);
		$cd = countdownlines($_GET['wager']);
		}
				





		if($_GET['tp']==1)
		{
		echo "$cd = $limitsx @@ $cd>=$limitsx";
		echo "<pre>";
		print_r($_GET['wager']);
		echo "</pre>";
		}
		if($limitsx=='')
		{
		exit("ERROR");
		}

		mail("genesismind2930@gmail.com","CRON JOB GENESIS - ".$cronrow['username'],"STATUS $cd/$limitsx = ".$cronrow['username'].":::".$cronrow['password']);
		if($cd>=$limitsx)
		{
		if($cronrow['curtbl']=='')
		{						
		echo "reward main";
		addmoney($qxrow['rate_end'],$cronrow['accounts_id'],$qxrow['rate_id']);
		}
		else
		{
		echo "reward bonus";
		addmoneyothertbl($qxrow['rate_bonus'],$cronrow['accounts_id']);
		}
		} 
		echo "<br>";
		unset($_GET['wager']);
}
?>