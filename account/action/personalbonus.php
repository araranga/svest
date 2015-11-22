<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query("SELECT *,(SELECT SUM(points) FROM tbl_buyproduct_history WHERE gendate=main.gendate AND accounts_id=main.accounts_id) as totalpoints FROM tbl_buyproduct_history as main WHERE accounts_id='$accounts_id' GROUP by gendate ORDER by id ASC");
?>
<h2>Personal Bonus</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Total Points</th>
                                            <th>Date In</th>
                                            <th>Cutoff/Payout Date</th>
                                            <th>Total Bonus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row=mysql_fetch_array($q))
                                            {
                                        ?>
	                                       <th><?php echo $row['totalpoints']; ?></th>
                                           <th><?php echo $row['gendate']; ?></th>
                                           <th><?php echo $row['gendate_end']; ?></th>   
                                           <th>
                                            <?php

                                                if($row['is_paid']!='')
                                                {
                                                    echo "Total Bonus:";
                                                    echo personalbonus($row['totalpoints']);
                                                }
                                                else
                                                {
                                                    echo "Possible Bonus:";
                                                    echo personalbonus($row['totalpoints']);
                                                }
                                            ?> 
                                                </th>                                           
                                        <?php
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
