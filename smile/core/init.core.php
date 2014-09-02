<?php
	//Start session:
	session_start();

	//Create an exception page array:
	$exceptions = array('register-business','login','index', 'item-web','item-web_');

	//Find out the current page name:
	$exploded = explode('/', $_SERVER['SCRIPT_NAME']);
	$page = substr(end($exploded),0,-4);

	//Check if the current page is an exception and if a user is already stored in the session:
	if( in_array($page, $exceptions) === false){
		if (isset($_SESSION['account']) === false){
			header('Location: login.php');
			die();
		}
	}


	//API URL constant:

	//Application Authorization Key
	define("API_APP_KEY","aafa460be460462dcb7e56fda6d2217a");
 	define("API_MOBILE_KEY","aba778b08bf5d2376ce2c7bd0be60ba7");

	//Development mode:
	//define("APIURL","http://139.133.73.55:9090/smile-server/api-1.1");
	define("APIURL","http://smile.abdn.ac.uk:8080/smile-server/api-1.1");
	//Deployment mode:
	//define("APIURL","http://localhost:8080/smile-server/api-1.1");

	//Path to file:
	include dirname(__FILE__)."/inc/rest.inc.php";
	include dirname(__FILE__)."/inc/dynamic-form.inc.php";
	// include dirname(__FILE__)."/inc/user.inc.php";
?>