<div class="modal fade" id="edit-production" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
             <form class="form-horizontal form-recipe-add edit-production-form" action="activity.php?activity=PRODUCTION&call=edit&prodid=<?php echo $_GET['prodid']; ?>&activityID=" method="post" role="form">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Editing: How was it made?</h4>
                </div>
            
                <div class="modal-body">
                   
                 
					<div class="form-group">
						<label for="production_description" class="col-sm-3 control-label">Production Details*:</label>
						<div class="col-md-8">
							<textarea rows="5" cols="5" class="form-control" id="production_description" name="production_description" title="Production details." required></textarea>
						</div>
					</div><!--End of .form-group-->
					<br />

					<div class="form-group">
						<label for="production_video" class="col-sm-3 control-label">Video URL:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="production_video" name="production_video" placeholder="Video url (Youtube)" title="Video link." >
						</div>
					</div><!--End of .form-group-->
					<br />

					<div class="form-group">
						<label for="production_picture" class="col-sm-3 control-label">Picture URL:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="production_picture" name="production_picture" placeholder="Picture url:" title="Picture link.">
						</div>
						<div class="col-sm-1">		
						 		<span class="btn btn-primary btn-file">Browse<input id="photo_upload_production" type="file" name="files[]" data-url="http://smile.abdn.ac.uk/smile/server/php/" multiple></span>
						 </div>
					</div><!--End of .form-group-->
			                 <!--
					<button type="button" class="btn btn-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-original-title = "This is how it will look for the consumer" data-content='<img src="ext/img/production_help.png" alt="">'>Sample Preview</button>

-->							                 
					

                   
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="edit-production-btn">Submit</button>
                    
                </div>
                
                
               </form><!--End of form-->  
                
            </div>
        </div>
    </div>

