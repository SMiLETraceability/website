<?php include('core/init.core.php');?>
<?php

    $collection_id = $_GET['colid'];

	//URL of the REST call

	$url = APIURL."/collections/".$collection_id."/items/";

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//GET the response from the REST call:
	$response =  rest_get($url,$headers);

	//Decode the JSON object:
	$data_arr = json_decode($response);

	//Get the number of items in the JSON object:
	$size = sizeof($data_arr);
	//print_r($size);
?>


<?php include('header.php'); ?>

	<div class="container-fluid">
      	<div class="row">
      		<?php include('dashboard-sidebar.php'); ?>
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header"><?php echo "A list of Items in Collection ".$collection_id?> &nbsp;&nbsp;</h1>

	          	<div class="table-responsive" style="clear:both;">
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

								//echo "<td>".$data_arr[$index]."</td>";
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
	          	</div><!--End of table-responsive-->
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->
<?php include('footer.php'); ?>