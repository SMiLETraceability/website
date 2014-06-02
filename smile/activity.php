<?php include('core/init.core.php');

$prod_id  = $_GET['prodid'];
$activity = $_GET['activity'];
$dataArr  = array();


if($activity === "PRODUCTION"){

	//Production information:
	if(isset($_POST['production_description'])){
		$p_description = $_POST['production_description'];
	}
	
	//Production video:
	if(isset($_POST['production_video'])){
		$p_video 	   = $_POST['production_video']; 
	}

	//Production picture:
	if(isset($_POST['production_picture'])){
		$p_image       = $_POST['production_picture'];
	}

	//Check if video is empty:
	if(empty($p_video) == true){
		$p_video = "";
	}

	//Check if image is empty:
	if(empty($p_image) == true){
		$p_image = "";
	}

	//Create the array:
	$dataArr = array(
		'type'=>$activity,
		'entity'=>'product',
		'recordId'=>$prod_id,
		'context'=> array(
			'description'=> $p_description, 
			'video' => $p_video,
			'image' => $p_image
			)
		);

	//URL of the REST call:
	$url 	 = APIURL."/activity";

	//Encode data array as JSON:
	$data 	 = json_encode($dataArr);

	//Create the headers:
	$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//Create the REST call:
	$response  = rest_post($url, $data, $headers);

	//Decode the json object:
	$userobj = json_decode($response);

	header("Location: product.php?prodid=".$prod_id."&activity=".$activity);
	die();


}else if($activity === "RECIPE") {
	
	if(isset($_POST['recipe_description'])){
		$r_description = $_POST['recipe_description'];	//recipe description
	}

	if(isset($_POST['recipe_image'])){
		$r_image = $_POST['recipe_image'];	//recipe image
	}

	if(empty($r_description) == true){
		$r_description = "";
	}

	if(empty($r_image) == true){
		$r_image = "";
	}

	$dataArr = array(
		'type'=>$activity,
		'entity'=>'product',
		'recordId'=>$prod_id,
		'context'=> array(
			'description'=> $r_description, 
			'image' => $r_image 
			)
		);

	//URL of the REST call:
	$url 	 = APIURL."/activity";

	//Encode data array as JSON:
	$data 	 = json_encode($dataArr);

	//Create the headers:
	$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//Create the REST call:
	$response  = rest_post($url, $data, $headers);

	//Decode the json object:
	$userobj = json_decode($response);

	header("Location: product.php?prodid=".$prod_id."&activity=".$activity);
	die();

}else if($activity === "INGREDIENT"){

	
	$ingredientName 		 			= $_POST['ingredient_name'];
	//Get all the descriptions of all the ingredients:
	$ingredientDescription  			= $_POST['ingredient_description'];
	//Get all the images of all the ingredients:
	$ingredientImage 		 			= $_POST['ingredient_image'];
	//Get all the producer names of all the ingredients:
	$ingredientProducerName 		    = $_POST['ingredient_producer_name'];
	//Get all the producer locations of all the ingredients:
	$ingredientProducerLocation        = $_POST['ingredient_producer_location'];


	if(empty($ingredientImage ) == true){
			$ingredientImage  = "";
	}


		$dataArr = array(
					'type'=>$activity,
					'entity'=>'product',
					'recordId'=>$prod_id,
					'context'=> array(
						'name' 		  => $ingredientName,
						'description' => $ingredientDescription, 
						'image' 	  => $ingredientImage,
						'producer'    => $ingredientProducerName,
						'location'    => $ingredientProducerLocation
						)
					);
		//URL of the REST call:
		$url 	 = APIURL."/activity";

		//Encode data array as JSON:
		$data 	 = json_encode($dataArr);

		//Create the headers:
		$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

		//Create the REST call:
		$response  = rest_post($url, $data, $headers);

		//Decode the json object:
		$userobj = json_decode($response);
		
		//Empty array, to repeat the process:
		$dataArr = array();
	

	header("Location: product.php?prodid=".$prod_id."&activity=".$activity);
	die();
}

?>