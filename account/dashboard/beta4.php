﻿<?php

error_reporting(E_ERROR | E_PARSE);

session_start();

include("../../connect.php");

include("../../function.php");

define("TABLE","tbl_othertablebeta");

define("CURTBL",$_GET['tbl']);

function addarray($a,$b)

{

	return count($a) + count($b);

}

function getchild($id)

{

	$table = TABLE;

	$curtbl = CURTBL;

	$query = "SELECT child FROM $table WHERE  parent!=0 AND parent='$id' AND curtbl='".$curtbl."' ORDER by id ASC";

	#echo "$query<br>";

	$q = mysql_query($query);

	$return =array();

	while($row=mysql_fetch_array($q))

	{

		$return[] = $row['child'];

	}

	return $return;

}



function getparent($id)

{

	$table = TABLE;

	$curtbl = CURTBL;

	$query = "SELECT parent FROM $table WHERE parent!=0 AND child='$id' AND curtbl='".$curtbl."'  ORDER by id ASC";

	$q = mysql_query($query);

	$return =array();

	while($row=mysql_fetch_array($q))

	{

		$return[] = $row['parent'];

	}

	return $return;



}





function loadprofile($id)

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

 	$return .= "<div class='peoplewith'><p onclick='profile($id)'>"."You";

	$return .= "<br/><img width='55' src='assets/img/".strtolower($row['gender']).".png' style='display:none;'/>";

	$return .= "</p></div>"; 

 }



	

	return $return;

}



function handlererror($id,$lbl)  

{

	return "<div class='peoplewithout'><p>EMPTY<br/><img width='55' src='assets/img/none.png' style='display:none;'/></p></div>";

}









function breakfree_child($array,$a)

{

	if(count($array)!=0)

	{

		$_GET[$a][] = $array;

	}

	

	foreach($array as $u1)

	{

		//LIMIT CONDITION

		if(count($_GET[$a])==14)

		{

			break;

		}

		//html here		

		$user1 = (getchild($u1));

		if(count($user1)!=0)

		{

			breakfree_child($user1,$a);

			

		}

		

	}

	

}







function breakfree_parent($array,$a)

{

	if(count($array)!=0)

	{

		$_GET[$a][] = $array;

	}

	foreach($array as $u1)

	{

		//LIMIT CONDITION

		if(count($_GET[$a])==14)

		{

			break;

		}

		//html here		

		$user1 = (getparent($u1));

		if(count($user1)!=0)

		{

			breakfree_parent($user1,$a);

			

		}

		

	}

	

}



function getfuckinguser($array)

{

	$count = 0;

	foreach($array as $array2)

	{

		$count += count($array2);

	}

	return $count;

}

























//reset

unset($_GET);





/* GETTING CORRECT PARENT */

$myid = $_SESSION['accounts_id'];

$userparent = (getparent($myid));

$left = array($userparent[0]);

breakfree_parent($left,"parent");



$meyarray = array();



foreach($_GET['parent'] as $varx)
{

	$meyarray[] = $varx[0];
}
asort($meyarray);
foreach($meyarray as $sssatch)

{

$var[0] = $sssatch;

	$user_id_table = '';

	breakfree_child(array($var[0]),"parent_test_".$var[0]);

	$userpaid = getfuckinguser($_GET["parent_test_".$var[0]]);

	$userid = $var[0];

	if($userpaid<15)

	{

		$user_id_table = $userid;

		break;

	}

	foreach($_GET['parent'] as $varunset)

	{

		unset($_GET["parent_test_".$varunset[0]]);

	}	

}	



if($user_id_table=='')

{

	$user_id_table = $myid;

}

/* GETTING CORRECT PARENT */

#echo "<pre>";

#print_r($_GET);

#echo "</pre>";

//$user_id_table = 1;

$_GET['tablecurrentid'] = $user_id_table;

	

	





?>

<h2>BONUS - Table <?php echo $_SESSION['codex'][CURTBL];?>
<?php
$codddd = explode("_",CURTBL);
if($codddd[2]!='')
{
	echo " - SET#:".$codddd[2];
}
?>
</h2>

<table border='0' style='width:100%;'>

<tr>

	<td colspan='8' class='tds main id'>

				<div class='people'>

					<?php echo loadprofile($_GET['tablecurrentid']); ?>

					<?php

					$left_parent = $_GET['tablecurrentid'];

					$right_parent = $_GET['tablecurrentid'];

					?>			

				</div> 

	</td>

</tr>



<?php

$level2 = (getchild($_GET['tablecurrentid']));

?>

