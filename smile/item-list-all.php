<?php include('core/init.core.php');?>
<?php

	//URL of the REST call:
	$url      = APIURL."/item";

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//GET the response from the REST call:
	$response =  rest_get($url,$headers);

	//Decode the JSON object:
	$data_arr = json_decode($response);

	//Get the number of items in the JSON object:
	$size = sizeof($data_arr->{'items'});
?>
<?php include('header.php'); ?>
<div class="container-fluid">
      	<div class="row">
        	<?php include('dashboard-sidebar.php');?>
        	
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">All items:&nbsp;&nbsp;<a href="item-add.php" class="btn btn-primary btn-lg active" role="button" style="float:right;">Add Item</a></h1>
	          	
	          	<div class="table-responsive" style="clear:both;">
	            	<table class="table table-striped footable" data-page-size="10">
	              		<thead>
	                		<tr>
	                			<th>Number:</th>
	                  			<th>Name:</th>
	                  			<th>Description:</th>
	                  			<th colspan="4">Options:</th>
	                		</tr>
	              		</thead>
	              		<tbody>
	              			<?php
	              			for($index = 0, $k=1; $index<$size; $index++, $k++){
								//print_r($data_arr->{'items'}[$index]);
								echo "<tr>";
								echo "<td>".$k."</td>";
								echo "<td><a href=\"item.php?itmid=".$data_arr->{'items'}[$index]->{'id'}."\">".$data_arr->{'items'}[$index]->{'name'}."</a></td>";
								echo "<td>".$data_arr->{'items'}[$index]->{'description'}."</td>";
								echo "<td><a href=\"item.php?itmid=".$data_arr->{'items'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">View Item</a></td>";
								echo "<td><a href=\"item-update.php?itmid=".$data_arr->{'items'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">Update Item</a></td>";
								echo "<td><a href=\"#\" onclick=\"printItem(".$data_arr->{'items'}[$index]->{'id'}.",'".$data_arr->{'items'}[$index]->{'name'}."');\" class=\"btn btn-primary btn-sm active\" role=\"button\">Print QR Code</a></td>";
								echo "<td><a href=\"item-delete.php?itmid=".$data_arr->{'items'}[$index]->{'id'}."\" class=\"btn btn-danger btn-sm active\" role=\"button\">Delete Item</a></td>";
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
	          	</div><!--End of table-responsive-->
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>