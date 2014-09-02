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

//print_r($ac_response);
//die();


?>
<?php include('mobile-header.php'); ?>

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
                    <p>You are about to delete a product from your catalogue.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

<!-- end of delete modal window -->


<!-- delete activity modal window -->

<div class="modal fade" id="confirm-delete-activity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete an activity from this product.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" onclick="deleteActivity();" class="btn btn-danger danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

<!-- end of delete activity modal window -->


<?php include('cards/NEW_INGREDIENT.php'); ?>
<?php include('cards/NEW_PRODUCTION.php'); ?>
<?php include('cards/NEW_RECIPE.php'); ?>

<?php include('cards/EDIT_INGREDIENT.php'); ?>
<?php include('cards/EDIT_PRODUCTION.php'); ?>
<?php include('cards/EDIT_RECIPE.php'); ?>

<div class="container-fluid">
	<div class="row">
		<?php include('dashboard-sidebar.php');?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> 
				<h1 class="page-header"><?php echo $data_arr->{'fn'};?>&nbsp;&nbsp;
				<a href="#" data-label="<?php echo $data_arr->{'fn'};?>" data-href="product-delete.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-danger active" role="button" style="float:right;" data-toggle="modal" data-target="#confirm-delete">Remove Product</a>&nbsp;&nbsp;
				<a href="product-update.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-warning active" role="button" style="float:right;margin-left:5px; margin-right:5px;">Update Product</a>&nbsp;&nbsp;
				<div class="btn-group"  style="float:right;margin-left:5px; margin-right:5px;">
						  <button type="button" class="btn btn-warning dropdown-toggle active" data-toggle="dropdown">
						    New Card <span class="caret"></span>
						  </button>
						<ul class="dropdown-menu" role="menu">
						    <li><a href="#" data-toggle="modal" data-target="#new-recipe">How to use this Product?</a></li>
						    <li><a href="#" data-toggle="modal" data-target="#new-production">How was it made?</a></li>
						    <li><a href="#" data-toggle="modal" data-target="#new-ingredient">What did we use?</a></li>
						    
						 </ul>
				</div>
		</div>
		
		<div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2">
				<div class="thumbnail"> 
					<?php 
					echo '<img src="'.$data_arr->{'photos'}[0].'" alt="">';
					?> 
				</div>
				
				<?php include('cards/PRODUCT-INFORMATION.php'); ?>
				
				<?php include('cards/DESCRIPTION.php'); ?>
		</div>

		<div class="col-sm-5 col-sm-offset-0 col-md-5 col-md-offset-0">
				
				
									
				<?php
				//$sorted_ac_data = usort($ac_data_arr->{'activities'}, "cmp");
				$sorted_ac_data = BubbleSort($ac_data_arr->{'activities'});
				 
				 foreach($sorted_ac_data as $item) { 
                	$card_name = 'cards/' . $item->{'type'} . '.php'; 
				
					if (file_exists($card_name)) {
						 include $card_name;  
					}
				} 
				
				//simple method to sort activities
				/*function cmp($a, $b)
				{
				    return strcmp($a->{'context'}->{'sort'}, $b->{'context'}->{'sort'});
				}*/

				function BubbleSort($source_array)
				{
					$flag = 1;    // set flag to 1 to start first pass
					$temp;             // holding variable
					$count = count($source_array); 
						for($i = 1; ($i <= $count) && $flag==1; $i++)
						{
							$flag = 0;
							for ($j=0; $j < ($count -1); $j++)
							{
								if ( ( isset($source_array[$j]->{'context'}->{'sort'}) && isset($source_array[$j+1]->{'context'}->{'sort'}) )  
									&& ($source_array[$j+1]->{'context'}->{'sort'} > $source_array[$j]->{'context'}->{'sort'}) )       // ascending order simply changes to <
								{ 
									$temp = $source_array[$j];             // swap elements
				                    $source_array[$j] = $source_array[$j+1];
				                    $source_array[$j+1] = $temp;
				                    $flag = 1;               // indicates that a swap occurred.
				                }
		            	}
		        	}

		        	return $source_array;
		    	}


				/*function cmp($a, $b)
				{

				    if ( empty($a->{'context'}->{'sort'}) || empty($b->{'context'}->{'sort'}) || ($a->{'context'}->{'sort'} == $b->{'context'}->{'sort'}) ) {
				        return 0;
				    }
				    //return ($a->{'context'}->{'sort'} < $b->{'context'}->{'sort'}) ? -1 : 1;
				}*/


			?>

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