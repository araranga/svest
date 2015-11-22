<header>
<?php
$main = getrow("tbl_logo");
$menu = mysql_query("SELECT * FROM tbl_userweb WHERE userweb_id='".$_GET['id']."'");
$row=mysql_fetch_array($menu);
?>
  <div class="container_12">
    <div class="grid_12">
      <div class="wrapper"><a href="/" class='logo'><?php echo $main['title'];?></a>
        <nav>
    <ul class="menu">
<li><a href="/userpage/?id=<?php echo $_GET['id'];?>&com=1"><?php echo $row['t1'];?></a></li>
<li><a href="/userpage/?id=<?php echo $_GET['id'];?>&com=2"><?php echo $row['t2'];?></a></li>
<li><a href="/userpage/?id=<?php echo $_GET['id'];?>&com=3"><?php echo $row['t3'];?></a></li>
<li><a href="/userpage/?id=<?php echo $_GET['id'];?>&com=4"><?php echo $row['t4'];?></a></li>

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
<li><a href="/userpage/?id=<?php echo $_GET['id'];?>&com=1"><?php echo $row['t1'];?></a></li>
<li><a href="/userpage/?id=<?php echo $_GET['id'];?>&com=2"><?php echo $row['t2'];?></a></li>
<li><a href="/userpage/?id=<?php echo $_GET['id'];?>&com=3"><?php echo $row['t3'];?></a></li>
<li><a href="/userpage/?id=<?php echo $_GET['id'];?>&com=4"><?php echo $row['t4'];?></a></li>
          <li><a href="/account/">Login</a></li>
      </ul>      
    </div>
  </div>
</div>