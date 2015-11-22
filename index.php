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
<script>
jQuery(function () {
    jQuery('#camera_wrap_1').camera({
        height: '317px',
        loader: false,
        pagination: false,
        thumbnails: false
    });
});
</script>
</head>

<body>
<style>
.camera_wrap img {
    width: 516px !important;
    height: 348px !important;
}
</style>
<?php include("includes/menu.php"); ?>

<div id="content">
  <div id="slider">
    <div class="container_12">
      <div class="grid_12">
        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
        <?php
          $qb = mysql_query("SELECT * FROM tbl_bannermanager");
          while($qbrow=mysql_fetch_array($qb))
          {
        ?>
        
          <div data-src="<?php echo $base;?>media/<?php echo $qbrow['bannermanager_image_large'];?>">
            <div class="camera_caption fadeIn">
              <h2><?php echo $qbrow['bannermanager_title'];?></h2>
              <?php echo $qbrow['bannermanager_content'];?>
            </div>
          </div>
        
        <?php
        }
        ?>
        </div>
      </div>
    </div>
  </div>


  <div class="inner">

    <div class="container_12">

      <div class="wrapper">

        <div class="block">

          <div class="grid_12">

            <div class="grid-inner">

              <div class="wrapper">

<?php include("includes/banner.php"); ?>
  <?php

  $qr = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cmsmanager WHERE id='38'"));

  echo $qr['cmsmanager_content'];

  ?>

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