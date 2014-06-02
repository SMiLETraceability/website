
<?php include('core/init.core.php');?>
<?php
	//Get the item id:
	$activityId = $_GET['actid'];


	//URL of the REST call:
	$url = APIURL."/activity/".$activityId;

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//REST delete call:
	$response = rest_delete($url, $headers);

	//Test the rest call:
	print_r($response);

	header("Location: product.php");
	die();
?>