<tr>

	<td colspan='4'  class='tds left w50'>

				<div class='people'>

					

				<?php

				if($level2[0]!='')

				{

					echo loadprofile($level2[0]);

					$left_parent = $level2[0];

				}

				else

				{

					echo handlererror($left_parent,"good");

				}

				?>

				</div>

	</td>

	<td colspan='4' class='tds right w50'>

				<div class='people'>

					

				<?php

				if($level2[1]!='')

				{

					echo loadprofile($level2[1]);

					$right_parent = $level2[1];

				}

				else

				{

					echo handlererror($right_parent,"good");

				}

				?>					



				</div>

	</td>

</tr>



<?php

$level3a1 = (getchild($level2[0]));

$level3a2 = (getchild($level2[1]));

?>

<tr>

	<td colspan='2' class='tds left w25'>

				<div class='people'>

					

				<?php

				if($level3a1[0]!='')

				{

					echo loadprofile($level3a1[0]);

					$left_parent = $level3a1[0];

				}

				else

				{

					echo handlererror($level2[0],$level2[0]);

				}

				?>						

					

				</div>

	</td>

	<td colspan='2' class='tds left w25'>

				<div class='people'>

					

				<?php

				if($level3a1[1]!='')

				{

					echo loadprofile($level3a1[1]);

				}

				else

				{

				

					echo handlererror($level2[0],$level2[0]);

				}

				?>					

					

					

				</div>

	</td>

	<td colspan='2' class='tds right w25'>

				<div class='people'>

					

				<?php

				if($level3a2[0]!='')

				{

					echo loadprofile($level3a2[0]);

					$right_parent = $level3a2[0];

				}

				else

				{

					echo handlererror($level2[1],$level2[1]);

				}

				?>	

					

					

				</div>

	</td>

	<td colspan='2' class='tds right w25'>

				<div class='people'>

					

				<?php

				if($level3a2[1]!='')

				{

					echo loadprofile($level3a2[1]);

					$right_parent = $level3a2[1];

				}

				else

				{

					echo handlererror($level2[1],$level2[1]);

				}

				?>						

					

					

				</div>

	</td>

</tr>



<?php

$level4a1 = (getchild($level3a1[0]));

$level4a2 = (getchild($level3a1[1]));

$level4b1 = (getchild($level3a2[0]));

$level4b2 = (getchild($level3a2[1]));

?>

<tr>

	<td class='tds left w12'>

					<div class='people'>

						

				<?php

				if($level4a1[0]!='')

				{

					echo loadprofile($level4a1[0]);

				}

				else

				{

					echo handlererror($level3a1[0],$level3a1[0]);

				}

				?>						

						

						

					</div>

	</td>

	<td class='tds left w12'>

					<div class='people'>

						

				<?php

				if($level4a1[1]!='')

				{

					echo loadprofile($level4a1[1]);

				}

				else

				{

					echo handlererror($level3a1[0],$level3a1[0]);

				}

				?>							

						

						

					</div>

	</td>



	

	

	<td class='tds left w12'>

					<div class='people'>

						

				<?php

				if($level4a2[0]!='')

				{

					echo loadprofile($level4a2[0]);

				}

				else

				{

					echo handlererror($level3a1[1],$level3a1[1]);

				}

				?>						

						

						

					</div>

	</td>

	<td class='tds left w12'>

					<div class='people'>

						

				<?php

				if($level4a2[1]!='')

				{

					echo loadprofile($level4a2[1]);

				}

				else

				{

					echo handlererror($level3a1[1],$level3a1[1]);

				}

				?>							

						

						

					</div>

	</td>	

	

	<!--RIGHT-->

	<td class='tds left w12'>

					<div class='people'>

						

				<?php

				if($level4b1[0]!='')

				{

					echo loadprofile($level4b1[0]);

				}

				else

				{

					echo handlererror($level3a2[0],$level3a2[0]);

				}

				?>						

						

						

					</div>

	</td>

	<td class='tds left w12'>

					<div class='people'>

						

				<?php

				if($level4b1[1]!='')

				{

					echo loadprofile($level4b1[1]);

				}

				else

				{

					echo handlererror($level3a2[0],$level3a2[0]);

				}

				?>							

						

						

					</div>

	</td>



	

	

	<td class='tds left w12'>

					<div class='people'>

						

				<?php

				if($level4b2[0]!='')

				{

					echo loadprofile($level4b2[0]);

				}

				else

				{

					echo handlererror($level3a2[1],$level3a2[1]);

				}

				?>						

						

						

					</div>

	</td>

	<td class='tds left w12'>

				<div class='people'>

						

				<?php

				if($level4b2[1]!='')

				{

					echo loadprofile($level4b2[1]);

				}

				else

				{

					echo handlererror($level3a2[1],$level3a2[1]);

				}

				?>							

						

						

					</div>

	</td>	

	

	

	

	

	



</tr>







</table>



	

