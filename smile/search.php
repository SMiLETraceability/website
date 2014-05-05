<?php include('core/init.core.php');?>
<?php
	
	//Declare the errors array:
	$errors = array();

	//Check if the form variables were submitted:
	if(isset($_POST['product'])){

		//Check if the username is empty:
		if(empty($_POST['product'])){
			$errors[] = 'The product cannot be empty.';
		}

		if(empty($errors)){
			$k = htmlentities($_POST['product']);
			$url = "";
			//$url  = "http://api.evrythng.com/search?fn=".$k;
			$headers = array("Content-Type: application/json",,"ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);
			$response = restGet($url, $headers);
			print_r($response);
			$searchObject = json_decode($response);
		}
	}
?>
<?php include('header.php'); ?>

		<div class="container">
			<form class="form-horizontal form-register" method="post" role="form">
				<h2 class="form-register-heading">Search your product:</h2>

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
			    	<label for="product" class="col-sm-2 control-label">Search Product:</label>
			    	<div class="col-sm-10">
			      		<input type="search" results=5 class="form-control" id="product" name="product" placeholder="Product" title="Enter your product name." required autofocus>
			    	</div>
			  	</div><!--End of .form-group-->
			  
			  	<div class="form-group">
			    	<div class="col-sm-offset-2 col-sm-10">
			      		<button type="submit" class="btn btn-primary">Search</button>
			    	</div>
			  	</div><!--End of .form-group-->
			</form><!--End of register form-->
			<!-- <div id="results">
				<strong>The search has returned <?php // echo $searchObject->{'thngsResultCount'};?> items.</strong></br>
				// <?php // if ($searchObject->{'thngsResultCount'}>0){
				// 	$no = $searchObject->{'thngsResultCount'};
				// 	for ($k = 0; $k<$no; $k++){
				// 		echo $searchObject->{'thngs'}[$k]->{'id'};
				// 		echo "<br/>";
				// 		echo date('Y-m-d H:i:s', $searchObject->{'thngs'}[$k]->{'createdAt'});
				// 		echo "<br/>";
				// 		echo date('Y-m-d H:i:s', $searchObject->{'thngs'}[$k]->{'updatedAt'});
				// 		echo "<br/>";
				// 		echo $searchObject->{'thngs'}[$k]->{'name'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'thngs'}[$k]->{'description'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'thngs'}[$k]->{'product'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'thngs'}[$k]->{'properties'}->{'property'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'thngs'}[$k]->{'properties'}->{'propertyb'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'thngs'}[$k]->{'properties'}->{'propertyc'};
				// 		echo "<hr/>";
				// 	}
				// } ?>
				<strong>The search has returned <?php // echo $searchObject->{'productsResultCount'};?> products.</strong></br>
				// <?php // if ($searchObject->{'productsResultCount'}>0){
				// 	$no = $searchObject->{'productsResultCount'};
				// 	for ($k = 0; $k<$no; $k++){
				// 		echo $searchObject->{'products'}[$k]->{'id'};
				// 		echo "<br/>";
				// 		echo date('Y-m-d H:i:s', $searchObject->{'products'}[$k]->{'createdAt'});
				// 		echo "<br/>";
				// 		echo date('Y-m-d H:i:s', $searchObject->{'products'}[$k]->{'updatedAt'});
				// 		echo "<br/>";
				// 		echo $searchObject->{'products'}[$k]->{'fn'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'products'}[$k]->{'description'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'products'}[$k]->{'url'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'products'}[$k]->{'identifiers'}->{'identifier'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'products'}[$k]->{'properties'}->{'property'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'products'}[$k]->{'properties'}->{'propertyb'};
				// 		echo "<br/>";
				// 		echo $searchObject->{'products'}[$k]->{'properties'}->{'propertyc'};
				// 		echo "<hr/>";
				// 	}
				// } ?>
				<strong>The search has returned <?php // echo $searchObject->{'collectionsResultCount'};?> collections.</strong></br>
				<strong>The search has returned <?php // echo $searchObject->{'placesResultCount'};?> places.</strong></br>
			</div> -->
		</div><!--End of .container-->

<?php include('footer.php'); ?>