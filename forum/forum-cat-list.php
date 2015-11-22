<?php
$query = getforumcategorydetail($_GET['cat']);
$row = mysql_fetch_array($query);
?>
<table border="0" cellspacing="0" cellpadding="5" class="tborder">
<thead>
<tr>
<td class="thead" colspan="5">
<div><strong><a href="forum.php?mode=forum-cat-list&cat=<?php echo $row['forumcategorymanager_id'];?>"><?php echo $row['forumcategorymanager_name'];?></a></strong><br><div class="smalltext"></div></div>
</td>
</tr>
</thead>
<tbody style="display: table-row-group;" id="cat_1_e">
<tr>
<td class="tcat" colspan="2"><span class="smalltext"><strong>Threads</strong></span></td>
<td class="tcat" width="85" align="center" style="white-space: nowrap"><span class="smalltext"><strong>Replies</strong></span></td>
<td class="tcat" width="200" align="center"><span class="smalltext"><strong>Last Post</strong></span></td>
</tr>
			<?php
			$querythread = getforumthread($row['forumcategorymanager_id'],50,1);
			while($row2=mysql_fetch_assoc($querythread))
			{
			?>
			<!-- start: forumbit_depth2_forum -->
			<tr>
				<td class="trow1" align="center" width="1"><span class="forum_status forum_off ajax_mark_read" title="Forum Contains No New Posts" id="mark_read_2"></span></td>
				<td class="trow1">
				<strong><a href="forum.php?mode=thread-list&thread=<?php echo $row2['id'];?>"><?php echo $row2['forummanager_title'];?>
				<?php
				$x = person($row2['forummanager_parent']);
				?>
				<br/><span style='font-size: 12px;'>by <?php echo $x['username'];?></span>
				</a></strong><div class="smalltext"></div>
				</td>
				<td class="trow1" align="center" style="white-space: nowrap"><?php echo getreplycount($row2['id']);?></td>
				<td class="trow1" align="right" style="white-space: nowrap">
				<div style="text-align: center;">Never</div>
				</td>
			</tr>
			<?php
			}
			if(mysql_num_rows($querythread)==0)
			{
			?>
			<tr>
				<td class="trow1" align="center" width="1" colspan='4'>
				No threads yet.
				</td>
			</tr>			
			<?php
			}
			?>
			<!-- end: forumbit_depth2_forum -->
</tbody>
</table> 
<br/>