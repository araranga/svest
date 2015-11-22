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

				

	<?php

	$qt = mysql_query("SELECT * FROM tbl_product WHERE status='1' AND product_id='".$_GET['id']."'");

	while($qtrow=mysql_fetch_array($qt))

	{

		$id = $qtrow['product_id'];

	?>	
				<h2 class="h-pad h-indent"><?php echo $qtrow['title'];?></h2>
                <div class="block">

					<div class="post">

						<div class="wrapper">

						  <div class="info">

							<div class="wrapper">

							 

							  </div>

						  </div>

						</div>

						<figure>

						<img src="<?php echo $base;?>media/<?php echo $qtrow['filename'];?>" alt="" style='width:100%;'>

						<figure>

						<p><?php echo $qtrow['contentarea'];?></p>
						<p>Points: <?php echo $qtrow['points'];?></p>
						<p>Price: <?php echo $qtrow['price'];?></p>
						</figure>

						</figure>

					</div>

                </div>

<?php		

	}

	?>

				



                

                

              </div>

<!-- Go to www.addthis.com/dashboard to customize your tools -->

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51275c366105c6f9" async="async"></script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->

<div class="addthis_sharing_toolbox"></div>

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