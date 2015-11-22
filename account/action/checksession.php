<?php
session_start();
if($_SESSION['accounts_id']=='')
{
	echo 0;
}
else
{
	echo 1;
}
?>
