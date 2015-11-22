<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];
$dateny = dateny();
$query  = "SELECT *, (SELECT SUM(points) FROM tbl_buyproduct_history WHERE referdata.child=accounts_id AND gendate_end='".$dateny."') as totalpoints FROM tbl_referdata as referdata WHERE parent='$accounts_id' HAVING totalpoints >= 1 ORDER by level";
#echo $query;
$q = mysql_query($query);
#echo "SELECT * FROM tbl_exitbonushistory as a JOIN tbl_exitbonusmanager as b WHERE account_id='$accounts_id' AND a.bonus_id=b.exitbonusmanager_id";
?>
<h2>Generational Bonuses</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Level #</th>
                                            <th>Child</th>
                                            <th>Accumulate Pts. / 400 required</th>
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
                                            <td><?php echo $row['totalpoints']; ?></td>
                                        </tr>
									<?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
