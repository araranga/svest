<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query("SELECT * FROM tbl_buyproduct_history as a WHERE accounts_id='$accounts_id' ORDER by a.history DESC");

?>
<h2>Purchase Product History</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID Number #</th>
                                            <th>Product Summary</th>
                                            <th>Points</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['id'];?>-<?php echo $row['gendate'];?><?php echo $row['gendate_end'];?></td>
                                            <td><?php echo $row['product_summary']; ?></td>
                                            <td><?php echo $row['points']; ?></td>
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
