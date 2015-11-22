<section id="header-content">
  <div class="main">
    <div class="slider">
<?php
$banner = mysql_query("SELECT * FROM tbl_bannermanager WHERE activated='1'");
?>
      <ul class="items">
	  <?php
	  while($rowb=mysql_fetch_array($banner))
	  {
	  ?>
        <li><img src="/adminpage/media/<?php echo $rowb['bannermanager_image_large'];?>" alt="">
          <div class="banner">
			<?php echo $rowb['bannermanager_content'];?>
		  </div>
        </li>
	  <?php
	  }
	  ?>
      </ul>
<?php
$banner = mysql_query("SELECT * FROM tbl_bannermanager WHERE activated='1'");
?>	  
      <div class="pagination">
        <ul>
			<?php
			while($rowbx=mysql_fetch_array($banner))
			{
			?>		
				<li><a href="javascript:void(0);"><img src="/adminpage/media/<?php echo $rowbx['bannermanager_image_large'];?>" alt="" style='width:87px;height:89px;'></a></li>
			<?php
			}
			?>
        </ul>
      </div>
    </div>
  </div>
</section>