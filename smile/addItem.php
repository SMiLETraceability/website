<?php include('core/init.core.php');

$item_name = $_GET['prod_name'];
$item_description = $_GET['item_description'];

//Declare the errors array:
$errors = array();

//Check if the form variables were submitted:
$url 	 = APIURL."/item";

//Encode data array as JSON:
//Create the headers:
$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

$dataArr = array(
	'name'=>$item_name,
	'description'=>$item_description,
	'product'=> $item_name
	);

$data 	 = json_encode($dataArr);

//Create the REST call:
$response  = rest_post($url,$data,$headers);

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