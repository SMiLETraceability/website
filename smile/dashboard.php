<?php include('core/init.core.php');?>
<?php include('header.php'); ?>
<?php 
	$size = sizeof($_SESSION['account']['businessApiKeys']);
	if($size > 0){
		//$_SESSION['account']['currentBusinessKey'] = $_SESSION['account']['businessApiKeys'][0];

		$url = APIURL."/business/".$_SESSION['account']['currentBusinessKey'];

		$headers = array("Content-Type: application/json","ApplicationAuthorization: aafa460be460462dcb7e56fda6d2217a","Authorization: ".$_SESSION['account']['apiKey']);

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
	          	<h1 class="page-header">Your Dashboard:</h1>
	          	<h3>You can either</h3>

	          	<a href ="register-user.php" title="Add User" class="btn btn-primary btn-lg active" role="button">Add a new user</a> &nbsp;&nbsp;
	          	<?php if($_SESSION['account']['accountType'] === "Business Account"){ ?>
	          		<a href ="register-business.php?bpid=<?php echo $id;?>" title="Add Business" class="btn btn-primary btn-lg active" role="button">Add a new business</a>
	          		<br/><br/>
	          	<?php } ?>
	          	<h3>Or select an already existing business:</h3>
	          	<?php
	          		//print_r($_SESSION['account']['businessApiKeys']);
	          		echo "<br />";
	          		//echo $_SESSION['account']['currentBusinessKey'];
	          		echo "<br />";
	          		//echo $size;
	          	 ?>
	          	
	        </div><!--End of .main-->
	    </div><!--End of .row-->
	</div><!--Container Ends here-->

<?php include('footer.php'); ?>