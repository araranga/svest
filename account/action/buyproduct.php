<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_assoc($q);
function pin()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 7; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

	if($_POST['submit']!='')
	{
	$check_rate = mysql_query("SELECT * FROM tbl_product WHERE product_id='".$_POST['rate']."'");
	$check_row  = mysql_fetch_array($check_rate);
		if($_POST['password']!=$row['password'])
		{
						$error .= "<i class=\"fa fa-warning\"></i>Password incorrect!.<br>";
		}
		
		if($check_row['price']>$row['balance'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Insufficient Funds!.<br>";
		}
		if($error=='')
		{
		$current_balance  = $row['balance'] - $check_row['price'];
		$code_package = $_POST['rate'];
		$code_referrer = $accounts_id;
		mysql_query("UPDATE tbl_accounts SET balance='$current_balance' WHERE accounts_id='$accounts_id'");
		//history
		$package_id = $check_row['product_id'];
		$points = $check_row['points'];
		$leadpoint = $check_row['overall_points'];
		$package_summary = $check_row['title']. " - ".$check_row['price'];
		$gendate = date("n-Y");
		//

			$month_a = date("n") + 1;
			$year_a = date("Y");
			if($month_a==13)
			{
				$month_a = 1;
				$year_a++;
			}
			$gendate_end = $month_a."-".$year_a;
		//


		mysql_query("INSERT INTO tbl_buyproduct_history SET product_id='$package_id',product_summary='$package_summary',accounts_id='$accounts_id',points='$points',leadpoint='$leadpoint',gendate='$gendate',gendate_end='$gendate_end'");
		$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
		$row = mysql_fetch_assoc($q);	
		$success = "Done Purchasing the product";
		}
	}



$package_query = mysql_query("SELECT * FROM tbl_product");
while($row_package = mysql_fetch_assoc($package_query))
{
	$arr[$row_package	['product_id']] = $row_package['title']. " - ".$row_package['price'];
}
	
$field[] = array("type"=>"select","value"=>"rate","label"=>"Choose Your Product","option"=>$arr);
$field[] = array("type"=>"password","value"=>"password","label"=>"Enter Password");
//
?>
<h2>Buy Product - Balance(<?php echo $row['balance'];?>)</h2>   
<?php
if($error!='')
{
?>
<div class="warning"><ul class="fa-ul"><li><?php echo $error;?></li></ul></div>
<?php
}
?>


<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>
<?php echo $success; ?>
</li></ul></div>
<?php
}
?>



<form method='POST' action=''>
<table width="100%">
						<?php
						$is_editable_field = 1;
						foreach($field as $inputs)
						{
												if($inputs['label']!='')
												{
												$label = $inputs['label'];
												}
												else
												{
												$label = ucwords($inputs['value']);
												}
						?>
									<!---weee--->
										<tr>
											<td style="width:180px;" class="key" valign="top" ><label for="accounts_name"><?php echo $label; ?><?php echo $req_fld?>:</label></td>
											<?php if ( $is_editable_field ) { ?>
											<td>
											<?php
											if ($inputs['type']=='select')
											{
												if($$inputs['value']!='' && $inputs['value']=='code_id')
												{ 
												 $code = $$inputs['value'];
												 $codeqq = mysql_query("SELECT * FROM tbl_code as a JOIN tbl_rate as b JOIN tbl_accounts as c WHERE c.code_id=a.code_value AND a.code_value='$code' AND a.code_package=b.product_id");
												 $coderow = mysql_fetch_array($codeqq);
												 
												//asds
												
												echo "Package Name"." : ".$coderow['rate_name'];
												echo "<br>";
												echo "Registration FEE"." : ".$coderow['price'];
												echo "<br>";
												echo "Salary"." : ".$coderow['rate_end'];
												echo "<br>";
												echo "Code Value - Code Pin"." : ".$coderow['code_value']." - ".$coderow['code_pin'];
												echo "<br><br>";
												echo "Total Earnings"." : ".$coderow['total_earnings'];
												echo "<br>";
												echo "Current Balance"." : ".$coderow['balance']; 
												//
												}
												else
												{
													
												
											
												?>
												<select name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" required <?php echo $inputs['attr']; ?>>
												<?php
												foreach($inputs['option'] as $key=>$val)
												{
													?>
													<option <?php if($$inputs['value']==$val){echo"selected='selected'";} ?> value='<?php echo $key;?>'><?php echo $val;?></option>
													<?php
												}
												?>
												</select>
												<span class="validation-status"></span>
												<?php
												}
											}
											else
											{
												?>
												<input required <?php echo $inputs['attr']; ?> type="<?php echo $inputs['type']; ?>" name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" size="40" maxlength="255" value="<?php echo $$inputs['value']; ?>" />
												<span class="validation-status"></span>												
												<?php
											}
											?>

											</td>
											<?php } else { ?>
											<td><?php echo $$inputs['value']; ?></td>
											<?php } ?>                                                                                                    
										</tr>
						<?php
						}
						?>
</table>
<br/>
<center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Process'></center>
</form>