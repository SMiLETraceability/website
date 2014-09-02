<?php include('core/init.core.php');?>
<?php
	//Declare the errors array:
	$errors = array();

	$url = APIURL."/business/".$_SESSION['account']['currentBusinessKey'];
	$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'], "Authorization: ".$_SESSION['account']['apiKey']);
	
	//Get the status code of the rest call:
	$response = rest_get($url, $headers);

	//Decode JSON respones:
	$data_arr = json_decode($response);

	//var_dump($data_arr->{'id'});
	//exit();

	if($_SERVER['REQUEST_METHOD']=='POST'){

		//Check if the email is empty:
		if(empty($_POST['email'])){
			$errors[] = 'The email field cannot be empty.';
		}

		//Check if the business name is empty:
		if(empty($_POST['bname'])){
			$errors[] = 'The business name field cannot be empty.';
		}

		//Check if the description is empty:
		if(empty($_POST['description'])){
			$errors[] = 'The description field cannot be empty.';
		}

		//Check if the photos field is empty:
		/*if(empty($_POST['photo_url'])){
			$errors[] = 'The photo_url field cannot be empty.';
		}*/

		//Check if the password or re-password are empty:
		/*if(empty($_POST['password']) || empty($_POST['repassword'])){
			$errors[] = 'The password field cannot be empty.';
		}

		//Check if the passwords are matching:
		if($_POST['password'] !== $_POST['repassword']){
			$errors[] = 'Password verification failed.';
		}*/

		if(empty($errors)){

			//Create a photos array:
			$photos  = array();
			//Add the field value to the photos array:
			$photos[] = htmlentities($_POST['photo_url']);

			//Initialize business parent id:
			$bpid = null;

			//Initialize authorization:
			$auth = null;

			if(isset($_GET['bpid'])){
				$bpid = $_GET['bpid'];
			}

			//If there is a current business set then use that key otherwise, use the parent business key:
			if(isset($_SESSION['account']['currentBusinessKey'])){
				$auth = $_SESSION['account']['currentBusinessKey'];
			}

			//Create the data array:
			$data_array = array(
					//'name' 		  => htmlentities($_POST['bname']),
					'description' => htmlentities($_POST['description']),
					'telephone'   => htmlentities($_POST['telephone']),
					'photos'      => $photos,
					'address' 	  => array(
							'number'   => htmlentities($_POST['number']),
							'street'   => htmlentities($_POST['street']),
							'postcode' => htmlentities($_POST['postcode']),
							'county'   => htmlentities($_POST['county']),
							'country'  => htmlentities($_POST['country'])
						)
					//'email' 		   => htmlentities($_POST['email']),
					//'password' 		   => htmlentities($_POST['password']),
					//'parentBusinessId' => $bpid
				);

			//Encode the data array as a json object:
			$data = json_encode($data_array);

			//print_r($data_array);
			//URL of the REST call:
			$url  = APIURL."/business/".$data_arr->{'id'};

			// //The header of the rest call:
			if($auth === null){
				$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY);
			}else{
				$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$auth, "Authorization: ".$_SESSION['account']['apiKey']);
			}

			//print_r($headers);

			//Get the status code of the rest call:
			$response = rest_put($url, $data, $headers);


			//var_dump($response);
			//exit(); //202

			//Decode JSON respones:
			$data_arr = json_decode($response);
			
			$status = $data_arr->{'statusCode'};
	        //Check if the business registration was successful:
	        if($status && $status!=202){
	        	//$errors[] = $data_arr->{'errors'}[0];
	            $errors[] = $data_arr->{'moreInfo'};
	        }
		}	
	}
