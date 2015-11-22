<?php
session_start();
include("../../connect.php");
include("../../function.php");

if($_POST['submit']!='')
{
	$useradd = $_POST['useradd'];
	$passadd = $_POST['passadd'];
	$checkadd = mysql_query("SELECT * FROM tbl_accounts WHERE username='$useradd' AND password='$passadd'");
	if(mysql_num_rows($checkadd)==0)
	{
		echo "<p class='perror'>Username or Password do not match. Maybe Account not exist</p>";
	}
	else
	{
		$checkaddrow = mysql_fetch_assoc($checkadd);
		$qs = mysql_query("SELECT * FROM tbl_multiaccount WHERE parent='".$checkaddrow['accounts_id']."' OR children='".$checkaddrow['accounts_id']."'");
		if(mysql_num_rows($qs)==0)
		{	
			if($checkaddrow['accounts_id']==$_SESSION['accounts_id'])
			{
				echo "<p class='perror'>Cannot add same account.</p>";
			}
			else
			{
			$qxx = mysql_query("SELECT * FROM tbl_multiaccount WHERE children='".$_SESSION['accounts_id']."'");
			$parentko = $_SESSION['accounts_id'];
			if(mysql_num_rows($qxx)!=0)
			{
			$qxxr = mysql_fetch_assoc($qxx);
			$parentko = $qxxr['parent'];
			}
			mysql_query("INSERT INTO tbl_multiaccount SET parent='".$parentko."',children='".$checkaddrow['accounts_id']."'");
			echo "<p class='perror'>Done adding account to this user.</p>";
			}
		
		}
		else
		{
		echo "<p class='perror'>This account already link to other accounts</p>";
		}
	}
}




$parentidd = $_SESSION['accounts_id'];

$q = mysql_query("SELECT * FROM tbl_multiaccount WHERE parent='$parentidd'");



?>
<style>
.perror
{
  font-size: 15px;
  color: red;
  background-color: rgb(208, 213, 208);
  padding: 10px;
  font-weight: 700;
  border-radius: 10px;
  border: 1px solid rgb(34, 28, 28);
}
 </style>
<div id='notibar'></div>
<button class='btn btn-primary btn-sm' onclick='jQuery("#addacc").slideToggle();'>Add Account</button>
<form id='addacc' method='POST' action='' style='display:none;'>
<div style="padding: 22px;
  border: 1px solid rgb(60, 38, 38);
  margin-top: 12px;
  background-color: rgb(216, 212, 212);">
<table width="100%">
<!---weee--->
<tbody>
<tr>
	<th style="width:180px;" class="key" valign="top"><label for="accounts_name">Username:</label></th>
	<th>
	<input required="" type="text" name="useradd" id="useradd" maxlength="255" value="">										
	</th>
</tr>
<tr>
	<th style="width:180px;" class="key" valign="top"><label for="accounts_name">Password:</label></th>
	<th>
	<input required="" type="password" name="passadd" id="passadd" maxlength="255" value="">										
	</th>
</tr>
</tbody>
</table>
<center><input type="submit" name="submit" value="Add"></center>	
</div>
</form>
<?php
$loop_q = mysql_query("SELECT * FROM tbl_multiaccount WHERE parent='".$_SESSION['accounts_id']."'");
$loop_q2 = mysql_query("SELECT * FROM tbl_multiaccount WHERE children='".$_SESSION['accounts_id']."'");
if(mysql_num_rows($loop_q2)!=0)
{
$visible_parent = 1;
$xxxxxx = mysql_fetch_assoc($loop_q2);
$loop_q = mysql_query("SELECT * FROM tbl_multiaccount WHERE parent='".$xxxxxx['parent']."'");
}
?>




<h2>Other Accounts</h2>

                  <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Balance</th>
											<th>Code Value/Code Pin</th>
											<th>Package Name</th>
                                            <th>Payin / Payout</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
											
									<?php
									while($data=mysql_fetch_assoc($loop_q))
									{
										$data1 = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='".$data['children']."'"));
										$data2 = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_code WHERE code_value='".$data1['code_id']."'"));
										$data3 = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_rate WHERE rate_id='".$data2['code_package']."'"));
									?>
                                        <tr>
                                            <th><?php echo $data1['username'];?></th>
                                            <th><?php echo number_format($data1['balance'],2);?></th>
											<th><?php echo $data2['code_value']." - ".$data2['code_pin'];?></th>
											<th><?php echo $data3['rate_name'];?></th>
                                            <th><?php echo $data3['rate_start']." - ".$data3['rate_end'];?></th>
											<?php
											if($data1['accounts_id']!=$_SESSION['accounts_id'])
											{
											?>
											<th><button class="btn btn-primary btn-sm" onclick="processloginx('<?php echo $data1['username'];?>','<?php echo $data1['password'];?>')">Switch Account</button></th>
											<?php
											}
											else
											{
											?>
											<th>Currently Logged-In</th>
											<?php
											}
											?>
                                        </tr>
									<?php
									$dataparent = $data['parent'];
									}
									?>			

								<?php
									if(mysql_num_rows($loop_q)!=0)
									{
										
										$data1 = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='".$dataparent."'"));
										$data2 = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_code WHERE code_value='".$data1['code_id']."'"));
										$data3 = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_rate WHERE rate_id='".$data2['code_package']."'"));
									?>
                                        <tr>
                                            <th><?php echo $data1['username'];?></th>
                                            <th><?php echo number_format($data1['balance'],2);?></th>
											<th><?php echo $data2['code_value']." - ".$data2['code_pin'];?></th>
											<th><?php echo $data3['rate_name'];?></th>
                                            <th><?php echo $data3['rate_start']." - ".$data3['rate_end'];?></th>
											<?php
											if($data1['accounts_id']!=$_SESSION['accounts_id'])
											{
											?>
											<th><button class="btn btn-primary btn-sm" onclick="processloginx('<?php echo $data1['username'];?>','<?php echo $data1['password'];?>')">Switch Account</button></th>
											<?php
											}
											else
											{
											?>
											<th>Currently Logged-In</th>
											<?php
											}
											?>
                                        </tr>
									<?php
									}
									?>										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   


<script>
	function processloginx(username,password)
	{
		$('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-cog fa-spin fa-li"></i> Please wait.. Checking your acccount.</li></ul></div>');
    $.post("action/process-login.php?rand=<?php echo rand();?>",{username: username,password:password}, function(data, status){
		//alert(data);
		$('#notibar').html('');
		if(data=="0")
		{
			$('#notibar').html('<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i>Please check your username/password. or Account does not exist.</li></ul></div>');
		}
		if(data=="1")
		{
			$('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-cog fa-spin fa-li"></i> Loading.. Your Account.</li></ul></div>');
			window.location = '?rand=<?php echo rand();?>';
		}
    });		
	}
	</script>
