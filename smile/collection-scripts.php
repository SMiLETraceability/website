<?php
include('core/init.core.php');
//include('include/shipment/fedex/TrackWebServiceClient/Track/TrackWebServiceClient.php');
include('include/shipment/fedex/library/fedex-common.php5');

//include('fedex-common.php5');

$call = $_GET['call']; //either update tracking data or submit new tracking number
$service_type = $_GET['service'];
$tracking_number = $_GET['tracking_number'];
	//Declare the errors array:
$errors = array();

	//Check if the form variables were submitted:
//$url 	 = APIURL."/product/".$prodid;

		//Encode data array as JSON:
		//Create the headers:
//$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

		//Create the REST call:
//$response  = rest_get($url, $headers);

//$userobj = json_decode($response);

/*if($status && $status!=200){
	$errors[] = $userobj->{'errors'}[0];
	$errors[] = $userobj->{'moreInfo'};
}

if(empty($errors))
	echo $response;
else
	echo $errors;
*/
$response;

//determine the type of call
switch ($call) {
	case 'shipment_service_submit': //submitting a new tracking number
		$response = submit_shipment($service_type,$tracking_number);
		break;
	case 'shipment_service_update': //update tracking info
		break;
	default:
		# code...
		break;
	}
if($response==-1)
	echo json_encode('Error');
else
	echo json_encode($response);
?>
<?php
//submit shipment tracking number for various services
function submit_shipment($service_type,$tracking_number){
		
		$shipment_result = -1;
		
		switch ($service_type) {
			case 'fedex':
				$shipment_result = fedex_submit_tracking($tracking_number, FEDEX_KEY, FEDEX_PASSWORD, FEDEX_ACCOUNT_NO, FEDEX_METER_NO);
				break;
			case 'royal-mail': //todo
				break;
			case 'dhl':	//todo
				break;
			default:
				# code...
				break;
		}

		return $shipment_result;
	}

function fedex_submit_tracking($tracking_no, $fedex_key, $fedex_password,$fedex_account, $fedex_meter){

	//The WSDL is not included with the sample code.
	//Please include and reference in $path_to_wsdl variable.
	//$path_to_wsdl = "../../wsdl/TrackService_v9.wsdl";
	$path_to_wsdl = 'include/shipment/fedex/wsdl/TrackService_v9.wsdl';
	//return 1;
	ini_set("soap.wsdl_cache_enabled", "0");

	$client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information
	
	//return 1;

	$request['WebAuthenticationDetail'] = array(
		'UserCredential' =>array(
		//	'Key' => getProperty('key'), 
		//	'Password' => getProperty('password')
			'Key' => $fedex_key, 
			'Password' => $fedex_password
		)
	);
	$request['ClientDetail'] = array(
		//'AccountNumber' => getProperty('shipaccount'), 
		//'MeterNumber' => getProperty('meter')
		'AccountNumber' => $fedex_account, 
		'MeterNumber' => $fedex_meter
	);
	$request['TransactionDetail'] = array('CustomerTransactionId' => '*** Track Request using PHP ***');
	$request['Version'] = array(
		'ServiceId' => 'trck', 
		'Major' => '9', 
		'Intermediate' => '1', 
		'Minor' => '0'
	);
	$request['SelectionDetails'] = array(
		'PackageIdentifier' => array(
			//'Type' => 'TRACKING_NUMBER_OR_DOORTAG', //797843158299
			'Type' => 'TRACKING_NUMBER_OR_DOORTAG', //123456789012
			//'Value' => getProperty('trackingnumber') // Replace 'XXX' with a valid tracking identifier
			'Value' => $tracking_no // Replace 'XXX' with a valid tracking identifier
		)
	);

	$response = -1;

	try {
		if(setEndpoint('changeEndpoint')){
			$newLocation = $client->__setLocation(setEndpoint('endpoint'));
		}
		
		$response = $client ->track($request);

	    if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR'){
			if($response->HighestSeverity != 'SUCCESS'){
				//echo '<table border="1">';
				//echo '<tr><th>Track Reply</th><th>&nbsp;</th></tr>';
				//trackDetails($response->Notifications, '');
				//echo '</table>';
				$response = -1;
			}else{
		    	if ($response->CompletedTrackDetails->HighestSeverity != 'SUCCESS'){
					//echo '<table border="1">';
				    //echo '<tr><th>Shipment Level Tracking Details</th><th>&nbsp;</th></tr>';
				    //trackDetails($response->CompletedTrackDetails, '');
					//echo '</table>';
					$response = -1;
				}else{

					//echo '<table border="1">';
				    //echo '<tr><th>Package Level Tracking Details</th><th>&nbsp;</th></tr>';
				    $response = fetchFedexData($response->CompletedTrackDetails->TrackDetails, '');
				   	//trackRawDetails($response->CompletedTrackDetails->TrackDetails, '');

					//echo '</table>';
				}
			}
	     //   printSuccess($client, $response);
	    }else{
	       $response = -1;
	       // printError($client, $response);
	    } 
	    
	    //writeToLog($client);    // Write to log file   
	}
	 catch (SoapFault $exception) {
	 	$response = -1;
	    //printFault($exception, $client);
	}

	return $response;
}

function fetchFedexData($details, $spacer){
	$retArray = array();
	$i=0;
	
	foreach($details as $key => $value){
		if(isset($value->Notification->Severity))
			$retArray[$i]['severity'] = $value->Notification->Severity;

		if(isset($value->TrackingNumberUniqueIdentifier))
			$retArray[$i]['uid'] = $value->TrackingNumberUniqueIdentifier;

		if(isset($value->OperatingCompanyOrCarrierDescription))
			$retArray[$i]['service'] = $value->OperatingCompanyOrCarrierDescription;

		if(isset($value->ShipTimestamp))
			$retArray[$i]['timestamp'] = $value->ShipTimestamp;

		if(isset($value->DestinationAddress)){
				if(isset($value->DestinationAddress->City))
					$retArray[$i]['address']['city'] = $value->DestinationAddress->City;
				if(isset($value->DestinationAddress->StateOrProvinceCode))
					$retArray[$i]['address']['state'] = $value->DestinationAddress->StateOrProvinceCode;
				if(isset($value->DestinationAddress->CountryCode))
					$retArray[$i]['address']['countryCode'] = $value->DestinationAddress->CountryCode;
				if(isset($value->DestinationAddress->CountryName))
					$retArray[$i]['address']['country'] = $value->DestinationAddress->CountryName;
			}

			//if(is_array($value) || is_object($value)){
			
//        	$newSpacer = $spacer. '&nbsp;&nbsp;&nbsp;&nbsp;';
    		//echo '<tr><td>'. $spacer . $key.'</td><td>&nbsp;</td></tr>';
    		//trackDetails($value, $newSpacer);

    		$i++;
    	}

    	/*elseif(empty($value)){
    		//echo '<tr><td>'.$spacer. $key .'</td><td>'.$value.'</td></tr>';
    	}else{
    		//echo '<tr><td>'.$spacer. $key .'</td><td>'.$value.'</td></tr>';
    	}*/
    	if(count($retArray)<1)
    		return -1;
    	return $retArray;
    }
?>