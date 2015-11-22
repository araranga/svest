<?php
include("../connect.php");
$file = fopen("users.csv","r");
$array = array();

$q = mysql_query("SELECT username,accounts_id FROM tbl_accounts");
while($row=mysql_fetch_array($q))
{
	$array[$row['username']] = $row['accounts_id'];
}
  while(! feof($file))
  {
  $data = fgetcsv($file);
	if($data[4]!=1)
	{
		$curtbl = $data[3].'_'.$data[4];
		if($data[0]!='' && $data[0]!='0')
		{
			echo "UPDATE tbl_accounts SET curtbl='$curtbl',specialmap='yes' WHERE accounts_id='".$array[$data[0]]."';<br>";
			echo "UPDATE tbl_accounts SET curtbl='$curtbl',specialmap='yes' WHERE accounts_id='".$array[$data[1]]."';<br>";
			echo "UPDATE tbl_accounts SET curtbl='$curtbl',specialmap='yes' WHERE accounts_id='".$array[$data[2]]."';<br>";
			#echo "INSERT INTO tbl_reward SET curtbl='$curtbl',accounts_id='".$array[$data[0]]."',done='no';<br>";
			#echo "INSERT INTO tbl_reward SET curtbl='$curtbl',accounts_id='".$array[$data[1]]."',done='no';<br>";
			#echo "INSERT INTO tbl_reward SET curtbl='$curtbl',accounts_id='".$array[$data[2]]."',done='no';<br>";
		}
	}
  }

fclose($file);
?>
