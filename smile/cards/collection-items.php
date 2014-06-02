<div class="panel panel-default">
	<div class="panel-heading">
		<h4><?php echo "A list of Items in Collection ".$collection_id?>
        <?php
				echo "<a href=\"collection-add-items.php?colid=".$_GET['colid']."\" class=\"btn btn-primary active\" role=\"button\" style=\"float:right;\">Add items</a>&nbsp;&nbsp";
		?>
	    </h4></div>
	<div class="panel-body">
		<p>
			<table class="table table-striped footable" data-page-size="10">
	              		<thead>
	                		<tr>
	                  			<th>Item Id:</th>
	            
	     
	                		</tr>
	              		</thead>
	              		<tbody>
	              			<?php
	              			for($index = 0; $index<$size; $index++){
								//print_r($data_arr->{'items'}[$index]);
								echo "<tr>";
                                echo "<td><a href=\"item.php?itmid=".$items_arr[$index]."\">".$items_arr[$index]."</a></td>";
								//echo "<td>".$items_arr[$index]."</td>";
								//echo "<td>".$data_arr[$index]->{'description'}."</td>";
								echo "</tr>";
							}
	              			?>
	              		</tbody>
	              		<tfoot>
	              				<tr>
	              					<td colspan="7">
	              						<div class="pagination pagination-centered hide-if-no-paging"></div>
	              					</td>
	              				</tr>
	              		</tfoot>
	            	</table>

		</p>
	</div>
</div>