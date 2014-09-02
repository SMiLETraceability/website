<?php include('core/init.core.php');?>
<?php include('header.php'); ?>
<?php 
	$size = sizeof($_SESSION['account']['businessApiKeys']);

	if($size > 0){
		//$_SESSION['account']['currentBusinessKey'] = $_SESSION['account']['businessApiKeys'][0];

		$url = APIURL."/business/".$_SESSION['account']['currentBusinessKey'];


		$headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"Authorization: ".$_SESSION['account']['apiKey']);

		$response =  rest_get($url,$headers);

		//Decode the REST response:
		$data_arr = json_decode($response);

		$id = $data_arr->{'id'};

		//print_r($response);
	}
?>
<div class="container-fluid">
      	<div class="row">
        	<?php include('dashboard-sidebar.php');?>
        	
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          	<h1 class="page-header">Your Dashboard</h1>
	            <h3>Quick guide</h3>
	            <p><strong>Step1: </strong> Add a product into your catalogue</p>
	            <a href ="product-add.php" title="Add Business" class="btn btn-primary btn-lg active" role="button">Add Product</a>
	            <p></p>
	            <p><strong>Step2: </strong> Add provenance information associated with the product involving production, recipies and ingredients</p>
	            <a href ="product-list-all.php" title="Add Business" class="btn btn-primary btn-lg active" role="button">Add cards</a>
	            <p></p>
	            
	            <p><strong>Step3: </strong> Create a new item</p>
	            <a href ="item-add.php" title="Add Business" class="btn btn-primary btn-lg active" role="button">Add Item</a>
	            <p></p>
	            
	            
	            <p><strong>Step4: </strong> Print the QR code and attach it to your product</p>
		         <a href ="item-list-all.php" title="Add Business" class="btn btn-primary btn-lg active" role="button">Print QR code</a>
		         <p></p>

                <h3>Other options</h3>
	          	<a href ="register-user.php" title="Add User" class="btn btn-primary btn-lg active" role="button">Add a new user</a> &nbsp;&nbsp;
	          	<?php if($_SESSION['account']['accountType'] === "Business Account"){ ?>
	          		<a href ="register-business.php?bpid=<?php echo $id;?>" title="Add Business" class="btn btn-primary btn-lg active" role="button">Add a new business</a>
	          		<br/><br/>
	          	<?php } ?>
	          	
	          	
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>