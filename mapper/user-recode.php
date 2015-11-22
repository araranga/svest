<?php
include("../connect.php");
$file = fopen("users.csv","r");

  while(! feof($file))
  {
  $data = fgetcsv($file);
  $package = $data[3];
  $exit = $data[4];
	  if($data[0]!='0')
	  {
		  #insertuser($data[0],$package);
		  echo "UPDATE tbl_code SET code_package='$package' WHERE code_pin='".$data[0]."';"."<br>";
	  }
	  if($data[1]!='0')
	  {
		  #insertuser($data[1],$package);
		  echo "UPDATE tbl_code SET code_package='$package' WHERE code_pin='".$data[1]."';"."<br>";
	  }
	  if($data[2]!='0')
	  {
		  #insertuser($data[2],$package);
		  echo "UPDATE tbl_code SET code_package='$package' WHERE code_pin='".$data[2]."';"."<br>";
	  }
  }

fclose($file);
?>
