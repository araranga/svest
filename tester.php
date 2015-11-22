<?php
	if($_GET['s']<=1)
	{
			$rand = $_GET['s'];
			if($rand!=1)
			{
				$updaterand = $rand + 1;
			}
			else
			{
				$updaterand = 1;
			}
			
			echo $updaterand;
	}
?>