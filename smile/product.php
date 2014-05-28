<?php include('core/init.core.php');?>
<?php

//URL of the REST call:
$url      = APIURL."/product/".$_GET['prodid'];

//Headers of the REST call:
$headers  = array("Content-Type: application/json","ApplicationAuthorization:".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

//REST response:
$response =  rest_get($url,$headers);

//Decode the JSON object:
$data_arr = json_decode($response);



//Get activities:
$ac_url = APIURL."/activity/product/".$_GET['prodid'];
$ac_response = rest_get($ac_url, $headers);
$ac_data_arr = json_decode($ac_response);
?>
<?php include('mobile-header.php'); ?>

<?php include('header.php'); ?>
<div class="container-fluid">
	<div class="row">
		<?php include('dashboard-sidebar.php');?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header"><?php echo $data_arr->{'fn'};?>&nbsp;&nbsp;
				<a href="product-delete.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-primary active" role="button" style="float:right;">Remove Product</a>&nbsp;&nbsp;
				<a href="product-update.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-primary active" role="button" style="float:right;margin-left:5px; margin-right:5px;">Update Product</a>&nbsp;&nbsp;
				<a href="product-provenance.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-primary active" role="button" style="float:right;">Add Provenance Information</a>&nbsp;&nbsp;
			</h1>
		</div>

		<div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2">
				<div class="thumbnail"> 
					<?php 
					echo '<img src="'.$data_arr->{'photos'}[0].'" alt="">';
					?> 
				</div>
		</div>

		<div class="col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
				
				<?php include('cards/PRODUCT-INFORMATION.php'); ?>

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

			

<!-- 			<h3>Description: </h3>
			<p><?php echo $data_arr->{'description'};?></p>


			<h3>Additional Information:</h3>
			<ul>
				<li><strong>Brand:</strong> <?php  echo $data_arr->{'brand'};?></li>
				<li><strong>URL:</strong> <a href="<?php echo $data_arr->{'url'};?>"><?php // echo $data_arr->{'url'};?></a></li>
				<li><strong>Price:</strong> <?php echo $data_arr->{'price'};?></li>
			</ul>

			<h3>Categories:</h3>
			<ul>
				<?php
				$categories = (array) $data_arr->{'categories'};
				if(!empty($categories)){
					foreach ($categories as $key => $value) {
						echo "<li>".$value."</li>";
					}
				}
				?>
			</ul>

			<h3>Properties:</h3>
			<ul>
				<?php
				$properties = (array) $data_arr->{'properties'};
				if(!empty($properties)){
					foreach ($properties as $key => $value) {
						echo "<li><strong>".$key."</strong> : ".$value."</li>";
					}
				}
				?>
			</ul>

			<h3>Identifiers:</h3>
			<ul>
				<?php
				$identifiers = (array) $data_arr->{'identifiers'};
				if(!empty($identifiers)){
					foreach ($identifiers as $key => $value) {
						echo "<li><strong>".$key."</strong> : ".$value."</li>";
					}
				}
				?>
			</ul>

			<h3>Tags:</h3>
			<ul>
				<?php
				$tags = (array) $data_arr->{'tags'};
				if(!empty($tags)){
					foreach ($tags as $key => $value) {
						echo "<li>".$value."</li>";
					}
				}
				?>
			</ul>

			

		</div><!--End of .main-->
	</div><!--End of .row-->
</div><!--Container Ends here--> -->

<?php include('footer.php'); ?>