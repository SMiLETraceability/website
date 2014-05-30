<?php include('core/init.core.php');?>
<?php
	
	$errors = array();
	
	
//Create the headers:
$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);	

	//Check if the variables are set:
	if($_SERVER['REQUEST_METHOD']=='POST'){

		//Check if the name is empty:
		if(empty($_POST['name'])){
			$errors[] = 'The name field cannot be empty.';
		}

		//Check if the description is empty:
		if(empty($_POST['description'])){
			$errors[] = 'The description field cannot be empty.';
		}

		//Check if the photos field is empty:
		if(empty($_POST['product'])){
			$errors[] = 'The product field cannot be empty.';
		}
		

		//Get the properties (key-value pairings) from the dynamic form:
		$properties = get_form_data_kv('property_label_','property_value_');

		//Get the tags (values) from the dynamic form:
		$tags       = get_form_data_v('tag_');
		
		//Create the data array:
		$dataArray = array(
				'name' 			=> htmlentities($_POST['name']),
				'description' 	=> htmlentities($_POST['description']),
				/*'location' 		=> array(
						'longitude'		=> htmlentities($_POST['longitude']),
						'latitude'		=> htmlentities($_POST['latitude'])
					),*/
				//'properties'	=> $properties,
				//'tags'			=> $tags,
				'product' 		=> htmlentities($_POST['product'])
		);
	
		//add the optional fields if filled by the user
		if($properties)
			$dataArray['properties'] = $properties;
		if($tags)
			$dataArray['tags'] = $tags;

		//API URL:
		$url 	 = APIURL."/item";
		
		//Encode data array as JSON:
		$data 	 = json_encode($dataArray);
		
	
		
		//Create the REST call:
		$response  = rest_post($url, $data, $headers);
	    
	    $userobj = json_decode($response);

		//print_r($status);

		 //Get the status of the user (active/innactive):
        $status = $userobj->{'statusCode'};

        //Check if the product creation was successful:
        if($status && $status!=200){
        	$errors[] = $userobj->{'errors'}[0];
            $errors[] = $userobj->{'moreInfo'};
        }

		//everything was successful, redirect to product view page
        if(empty($errors)){
        	$item_id = $userobj->{'id'};
        	header("Location: item.php?itmid=$item_id");
            die();  
        }

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
<?php include('header.php'); ?>
<div class="container-fluid">
      	<div class="row">

      		<?php include('dashboard-sidebar.php');?>

	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Add Item:</h1>
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
				      		<input type="text" class="form-control" id="Name" name="name" placeholder="Name" title="Please select an name." value="<?php echo isset($_POST['name'])?$_POST['name'] :''?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="description" class="col-sm-2 control-label">Description:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Description" name="description" placeholder="Description" title="Please select a description." value="<?php echo isset($_POST['description'])?$_POST['description'] :''?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

<!--
				  	<h3 class="col-sm-2">Properties:</h3><button type="button" class="btn btn-primary add-properties" style="margin-top: 15px;margin-left: 5px;">Add Properties</button>
				  	<br/><br/><br/>

				  	<div class="properties">
				  	</div>

				  	<h3 class="col-sm-2">Tags:</h3><button type="button" class="btn btn-primary add-tags" style="margin-top: 15px;margin-left: 5px;">Add Tags</button>
				  	<br/><br/><br/>

				  	<div class="tags">
				  	</div>
				  	-->

				  	<div class="form-group">
				    	<label for="product" class="col-sm-2 control-label">Product:</label>
				    	<div class="col-sm-9">
				    	 <select class="selectpicker" class="form-control" id="product" name="product" placeholder="Product" title="Please enter a product." reuired>
				    	    <?php for($index = 0, $k=1; $index<$psize; $index++, $k++){ ?>
				    	    <option><?php echo $pdata_arr->{'products'}[$index]->{'fn'} ?></option>
				    	    <?php } ?>
				    	 </select>
				    	
				      		<!--
				      		<input type="text" class="form-control" id="product" name="product" placeholder="Product" title="Please enter a product." value="<?php echo isset($_POST['product'])?$_POST['product'] :''?>" required>
				      		-->
				    	</div>
				  	</div><!--End of .form-group-->

				  	<!--div class="form-group">
				    	<label for="longitude" class="col-sm-2 control-label">Longitude:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="longitude" name="longitude" value=" " placeholder="Longitude">
				    	</div>
				  	</div><!--End of .form-group-->

				  	<!--iv class="form-group">
				    	<label for="latitude" class="col-sm-2 control-label">Latitude:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="latitude" name="latitude" value=" " placeholder="Latitude">
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-9">
				      		<button type="submit" class="btn btn-primary">Add Item</button>
				      		<button type="reset" class="btn btn-primary">Reset</button>
				    	</div>
				  	</div><!--End of .form-group-->
				
				</form><!--End of register form-->
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>