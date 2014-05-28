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
		$p_video = " ";
	}

	//Check if image is empty:
	if(empty($p_image) == true){
		$p_image = " ";
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
		$r_description = " ";
	}

	if(empty($r_image) == true){
		$r_image = " ";
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

	//Get all the names of all the ingredients:
	$ingredientNames 		 			= get_form_data_v('ingredient_name_');
	//Get all the descriptions of all the ingredients:
	$ingredientDescriptions  			= get_form_data_v('ingredient_description_');
	//Get all the images of all the ingredients:
	$ingredientImages 		 			= get_form_data_v('ingredient_image_');
	//Get all the producer names of all the ingredients:
	$ingredientProducerNames 		    = get_form_data_v('ingredient_producer_name_');
	//Get all the producer locations of all the ingredients:
	$ingredientProducerLocations        = get_form_data_v('ingredient_producer_location_');

	//All arrays have the same size:
	for ($index=0; $index<sizeof($ingredientNames); $index++){
		$dataArr = array(
					'type'=>$activity,
					'entity'=>'product',
					'recordId'=>$prod_id,
					'context'=> array(
						'name' 		  => $ingredientNames[$index],
						'description' => $ingredientDescriptions[$index], 
						'image' 	  => $ingredientImages[$index],
						'producer'    => $ingredientProducerNames[$index],
						'location'    => $ingredientProducerLocations[$index]
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
	}

	header("Location: product.php?prodid=".$prod_id."&activity=".$activity);
	die();
}

?>