<?php include('core/init.core.php');

$prod_id  = $_GET['prodid'];
$activity = $_GET['activity'];
$dataArr  = array();


if($activity === "production"){

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

	print_r($dataArr);


}else if($activity === "recipe") {
	
	if(isset($_GET['recipe_description'])){
		$r_description = $_GET['recipe_description'];	//recipe description
	}

	if(isset($_GET['recipe_image'])){
		$r_image = $_GET['recipe_image'];	//recipe image
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

	print_r($dataArr);

}else if($activity === "ingredient"){

	if(isset($_GET['ingredient_name'])){
		$i_name = $_GET['ingredient_name'];	//ingredient name
	}

	if(isset($_GET['ingredient_description'])){
		$i_description = $_GET['ingredient_description'];	//ingredient name
	}

	if(isset($_GET['ingredient_image'])){
		$i_image = $_GET['ingredient_image'];	//ingredient image
	}

	if(isset($_GET['ingredient_producer_name'])){
		$i_producer_name = $_GET['ingredient_producer_name'];	//ingredient producer name
	}

	if(isset($_GET['ingredient_producer_location'])){
		$i_producer_location = $_GET['ingredient_producer_location'];	//ingredient producer location
	}

	$dataArr = array(
		'type'=>$activity,
		'entity'=>'product',
		'recordId'=>$prod_id,
		'context'=> array(
			'name' => $i_name,
			'description'=> $i_description, 
			'image' => $i_image,
			'producer' => $i_producer_name,
			'location' => $i_producer_location
			)
		);

	print_r($dataArr);

}

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

//If there are any errors, append them to the errors notification:
//header("Location: product.php?prodid=".$prod_id."&activity=".$activity);
//die();

//Response testing:
print_r($response);
?>