<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query("SELECT * FROM tbl_referdata WHERE parent='$accounts_id' ORDER by level");
#echo "SELECT * FROM tbl_exitbonushistory as a JOIN tbl_exitbonusmanager as b WHERE account_id='$accounts_id' AND a.bonus_id=b.exitbonusmanager_id";
?>
<h2>Direct / Indirect Bonuses</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Level #</th>
                                            <th>Child</th>
                                            <th>Bonus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
                                    $bonus_total = 0;                                   
									while($row=mysql_fetch_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['level'];?></td>
                                            <td>
                                            <?php
                                            $person = person($row['child']);
                                            echo $person['username']; 
                                            ?></td>
                                            <td><?php echo reward($row['level']); ?></td>
                                        </tr>
									<?php
                                    $bonus_total += reward($row['level']);
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            Total Bonus: <?php echo $bonus_total; ?>
                        </div>
                    </div>   
