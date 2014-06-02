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


<?php
  
  $collection_id = $_GET['colid'];

  if($_SERVER['REQUEST_METHOD']=='POST'){
  
    $aItem = $_POST['selitems'];

  if(empty($aItem)){
    echo("You didn't select any items.");
  } 
  else
  {
    //$N = count($aItem);
    	
      $url = APIURL."/collections/".$collection_id."/items/";

		//Encode the JSON array:
	  $data = json_encode($aItem);

		//Create the headers:
	  $headers = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

		//Create the REST call:
	  $response = rest_put($url, $data, $headers);

	  //print_r($data);
		
		//For testing purposes:
		//print_r($status);
	    
	   // $userobj = json_decode($response);

	  //  $status = $userobj->{'statusCode'};

        //Check if the collection creation was successful:
      //  if($status && $status!=200){
       // 	$errors[] = $userobj->{'errors'}[0];
        //    $errors[] = $userobj->{'moreInfo'};
        //}

		//everything was successful, redirect to product view page
        //if(empty($errors)){
        	//$collection_id = $userobj->{'id'};
        	//header("Location: collection.php?colid=$collection_id");
         //   die();  
        //}
    
    
  }
  header("Location: collection.php?colid=$collection_id");
  die();
}

?>



<?php include('header.php'); ?>
<div class="container-fluid">
      	<div class="row">
        	<?php include('dashboard-sidebar.php');?>
        	
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">All items:&nbsp;&nbsp;
	          	<form class="form-horizontal form-register" method="post" role="form">	
	          	<div class="table-responsive" style="clear:both;">
	            	<table class="table table-striped footable" data-page-size="10">
	              		<thead>
	                		<tr>
	                  			<th>Name:</th>
	                  			<th>Description:</th>
	                  			<th>Product:</th>
	                  			<th><input type="checkbox" id="selectall"/> Select All</th>	                  			
	                		</tr>
	              		</thead>
	              		<tbody>
	              			<?php
	              			for($index = 0; $index<$size; $index++){
								//print_r($data_arr->{'items'}[$index]);
								echo "<tr>";
								echo "<td><a href=\"item.php?itmid=".$data_arr->{'items'}[$index]->{'id'}."\">".$data_arr->{'items'}[$index]->{'name'}."</a></td>";
								echo "<td>".$data_arr->{'items'}[$index]->{'description'}."</td>";
								echo "<td>".$data_arr->{'items'}[$index]->{'product'}."</td>";			
								//echo "<td> <input type=\"checkbox\" class=\"qr-item\" name=\"selitems\" value=\"ok\"\></td>";

								echo "<td> <input type=\"checkbox\" class=\"qr-item\" name=\"selitems[]\" value=\"" . $data_arr->{'items'}[$index]->{'id'} . "\"></td>";
								
								//echo "<td> <input type=\"checkbox\" class=\"qr-item\" name=\"". $data_arr->{'items'}[$index]->{'name'}."\" value=\"" . $data_arr->{'items'}[$index]->{'id'} . "\"></td>";

								//echo "<td><a href=\"PrintQR.php?itmid=" . $data_arr->{'items'}[$index]->{'id'} . "&itmname=" . $data_arr->{'items'}[$index]->{'name'}. "\" class=\"btn btn-primary btn-sm active\" role=\"button\">Print QR Code</a></td>";
								
								//echo "<td><a href=\"#\" onclick=\"printItem(".$data_arr->{'items'}[$index]->{'id'}.",'".$data_arr->{'items'}[$index]->{'name'}."');\" class=\"btn btn-primary btn-sm active\" role=\"button\">Print QR Code</a></td>";
							
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
	          	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-10">
				      		<button type="submit" class="btn btn-primary">Add to the collection</button>
				
				    	</div>
			    </div>
	          </form>
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>