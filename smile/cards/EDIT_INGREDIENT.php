<div class="modal fade" id="edit-ingredient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
            	<form class="form-horizontal form-subingredients-add edit-ingredient-form" action="activity.php?activity=INGREDIENT&call=edit&prodid=<?php echo $_GET['prodid']; ?>&activityID=" method="post" role="form">
            	
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Editing: What did we use?</h4>
                </div>
            
                <div class="modal-body">
                    
                    <div class="form-group">
                    	<label for="Ingredient Name" class="col-sm-3 control-label">Ingredient Name:
                    	</label>
                    	<div class="col-md-8"><input type="text" class="form-control" id="ingredient_name" name="ingredient_name" placeholder="Ingredient Name" title="Ingredient name." value="" required/></div>
                  	</div><!--End of .form-group-->
                    <div class="form-group"><label for="Ingredient Description" class="col-sm-3 control-label">Ingredient Details:</label>
                    <div class="col-md-8">
                    	<textarea type="text" rows="5" class="form-control" id="ingredient_description" name="ingredient_description" title="Ingredient details." required></textarea>
                    	</div>
                    </div><!--End of .form-group-->
                    <div class="form-group">
                    <label for="ingredient_producer_name" class="col-sm-3 control-label">Producer Name:</label>
                    <div class="col-md-8">
                    	<input type="text" class="form-control" id="ingredient_producer_name" name="ingredient_producer_name" placeholder="Ingredient Producer Name" title="Ingredient producer name." required>
                    </div>
                    </div><!--End of .form-group-->
                    <div class="form-group">
                     <label for="ingredient_producer_location" class="col-sm-3 control-label">Producer Location:</label>
                     <div class="col-md-8">
                      <input type="text" class="form-control" id="ingredient_producer_location" name="ingredient_producer_location" placeholder="Ingredient Producer Location" title="Ingredient producer location."  required>
                      </div>
                      </div><!--End of .form-group-->
                      <div class="form-group"><label for="Ingredient Image" class="col-sm-3 control-label">Image URL:</label>
                       <div class="col-md-6">
                        <input type="text" class="form-control" id="ingredient_image" name="ingredient_image" placeholder="Please enter an image url" title="Image link.">
                       </div>
                       <div class="col-sm-1">		
                        		<span class="btn btn-primary btn-file">Browse<input id="photo_upload_ingredient" type="file" name="files[]" data-url="http://smile.abdn.ac.uk/smile/server/php/" multiple></span>
                        </div>
                       </div><!--End of .form-group-->
                                              
                    
                        <div class="form-group">
                      <label for="ingredient_sort" class="col-sm-3 control-label">Sort Order:</label>
                      <div class="col-md-8">
                        <input type="integer" class="form-control" id="ingredient_sort" name="ingredient_sort" placeholder="Enter an integer" title="Sort order value." required>
                      </div>
                    </div><!--End of .form-group-->
                    <br />

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="edit-ingredient-btn">Submit</button>
                </div>
                
              </form>
            </div>
        </div>
    </div>
