<?php include('core/init.core.php');?>
<?php

	$product_id = $_GET['prodid'];
	$userobj = getProduct($product_id);	
	$errors = '';

	//Check if the variables are set:
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//Get the tags (values) from the dynamic form:
		$tags       = get_form_data_v('tag_');
		
		$photos  = array();
		$photos[] = htmlentities($_POST['photo_url']);

		//Create the data array:
		$dataArray = array(
				'fn' 		  => htmlentities($_POST['name']),
				'description' => htmlentities($_POST['description']),
				'brand' 	  => htmlentities($_POST['brand']),
				'photos'   	  => $photos,
				'url' 		  => htmlentities($_POST['Url']),
				'price'		  => htmlentities($_POST['price']),
				'identifiers' => $identifiers,
				'properties'  => $properties,
				'categories'  => $categories,
				'tags'		  => $tags
		);

		//add the optional fields if filled by the user
		if($properties)
			$dataArray['properties'] = $properties;
		if($identifiers)
			$dataArray['identifiers'] = $identifiers;
		if($categories)
			$dataArray['categories'] = $categories;
		if($tags)
			$dataArray['tags'] = $tags;

		//API URL:
		$url 	 = APIURL."/product/".$product_id;
		
		//Encode data array as JSON:
		$data 	 = json_encode($dataArray);

		//Create the headers:
		$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);
		
		//Create the REST call:
		$response  = rest_put($url, $data, $headers);
		//print_r(strlen($response));

		$userobj = json_decode($response);
		//Testing purposes:
		print_r($userobj);

		$status = $userobj->{'statusCode'};

        //Check if the product creation was successful:
        if($status && $status!=200){
        	$errors[] = $userobj->{'errors'}[0];
            $errors[] = $userobj->{'moreInfo'};
        }

	}

?>
<?php include('header.php'); ?>

<?php

//get the item object
function getProduct($product_id){
	$url 	 = APIURL."/product/".$product_id;
	$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);
	$response= rest_get($url, $headers);
	//print_r($response);
	$userobj = json_decode($response);

	return $userobj;
}

?>

<div class="container-fluid">
      	<div class="row">

      		<?php include('dashboard-sidebar.php');?>

	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Update Product:</h1>
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
				      		<input type="text" class="form-control" id="Name" name="name" placeholder="Name" title="Please select a name." value="<?php echo isset($_POST['name'])?$_POST['name']:$userobj->{'fn'}?>" required> 
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="description" class="col-sm-2 control-label">Description:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Description" name="description" placeholder="Description" title="Please select a description." value="<?php echo isset($_POST['description'])?$_POST['description'] :$userobj->{'description'}?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="brand" class="col-sm-2 control-label">Brand:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Brand" name="brand" placeholder="Brand" title="Please select a brand." value="<?php echo isset($_POST['brand'])?$_POST['brand'] :$userobj->{'brand'}?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="photo_url" class="col-sm-2 control-label">Photo Url:</label>
				    	<div class="col-sm-6">
				      		<input type="text" class="form-control" id="photo_url" name="photo_url" placeholder="Photo Url" title="Please input a photo url." value="<?php echo isset($_POST['photo_url'])?$_POST['photo_url'] :$userobj->{'photos'}[0]?>" required>
				    	</div>
			 
		  	    	    <div class="col-sm-2">		
				    	  		<span class="btn btn-primary btn-file">  Upload Photo <input id="photo_upload" type="file" name="files[]" data-url="server/php/" multiple></span>
				    	  </div>	
				    	
				    	
				    	
				    	
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="Url" class="col-sm-2 control-label">URL:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Url" name="Url" placeholder="Url" title="Please enter a Url." value="<?php echo isset($_POST['url'])?$_POST['url'] :$userobj->{'url'}?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="price" class="col-sm-2 control-label">Price:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Price" name="price" placeholder="Price" title="Please enter a Price." value="<?php echo isset($_POST['price'])?$_POST['price'] :$userobj->{'price'}?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<h3 class="col-sm-2">Tags:</h3><button type="button" class="btn btn-primary add-tags" style="margin-top: 15px;margin-left: 5px;">Add Tags</button>
				  	<br/><br/><br/>

				  	<div class="tags">
				  	</div><!--End of .tags-->



				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-9">
				      		<button type="submit" class="btn btn-primary">Update Product</button>
				      		<button type="reset" class="btn btn-primary">Reset</button>
				    	</div>
				  	</div><!--End of .form-group-->
				
				</form><!--End of register form-->
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>