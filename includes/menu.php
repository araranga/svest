<header>
<?php
$main = getrow("tbl_logo");
?>
  <div class="container_12">
    <div class="grid_12">
      <div class="wrapper"><a href="index.php" class='logo'><?php echo $main['title'];?></a>
        <nav>
    <ul class="menu">
    <li class="active"><a href="index.php">Home</a></li>
    <li><a href="products.php">Products</a></li>          
    <li><a href="contacts.php">Contacts</a></li>
    <li><a href="testimonials.php">Testimonials</a></li>
    <li><a href="/account/">Login</a></li>
    </ul>
        </nav>
      </div>
    </div>
  </div>
</header>
<div id="menumenu" class="wrapper">
  <div class="block">
    <div class="container_12">   
      <ul class="menux">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="products.php">Products</a></li>          
          <li><a href="contacts.php">Contacts</a></li>
          <li><a href="testimonials.php">Testimonials</a></li>
          <li><a href="/account/">Login</a></li>
      </ul>      
    </div>
  </div>
</div>