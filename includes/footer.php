

<footer style='width:auto;'>
  <div class="container_12">
    <div class="wrapper">
      <div class="grid_8"> 
	  <?php echo $main['footer'];?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=220599038130096";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>		
	  </div>
      <div class="grid_4">
<?php
$social = getrow("tbl_socialmanager");
?> 

        <div class="social"> 
		My Social:
		<a href="<?php echo $social['facebook'];?>"><img src="images/facebook-icon.png" alt=""></a>
		<a href="<?php echo $social['twitter'];?>"><img src="images/twitter-icon.png" alt=""></a> 
		<div class="fb-like" data-href="http://sureinvest-oms.com/" data-width="100" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>		
		</div>
      </div>
    </div>
  </div>
</footer> 