<?php include('core/init.core.php');?>
<?php
	//Get the collection id:
	$collectionId = $_GET['colid'];

	//Get the business key:
	$businessKey = $_GET['bkey'];

	//URL of the REST call:
	$url = APIURL."/collections/".$collectionId."/items";

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//REST delete call:
	$response = rest_delete($url, $headers);

	//Test the rest call:
	//print_r($response);

	//Verify if the delete code is ok then redirect:
	header("Location: collection-list-all.php");
	die();
?>