<?php include('core/init.core.php');?>
<?php

	//URL of the REST call:
	$url      = APIURL."/collections";

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//GET the response from the REST call:
	$response =  rest_get($url,$headers);

	//Decode the JSON object:
	$data_arr = json_decode($response);

	//Get the number of items in the JSON object:
	$size = sizeof($data_arr->{'collections'});
?>




<?php include('header.php'); ?>

	<div class="container-fluid">
      	<div class="row">
      		<?php include('dashboard-sidebar.php'); ?>
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Collections &nbsp;&nbsp;<a href="collection-add.php" class="btn btn-primary btn-lg active" role="button" style="float:right;">Add Collection</a></h1>

	          	<div class="table-responsive" style="clear:both;">
	            	<table class="table table-striped footable" data-page-size="10">
	              		<thead>
	                		<tr>
	                  			<th>Name:</th>
	                  			<th>Description:</th>
	                  			<th colspan="2">Options:</th>
	                  			<th><a href="#" class="btn btn-primary btn-sm active" onclick="printItems()"role="button">Print QR Code</a></th>
	                  			<th></th>
	                		</tr>
	              		</thead>
	              		<tbody>
	              			<?php
	              			for($index = 0; $index<$size; $index++){
								//print_r($data_arr->{'items'}[$index]);
								echo "<tr>";
								echo "<td><a href=\"collection.php?colid=".$data_arr->{'collections'}[$index]->{'id'}."\">".$data_arr->{'collections'}[$index]->{'name'}."</a></td>";
								echo "<td>".$data_arr->{'collections'}[$index]->{'description'}."</td>";
								echo "<td><a href=\"collection.php?colid=".$data_arr->{'collections'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">View</a></td>";
								echo "<td><a href=\"collection-update.php?colid=".$data_arr->{'collections'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">Update</a></td>";
								
								echo "<td> <input type=\"checkbox\" class=\"qr-item\" name=\"". $data_arr->{'collections'}[$index]->{'name'}."\" value=\"" . $data_arr->{'collections'}[$index]->{'id'} . "\"></td>";

								//echo "<td><a href=\"\" class=\"btn btn-primary btn-sm active\" role=\"button\">Print QR Code</a></td>";
								echo "<td><a href=\"collection-delete.php?colid=".$data_arr->{'collections'}[$index]->{'id'}."\" class=\"btn btn-danger btn-sm active\" role=\"button\">Delete</a></td>";
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