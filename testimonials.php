<?php
include("connect.php");
include("function.php");
$main = getrow("tbl_logo");

$base = getbaseme();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $main['title'];?></title>
<?php include("includes/head.php"); ?>
<style>
.container_12 .grid_4 {
    width: 30%;
    float: left;
}
</style>
</head>
<body>
<?php include("includes/menu.php"); ?>
<div id="content">
  <div class="inner">
    <div class="container_12">
<div class="wrapper">
        <div class="grid_12">
          <div class="wrapper">
            <div class="grid_12">
              <div class="grid-inner">
                <h2 class="h-pad h-indent">Recent Posts</h2>
				
	<?php
	$qt = mysql_query("SELECT * FROM tbl_testimonial WHERE status='1'");
	while($qtrow=mysql_fetch_array($qt))
	{
		$id = $qtrow['testimonial_id'];
		$datetime = strtotime($qtrow['created_time']);
		$month = date("M",$datetime);
		$day = date("d",$datetime);
	?>
                <div class="block">
					<div class="post">
						<div class="wrapper">
						  <div class="info">
							<div class="wrapper">
							  <div class="date"> <span><?php echo $month;?></span><strong><?php echo $day;?></strong> </div>
							  <a href="testimonials-read.php?id=<?php echo $id;?>"><strong><?php echo $qtrow['title'];?></strong></a>
							  </div>
						  </div>
						</div>
						<figure>
						<a href="testimonials-read.php?id=<?php echo $id;?>"><img src="<?php echo $base;?>media/<?php echo $qtrow['filename'];?>" alt="" style='width:100%;'></a>
						<figure>
						<p><?php echo $qtrow['teaser'];?></p>
						<a href="testimonials-read.php?id=<?php echo $id;?>" class="button1">Read more</a></figure></figure>
					</div>
                </div>
<?php		
	}
	?>
				

                
                
              </div>
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