<?php include('core/init.core.php');

$prod_id = $_GET['prodid'];
$activity_type = $_GET['type'];

if(isset($_GET['p_description']))
	$p_description = $_GET['p_description'];
if(isset($_GET['p_video']))
	$p_video = $_GET['p_video'];
if(isset($_GET['r_description']))
	$r_description = $_GET['r_description'];
if(isset($_GET['r_image']))
	$r_image = $_GET['r_image'];

//create data array according to activity type
switch ($activity_type) {
	case 'PRODUCTION':
	$dataArr = array(
		'type'=>$activity_type,
		'entity'=>'product',
		'recordId'=>$prod_id,
		'context'=> array(
			'description'=> $p_description, 
			'video' => $p_video 
			)
		);
	break;
	case 'RECIPE':
		$dataArr = array(
		'type'=>$activity_type,
		'entity'=>'product',
		'recordId'=>$prod_id,
		'context'=> array(
			'description'=> $r_description, 
			'image' => $r_image 
			)
		);
	break;
	case 'INGREDIENT':
			# code...
	break;
	default:
		# code...
	break;
}



	//Declare the errors array:
$errors = array();

	//Check if the form variables were submitted:
$url 	 = APIURL."/activity";

		//Encode data array as JSON:
$data 	 = json_encode($dataArr);

		//Create the headers:
$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

		//Create the REST call:
$response  = rest_post($url, $data, $headers);

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