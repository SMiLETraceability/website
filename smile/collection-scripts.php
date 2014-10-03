<?php include('core/init.core.php');

$call = $_GET['call'];
$service_type = $_GET['service'];
$tracking_number = $_GET['tracking_number'];
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


//determine the type of call
switch ($call) {
	case 'shipment_service_submit': //submitting a tracking number
		submit_shipment($service_type,$tracking_number);
		break;
	case 'shipment_service_refresh': //refresh tracking info
		break;
	default:
		# code...
		break;
}

//submit shipment tracking number for various services
function submit_shipment($service_type,$tracking_number){
		
		$shipment_result = '';
		
		switch ($service_type) {
			case 'fedex':
				$shipment_result = fedex_shipment($tracking_number);
				break;
			
			default:
				# code...
				break;
		}
		# code...
}
?>