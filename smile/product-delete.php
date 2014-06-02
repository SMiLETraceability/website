<?php include('core/init.core.php');?>
<?php
	//Get the item id:
	$productId = $_GET['prodid'];

	//URL of the REST call:
	$url = APIURL."/product/".$productId;

	//Headers of the REST call (make sure you add the other api keys):
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//REST delete call:
	$response = rest_delete($url, $headers);

	//Test the rest call:
	print_r($response);

	//Verify if the delete code is ok then redirect:
	header("Location: product-list-all.php");
	die();
	
?>