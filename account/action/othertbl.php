<style>
.rankings
{
  position: absolute;
  color: white;
  background-color: red;
  font-weight: 700;
  padding: 6px;
  border-radius: 15px;	
  margin-left: -3%;
  margin-top: -23px; 
}
</style>
<?php
$xx = $_GET['tbl'];
$xe = explode("_",$xx);

$counterx = 0;
$q = mysql_query("SELECT * FROM tbl_othertable WHERE curtbl='$xx' AND is_win='no' ORDER by id ASC LIMIT 0,15");
$users = array();
$static = 0;
if(mysql_num_rows($q)==0)
{
$static = 1;
$static_q = mysql_query("SELECT * FROM tbl_othertable WHERE curtbl='$xx'");
$static_row = mysql_fetch_assoc($static_q);
$myidx = $static_row['id'];
$q = mysql_query("SELECT * FROM tbl_othertable WHERE id >= $myidx ORDER BY id ASC LIMIT 0,15");
}

$qx = mysql_query("SELECT * FROM tbl_code as a JOIN tbl_rate as b WHERE b.rate_id=a.code_package AND code_value='".$_SESSION['code_id']."'");
$qxrow = mysql_fetch_array($qx);	
					if($qxrow['rate_req']==3)
					{
						$xcount = 7 - mysql_num_rows($q);
						$xlimit = 7;
					}
					if($qxrow['rate_req']==4)
					{
						$xcount = 15 - mysql_num_rows($q);
						$xlimit = 15;
					}	
					
$mypos = 0;
$xcount = 1;

#SELECT * FROM table_name WHERE id >= 3 ORDER BY id ASC LIMIT 0,15
while($row=mysql_fetch_array($q))
{
	
	$users[$xcount] = $row['accounts_id'];
	$xcount++;
	if($row['accounts_id']==$_SESSION['accounts_id'])
	{
		$mypos = $xcount;
	}
}
if($mypos==1 && $static==0)
{
	addmoneyothertbl($qxrow['rate_end'],$_SESSION['accounts_id']);
}
#test
if($_GET['pos']==1)
{
#addmoneyothertbl($qxrow['rate_end'],$_SESSION['accounts_id']);
}
?>
<h2>Table <?php echo $xe[1];?> <?php if($static==1){ echo "(FINISHED)"; }?></h2>
<table border='0' style='width:100%;'>
<tr>
	<td colspan='8' class='tds main id'>
				<div class='people'>
				<?php echo loadprofilex($users[1]); ?>
				</div> 
	</td>
</tr>
<tr>
	<td colspan='4' class='tds left'>
				<div class='people'>
				<?php echo loadprofilex($users[2]); ?>	
				</div>
	</td>
	<td colspan='4' class='tds right'>
				<div class='people'>
					
	<?php echo loadprofilex($users[3]); ?>			

				</div>
	</td>
</tr>

<tr>
	<td colspan='2' class='tds left'>
				<div class='people'>
					
	<?php echo loadprofilex($users[4]); ?>				
					
				</div>
	</td>
	<td colspan='2' class='tds left'>
				<div class='people'>
				
<?php echo loadprofilex($users[5]); ?>					
					
				</div>
	</td>
	<td colspan='2' class='tds right'>
				<div class='people'>

<?php echo loadprofilex($users[6]); ?>					
					
				</div>
	</td>
	<td colspan='2' class='tds right'>
				<div class='people'>
<?php echo loadprofilex($users[7]); ?>
					
				</div>
	</td>
</tr>
<?php
if($xlimit!=7)
{
?>
<tr>
	<td class='tds left'>
					<div class='people'>
						
<?php echo loadprofilex($users[8]); ?>		
						
					</div>
	</td>
	<td class='tds left'>
					<div class='people'>
						
<?php echo loadprofilex($users[9]); ?>						
						
						
					</div>
	</td>

	
	
	<td class='tds left'>
					<div class='people'>
					
<?php echo loadprofilex($users[10]); ?>						
						
					</div>
	</td>
	<td class='tds left'>
					<div class='people'>
						
<?php echo loadprofilex($users[11]); ?>	
						
					</div>
	</td>	
	
	<!--RIGHT-->
	<td class='tds left'>
					<div class='people'>
						
<?php echo loadprofilex($users[12]); ?>	
						
					</div>
	</td>
	<td class='tds left'>
					<div class='people'>
						
<?php echo loadprofilex($users[13]); ?>					
						
						
					</div>
	</td>

	
	
	<td class='tds left'>
					<div class='people'>
						
<?php echo loadprofilex($users[14]); ?>					
						
						
					</div>
	</td>
	<td class='tds left'>
				<div class='people'>
											
<?php echo loadprofilex($users[15]); ?>						
						
					</div>
	</td>	
	
	
	
	
	

</tr>
<?php
}
?>


</table>