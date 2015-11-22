<nav class="navbar-default navbar-side" role="navigation">
<div class="sidebar-collapse">
<ul class="nav" id="main-menu">
<li class="text-center">
<!--<img src="assets/img/<?php echo strtolower($_SESSION['gender']);?>.png" class="user-image img-responsive"/>-->

	<div style='  color: white;text-align: left;margin-left: 9px;'>		<?php		echo "Cache:".rand();		?>		<br/>		Account Number: <?php echo $_SESSION['accounts_id']; ?>
		<br/>
		Username: <?php echo $_SESSION['username']; ?>
		<br/>
		Total Money: <?php echo number_format($_SESSION['balance'],2);?> 
		<br/>
		Time : <?php echo date("M d, Y");?> <span id='hour'></span><span id='minute'></span><span id='secs'></span>
	</div>
	<br/>
</li>

<li>
<a class="active-menu" href="index.php"><i class="fa fa-home fa-3x"></i>Dashboard</a>
</li>
<li>
<a href="#"><i class="fa fa-user fa-3x"></i>My Account</a>
<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
<li>
<a href="index.php?pages=multiaccount">Others Accounts</a>
</li>
<li>
<a href="index.php?pages=editprofile">Edit Information</a>
</li>
<li>
<a href="index.php?pages=changepass">Change Password</a>
</li>
</ul>
</li>

<li class="">
<a href="#"><i class="fa fa-history fa-3x"></i>Payout/Purchase History<span class="fa arrow"></span></a>
<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">

<li>
<a href="index.php?pages=bonusitems">Bonus/Items History</a>
</li>
<li>
<a href="index.php?pages=withdrawhistory">Withrawal History</a>
</li>
<li>
<a href="index.php?pages=buycodehistory">Purchased Code History</a>
</li>
<li>
<a href="index.php?pages=buyproducthistory">Purchased Product History</a>
</li>

<li>
<a href="index.php?pages=encodehistory">Referral/Encode History</a>
</li>
</ul>
</li>


<li class="">
<a href="#"><i class="fa fa-smile-o fa-3x"></i>Bonuses<span class="fa arrow"></span></a>
<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
	<li>
		<a href="index.php?pages=directbonus">Indirect / Direct Bonus</a>
	</li>
	<li>
		<a href="index.php?pages=personalbonus">Personal Bonus</a>
	</li>	
	<li>
		<a href="index.php?pages=genbonus">Generational Bonus</a>
	</li>	
</ul>
</li>





<li class="">
<a href="#"><i class="fa fa-shopping-cart fa-3x"></i>Buy Code/Product<span class="fa arrow"></span></a>
<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
<li>
<a href="index.php?pages=buycode">Purchase Code</a>
</li>
<li>
<a href="index.php?pages=buyproduct">Purchase Product</a>
</li>
</ul>
</li>


<li>
<a href="index.php?pages=withdrawrequest"><i class="fa fa-money fa-3x"></i>Request Payout</a>
</li>






<li class="" style="display:none;">
<a href="#"><i class="fa fa-sitemap fa-3x"></i>Downlines<span class="fa arrow"></span></a>
<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
<?php
$qboard  = mysql_query("SELECT * FROM tbl_reward WHERE accounts_id='".$_SESSION['accounts_id']."'");
#echo "SELECT * FROM tbl_othertablebeta WHERE parent='".$_SESSION['accounts_id']."' GROUP by parent ORDER by id ASC";
if(mysql_num_rows($qboard)!=0)
{
$labelboard = "(Finished)";
}
?>
<li>
<a href="?pages=downline">Board 1<?php echo $labelboard;?></a>
</li>
<?php
$qx2 = mysql_query("SELECT * FROM tbl_code as a JOIN tbl_rate as b WHERE b.rate_id=a.code_package AND code_value='".$_SESSION['code_id']."'");
$qxrow2 = mysql_fetch_array($qx2);	
$csuc = 0;
while($qboardrow=mysql_fetch_assoc($qboard ))
{
$csuc++;
$labelboard = '';
if($qboardrow['done']=='yes')
{
$labelboard = "(Finished)";
}
?>
<li>
<a href="index.php?pages=beta<?php echo $qxrow2['rate_req']; ?>&tbl=<?php echo $qboardrow['curtbl'];?>">
Board <?php echo $_SESSION['codex'][$qboardrow['curtbl']] = $csuc + 1;?>
<?php echo $labelboard;?>
</a>
</li>
<?php
}
?>
</ul>
</li>


<li>
<a href="index.php?pages=web"><i class="fa fa-file-text fa-3x"></i>My Web</a>
</li> 
<li>
<a href="logout.php"><i class="fa fa-sign-out fa-3x"></i>Logout</a>
</li>

</ul>

</div>

</nav>  
<!-- /. NAV SIDE  -->