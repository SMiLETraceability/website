<?php include('core/init.core.php');?>
<?php

//URL of the REST call:
$url      = APIURL."/product/".$_GET['prodid'];

//echo $url;

//Headers of the REST call:
$headers  = array("Content-Type: application/json","ApplicationAuthorization:".API_APP_KEY,"BusinessAuthorization: ".$_SESSION['account']['currentBusinessKey'],"Authorization: ".$_SESSION['account']['apiKey']);

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
				<a href="product.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-primary active" role="button" style="float:right;">Back to Product Details</a>&nbsp;&nbsp;
				<a href="product-update.php?prodid=<?php echo $_GET['prodid'];?>" class="btn btn-primary active" role="button" style="float:right;margin-left:5px; margin-right:5px;">Update Product</a>&nbsp;&nbsp;
			</h1>

			<h3>Description: </h3>
			<p><?php echo $data_arr->{'description'};?></p>
			
			<h3>Add Provenance Information:</h3>
			<div class="panel-group col-lg-10" id="accordion">
	
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Add Product Production Details</a>
						</h4><!--End of .panel-title-->
					</div><!--End of .panel-heading-->
					
					<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">

							<form class="form-horizontal form-recipe-add" action="activity.php?activity=production&prodid=<?php echo $_GET['prodid']; ?>" method="post" role="form">

								<div class="alert alert-info col-md-11">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<strong>Tip: </strong> The fields of this panel marked with an asterisk (*) are mandatory. All the other fields are optional.
								</div><!--End of .alert-->
								<br/>

								<div class="form-group">
									<label for="production_description" class="col-sm-3 control-label">Production Details*:</label>
									<div class="col-md-8">
										<textarea rows="5" cols="5" class="form-control" id="production_description" name="production_description" title="Please enter production details text." value="<?php echo isset($_POST['production_description'])?$_POST['production_description'] :''?>" required></textarea>
									</div>
								</div><!--End of .form-group-->
								<br />

								<div class="form-group">
									<label for="production_video" class="col-sm-3 control-label">Video URL:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="production_video" name="production_video" placeholder="Please enter a video url (Youtube)" title="Please enter video link." value="<?php echo isset($_POST['production_video'])?$_POST['production_video'] :''?>" required>
									</div>
								</div><!--End of .form-group-->
								<br />

								<div class="form-group">
									<label for="production_picture" class="col-sm-3 control-label">Picture URL:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="production_picture" name="production_picture" placeholder="Please enter a picture url:" title="Please enter picture link." value="<?php echo isset($_POST['production_picture'])?$_POST['production_picture'] :''?>" required>
									</div>
								</div><!--End of .form-group-->
								<br />

								<button type="button" class="btn btn-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-original-title = "This is how it will look for the consumer" data-content='<img src="ext/img/production_help.png" alt="">'>Sample Preview</button>

								<button type="submit" class="btn btn-primary" id="add-production-btn">Submit</button>

								</form><!--End of form-->
							</div><!--End of .panel-body-->
					</div><!--End of #collapseOne-->
				</div><!--End of .panel-->

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Add Recipes</a>
						</h4>
					</div><!--panel-heading-->
									
					<div id="collapseTwo" class="panel-collapse collapse">
						<div class="panel-body">
							
							<form class="form-horizontal form-recipe-add" action="activity.php?activity=recipe&prodid=<?php echo $_GET['prodid']; ?>" method="post" role="form">

							<div class="alert alert-info col-md-11">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Tip: </strong> The fields of this panel marked with an asterisk (*) are mandatory. All the other fields are optional.
							</div><!--End of .alert-->

							<div class="form-group">
								<label for="Recipe Description" class="col-sm-3 control-label">Recipe Details:</label>
								<div class="col-md-8">
									<textarea type="text" rows="5" class="form-control" id="recipe_description" name="recipe_description" title="Please enter recipe details text." value="<?php echo isset($_POST['recipe_description'])?$_POST['recipe_description'] :''?>" required></textarea>
								</div>
							</div><!--End of .form-group-->

							<div class="form-group">
								<label for="Recipe Image" class="col-sm-3 control-label">Image URL:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="recipe_image" name="recipe_image" placeholder="Please enter an image url" title="Please enter image link." value="<?php echo isset($_POST['recipe_image'])?$_POST['recipe_image'] :''?>" required>
								</div>
							</div><!--End of .form-group-->

							<button type="button" class="btn btn-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-original-title = "This is how it will look for the consumer" data-content='<img src="ext/img/recipe_help.png" alt="">'>Sample Preview</button>
											
							<button type="submit" class="btn btn-primary" id="add-recipe-btn">Submit</button>

							</form><!--End of form-->

						</div><!--End of .panel-body-->
					</div><!--End of #collapseTwo-->
				</div><!--End of .panel-->

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Add Sub Ingredients</a>
						</h4>
					</div><!--End .panel-heading-->
									
					<div id="collapseThree" class="panel-collapse collapse">
						<div class="panel-body">

							<form class="form-horizontal form-subingredients-add ingredients" action="activity.php?activity=ingredient&prodid=<?php echo $_GET['prodid']; ?>" method="post" role="form">

							<div class="alert alert-info col-md-11">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Tip: </strong> The fields of this panel marked with an asterisk (*) are mandatory. All the other fields are optional.
							</div><!--End of .alert-->
							
							<div class="theingredients">
							</div>

							<button type="button" class="btn btn-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-original-title = "This is how it will look for the consumer" data-content='<img src="ext/img/recipe_help.png" alt="">'>Sample Preview</button>

							<button type="button" class="btn btn-info add-more-ingredients">Add Another Ingredient</button>

							<button type="submit" class="btn btn-primary" id="add-ingredient-btn">Submit</button>

							</form><!--End of form-->
						</div><!--End of .panel-body-->
					</div><!--End of #collapseThree-->
				</div><!--End of .panel-->
			</div><!--End of #accordion-->



		</div><!--End of .main-->
	</div><!--End of .row-->
</div><!--Container Ends here-->

<?php include('footer.php'); ?>