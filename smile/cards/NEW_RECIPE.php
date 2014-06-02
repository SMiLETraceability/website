<div class="modal fade" id="new-recipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
	             <form class="form-horizontal form-recipe-add" action="activity.php?activity=RECIPE&prodid=<?php echo $_GET['prodid']; ?>" method="post" role="form">
	             
	             
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title" id="myModalLabel">How to use this product?</h4>
	                </div>
	            
	                <div class="modal-body">
	                    <p class="debug-url"></p>
	                                     
							
			
								<div class="form-group">
									<label for="Recipe Description" class="col-sm-3 control-label">Recipe Details:</label>
									<div class="col-md-9">
										<textarea type="text" rows="5" class="form-control" id="recipe_description" name="recipe_description" title="Please enter recipe details text." value="<?php echo isset($_POST['recipe_description'])?$_POST['recipe_description'] :''?>" required></textarea>
									</div>
								</div><!--End of .form-group-->
			
								<div class="form-group">
									<label for="Recipe Image" class="col-sm-3 control-label">Image URL:</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="recipe_image" name="recipe_image" placeholder="Please enter an image url" title="Please enter image link." value="<?php echo isset($_POST['recipe_image'])?$_POST['recipe_image'] :''?>" required>
									</div>
									<div class="col-sm-1">		
									 		<span class="btn btn-primary btn-file">Browse<input id="photo_upload_recipe" type="file" name="files[]" data-url="http://smile.abdn.ac.uk/smile/server/php/" multiple></span>
									 </div>
									
								</div><!--End of .form-group-->
			                   
			                    <!--								
								<button type="button" class="btn btn-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-original-title = "This is how it will look for the consumer" data-content='<img src="ext/img/recipe_help.png" alt="">'>Sample Preview</button>
									-->				                    
	                    
	                </div>
	                
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	                    <button type="submit" class="btn btn-primary" id="add-recipe-btn">Submit</button>
	                </div>
	                
	            </form><!--End of form-->
            </div>
        </div>
    </div>


