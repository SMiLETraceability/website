<?php include('core/init.core.php');?>
<?php
	//URL of the REST call:
$url      = APIURL."/item/".$_GET['itmid'];

	//Headers of the REST call:
$headers  = array("Content-Type: application/json","ApplicationAuthorization: ".API_MOBILE_KEY);

	//GET the response from the REST call:
$response =  rest_get($url,$headers);

	//Decode the JSON object:
$data_arr = json_decode($response);
$photo_url = $data_arr->{'product'}->{'photos'}[0];

$prod_id = $data_arr->{'product'}->{'id'};
$b_url  = APIURL."/business/".$data_arr->{'product'}->{'businessId'};
$b_response =  rest_get($b_url,$headers);
$b_data_arr = json_decode($b_response);



//get activities from APIs

$ac_url = APIURL."/activity/product/".$prod_id;
$ac_response = rest_get($ac_url, $headers);
$ac_data_arr = json_decode($ac_response);
//print_r($ac_response);
//print_r($prod_id);
//die();

//print_r($b_response);
//die();


?>
<?php include('header.php'); ?>



<div class="container-fluid">

		<h3><?php echo $data_arr->{'name'}; ?></h3>
		<div class ="row">
          <div class="col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
				<div class="thumbnail"> 
					<?php 
					echo '<img src="'.$photo_url.'" alt="">';
					?> 
				</div>
			</div>
          <div class="col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
				<?php include('cards/PRODUCER.php'); ?>
				
				<?php include('cards/DESCRIPTION.php'); ?>
				
				<?php foreach($ac_data_arr->{'activities'} as $item) { 
                $card_name = 'cards/' . $item->{'type'} . '.php'; 
				
				if (file_exists($card_name)) {
				 include $card_name;  
				 }
				?>
					 	
				<?php } ?>
					
			
			</div>
		</div>
	</div>

		

<div class="container-fluid">
	
	<div class="alert alert-info">
	  <p>This application is developed as part of the <a href="http://www.dotrural.ac.uk/smile">SMiLE project</a> from the <a href="http://www.dotrural.ac.uk">RCUK dot.rural Digital Economy Hub</a> at the University of Aberdeen.</p>
	  <p/>We are currently developing a dedicated mobile app for iOS and Android for the purpose opt enhancing the user experience. Please watch this space for updates.</p>
	</div>

</div>


<?php include('footer.php'); ?>