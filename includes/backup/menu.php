<?php
$main = getrow("tbl_logo");
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65439011-1', 'auto');
  ga('send', 'pageview');

</script>
<header>
  <div class="main">
    <h1><a href="index.php"><img src="/adminpage/media/<?php echo $main['image'];?>" alt="Genesis"></a></h1>
    <nav>
      <ul class="menu">
        <li class="current"><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="forum.php">Forum</a></li>
        <li><a href="contact-us.php">Contact Us</a></li>		
        <li><a href="/account">Login</a></li>
      </ul>
    </nav>
  </div>
</header>