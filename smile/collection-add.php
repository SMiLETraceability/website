<?php include('core/init.core.php');?>
<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Get the properties (key-value pairings) from the dynamic form:
		$properties = get_form_data_kv('property_label_','property_value_');

		//Get the tags (values) from the dynamic form:
		$tags       = get_form_data_v('tag_');

		//Create the data array:
		$dataArray = array(
				'name' 		  => htmlentities($_POST['Name']),
				'description' => htmlentities($_POST['Description']),
				'properties'  => $properties,
				'tags' 		  => $tags
		);

		//API Url:
		$url = APIURL."/collections";

		//Encode the JSON array:
		$data = json_encode($dataArray);

		//Create the headers:
		$headers = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

		//Create the REST call:
		$status = rest_post($url, $data, $headers);
		
		//For testing purposes:
		//print_r($status);
	}
?>
<?php include('header.php'); ?>
	<div class="container-fluid">
      	<div class="row">
      		<?php include('dashboard-sidebar.php'); ?>
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Add Collection</h1>
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

				  	<h3 class="col-sm-2">Properties:</h3><button type="button" class="btn btn-primary add-properties" style="margin-top: 15px;margin-left: 5px;">Add Properties</button>
				  	<br/><br/><br/>

				  	<div class="properties">
				  	</div><!--End of .properties-->

				  	<h3 class="col-sm-2">Tags:</h3><button type="button" class="btn btn-primary add-tags" style="margin-top: 15px;margin-left: 5px;">Add Tags</button>
				  	<br/><br/><br/>

				  	<div class="tags">
				  	</div><!--End of .tags-->

				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-10">
				      		<button type="submit" class="btn btn-primary">Add Collection</button>
				      		<button type="reset" class="btn btn-primary">Reset</button>
				    	</div>
				  	</div><!--End of .form-group-->
				</form><!--End of register form-->
	          	
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>