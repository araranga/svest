<?php
include("connect.php");
include("function.php");
$main = getrow("tbl_logo");
?>
<!DOCTYPE html>
<html lang="en">
<head> 
<title><?php echo $main['title'];?> - Forum</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/grid_12.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/tabs.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/forum.css">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script src="js/jquery-1.7.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/tms-0.3.js"></script>
<script src="js/tms_presets.js"></script>
<script src="js/cufon-yui.js"></script>
<script src="js/Vegur-L_300.font.js"></script>
<script src="js/Vegur-M_500.font.js"></script>
<script src="js/Vegur-R_400.font.js"></script>
<script src="js/cufon-replace.js"></script>
<script src="js/tabs.js"></script>
<script src="js/FF-cash.js"></script>
<script>
$(window).load(function(){
	$('.slider')._TMS({
	prevBu:'.prev',
	nextBu:'.next',
	pauseOnHover:true,
	pagNums:false,
	duration:800,
	easing:'easeOutQuad',
	preset:'Fade',
	slideshow:7000,
	pagination:'.pagination',
	waitBannerAnimation:false,
	banners:'fromLeft'
	})
}) 	
</script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
<![endif]-->
</head>
<body>
<!--==============================header=================================-->
<?php
	include("includes/menu.php");
?>
<!--==============================content================================-->

<section id="content">
  
  <div class="container_12" style="padding-top: 31px;  min-height: 500px;">

 
<?php

if($_GET['mode']=='')
{
	include("forum/forum-cat.php");
}
if($_GET['mode']=='forum-cat-list')
{
	include("forum/forum-cat-list.php");
}
if($_GET['mode']=='thread-list')
{
	include("forum/thread-list.php");
}

?>
  
  
    <div class="clear"></div>
  </div>
</section>
<!--==============================footer=================================-->
<footer>
							<?php echo $main['footer'];?>
							<div class="social-footer">
								<?php include("includes/footeradded.php"); ?>
								<ul>
                                    <?php
                                    $social = getrow("tbl_socialmanager");
                                    ?>
									<li><a href="<?php echo $social['facebook'];?>" class="fa fa-facebook"></a></li>
									<li><a href="<?php echo $social['twitter'];?>" class="fa fa-twitter"></a></li>
									<li><a href="<?php echo $social['youtube'];?>" class="fa fa-youtube"></a></li>
                                    <li><a href="<?php echo $social['google'];?>" class="fa fa-google-plus"></a></li>
									<li><a href="<?php echo $social['rss'];?>" class="fa fa-rss"></a></li>
								</ul>
							</div>
</footer>
<script>Cufon.now();</script>
</body>
</html>
