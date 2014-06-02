<!--
<div class="panel panel-default">
	<div class="panel-heading">What did we use?</div>
	<div class="panel-body">
		<?php echo $item->{'context'}->{'description'}?>  
	</div>
</div>
-->


            <div class="panel panel-default">
                <div class="panel-heading"><h4>How was it made?
                <?php if ($page === "product") { ?>
                   <a href="#" data-label="H" data-activity-id="<?php echo $item->{'id'} ?>" class="btn btn-danger active" role="button" style="float:right;margin-left:5px; margin-right:5px;" data-toggle="modal" data-target="#confirm-delete-activity">Remove</a>        
                <?php }  ?> 
                </h4>
                </div>
                <div class="panel-body">
                <p><?php echo $item->{'context'}->{'description'}?></p>
                
                   <div class="js-video">
                    <iframe src="<?php echo $item->{'context'}->{'video'}?>" frameborder="0" allowfullscreen></iframe>
                   </div>
                </div>
                <div class="panel-footer text-center">
                    <a href="#share"><span class="glyphicon glyphicon-share-alt"></span></a>
                </div>
            </div>

