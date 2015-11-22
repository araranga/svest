
<?php
$q = mysql_query("SELECT COUNT(username) as total FROM tbl_accounts");
$row = mysql_fetch_assoc($q);

$q2 = mysql_query("SELECT SUM(amount) as sum FROM tbl_withdraw_history");
$row2 = mysql_fetch_assoc($q2);

$q3 = mysql_query("SELECT SUM(balance) as sum FROM tbl_accounts");
$row3 = mysql_fetch_assoc($q3);

$q4 = mysql_query("SELECT SUM(b.rate_start) as sum FROM tbl_buycode_history as a JOIN tbl_rate as b WHERE a.package_id=b.rate_id;");
$row4 = mysql_fetch_assoc($q4);
?>

<p style='font-weight:700;'>Total Users: <?php echo $row['total'];?></p>
<p style='font-weight:700;'>Total Payouts: &#8369;<?php echo number_format(($row2['sum'] + $row3['sum'] + $row4['sum']),2);?></p>