<?php
session_start();
session_unset();
session_destroy(); 
header('Location: /index.php');
include("../connect.php");
include("../function.php");
$main = getrow("tbl_logo");
?> 