?>
<?php include('header.php');?>
		<div class="container">
			<form class="form-horizontal form-register" method="post" role="form">
				
				<p> <span style="color:Red;">*</span> fields are required.</p> 

                <?php  if(count($errors)==0 && $_SERVER['REQUEST_METHOD'] == 'POST') echo'<div class="alert alert-success" role="alert">Profile updated successfully.</div>';?>

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
			    	<label for="bname" class="col-sm-2 control-label">Business Name <span style="color:Red;">*</span>:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="bname" name="bname" placeholder="Business Name" title="Business name." value="<?php echo isset($data_arr->{'name'})?$data_arr->{'name'}:(isset($_POST['bname'])?$_POST['bname']:'')?>" required readonly autofocus />
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			    	<label for="description" class="col-sm-2 control-label">Business Description <span style="color:Red;">*</span>:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="description" name="description" placeholder="Business Description" title="Business description." value="<?php echo isset($data_arr->{'description'})?$data_arr->{'description'}:(isset($_POST['description'])?$_POST['description']:'')?>" required autofocus />
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			    	<label for="telephone" class="col-sm-2 control-label">Telephone Number <span style="color:Red;">*</span>:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone Number" title="Telephone number." value="<?php echo isset($data_arr->{'telephone'})?$data_arr->{'telephone'}:(isset($_POST['telephone'])?$_POST['telephone']:'')?>" required autofocus />
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			    	<label for="email" class="col-sm-2 control-label">E-mail <span style="color:Red;">*</span>:</label>
			    	<div class="col-sm-10">
			      		<input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address" required value="<?php echo isset($data_arr->{'email'})?$data_arr->{'email'}:(isset($_POST['email'])?$_POST['email']:'')?>" readonly />
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			    	<label for="photos" class="col-sm-2 control-label">Photo URL:</label>
			    	<div class="col-sm-8">
			      		<input type="photos" class="form-control" id="photo_url" name="photo_url" placeholder="Photo Url" value="<?php echo isset($data_arr->{'photos'}[0])?$data_arr->{'photos'}[0]:(isset($_POST['photo_url'])?$_POST['photo_url']:'')?>" />
			    	</div>

			    	<div class="col-sm-2">		
			    		<span class="btn btn-primary btn-file">  Upload Photo <input id="photo_upload" type="file" name="files[]" data-url="http://smile.abdn.ac.uk/smile/server/php/" multiple></span>
			    	</div>	

			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			    	<label for="number" class="col-sm-2 control-label">House Number:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="number" name="number" placeholder="Street Number" title="House number." value="<?php echo isset($data_arr->{'address'}->{'number'})?$data_arr->{'address'}->{'number'}:(isset($_POST['number'])?$_POST['number']:'')?>" />
			    	</div>
			  	</div><!--End of .formg-group-->

			  	<div class="form-group">
			    	<label for="street" class="col-sm-2 control-label">Street Name:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="street" name="street" placeholder="Street" title="Street name." value="<?php echo isset($data_arr->{'address'}->{'street'})?$data_arr->{'address'}->{'street'}:(isset($_POST['street'])?$_POST['street']:'')?>" />
			    	</div>
			  	</div><!--End of .formg-group-->

			  	<div class="form-group">
			    	<label for="postcode" class="col-sm-2 control-label">Postcode:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" title="Postcode." value="<?php echo isset($data_arr->{'address'}->{'postcode'})?$data_arr->{'address'}->{'postcode'}:(isset($_POST['postcode'])?$_POST['postcode']:'')?>" />
			    	</div>
			  	</div><!--End of .formg-group-->

			  	<div class="form-group">
			    	<label for="county" class="col-sm-2 control-label">County:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="county" name="county" placeholder="County" title="County." value="<?php echo isset($data_arr->{'address'}->{'county'})?$data_arr->{'address'}->{'county'}:(isset($_POST['county'])?$_POST['county']:'')?>" />
			    	</div>
			  	</div><!--End of .formg-group-->

			  	<div class="form-group">
			    	<label for="country" class="col-sm-2 control-label">Country:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="country" name="country" placeholder="Country" title="Country." value="<?php echo isset($data_arr->{'address'}->{'country'})?$data_arr->{'address'}->{'country'}:(isset($_POST['country'])?$_POST['country']:'')?>" />
			    	</div>
			  	</div><!--End of .formg-group-->

			  
			  	<div class="form-group">
			    	<div class="col-sm-offset-2 col-sm-10">
			      		<button type="submit" class="btn btn-primary">Update Profile</button>
			      		<button type="" class="btn btn-primary">Cancel</button>
			    	</div>
			  	</div><!--End of .form-group-->
			</form><!--End of register form-->
		</div><!--End of .container-->
<?php include('footer.php');?>