<?php include('core/init.core.php');?>
<?php
	
	//URL of the REST call:
	$url      = APIURL."/collections";

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//REST Get call:
	$response =  rest_get($url,$headers);

	//Decode the REST response:
	$data_arr = json_decode($response);

	//Print out array for testing purposes:
	//print_r($data_arr);

	//Collection size:
	$size = sizeof($data_arr->{'collections'});

?>
<?php include('header.php'); ?>
	<div class="container-fluid">
      	<div class="row">
      		<?php include('dashboard-sidebar.php'); ?>
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Collections: &nbsp;&nbsp;<a href="collection-add.php" class="btn btn-primary btn-lg active" role="button" style="float:right;">Add Collection</a></h1>

	          	<div class="table-responsive" style="clear:both;">
	            	<table class="table table-striped">
	              		<thead>
	                		<tr>
	                			<th>No:</th>
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
								echo "<td><a href=\"collection.php?colid=".$data_arr->{'collections'}[$index]->{'id'}."\">".$data_arr->{'collections'}[$index]->{'name'}."</a></td>";
								echo "<td>".$data_arr->{'collections'}[$index]->{'description'}."</td>";
								echo "<td><a href=\"collection.php?colid=".$data_arr->{'collections'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">View Collection</a></td>";
								echo "<td><a href=\"collection-update.php?colid=".$data_arr->{'collections'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">Update Collection</a></td>";
								echo "<td><a href=\"\" class=\"btn btn-primary btn-sm active\" role=\"button\">Print QR Code</a></td>";
								echo "<td><a href=\"collection-delete.php?colid=".$data_arr->{'collections'}[$index]->{'id'}."\" class=\"btn btn-danger btn-sm active\" role=\"button\">Delete Collection</a></td>";
								echo "</tr>";
							}
	              			?>
	              		</tbody>
	            	</table>
	          	</div><!--End of table-responsive-->
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->
<?php include('footer.php'); ?>