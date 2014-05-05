<?php include('core/init.core.php');?>
<?php
	
	//URL of the REST Call:
	$url      = APIURL."/product";
	
	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//REST call:
	$response =  rest_get($url,$headers);
	
	//Decode the JSON object:
	$data_arr = json_decode($response);
 	
 	//Number of products in the JSON object:
	$size = sizeof($data_arr->{'products'});
?>

<?php include('header.php'); ?>
<div class="container-fluid">
      	<div class="row">
        	<?php include('dashboard-sidebar.php');?>
        	
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">All products:<a href="product-add.php" class="btn btn-primary btn-lg active" role="button" style="float:right;">Add Product</a></h1>

	          	<h2 class="sub-header">Products:</h2>
	          	
	          	<div class="table-responsive">
	            	<table class="table table-striped">
	              		<thead>
	                		<tr>
	                			<th>No:</th>
	                  			<th>Name</th>
	                  			<th>Description</th>
	                  			<th colspan="3">Options:</th>
	                		</tr>
	              		</thead>
	              		<tbody>
	              			<?php
	              			for($index = 0, $k=1; $index<$size; $index++, $k++){
								echo "<tr>";
								echo "<td>".$k."</td>";
								echo "<td><a href=\"product.php?prodid=".$data_arr->{'products'}[$index]->{'id'}."\">".$data_arr->{'products'}[$index]->{'fn'}."</a></td>";
								echo "<td>".$data_arr->{'products'}[$index]->{'description'}."</td>";
								echo "<td><a href=\"product.php?prodid=".$data_arr->{'products'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">View product</a></td>";
								echo "<td><a href=\"product-update.php?prodid=".$data_arr->{'products'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">Update product</a></td>";
								//echo "<td><a href=\"#\" onclick=\"printImage(".$data_arr->{'products'}[$index]->{'id'}.",'".$data_arr->{'products'}[$index]->{'fn'}."');\" class=\"btn btn-primary btn-sm active\" role=\"button\">Print QR Code</a></td>";
								echo "<td><a href=\"product-delete.php?prodid=".$data_arr->{'products'}[$index]->{'id'}."\" class=\"btn btn-danger btn-sm active\" role=\"button\">Delete product</a></td>";
								echo "</tr>";
							}
							?>
	              		</tbody>
	            	</table>
	          	</div><!--End of table-responsive-->
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->
<!--  -->
<?php include('footer.php'); ?>