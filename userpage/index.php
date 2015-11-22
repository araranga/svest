<?php

include("../connect.php");

include("../function.php");

$main = getrow("tbl_logo");
$base = getbaseme();

$menu = mysql_query("SELECT * FROM tbl_userweb WHERE userweb_id='".$_GET['id']."'");
$row=mysql_fetch_array($menu);
if(mysql_num_rows($menu)==0)
{
	exit("Your not allowed to access this page.");
}
if($row['activated']==0)
{
	exit("User not yet publish his/her page.");
}
if($_GET['com']=='')
{
	$_GET['com'] = 1;
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

<title><?php echo $main['title'];?></title>

<?php include("includes/head.php"); ?>
</head>

<body>
<?php include("includes/menu.php"); ?>

<div id="content">


  <div class="inner">

    <div class="container_12">

      <div class="wrapper">

        <div class="block">

          <div class="grid_12">

            <div class="grid-inner">

              <div class="wrapper">
<?php
echo $row['c'.$_GET['com']];
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=220599038130096";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-width="100%" data-href="http://sureinvest-oms.com/userpage/?id=<?php echo $_GET['id'];?>&com=<?php echo $_GET['com'];?>" data-numposts="5"></div>
            </div>

          </div>



        </div>

      </div>



    </div>

  </div>

</div>

<?php include("includes/footer.php"); ?>

</body>

</html>