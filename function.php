<?php
function getbaseme()
{
	$q = mysql_query("SELECT * FROM tbl_core_config_data WHERE path='web/unsecure/base_url'");
	$row = mysql_fetch_array($q);
	return $row['value'];
}
function loadprofilex($id)
{
	if($id!='')
	{
 $q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$id'");
 $row = mysql_fetch_assoc($q);
 if($row['accounts_id']!=$_SESSION['accounts_id'])
 {
 	$return .= "<div class='peoplewith'><p onclick='profile($id)'>".$row['username'];
	$return .= "<br/><img width='55' src='assets/img/".strtolower($row['gender']).".png' style='display:none;'/>";
	$return .= "</p></div>";
 }
 else
 {
 	$return .= "<div class='peoplewith'><p onclick='profile($id)'>You";
	$return .= "<br/><img width='55' src='assets/img/".strtolower($row['gender']).".png' style='display:none;'/>";
	$return .= "</p></div>"; 
 }

	
	return $return;		
	}
	else{
		return "<div class='peoplewithout'><p>EMPTY<br/><img width='55' src='assets/img/none.png' style='display:none;'/></p></div>";
	}

}


function success200($curtbladded,$id)
{
$log  = '';
			$q1 = mysql_query("SELECT parent as parentx,curtbl,(SELECT COUNT(child) FROM tbl_othertablebeta WHERE parent=parentx AND curtbl='$curtbladded') AS total FROM tbl_othertablebeta WHERE curtbl = '$curtbladded' AND parent!=0
			GROUP by parent
			HAVING total < 2");			
			$q1row = mysql_fetch_assoc($q1);
			if($q1row['parentx']=='')
			{
				$q2 = mysql_query("SELECT child FROM tbl_othertablebeta  WHERE curtbl='$curtbladded' AND child NOT IN (SELECT parent FROM tbl_othertablebeta WHERE curtbl='$curtbladded') GROUP by child ORDER BY id ASC LIMIT 0 , 1");			
				$q2row = mysql_fetch_assoc($q2);
				if($q2row['child']!='')
				{
					mysql_query("INSERT INTO tbl_othertablebeta SET curtbl='$curtbladded',child='$id',parent='".$q2row['child']."'");								
				}
				else
				{
					$q3 = mysql_query("SELECT child FROM tbl_othertablebeta WHERE parent=0 AND curtbl='$curtbladded'");									
					if(mysql_num_rows($q3)==0)
					{
					mysql_query("INSERT INTO tbl_othertablebeta SET curtbl='$curtbladded',child='$id',parent='0'");						
					}
					else
					{
					$q3row = mysql_fetch_assoc($q3);
					mysql_query("INSERT INTO tbl_othertablebeta SET curtbl='$curtbladded',child='$id',parent='".$q3row['child']."'");											
					mysql_query("DELETE FROM tbl_othertablebeta WHERE child='".$q3row['child']."' AND parent='0' AND curtbl='$curtbladded'");
					} 
				}
			} 
			else
			{	
				mysql_query("DELETE FROM tbl_othertablebeta WHERE child='".$q1row['parentx']."' AND parent='0' AND curtbl='$curtbladded'");
				mysql_query("INSERT INTO tbl_othertablebeta SET curtbl='$curtbladded',child='$id',parent='".$q1row['parentx']."'");						
			}	
			
			#mysql_query("INSERT INTO tbl_logger SET acc='$id',log='$log'");
	
}
function mytimestamp()
{
	return date('Y-m-d H:i:s');
}
function addmoneyothertbl($amount,$id)
{
$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$id'");
$row = mysql_fetch_assoc($q);
//update
$curtbl = $row['curtbl'];
$explode = explode("_",$curtbl);
$newid = $explode[1] + 1;
$rand = rand(1,8);
$curtbladded = $explode[0]."_".$newid;
$balance = $row['balance'] + $amount;
$total_earnings = $row['total_earnings'] + $amount;
$timenow = mytimestamp();
$package = $explode[0];

//rates condition
$rates = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_rate WHERE rate_id='$package'"));



if($rates['bonus_limit']>=$newid)
{
	addreferbonus($row['code_id'],$rates['rate_referbonus']);
	addbonusitem($id,$package,$explode[1]);
	mysql_query("UPDATE tbl_accounts SET balance='$balance',total_earnings='$total_earnings',curtbl='$curtbladded' WHERE accounts_id='$id'");
	mysql_query("INSERT INTO tbl_reward SET accounts_id='$id',curtbl='$curtbladded',done='no'");
	mysql_query("UPDATE tbl_reward SET done='yes',date_payout='$timenow' WHERE accounts_id='$id' AND curtbl='$curtbl'");	
}
else
{
	mysql_query("UPDATE tbl_accounts SET curtbl='$curtbladded' WHERE accounts_id='$id'");
}


//tweak here
success200($curtbladded,$id);
//
	
//
}
	#addmoneyothertbl(3500,2);

function addmoneybonus($userid,$amount)
{
	mysql_query("UPDATE tbl_accounts SET balance_extra=balance_extra + $amount WHERE accounts_id='$userid'");
}

function addmoney($amount,$id,$package)
{
	//balance
	//total_earnings
	$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$id'");
	$row = mysql_fetch_assoc($q);
	if($row['curtbl']=='')
	{	

	$rates = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_rate WHERE rate_id='$package'"));
	if($rates['current_open']<=$rates['rate_bonus_opentable'])
	{
			$rand = $rates['current_open'];
			if($rand!=$rates['rate_bonus_opentable'])
			{
				$updaterand = $rand + 1;
			}
			else
			{
				$updaterand = 1;
			}
			mysql_query("UPDATE tbl_rate SET current_open='$updaterand' WHERE rate_id='$package'");
			
	}
		
	$curtbl = $package."_"."2"."_".$rand;
	$timenow = mytimestamp();

	$balance = $row['balance'] + $amount;
	$total_earnings = $row['total_earnings'] + $amount;
	addreferbonus($row['code_id'],$rates['rate_referbonus']);
	addbonusitem($id,$package,1);
	
	
	mysql_query("UPDATE tbl_accounts SET balance='$balance',total_earnings='$total_earnings',curtbl='$curtbl',date_payout='$timenow' WHERE accounts_id='$id'");
				if($rates['bonus']=='no')
				{
					//DO NOTHING 
				}
				else 
				{
					//tweak here
					mysql_query("INSERT INTO tbl_reward SET accounts_id='$id',curtbl='$curtbl',done='no'");
					success200($curtbl,$id);
					//	
				}
	}
}

function addbonusitem($account_id,$rate_id,$exit_number)
{
	$q = mysql_query("SELECT * FROM tbl_exitbonusmanager WHERE rate_id='$rate_id' AND exit_number='$exit_number'");
	while($row=mysql_fetch_array($q))
	{
		$exitbonusmanager_id = $row['exitbonusmanager_id'];
		mysql_query("INSERT INTO tbl_exitbonushistory SET bonus_id='$exitbonusmanager_id',account_id='$account_id',status='1'");
	}
}
function addreferbonus($code_id,$amount)
{
	$qx = mysql_query("SELECT * FROM tbl_code WHERE code_value='$code_id'");
	$qxrow = mysql_fetch_array($qx);
	$refer_id = $qxrow['code_referrer'];
	if($refer_id!='')
	{
		//code_referrer
		$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$refer_id'");
		$row = mysql_fetch_assoc($q);	
		$balance = $row['balance'] + $amount;
		$total_earnings = $row['total_earnings'] + $amount;	
		mysql_query("UPDATE tbl_accounts SET balance='$balance',total_earnings='$total_earnings' WHERE accounts_id='$refer_id'");
	}
}

    function getrow($table)
    {
        $query = mysql_query("SELECT * FROM $table LIMIT 1");
        $row = mysql_fetch_array($query);
        return $row;
    }
	function countfield($field,$value)
	{
		$query = mysql_query("SELECT * FROM tbl_accounts WHERE $field='$value'");
		return mysql_num_rows($query);
	}
	function formquery($post)
	{
	$return = array();
	foreach($post as $key=>$val)
	{
		$return[] = "$key='$val'";
	}
	 return implode(",",$return);
	}
	
	function countresult($xx)
	{
	$query = mysql_query($xx);
	return mysql_num_rows($query);
	}
	
	function setinsert($array)
	{
	$return = array();
	
		foreach($array as $key=>$val)
		{
		$return[] = "$key='$val'";
		}
	
	return implode(",",$return);
	}
	
	

	function getchildwagess_dashboard($id)
	{			
		$table = "tbl_refer";
		$query = "SELECT child FROM $table WHERE parent='$id' ORDER by id ASC";
		if($_GET['tp']==1)
		{
			#echo $query."<br>";
		}
		$q = mysql_query($query);
		$return =array();

		while($row=mysql_fetch_array($q))
		{
			$return[] = $row['child'];
		}	

		return $return;
		
	}	


	
	function getchildwagess($id)
	{			
		$table = "tbl_refer";
		$query = "SELECT child FROM $table WHERE parent='$id' ORDER by id ASC";
		if($_GET['tp']==1)
		{
			#echo $query."<br>";
		}
		$q = mysql_query($query);
		$return =array();

		while($row=mysql_fetch_array($q))
		{
			$return[] = $row['child'];
		}	

		if(mysql_num_rows($q)==0)		
		{	
			$return[] = 0;			
			$return[] = 0;	
		}		
		if(mysql_num_rows($q)==1)		
		{			
		$return[] = 0;		
		}

		return $return;
		
	}	

function pre($array)
{
echo "<pre>";
print_r($array);
echo "</pre>";
}
		
function breakfree_child_wager($array,$a,$limit)
{




$level2 = (getchildwagess_dashboard($array[0]));
$level3a1 = (getchildwagess_dashboard($level2[0]));
$level3a2 = (getchildwagess_dashboard($level2[1]));
$level4a1 = (getchildwagess_dashboard($level3a1[0]));
$level4a2 = (getchildwagess_dashboard($level3a1[1]));
$level4b1 = (getchildwagess_dashboard($level3a2[0]));
$level4b2 = (getchildwagess_dashboard($level3a2[1]));	
$_GET[$a][] = $array;
$_GET[$a][] = $level2;
$_GET[$a][] = $level3a1;
$_GET[$a][] = $level3a2;
$_GET[$a][] = $level4a1;
$_GET[$a][] = $level4a2;
$_GET[$a][] = $level4b1;
$_GET[$a][] = $level4b2;


	// if(count($array)!=0)
	// {
	// 	$_GET[$a][] = $array;
		
	// }

	// foreach($array as $u1)
	// {

	// 	//LIMIT CONDITION
	// 	if(countdownlines($_GET[$a])>=$limit)
	// 	{

	// 		break;
	// 	}
	// 	//html here	
		
	// 	$user1 = getchildwagess($u1);	
	// 	if($_GET['tp']==1)
	// 	{
	// 		echo $u1."==".implode(",",$user1)."<br>";
	// 	}

	// 	if(count($user1)!=0)
	// 	{
	// 		#pre($user1);
	// 		breakfree_child_wager($user1,$a,$limit);
			
	// 	}
		 
	// }
	

	
	
}	
	
	
	
function countdownlines($array)
{
	$count = 0;
	foreach($array as $array2)
	{		
		$count += count($array2);
	}
	return $count;
}	
	
function countdownlines_dashboard($array)
{	
	$count = 0;	
	foreach($array as $array2)	
	{				
		foreach($array2 as $val)		
		{			
			if($val!=0)			
			{				
				$count++;			
			}		
		}	
	}	
	return $count;
}		

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function getchildwagess_bonus($id,$curtbl)
	{			
		$table = "tbl_othertablebeta";
		$query = "SELECT child FROM $table WHERE curtbl='$curtbl' AND parent!=0 AND parent='$id' ORDER by id ASC";
		$q = mysql_query($query);
		$return =array();
		while($row=mysql_fetch_array($q))
		{
			$return[] = $row['child'];
		}		
		return $return;
		
	}		
	
	
	
function breakfree_child_wager_bonus($array,$a,$limit,$curtbl)
{
	
	if(count($array)!=0)
	{
		$_GET[$a][] = $array;
		
	}
	
	foreach($array as $u1)
	{
	
		//LIMIT CONDITION
		if(countdownlines($_GET[$a])>=$limit)
		{

			break;
		}
		//html here	
		
		$user1 = getchildwagess_bonus($u1,$curtbl);	
		if(count($user1)!=0)
		{
			#pre($user1);
			breakfree_child_wager_bonus($user1,$a,$limit,$curtbl);
			
		}
		 
	}
	

	
	
}	
	
	
function getforumcategorydetail($cat)
{
return mysql_query("SELECT * FROM tbl_forumcategorymanager WHERE activated='1' AND forumcategorymanager_id='$cat'");
}	

function getforumthreaddetail($cat)
{

return mysql_query("SELECT * FROM tbl_forummanager WHERE id='$cat' ");
}
	
function convertdate($date)
{
return date("M d, Y",strtotime($date))."<br>".date("h:i A",strtotime($date));

}
function getforumcategory()
{
return mysql_query("SELECT * FROM tbl_forumcategorymanager WHERE activated='1'");
}	

function getforumthread($cat,$limit,$page)
{
if($page==1)
{
$page = 0;
}
else
{
$page = $page * 2;
}
return mysql_query("SELECT * FROM tbl_forummanager WHERE activated='1' AND forummanager_category='$cat' LIMIT 0,$limit");
}
	
function person($id)
{
$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$id'");
return mysql_fetch_assoc($q);
}
	
function getreplycount($thread)
{
$q = mysql_query("SELECT COUNT(*) as count FROM tbl_forumreply WHERE status='1' AND forum='$thread'");
$row = mysql_fetch_assoc($q);
return $row['count'];
}	 


function reward($level){
	$array = array();
	$array[1] = 50;
	$array[2] = 35;
	$array[3] = 25;
	$array[4] = 20;
	$array[5] = 10;
	$array[6] = 10;
	$array[7] = 10;
	$array[8] = 10;
	$array[9] = 10;
	$array[10] = 10;

	return $array[$level];
}	


function reward_gen($level){
	$array = array();
	$array[1] = 25;
	$array[2] = 12.5;
	$array[3] = 7.5;
	$array[4] = 5;
	$array[5] = 2.5;
	$array[6] = 2.5;
	$array[7] = 2.5;
	$array[8] = 2.5;
	$array[9] = 2.5;
	$array[10] = 2.5;
	$array[11] = 2.5;
	$array[12] = 2.5;
	$array[13] = 2.5;
	$array[14] = 12.5;
	$array[15] = 15;

	return $array[$level] / 100;
}	




function dateny()
{
	return date("n-Y");
}

function personalbonus($price)
{
	if($price<400)
	{
		return 0;
	}
	else
	{
		$prices = $price - 400;
		$prices_final = $prices * 0.35;
		$prices_final2 = $prices_final * 3.5;
		return $prices_final2;
	}

}
function sumpoints($gendate,$accounts_id)
{
	$q = "SELECT SUM(points) as sumpoints FROM tbl_buyproduct_history WHERE accounts_id=$accounts_id and gendate_end='$gendate'";
	$row = mysql_fetch_assoc(mysql_query($q));
	if($row['sumpoints']=='')
	{
		$row['sumpoints'] = 0;
	}
	return $row['sumpoints'];
}


function getparentgen($child,$level)
{
    $query = "SELECT * FROM tbl_referdata WHERE level='$level' AND child='$child'";
    #echo $query."<br>";
	$row = mysql_fetch_array(mysql_query($query));
	return $row['parent'];
}

function getlevelgen($child,$level)
{
	$checker = 0;
	$dateny = dateny();
	while($checker==0)
	{
		$parent =  getparentgen($child,$level);	
		$sumpoints = sumpoints($dateny,$parent);
		if($level==0)
		{
			return 1;
		}
		if($sumpoints>=400)
		{
			$checker = 1;
		}
		else
		{
			$level--;
		}
	}
		return $level;
}
?>