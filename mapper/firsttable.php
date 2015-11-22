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
	if($data[4]==1)
	{
		if($data[0]!='' && $data[0]!='0')
		{
			if($data[1]!='' && $data[1]!='0')
			{
				echo "INSERT INTO tbl_refer SET parent='".$array[$data[0]]."',child='".$array[$data[1]]."';<br>";
			}
			if($data[2]!='' && $data[2]!='0')
			{
				echo "INSERT INTO tbl_refer SET parent='".$array[$data[0]]."',child='".$array[$data[2]]."';<br>";
			}		
		}
	}
  }

fclose($file);
?>
