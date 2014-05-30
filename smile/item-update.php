<?php include('core/init.core.php');?>
<?php

	$errors = array();

	$item_id = $_GET['itmid'];
	$userobj = getItem($item_id);	


//Create the headers:
$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);


	//Check if the variables are set:
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//Get the tags (values) from the dynamic form:
		$tags       = get_form_data_v('tag_');
		
		//Create the data array:
		$dataArray = array(
				'name' 			=> htmlentities($_POST['name']),
				'description' 	=> htmlentities($_POST['description']),
				'product' 		=> htmlentities($_POST['product'])
				//'tags'			=> $tags
		);
		
		if($tags)
			$dataArray['tags'] = $tags;

		//API URL:
		$url 	 = APIURL."/item/".$item_id;
		
		//Encode data array as JSON:
		$data 	 = json_encode($dataArray);

	
		//Create the REST call:
		$response  = rest_put($url, $data, $headers);
		//print_r(strlen($response));

		$userobj = json_decode($response);
		//Testing purposes:
		//print_r($userobj);
	

		if (isset($userobj->{'statusCode'})) {
			$status = $userobj->{'statusCode'};
	
	        //Check if the product creation was successful:
	        if($status && $status!=200){
	        	$errors[] = $userobj->{'errors'}[0];
	            $errors[] = $userobj->{'moreInfo'};
	        }
        }
        
        header("Location: item.php?itmid=$item_id");

	}

?>
<?php include('header.php'); ?>

<?php

//get the item object
function getItem($item_id){
	$url 	 = APIURL."/item/".$item_id;
	$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);
	$response= rest_get($url, $headers);
	//print_r($response);
	$userobj = json_decode($response);

	return $userobj;
}



//URL of the REST Call:
$purl      = APIURL."/product";

$presponse =  rest_get($purl,$headers);

	//Decode the JSON object:
$pdata_arr = json_decode($presponse);

//print_r($pdata_arr);

 	//Number of products in the JSON object:
$psize = sizeof($pdata_arr->{'products'});



?>

<div class="container-fluid" onload="getLocation()">
      	<div class="row">

      		<?php include('dashboard-sidebar.php');?>

	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Update Item:</h1>
	          	<form class="form-horizontal form-item-add" method="post" role="form">

					<div class="form-group">
						<?php if($errors){ ?>
							<ul class="feedback-error">
								<?php foreach ($errors as $error) {
									echo "<li><p><span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>&nbsp;&nbsp;{$error}</p></li>";
								} ?>
							</ul>
						<?php } ?>
					</div><!--End of .form-group-->
	          		
	          		<div class="form-group">
				    	<label for="name" class="col-sm-2 control-label">Name:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Name" name="name" placeholder="Name" title="Please select an name." value="<?php echo isset($_POST['name'])?$_POST['name']:$userobj->{'name'}?>" required> 
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="description" class="col-sm-2 control-label">Description:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Description" name="description" placeholder="Description" title="Please select a description." value="<?php echo isset($_POST['description'])?$_POST['description'] :$userobj->{'description'}?>" required>
				    	</div>
				  	</div><!--End of .form-group-->


<!--
				  	<h3 class="col-sm-2">Tags:</h3><button type="button" class="btn btn-primary add-tags" style="margin-top: 15px;margin-left: 5px;">Add Tags</button>
				  	<br/><br/><br/>

				  	<div class="tags">
				  	</div>
-->


				  	<div class="form-group">
				    	<label for="product" class="col-sm-2 control-label">Product:</label>
				    	<div class="col-sm-9">
				    	<select class="selectpicker" class="form-control" id="product" name="product" placeholder="Product" title="Please enter a product." reuired>
				    	   <?php for($index = 0, $k=1; $index<$psize; $index++, $k++){
				    	   
				    	   $product_name = $pdata_arr->{'products'}[$index]->{'fn'};
				    	   $product_old_name = isset($_POST['product'])?$_POST['product'] :$userobj->{'product'}->{'fn'};
				    	
				    	   if ($product_name == $product_old_name) {
				    	    ?>
				    	   <option selected><?php echo $pdata_arr->{'products'}[$index]->{'fn'} ?></option>
				    	   
				    	   <?php 
				    	   } else {
				    	   ?>
				    	   			 <option><?php echo $pdata_arr->{'products'}[$index]->{'fn'} ?></option>
				    	   <?php
				    	   		   }
				    	   
				    	   }
				    	   ?>
				    	</select>
				    	<!--
				      		<input type="text" class="form-control" id="product" name="product" placeholder="Product" title="Please enter a product." value="<?php echo isset($_POST['product'])?$_POST['product'] :$userobj->{'product'}->{'fn'}?>" required>
				      		-->
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-9">
				      		<button type="submit" class="btn btn-primary">Update Item</button>
				      		<button type="reset" class="btn btn-primary">Reset</button>
				    	</div>
				  	</div><!--End of .form-group-->
				
				</form><!--End of register form-->
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>