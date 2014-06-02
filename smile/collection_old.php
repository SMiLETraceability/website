<?php include('core/init.core.php');?>



<?php

	//URL of the REST call:
	$url      = APIURL."/collections/".$_GET['colid'];

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

	//REST response:
	$response =  rest_get($url,$headers);

	//Decode the JSON object:
	$data_arr = json_decode($response);


	//Get activities:
	$ac_url = APIURL."/activity/collections/".$_GET['colid'];
	$ac_response = rest_get($ac_url, $headers);
	$ac_data_arr = json_decode($ac_response);

?>

<?php include('header.php'); ?>
<div class="container-fluid">
     	
	<div class="row">
		<?php include('dashboard-sidebar.php');?>
        
        
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header"><?php echo $data_arr->{'name'};?>&nbsp;&nbsp;
				<?php
				echo "<a href=\"collection-add-items.php?colid=".$_GET['colid']."\" class=\"btn btn-primary active\" role=\"button\" style=\"float:right;\">Add items</a>&nbsp;&nbsp";
				?>
			</h1>
		</div>
      
	    <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2">
			<!--	<div class="thumbnail"> 
					<?php 
					echo '<img src="'.$data_arr->{'product'}->{'photos'}[0].'" alt="">';
					?> 
				</div>
			-->
			<?php include('cards/DESCRIPTION.php'); ?>
		</div> 

		<div class="col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
				
				
                <!--
				<?php include('cards/DESCRIPTION.php'); ?>
				
				<?php foreach($ac_data_arr->{'activities'} as $item) { 
                $card_name = 'cards/' . $item->{'type'} . '.php'; 
				
				if (file_exists($card_name)) {
				 include $card_name;  
				 }
				?>
					 	
				<?php } ?>
				-->	
			
			</div>
		</div>
	</div><!--Container Ends here-->  

<?php include('footer.php'); ?>