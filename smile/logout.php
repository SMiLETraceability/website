<?php include('core/init.core.php');?>
<?php

	//Api URL:
	$url = APIURL."/auth/all/logout";
	//Header of the API:
	$headers = array('Content-Type: application/json',"ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a", 'Authorization: '.$_SESSION['account']['apiKey']);
	//Data array of the API:
	$data = array();

	//REST call:
	$status = rest_post($url, $data, $headers);
	//Decode the response:
	$statusobj = json_decode($status);

	//Clear the session object:
	if($statusobj==="LOGOUT_SUCCESSFUL"){
	 	$_SESSION = array();
	 	session_destroy();
	 	header('Location: login.php');
	}
?>