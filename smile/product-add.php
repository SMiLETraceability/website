<?php include('core/init.core.php');?>
<?php
	
	if($_SERVER['REQUEST_METHOD']=='POST'){

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
				'fn' 		  => htmlentities($_POST['Name']),
				'description' => htmlentities($_POST['Description']),
				'brand' 	  => htmlentities($_POST['Brand']),
				'photos'   	  => $photos,
				'url' 		  => htmlentities($_POST['Url']),
				'price'		  => htmlentities($_POST['price']),
				'identifiers' => $identifiers,
				'properties'  => $properties,
				'categories'  => $categories,
				'tags'		  => $tags
		);

		//API Url:
		$url = APIURL."/product";

		//Encode the JSON array:
		$data = json_encode($dataArray);
		
		//Create the headers:
		$headers = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

		//Create the rest call:
		$status = rest_post($url, $data, $headers);
		print_r($status);
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
						<?php if(empty($errors)===false){ ?>
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
				      		<input type="text" class="form-control" id="Name" name="Name" placeholder="Name" title="Please select an name." required>
				    	</div>
				  	</div><!--End of .form-group-->
				  
				  	<div class="form-group">
				    	<label for="description" class="col-sm-2 control-label">Description:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Description" name="Description" placeholder="Description" title="Please select a description." required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="Brand" class="col-sm-2 control-label">Brand:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Brand" name="Brand" placeholder="Brand" title="Please select a brand." required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="photo_url" class="col-sm-2 control-label">Photo Url:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="photo_url" name="photo_url" placeholder="Photo Url" title="Please input a photo url." required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="Url" class="col-sm-2 control-label">Url:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Url" name="Url" placeholder="Url" title="Please select a url." required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="price" class="col-sm-2 control-label">Price:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="price" name="price" placeholder="Price" title="Please select a price." required>
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