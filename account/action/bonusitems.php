<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query("SELECT * FROM tbl_exitbonushistory as a JOIN tbl_exitbonusmanager as b WHERE account_id='$accounts_id' AND a.bonus_id=b.exitbonusmanager_id");
#echo "SELECT * FROM tbl_exitbonushistory as a JOIN tbl_exitbonusmanager as b WHERE account_id='$accounts_id' AND a.bonus_id=b.exitbonusmanager_id";
?>
<h2>Bonus Item History</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID Number #</th>
                                            <th>Bonus Item</th>
                                            <th>Exit Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['exitbonushistory_id'];?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['exit_number']; ?></td>
                                        </tr>
									<?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
