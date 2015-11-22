<?php
$counter = 1;
$url = 'http://localhost/cronjobs/cron-parent.php';
while($counter<4)
{
	?>
		<script>
		function ohno<?php echo $counter;?>()
		{
		var iframe = document.getElementById('set<?php echo $counter;?>');
		iframe.src = iframe.src;	
		}
		</script>
		<iframe style='width:150px;' id='set<?php echo $counter;?>' src='<?php echo $url; ?>' onload='ohno<?php echo $counter;?>()'></iframe>
	<?php
	$counter++;
}

?>