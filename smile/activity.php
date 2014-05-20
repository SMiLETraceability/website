<?php include('core/init.core.php');

$prod_id = $_GET['prodid'];
$activity_type = $_GET['type'];

//production data
if(isset($_GET['p_description']))
	$p_description = $_GET['p_description']; //production description
if(isset($_GET['p_video']))
	$p_video = $_GET['p_video'];	//production video

//recipe data
if(isset($_GET['r_description']))
	$r_description = $_GET['r_description'];	//recipe description
if(isset($_GET['r_image']))
	$r_image = $_GET['r_image'];	//recipe image

//ingredient data
if(isset($_GET['i_name']))
	$i_name = $_GET['i_name'];	//ingredient name
if(isset($_GET['i_description']))
	$i_description = $_GET['i_description'];	//ingredient name
if(isset($_GET['i_image']))
	$i_image = $_GET['i_image'];	//ingredient image
if(isset($_GET['i_producer_name']))
	$i_producer_name = $_GET['i_producer_name'];	//ingredient producer name
if(isset($_GET['i_producer_location']))
	$i_producer_location = $_GET['i_producer_location'];	//ingredient producer location

$dataArr = array();

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
		$dataArr = array(
		'type'=>$activity_type,
		'entity'=>'product',
		'recordId'=>$prod_id,
		'context'=> array(
			'name' => $i_name,
			'description'=> $i_name, 
			'image' => $i_image,
			'producer' => $i_producer_name,
			'location' => $i_producer_location
			)
		);
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