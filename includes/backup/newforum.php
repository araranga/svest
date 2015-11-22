<?php
$a = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cmsmanager WHERE id='36'"));
$b = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cmsmanager WHERE id='37'"));
$c = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cmsmanager WHERE id='38'"));
?>    
	
	<div class="grid_4">
      <div class="block-1">
        <h3><?php echo $a['cmsmanager_title'];?></h3>
			<?php echo $a['cmsmanager_content'];?>
		</div>
    </div>
	<div class="grid_4">
      <div class="block-1">
        <h3><?php echo $b['cmsmanager_title'];?></h3>
			<?php echo $b['cmsmanager_content'];?>
		</div>
    </div>
	<div class="grid_4">
      <div class="block-1">
        <h3><?php echo $c['cmsmanager_title'];?></h3>
			<?php echo $c['cmsmanager_content'];?>
		</div>
    </div>