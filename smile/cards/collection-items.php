<div class="panel panel-default">
	<div class="panel-heading">
		<h4>Items        <?php
				echo "<a href=\"collection-add-items.php?colid=".$_GET['colid']."&colname=". $data_arr->{'name'} ."\" class=\"btn btn-primary active\" role=\"button\" style=\"float:right;\">Add items</a>&nbsp;&nbsp";
		?>
	    </h4></div>
	<div class="panel-body">
		<p>
			<table class="table table-striped footable" data-page-size="10">
	              		<thead>
	                		<tr>
	                  			<th>Item Id:</th>
	                  			<th>Name</th>
	                  			<th>Options</th>    
	                		</tr>
	              		</thead>
	              		<tbody>
	              			<?php
	              			if ($status!=404) {
			              			for($index = 0; $index<$size; $index++){
			              			
			              			   
			              			//URL of the REST call:
			              			$it_url      = APIURL."/item/".$items_arr[$index];
			              			//REST response:
			              			$it_response =  rest_get($it_url,$headers);
			              			
			              			//Decode the JSON object:
			              			$it_data_arr = json_decode($it_response);
			              			
										//print_r($data_arr->{'items'}[$index]);
										echo "<tr>";
		                                echo "<td><a href=\"item.php?itmid=".$items_arr[$index]."\">".$items_arr[$index]."</a></td>"; 
		                                echo "<td>" . $it_data_arr->{'name'} ."</td>";
		                                echo "<td><a href=\"#\" data-label=\"". $it_data_arr->{'name'} ."\"data-href=\"collection-item-delete.php?colid=".$_GET['colid']."&itemid=".$items_arr[$index]."\" class=\"btn btn-danger active\" role=\"button\" data-toggle=\"modal\" data-target=\"#confirm-delete\">Delete item</a></td>";
										//echo "<td>".$items_arr[$index]."</td>";
										//echo "<td>".$data_arr[$index]->{'description'}."</td>";
										echo "</tr>";
									}
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