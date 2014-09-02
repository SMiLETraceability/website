<?php include('core/init.core.php');?>

<?php

	$collection_id = $_GET['colid'];
	$userobj = getCollection($collection_id);	

	//Check if the variables are set:
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Create the data array:
		$dataArray = array(
				'name' 			=> htmlentities($_POST['Name']),
				'description' 	=> htmlentities($_POST['Description']),				
		);
		
        

		//API URL:
		$url 	 = APIURL."/collections/".$collection_id;
		
		//Encode data array as JSON:
		$data 	 = json_encode($dataArray);

		//Create the headers:
		$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);
		
		//Create the REST call:
		$response  = rest_put($url, $data, $headers);
		//print_r(strlen($response));

		$userobjj = json_decode($response);
		//Testing purposes:
		//print_r($userobj);

		$status = $userobjj->{'statusCode'};

        //Check if the product creation was successful:
        if($status && $status!=200){
        	$errors[] = $userobjj->{'errors'}[0];
            $errors[] = $userobjj->{'moreInfo'};
        }

        if(empty($errors)){
        	header("Location: collection-list-all.php");
            die();  
        }

	}

?>

<?php

function getCollection($collection_id){
	$url 	 = APIURL."/collections/".$collection_id;
	$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);
	$response= rest_get($url, $headers);

	$userobj = json_decode($response);

	return $userobj;
}

?>



<?php include('header.php'); ?>
	<div class="container-fluid">
      	<div class="row">
      		<?php include('dashboard-sidebar.php'); ?>
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Update box</h1>
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
				      		<input type="text" class="form-control" id="Name" name="Name" placeholder="Name" title="Please select an name." value="<?php echo isset($_POST['name'])?$_POST['name']:$userobj->{'name'}?>" required>  
				    	</div>
				  	</div><!--End of .form-group-->
				  
				  	<div class="form-group">
				    	<label for="description" class="col-sm-2 control-label">Description:</label>
				    	<div class="col-sm-9">
				      		<input type="text" class="form-control" id="Description" name="Description" placeholder="Description" title="Please select a description." value="<?php echo isset($_POST['description'])?$_POST['description'] :$userobj->{'description'}?>" required>
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
				    	<div class="col-sm-offset-2 col-sm-10">
				      		<button type="submit" class="btn btn-primary">Update</button>
				      		<button type="reset" class="btn btn-primary">Reset</button>
				    	</div>
				  	</div><!--End of .form-group-->
				</form><!--End of register form-->
	          	
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>