<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];

$q = mysql_query("SELECT * FROM tbl_userweb WHERE accounts_id='$accounts_id'");
if(mysql_num_rows($q)==0)
{
	mysql_query("INSERT INTO tbl_userweb SET accounts_id='$accounts_id',activated='0'") or die(mysql_error());
?>
<script>
window.location = '';
</script>
<?php
}
else
{
	$row = mysql_fetch_array($q);
}
if($_POST['submit']!='')
{	
		unset($_POST['submit']);
		$fields = formquery($_POST);
		mysql_query("UPDATE tbl_userweb SET $fields WHERE accounts_id='$accounts_id'");
		$success = 1;
}

?>
<?php

if($success!='')

{

?>

<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done updating your website details!.</li></ul></div>
<script>
window.location = '';
</script>
<?php

}

?>

<h2>My Web Page</h2>
<style>
.jqte_tool.jqte_tool_1 .jqte_tool_label {
    position: relative;
    display: block;
    padding: 3px;
    width: 70px;
    height: 29px;
    overflow: hidden;
}
.jqte{
	margin:0px!important;
}
.tab-pane input{
    width: 100%;
    padding: 4px;
    border: 1px solid black;
    border-radius: 6px;	
}
</style>
					<form method='POST' action=''>
					<div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Menu 1</a>
                                </li>
                                <li class=""><a href="#profile" data-toggle="tab">Menu 2</a>
                                </li>
                                <li class=""><a href="#messages" data-toggle="tab">Menu 3</a>
                                </li>
                                <li class=""><a href="#settings" data-toggle="tab">Menu 4</a>
                                </li>
                            </ul> 

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
									<span>Title:</span>
									<br/>
									<input type='text' name='t1' value='<?php echo $row['t1'];?>'>
									<br/>
									<span>Content:</span>
									<textarea id='c1' name='c1'><?php echo $row['c1'];?></textarea>
                                </div>
                                <div class="tab-pane fade" id="profile">
									<span>Title:</span>
									<br/>
									<input type='text' name='t2' value='<?php echo $row['t2'];?>'>
									<br/>
									<span>Content:</span>
									<textarea id='c2' name='c2'><?php echo $row['c2'];?></textarea>
                                </div>
                                <div class="tab-pane fade" id="messages">
									<span>Title:</span>
									<br/>
									<input type='text' name='t3' value='<?php echo $row['t3'];?>'>
									<br/>
									<span>Content:</span>
									<textarea id='c3' name='c3'><?php echo $row['c3'];?></textarea>
                                </div>
                                <div class="tab-pane fade" id="settings">
									<span>Title:</span>
									<br/>
									<input type='text' name='t4' value='<?php echo $row['t4'];?>'>
									<br/>
									<span>Content:</span>
									<textarea id='c4' name='c4'><?php echo $row['c4'];?></textarea>
                                </div>
                            </div>
                        </div>
						<hr>
						Publish your web? 
						Yes<input type='radio' name='activated' <?php if($row['activated']==1){ echo "checked='checked'"; } ?> value='1'> /
						No<input type='radio' name='activated' <?php if($row['activated']==0){ echo "checked='checked'"; } ?> value='0'>
						<br/>
						<?php
						$urlx = "http://sureinvest-oms.com/userpage/?id=".$row['userweb_id'];
						?>
						Here is your url : <a href='<?php echo $urlx;?>' target='new'><?php echo $urlx;?></a>
						<hr>
						<center><input class="btn btn-primary btn-lg" type="submit" name="submit" value="Save my Web!"></center>
                    </div>
					</form>
