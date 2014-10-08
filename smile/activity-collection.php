<?php include('core/init.core.php');

$prod_id  = $_GET['prodid'];
$activity = $_GET['activity'];
$activityID = $_GET['activityID'];

$call = $_GET['call']; //adding a new activity or editing previous one

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

	//Production sort:
	if(isset($_POST['production_sort'])){
		$sort = $_POST['production_sort'];
	}


	//Check if video is empty:
	if(empty($p_video) == true){
		$p_video = "";
	}

	//Check if image is empty:
	if(empty($p_image) == true){
		$p_image = "";
	}


	//Check if sort is empty:
	if(empty($sort) == true){
		$sort = 0;
	}


	//Create the array:
	$dataArr = array(
		'type'=>$activity,
		'entity'=>'product',
		'recordId'=>$prod_id,
		'context'=> array(
			'description'=> $p_description, 
			'video' => $p_video,
			'image' => $p_image,
			'sort' => $sort
			)
		);

}else if($activity === "RECIPE") {
	
	if(isset($_POST['recipe_description'])){
		$r_description = $_POST['recipe_description'];	//recipe description
	}

	if(isset($_POST['recipe_image'])){
		$r_image = $_POST['recipe_image'];	//recipe image
	}

	if(isset($_POST['recipe_sort'])){
		$sort = $_POST['recipe_sort'];
	}

	if(empty($sort) == true){
		$sort = 2;
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
			'image' => $r_image,
			'sort' => $sort
			)
		);

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

	if(isset($_POST['ingredient_sort'])){
		$sort = $_POST['ingredient_sort'];
	}

	if(empty($sort) == true){
		$sort = 1;
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
						'location'    => $ingredientProducerLocation,
						'sort' => $sort
						)
					);


}

	//Encode data array as JSON:
	$data 	 = json_encode($dataArr);

	//Create the headers:
	$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);
	
	switch ($call) {
		case 'new':
			//URL of the REST call:
			$url 	 = APIURL."/activity/";
			$response  = rest_post($url, $data, $headers);
			break;
		case 'edit':
			$url 	 = APIURL."/activity/".$activityID;
			$response  = rest_put($url, $data, $headers);

			break;
		
		default:
			# code...
			break;
	}

	//Decode the json object:
	//$userobj = json_decode($response);
	//Empty array, to repeat the process:
	$dataArr = array();

	header("Location: product.php?prodid=".$prod_id."&activity=".$activity);
	die();

?>