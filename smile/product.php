<?php include('core/init.core.php');?>
<?php
	
	//URL of the REST call:
	$url      = APIURL."/product/".$_GET['prodid'];

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//REST response:
	$response =  rest_get($url,$headers);
	
	//Decode the JSON object:
	$data_arr = json_decode($response);
?>

<?php include('header.php'); ?>
<div class="container-fluid">
      	<div class="row">
        	<?php include('dashboard-sidebar.php');?>
        	
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header"><?php echo $data_arr->{'fn'};?>&nbsp;&nbsp;
	          		<a href="product-update.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-primary btn-lg active" role="button" style="float:right;margin-left:5px">Update Product</a>&nbsp;&nbsp;
	          		<a href="product-delete.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-primary btn-lg active" role="button" style="float:right;">Remove Product</a>
	          	</h1>

	          	<h3>Description: </h3>
	          	<p><?php echo $data_arr->{'description'};?></p>

	          	<h3>Photo:</h3>
	          	<?php
	          		$photos = (array) $data_arr->{'photos'}; 
					foreach ($photos as $key => $value) {
						echo "<img src=\"".$value."\" alt=\"\" width=\"300\" height=\"300\">";
					}
	          	?>

	          	<h3>Additional Information:</h3>
	          	<ul>
	          		<li><strong>Brand:</strong> <?php echo $data_arr->{'brand'};?></li>
	          		<li><strong>URL:</strong> <a href="<?php echo $data_arr->{'url'};?>"><?php echo $data_arr->{'url'};?></a></li>
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
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>