<div class="wrapper">
	<div class="block">
		<div class="container_12" style='height:360px;'>
  <?php
  $qr = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cmsmanager WHERE id='36'"));
  echo $qr['cmsmanager_content'];
  ?>			
		</div>
	</div>
</div>