<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include("../../connect.php");
include("../../function.php");
$word = $_GET['spill'];
$query = "SELECT * FROM tbl_accounts WHERE username LIKE '%$word%'  OR firstname LIKE '%$word%' OR lastname LIKE '%$word%' LIMIT 0,50";
$q = mysql_query($query);
?>
Search result for : <?php echo $word; ?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th>ID</th>	
<th>CODE ID</th>	
<th>Username</th>
<th>Full Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>

	

<?php
while($row=mysql_fetch_array($q))
{
	?>
	<tr>
	<td><?php echo $row['accounts_id'];?></td>	
	<td><?php echo $row['code_id'];?></td>	
	<td><?php echo $row['username'];?></td>
	<td><?php echo $row['firstname'];?> <?php echo $row['lastname'];?></td>
	<td><button class="btn btn-primary btn-sm" onclick="pickspillover(<?php echo $row['accounts_id'];?>)">View Table</button></td>
	</tr>
	
	<?php
}
	
?>
</tbody>
</table>
</div>