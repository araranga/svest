<?php
$query = getforumthreaddetail($_GET['thread']);
$row = mysql_fetch_array($query);

if($_POST['forum']!='')
{
	$_POST['message']  = nl2br(htmlentities($_POST['message']));
	$_POST['status'] = 1;
	$set = array();

	foreach($_POST as $key=>$val)
	{
		$set[] = "$key='$val'";
	}
	$sets = implode(",",$set);
 $query = "INSERT INTO tbl_forumreply SET $sets";
mysql_query($query);
$oks = 1;
}


?>


<?php
if($oks!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Thread is successfully added!</li></ul></div>
<?php
}
?>


<style>
.threadcover
{
  width: 70%;
  margin: 0 auto;
  background-color: #f4f4f4;
  border-radius: 7px;
  border: 1px solid black;
  color:#1e1e1e;
}
.threadcontent
{
	padding:10px;
}
.trleft
{
float:left;
width:20%;
text-align:center;
}
.trright
{
float:left;
width:65%;
margin-left: 49px;
}
.saveme
{
  display: inline-block;
  font-size: 36px;
  color: #fff;
  padding: 20px 35px 23px 35px;
  border-radius: 5px;
  letter-spacing: -2px;
  float: left;
  width: 100%;
  margin-top: 10px;
}

  
</style>
<h1 style='float: none!important;font-size: 25px;'><?php echo $row['forummanager_title'];?></h1>
<div class='threadcover'>
	 <div class='threadcontent'>
	 <?php
	 $person = person($row['forummanager_parent']);
	 ?>
			 <div class='trleft'>
			 <?php echo convertdate($row['forummanager_lastupdate']);?>
			 <p><img src='/account/assets/img/<?php echo strtolower($person['gender']);?>.png'/></p>
			 <p><?php echo $person['firstname']." ".$person['lastname']; ?></p>
			 </div>

			 <div class='trright'>
			 <?php echo $row['forummanager_content']; ?>
			 </div>	 
			 <br style='clear:both;'>
	 </div>
</div>




<?php
$queryx = mysql_query("SELECT * FROM tbl_forumreply WHERE forum='".$_GET['thread']."' AND status='1'");
while($row=mysql_fetch_assoc($queryx))
{
?>
<div class='threadcover' style='margin-top:10px;'>
	 <div class='threadcontent'>
	 <?php
	 $person = person($row['userid']);
	 ?>
			 <div class='trleft'>
			 <?php echo convertdate($row['post_date']);?>
			 <p><img src='/account/assets/img/<?php echo strtolower($person['gender']);?>.png'/></p>
			 <p><?php echo $person['firstname']." ".$person['lastname']; ?></p>
			 </div>

			 <div class='trright'>
			 <?php echo $row['message']; ?>
			 </div>	 
			 <br style='clear:both;'>
	 </div>
</div>
<?php
}
/*
tbl_forumreply

forum
userid
message
post_date
status
*/
?>
<?php
if($_SESSION['accounts_id']!='')
{
	?>
<div class="threadcover" style="margin-top:10px;">
	 <div class="threadcontent">	 			 
		<form style='width: 100%;' action='forum.php?mode=thread-list&thread=<?php echo $_GET['thread'];?>' method='POST' id='form'>
		<textarea name='message' required style='background-color:white!important;width:100%;height:150px;resize:none;'></textarea>
		<input type='hidden' name='forum' value='<?php echo $_GET['thread'];?>'/>
		<input type='hidden' name='post_date' value='<?php echo date('Y-m-d H:i:s');?>'/>
		<input type='hidden' name='userid' value='<?php echo $_SESSION['accounts_id'];?>'/>
		<button class='saveme btn btn-primary btn-lg'>Post</button>
		<br style='clear:both;'>
		</form>
		<br style='clear:both;'>	 
	 </div>
</div>

	<?php
}
?>





