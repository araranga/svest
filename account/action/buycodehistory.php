<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query("SELECT * FROM tbl_buycode_history as a WHERE accounts_id='$accounts_id' ORDER by a.history DESC");

?>
<h2>Purchase Code History</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID Number #</th>
                                            <th>Package Summary</th>
											<th>Code Value/Code Pin</th>
											<th>Current Owner</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['id'];?></td>
                                            <td><?php echo $row['package_summary']; ?></td>
                                            <td><?php echo $row['code_value']; ?> / <?php echo $row['code_pin']; ?></td>
											<th>
											<?php
											$cas = mysql_query("SELECT firstname,lastname,email,username,gender FROM tbl_accounts WHERE code_id='".$row['code_value']."'");
											$casr = mysql_fetch_assoc($cas);
											//echo "SELECT firstname,lastname,email,username FROM tbl_accounts WHERE code_id='".$row['code_value']."'";
											if(mysql_num_rows($cas)!=0)
											{
											?>	
											<div style='margin:0 auto;width:70%;text-align: center;'>
											<img style='width:50%;' src='assets/img/<?php echo strtolower($casr['gender']);?>.png'/>	
											</div>
											<table>
											<tr><td>Username:</td><td><?php echo $casr['username'];?></td></tr>
											<tr><td>Name:</td><td><?php echo $casr['firstname']." ".$casr['lastname'];?></td></tr>
											<tr><td>Email:</td><td><?php echo $casr['email'];?></td></tr>
											</table>
											<?php
											}
											else
											{
											?>
												<a href='#'>------</a>
											<?php
											}
											?>
											</th>
                                            <td><?php echo $row['history']; ?></td>
                                        </tr>
									<?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
