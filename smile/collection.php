<?php include('collection-scripts.php');?>
<?php

    $collection_id = $_GET['colid'];

	//URL of the REST call

	$url = APIURL."/collections/".$collection_id."/items/";

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//GET the response from the REST call:
	$response =  rest_get($url,$headers);

	//Decode the JSON object:
	$items_arr = json_decode($response);
     
   $status = '';
   
   if (isset($items_arr->{'statusCode'})) {
   		$status = $items_arr->{'statusCode'};     
       }
   
	//Get the number of items in the JSON object:
	$size = sizeof($items_arr);
	//print_r($size);
	
     
?>
<?php

	//URL of the REST call:
	$url      = APIURL."/collections/".$_GET['colid'];

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//REST response:
	$response =  rest_get($url,$headers);

	//Decode the JSON object:
	$data_arr = json_decode($response);


	//Get activities:
	$ac_url = APIURL."/activity/collections/".$_GET['colid'];
	$ac_response = rest_get($ac_url, $headers);
	$ac_data_arr = json_decode($ac_response);

?>
<?php include('header.php'); ?>

<!-- delete modal window -->

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete an item from your box.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

<!-- end of delete modal window -->

<!-- ship modal window -->

<div class="modal fade" id="select-shipment-service" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Select Shipment Service</h4>
                </div>
            
                <div class="modal-body">
                    <select id="shipment-service-type" class="form-control">
                    	<option value="default">SMiLE Default</option>
                    	<option value="fedex">FedEx</option>
                    	<option value="dhl">DHL</option>
                    	<option value="ups">UPS</option>
                    </select>

                    <br/>
                    <input type="text" class="form-control" id="tracking-number" name="tracking-number" placeholder="Enter tracking number" style="display:none;">

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-success success" onClick="submitTrackingNumber()">Submit</a>
                </div>
            </div>
        </div>
    </div>

<!-- end of ship modal window -->


<div class="container-fluid">
     	
	<div class="row">
		<?php include('dashboard-sidebar.php');?>
        
        
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header"><?php echo $data_arr->{'name'};?>&nbsp;&nbsp;
				
			</h1>
		</div>
      
	    <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2">
			<!--	<div class="thumbnail"> 
					<?php 
					echo '<img src="'.$data_arr->{'product'}->{'photos'}[0].'" alt="">';
					?> 
				</div>
			-->
			<?php include('cards/DESCRIPTION.php'); ?>
				
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<?php echo "<a href=\"#\" data-label=\"\" class=\"btn btn-success active\" role=\"button\" data-toggle=\"modal\" data-target=\"#select-shipment-service\">Ship Box</a>";?>
				</div>

		</div> 

		<div class="col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
		
				<?php include('cards/collection-items.php'); ?>
				<!--
				<?php foreach($ac_data_arr->{'activities'} as $item) { 
                $card_name = 'cards/' . $item->{'type'} . '.php'; 
				
				if (file_exists($card_name)) {
				 include $card_name;  
				 }
				?>
					 	
				<?php } ?>
				-->	
			
			</div>
		</div>
	</div><!--Container Ends here-->  

<?php include('footer.php'); ?>

<script type="text/javascript">
	
	$(document).ready(function() {
	$("#select-shipment-service").change(function(){
		var shipment = $('#select-shipment-service option:selected').text();
		if(shipment=='SMiLE Default')
			$("#tracking-number").css('display','none');
		else
			$("#tracking-number").css('display','block');
		});
	});
	/*
	*/
	function submitTrackingNumber(){
		var tracking_number = $('#tracking-number').val();
		var shipment_service_type = $('#shipment-service-type').val();
		//alert(shipment_service_type);

		$.ajax({
			type:'GET',
			dataType:'json',
			url:'collection-scripts.php?call=shipment_service_submit&tracking_number='+tracking_number+'&service='+shipment_service_type,
			success:function(response){
        		//console.log(response);
        		if(response=='Error')
        			alert('There was an Error!');
        		else
        			saveTrackingData(response);

			},
			error:function(response){
				alert(response);
			}

		});

		return false;
	}
</script>