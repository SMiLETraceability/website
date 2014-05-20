<?php include('core/init.core.php');?>
<?php
	
	$errors = array();
	
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
		if(empty($_POST['photo_url'])){
			$errors[] = 'The photo field cannot be empty.';
		}
		
		//Check if the URL field is empty:
		if(empty($_POST['Url'])){
			$errors[] = 'The Url field cannot be empty.';
		}

		//Check if the Price field is empty:
		if(empty($_POST['price'])){
			$errors[] = 'The Price field cannot be empty.';
		}

		if(empty($errors)){
			//Get the properties (key-value pairings) from the dynamic form:
			$properties = get_form_data_kv('property_label_','property_value_');
			//Get the identifiers (key-value pairings) from the dynamic form:
			$identifiers = get_form_data_kv('identifier_label_','identifier_value_');

			//Get the categories (values) from the dynamic form:
			$categories = get_form_data_v('category_');

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
					'price'		  => htmlentities($_POST['price'])
					//'identifiers' => $identifiers,
					//'properties'  => $properties
					//'categories'  => $categories,
					//'tags'		  => $tags
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

			//API Url:
			$url = APIURL."/product";

			//Encode the JSON array:
			$data = json_encode($dataArray);

			//Create the headers:
			$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

			//Create the rest call:
			$response = rest_post($url, $data, $headers);
			//print_r($response);

			//Get the user object:
	        $userobj = json_decode($response);
	        
	        //print_r($userobj);
	        //Get the status of the user (active/innactive):
	        $status = $userobj->{'statusCode'};

	        //Check if the product creation was successful:
	        if($status && $status!=200){
	        	$errors[] = $userobj->{'errors'}[0];
	            $errors[] = $userobj->{'moreInfo'};
	        }

			//everything was successful, redirect to product view page
	        if(empty($errors)){
	        	$product_id = $userobj->{'id'};
	        	header("Location: product.php?prodid=$product_id");
                die();  
	        }


		}
		else{
				$errors[] = "This action could not be completed.";
		}
	}
?>
<?php include('header.php'); ?>
<div class="container-fluid">
      	<div class="row">
        	<?php include('dashboard-sidebar.php');?>
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Add Product</h1>
	          	<form class="form-horizontal form-register" method="post" role="form">

					<div class="form-group">
						<?php if($errors){ ?>
							<ul class="feedback-error">
								<?php foreach ($errors as $error) {
									echo "<li><p><span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>&nbsp;&nbsp;{$error}</p></li>";
								} ?>
							</ul>
						<?php } ?>
					</div>
	          		
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

				  	<div class="form-group">
				    	<label for="Brand" class="col-sm-2 control-label">Brand:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Brand" name="brand" placeholder="Brand" title="Please select a brand." value="<?php echo isset($_POST['brand'])?$_POST['brand'] :''?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="photo_url" class="col-sm-2 control-label">Photo Url:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="photo_url" name="photo_url" placeholder="Photo Url" title="Please input a photo url." value="<?php echo isset($_POST['photo_url'])?$_POST['photo_url'] :''?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="Url" class="col-sm-2 control-label">Url:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Url" name="Url" placeholder="Url" title="Please select a url." value="<?php echo isset($_POST['Url'])?$_POST['Url'] :''?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="price" class="col-sm-2 control-label">Price:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="price" name="price" placeholder="Price" title="Please select a price." value="<?php echo isset($_POST['price'])?$_POST['price'] :''?>" required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<h3 class="col-sm-2">Identifiers:</h3><button type="button" class="btn btn-primary add-identifiers" style="margin-top: 15px;margin-left: 5px;">Add Identifiers</button>
				  	<br/><br/><br/>

				  	<div class="identifiers">
				  	</div><!--End of .identifiers-->

				  	<h3 class="col-sm-2">Properties:</h3><button type="button" class="btn btn-primary add-properties" style="margin-top: 15px;margin-left: 5px;">Add Properties</button>
				  	<br/><br/><br/>

				  	<div class="properties">
				  	</div><!--End of .properties-->

				  	<h3 class="col-sm-2">Categories:</h3><button type="button" class="btn btn-primary add-categories" style="margin-top: 15px;margin-left: 5px;">Add Categories</button>
				  	<br/><br/><br/>

				  	<div class="categories">
				  	</div><!--End of .categories-->

				  	<h3 class="col-sm-2">Tags:</h3><button type="button" class="btn btn-primary add-tags" style="margin-top: 15px;margin-left: 5px;">Add Tags</button>
				  	<br/><br/><br/>

				  	<div class="tags">
				  	</div><!--End of .tags-->

				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-10">
				      		<button type="submit" class="btn btn-primary">Add Product</button>
				      		<button type="reset" class="btn btn-primary">Reset</button>
				    	</div>
				  	</div><!--End of .form-group-->
				</form><!--End of register form-->

				<div id="results">
				</div>

	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>