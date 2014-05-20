<?php include('core/init.core.php');?>
<?php
	
	//Declare the errors array:
	$errors = array();

	if($_SERVER['REQUEST_METHOD']=='POST'){

		//Check if the email is empty:
		if(empty($_POST['email'])){
			$errors[] = 'The email cannot be empty.';
		}

		//Check if the first name is empty:
		if(empty($_POST['fname'])){
			$errors[] = 'The first name cannot be empty.';
		}

		//Check if the last name is empty:
		if(empty($_POST['lname'])){
			$errors[] = 'The last name cannot be empty.';
		}

		//Check if the password or re-password:
		if(empty($_POST['password']) || empty($_POST['repassword'])){
			$errors[] = 'The password cannot be empty.';
		}

		//Check if the passwords are matching:
		if($_POST['password'] !== $_POST['repassword']){
			$errors[] = 'Password verification failed.';
		}

		//Check if the gender is empty:
		if(empty($_POST['gender'])){
			$errors[] = 'Please select your gender.';
		}

		//Check if the timezone is empty:
		if(empty($_POST['timezone'])){
			$errors[] = 'Please select your timezone';
		}

		//Check if the locale is empty:
		if(empty($_POST['locale'])){
			$errors[] = 'Please select your locale.';
		}

		//Check if the birthday is empty:
		if(empty($_POST['birthday'])){
			$errors[] = 'Please select your birthday.';
		}

		if(empty($errors)){

			//Explode the birthday input into a dateOfBirth array:
			$dateOfBirth = explode('-', $_POST['birthday']);

			//Create the data array:
			$dataArray = array('email'			=> htmlentities($_POST['email']),
						  	   'firstName'		=> htmlentities($_POST['fname']),
						       'lastName'		=> htmlentities($_POST['lname']),
						       'password'		=> htmlentities($_POST['password']),
						       'birthday'		=> array(
						       						'day' 	=> htmlentities($dateOfBirth[2]),
						       						'month' => htmlentities($dateOfBirth[1]),
						       						'year'  => htmlentities($dateOfBirth[0])
						       						),
						       'gender'			=> htmlentities($_POST['gender']),
						       'timeZone'		=> htmlentities($_POST['timezone']),
						       'locale'			=> htmlentities($_POST['locale']),
						       'userRole'		=> "ADMIN",
						       'address' 	  	=> array(
													'number'   => htmlentities($_POST['number']),
													'street'   => htmlentities($_POST['street']),
													'postcode' => htmlentities($_POST['postcode']),
													'county'   => htmlentities($_POST['county']),
													'country'  => htmlentities($_POST['country'])
												)
						  );

			//Encode the data array as a json object:
			$data = json_encode($dataArray);

			//The url of the rest call:
			$url  = APIURL."/users";

			//The header of the rest call:
			$headers = array('Content-Type: application/json','ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a',"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'], "Authorization: ".$_SESSION['account']['apiKey']);

			//Get the status of the rest call:
			$response = rest_post($url, $data, $headers);

			//Testing:
			print_r($response);

			//Decode JSON respones:
			$data_arr = json_decode($response);

			if(isset($data_arr->{'email'})){
				header('Location: dashboard.php');
				die();
			}else{
				$errors[] = 'The user cannot be registered or the e-mail might already exist in the database.';
			}
		}
	}
?>
<?php include('header.php'); ?>

		<div class="container">
			<form class="form-horizontal form-register" method="post" role="form">
				<h2 class="form-register-heading">Please register your account:</h2>

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
			    	<label for="email" class="col-sm-2 control-label">E-mail:</label>
			    	<div class="col-sm-10">
			      		<input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address" required>
			    	</div>
			  	</div><!--End of .form-group-->

				<div class="form-group">
			    	<label for="fname" class="col-sm-2 control-label">First Name:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" title="Enter your given name." required autofocus>
			    	</div>
			  	</div><!--End of .form-group-->
			  	
			  	<div class="form-group">
			    	<label for="lname" class="col-sm-2 control-label">Last Name:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" title="Enter your family name." required>
			    	</div>
			  	</div><!--End of .form-group-->
			  
			  	<div class="form-group">
			    	<label for="password" class="col-sm-2 control-label">Password:</label>
			    	<div class="col-sm-10">
			      		<input type="password" class="form-control" id="password" name="password" placeholder="Password" title="Please select a password." required>
			    	</div>
			  	</div><!--End of .form-group-->
			  
			  	<div class="form-group">
			    	<label for="repassword" class="col-sm-2 control-label">Re-type Password:</label>
			    	<div class="col-sm-10">
			      		<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Retype Password" title="Please repeat your password." required>
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			    	<label for="birthday" class="col-sm-2 control-label">Birthday:</label>
			    	<div class="col-sm-10">
			      		<input type="date" class="form-control" id="birthday" name="birthday" title="Please enter your birthday." required>
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			  		<label for="gender" class="col-sm-2 control-label">Gender:</label>
			    	<div class="col-sm-10">
			      		<select class="form-control" name="gender">
			      			<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="other">Other</option>
						</select>
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			  		<label for="timezone" class="col-sm-2 control-label">Timezone:</label>
			    	<div class="col-sm-10">
			      		<select class="form-control" name="timezone">
			      			<option value="United Kingdom">United Kingdom</option>
						</select>
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			  		<label for="locale" class="col-sm-2 control-label">Locale:</label>
			    	<div class="col-sm-10">
			      		<select class="form-control" name="locale">
			      			<option value="United Kingdom">en-GB</option>
						</select>
			    	</div>
			  	</div><!--End of .form-group-->

			  	<div class="form-group">
			    	<label for="number" class="col-sm-2 control-label">Street Number:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="number" name="number" placeholder="Street Number" title="Please enter your street number.">
			    	</div>
			  	</div><!--End of .formg-group-->

			  	<div class="form-group">
			    	<label for="street" class="col-sm-2 control-label">Street Name:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="street" name="street" placeholder="Street" title="Please enter your street name.">
			    	</div>
			  	</div><!--End of .formg-group-->

			  	<div class="form-group">
			    	<label for="postcode" class="col-sm-2 control-label">Postcode:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" title="Please enter your postcode.">
			    	</div>
			  	</div><!--End of .formg-group-->

			  	<div class="form-group">
			    	<label for="county" class="col-sm-2 control-label">County:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="county" name="county" placeholder="County" title="Please enter your county name.">
			    	</div>
			  	</div><!--End of .formg-group-->

			  	<div class="form-group">
			    	<label for="country" class="col-sm-2 control-label">Country:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="country" name="country" placeholder="Country" title="Please enter your country name.">
			    	</div>
			  	</div><!--End of .formg-group-->
			  
			  	<div class="form-group">
			    	<div class="col-sm-offset-2 col-sm-10">
			      		<button type="submit" class="btn btn-primary">Register</button>
			      		<button type="reset" class="btn btn-primary">Reset</button>
			    	</div>
			  	</div><!--End of .form-group-->
			</form><!--End of register form-->
		</div><!--End of .container-->

<?php include('footer.php'); ?>