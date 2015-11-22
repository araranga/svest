<?php
include("../connect.php");

function countuser($username)
{
	return mysql_num_rows(mysql_query("SELECT * FROM tbl_accounts WHERE username='$username'"));
}
function insertuser($username,$package)
{
	mysql_query("INSERT INTO tbl_accounts SET username='$username',password='1234',code_id='$username'");
	mysql_query("INSERT INTO tbl_code SET code_pin='$username',code_value='$username',code_package='$package'");
}

$file = fopen("users.csv","r");

  while(! feof($file))
  {
  $data = fgetcsv($file);
  $package = $data[3];
  $exit = $data[4];
	  if(countuser($data[0])==0)
	  {
		  insertuser($data[0],$package);
	  }
	  if(countuser($data[1])==0)
	  {
		  insertuser($data[1],$package);
	  }	
 	  if(countuser($data[2])==0)
	  {
		  insertuser($data[2],$package);
	  } 
  }

fclose($file);
?>
