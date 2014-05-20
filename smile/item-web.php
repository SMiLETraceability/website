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


$b_url  = APIURL."/business/".$data_arr->{'product'}->{'businessId'};
$b_response =  rest_get($b_url,$headers);
$b_data_arr = json_decode($b_response);

?>
<?php include('header.php'); ?>

<div class="container-fluid">
	<div class="jumbotron">
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
				<div class="panel panel-default">
										<div class="panel-heading">Produced By</div>
					<div class="panel-body">
						<span><?php echo $b_data_arr->{'name'}; ?></span>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Description</div>
					<div class="panel-body">
						<?php echo $data_arr->{'description'};?>  
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="divider"></div>

</div>

<div class="container-fluid">
	<div class="jumbotron">
	<p/>Get more info about this product using our mobile Apps!</p>
</br/>
	<div class ="row"> <!--main row-->
          <div class="col-sm-9 col-sm-offset-0 col-md-10 col-md-offset-0 main">
			<div class="row">
				<div class="col-ld-8 col-md-2">
					<a href="#" class="thumbnail">
						<img src="ext/img/appstore_icon.jpg" alt="...">
					</a>
				</div>
				<!--text here-->
			</div>
		</div>
          <div class="col-sm-9 col-sm-offset-0 col-md-10 col-md-offset-0 main">
			<div class="row">
				<div class="col-ld-8 col-md-2">
					<a href="#" class="thumbnail">
						<img src="ext/img/playstore_icon.png" alt="...">
					</a>
				</div>
				<!--text here-->
			</div>
		</div>
	</div> <!--main row end-->
</div>
</div>


<?php include('footer.php'); ?>