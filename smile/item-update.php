<?php include('core/init.core.php');?>
<?php

	//Check if the variables are set:
	if($_SERVER['REQUEST_METHOD']=='POST'){

		//Get the tags (values) from the dynamic form:
		$tags       = get_form_data_v('tag_');
		
		//Create the data array:
		$dataArray = array(
				'name' 			=> htmlentities($_POST['name']),
				'description' 	=> htmlentities($_POST['description']),
				'product' 		=> htmlentities($_POST['product']),
				'tags'			=> $tags
		);
		
		//API URL:
		$url 	 = APIURL."/item/".$_GET['itmid'];
		
		//Encode data array as JSON:
		$data 	 = json_encode($dataArray);
		
		//Create the headers:
		$headers = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);
		
		//Create the REST call:
		$status  = rest_put($url, $data, $headers);

		//Testing purposes:
		print_r($status);

		//If status is correct then redirect to item page:
	}
?>
<?php include('header.php'); ?>
<div class="container-fluid" onload="getLocation()">
      	<div class="row">

      		<?php include('dashboard-sidebar.php');?>

	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Update Item:</h1>
	          	<form class="form-horizontal form-item-add" method="post" role="form">

					<div class="form-group">
						<?php if(empty($errors)===false){ ?>
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
				      		<input type="text" class="form-control" id="Name" name="name" placeholder="Name" title="Please select an name." required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<div class="form-group">
				    	<label for="description" class="col-sm-2 control-label">Description:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Description" name="description" placeholder="Description" title="Please select a description." required>
				    	</div>
				  	</div><!--End of .form-group-->

				  	<h3 class="col-sm-2">Tags:</h3><button type="button" class="btn btn-primary add-tags" style="margin-top: 15px;margin-left: 5px;">Add Tags</button>
				  	<br/><br/><br/>

				  	<div class="tags">
				  	</div><!--End of .tags-->

				  	<div class="form-group">
				    	<label for="product" class="col-sm-2 control-label">Product:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="product" name="product" placeholder="Product" title="Please enter a product." required>
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