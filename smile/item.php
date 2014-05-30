<?php include('core/init.core.php');?>
<?php

	//URL of the REST call:
	$url      = APIURL."/item/".$_GET['itmid'];

	//Headers of the REST call:
	$headers  = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

//REST response:
$response =  rest_get($url,$headers);

//Decode the JSON object:
$data_arr = json_decode($response);



//Get activities:
$ac_url = APIURL."/activity/item/".$_GET['itmid'];
$ac_response = rest_get($ac_url, $headers);
$ac_data_arr = json_decode($ac_response);

?>
<?php include('header.php'); ?>
<!-- delete modal window -->

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete an item from your catalogue.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

<!-- end of delete modal window -->

<div class="container-fluid">

     	
	<div class="row">
		<?php include('dashboard-sidebar.php');?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header"><?php echo $data_arr->{'name'};?>&nbsp;&nbsp;
				<a href="#" data-label="<?php echo $data_arr->{'name'};?>" data-href="item-delete.php?itmid=<?php echo $_GET['itmid'];?>" class="btn btn-danger active" role="button" style="float:right;"  data-toggle="modal" data-target="#confirm-delete">Delete Item</a>&nbsp;&nbsp;
				<a href="item-update.php?itmid=<?php echo $_GET['itmid'];?>" class="btn btn-primary active" role="button" style="float:right;margin-left:5px; margin-right:5px;">Update Item</a>&nbsp;&nbsp;
			</h1>
		</div>

		<div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2">
				<div class="thumbnail"> 
					<?php 
					echo '<img src="'.$data_arr->{'product'}->{'photos'}[0].'" alt="">';
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
	</div><!--Container Ends here-->  

<?php include('footer.php'); ?>