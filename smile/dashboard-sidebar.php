<?php



	//Headers of the REST call:
	$headers_count  = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

//URL of the REST call:
$url_count_products      = APIURL."/product/count";
$response_count_products =  rest_get($url_count_products  ,$headers_count);
$count_products = json_decode($response_count_products);

//URL of the REST call:
$url_count_items      = APIURL."/item/count";
$response_count_items =  rest_get($url_count_items  ,$headers_count);
$count_items = json_decode($response_count_items);

//URL of the REST call:
$url_count_collections      = APIURL."/collections/count";
$response_count_collections=  rest_get($url_count_collections  ,$headers_count);
$count_collections = json_decode($response_count_collections);


?>        	
        	
        	
        	
        	<div class="col-sm-3 col-md-2 sidebar">
          		<ul class="nav nav-sidebar">
            		<li><a href="dashboard.php"><span class="glyphicon glyphicon-eye-open"></span> Overview</a></li>
            		<li><a href="product-list-all.php"><span class="glyphicon glyphicon-book"></span> Products  <small class="badge pull-right bg-yellow"><?php echo $count_products ?></small> </a></li>
            		<li><a href="item-list-all.php"><span class="glyphicon glyphicon-qrcode"></span> Items <small class="badge pull-right bg-yellow"><?php echo $count_items ?></small></a></li>
            	<!--	<li><a href="item-add.php">Add Item</a></li> -->
            		<li><a href="collection-list-all.php"><span class="glyphicon glyphicon-gift"></span> Boxes <small class="badge pull-right bg-yellow"><?php echo $count_collections ?></small></a></li>
            	<!--	<li><a href="collection-add.php">Add Collection</a></li> -->
            	
            	<!--	<li><a href="product-add.php">Add Product</a></li> -->
          		</ul>
        	</div><!--End of .sidebar-->