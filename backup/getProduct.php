<?php include('core/init.core.php');

$prodid = $_GET['prodid'];

	//Declare the errors array:
$errors = array();

	//Check if the form variables were submitted:
$url 	 = APIURL."/product/".$prodid;

		//Encode data array as JSON:
		//Create the headers:
$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

		//Create the REST call:
$response  = rest_get($url, $headers);

$userobj = json_decode($response);

if($status && $status!=200){
	$errors[] = $userobj->{'errors'}[0];
	$errors[] = $userobj->{'moreInfo'};
}

if(empty($errors))
	echo $response;
else
	echo $errors;
?>