<h1>Add "New" Thread</h1>
<?php
//

if($_POST['submit']!='')
{
	$_POST['forummanager_content']  = nl2br(htmlentities($_POST['forummanager_content']));
	$_POST['activated'] = 1;
	unset($_POST['submit']);

	$set = array();

	foreach($_POST as $key=>$val)
	{
		$set[] = "$key='$val'";
	}
	$sets = implode(",",$set);
$query = "INSERT INTO tbl_forummanager SET $sets";
mysql_query($query);
?>
<script>
window.location = 'forum.php?mode=addthread&success=<?php echo md5(rand());?>';
</script>
<?php

}


$field[] = array("type"=>"text","value"=>"forummanager_title","label"=>"Forum Title");
?>
<?php
if($_GET['success']!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Thread is successfully added!</li></ul></div>
<?php
}
?>

<form method='POST' action=''>
<table width="100%">
<tr>
	<td>
		<label for="accounts_name">Choose Category:</label>
	</td>
	<td>
		<?php
		//forummanager_parent
		$q = mysql_query("SELECT * FROM tbl_forumcategorymanager WHERE activated='1'");
		?>
		<select id="forummanager_category" name="forummanager_category" class="" style="width: 303px;" required>
		<?php
		while($row=mysql_fetch_array($q))
		{
		?>
		<option value='<?php echo $row['forumcategorymanager_id']; ?>' <?php if($forummanager_category==$row['forumcategorymanager_id']){ echo "selected=\"selected\"";} ?>><?php echo $row['forumcategorymanager_name']; ?></option>
		<?php
		}
		?>
		</select>
	</td>
</tr>
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
										<tr>
											<td style="width:180px;" class="key" valign="top" ><label for="accounts_name"><?php echo $label; ?><?php echo $req_fld?>:</label></td>
											<?php if ( $is_editable_field ) { ?>
											<td>
											<?php
											if ($inputs['type']=='select')
											{
												if($$inputs['value']!='' && $inputs['value']=='code_id')
												{ 
												}
												else
												{
													
												
											
												?>
												<select name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" required <?php echo $inputs['attr']; ?>>
												<?php
												foreach($inputs['option'] as $val)
												{
													?>
													<option <?php if($$inputs['value']==$val){echo"selected='selected'";} ?> value='<?php echo $val;?>'><?php echo $val;?></option>
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
												<input maxlenght="200" required <?php echo $inputs['attr']; ?> type="<?php echo $inputs['type']; ?>" name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" size="40" maxlength="255" value="<?php echo $$inputs['value']; ?>" />
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
					<tr>
						<td><label for="accounts_name">Forum Content:</label></td>
						<td>
							<textarea required name='forummanager_content' style='  width: 302px;height: 150px;margin-top: 10px;resize: none;'></textarea>
						</td> 
					</tr>
					<input type='hidden' name='forummanager_parent' value='<?php echo $_SESSION['accounts_id'];?>'>
					<input type='hidden' name='forummanager_lastupdate' value='<?php echo date("Y-m-d H:i:s");?>'>
					
</table>
<br/>
<center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Add Thread'></center>
</form>
