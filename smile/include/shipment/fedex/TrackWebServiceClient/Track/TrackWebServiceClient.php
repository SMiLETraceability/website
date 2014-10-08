<?php include('../../library/fedex-common.php5');
	//include('fedex-common.php5');

function fedex_submit_tracking($tracking_no, $fedex_key, $fedex_password,$fedex_account, $fedex_meter){

	//The WSDL is not included with the sample code.
	//Please include and reference in $path_to_wsdl variable.
	//$path_to_wsdl = "../../wsdl/TrackService_v9.wsdl";
	$path_to_wsdl = 'TrackService_v9.wsdl';
	//return 1;
	ini_set("soap.wsdl_cache_enabled", "0");

	$client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information
	
	return 1;

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
			'Type' => 'TRACKING_NUMBER_OR_DOORTAG', //797843158299
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
			}/*else{
		    	if ($response->CompletedTrackDetails->HighestSeverity != 'SUCCESS'){
					//echo '<table border="1">';
				    //echo '<tr><th>Shipment Level Tracking Details</th><th>&nbsp;</th></tr>';
				    //trackDetails($response->CompletedTrackDetails, '');
					//echo '</table>';
				}else{
					//echo '<table border="1">';
				    //echo '<tr><th>Package Level Tracking Details</th><th>&nbsp;</th></tr>';
				    //trackDetails($response->CompletedTrackDetails->TrackDetails, '');
				   	//trackRawDetails($response->CompletedTrackDetails->TrackDetails, '');

					//echo '</table>';
				}
			}*/
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

?>