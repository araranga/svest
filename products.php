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

          <h2 class="h-pad1">Products</h2>

          <ul class="wrapper works">
<?php
$q = mysql_query("SELECT * FROM tbl_product WHERE status='1'");
while($qtrow=mysql_fetch_array($q))
{
?>
            <li class="grid_4">
              <figure><img src="<?php echo $base;?>media/<?php echo $qtrow['filename'];?>" alt="" style='width: 100%;height:180px;'></figure>
              <p><a href="product-read.php?id=<?php echo $qtrow['product_id'];?>" class="link"><?php echo $qtrow['title'];?></a></p>
              <p><a href="product-read.php?id=<?php echo $qtrow['product_id'];?>" class="button">Read more</a></p>
            </li>
<?php
}
if(mysql_num_rows($q)==0)
{
  echo "<p>No current products as the moment</p>";
}
?>

          </ul>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include("includes/footer.php"); ?>

</body>

</html>