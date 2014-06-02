
<!--
<div class="panel panel-default">
	<div class="panel-heading">What did we use?</div>
	<div class="panel-body">
		<?php echo $item->{'context'}->{'description'}?>  
	</div>
</div>
-->


            <div class="panel panel-default">
                <div class="panel-image">
                    <img src="<?php echo $item->{'context'}->{'image'}?>" class="panel-image-preview">
                </div>
                <div class="panel-body">
                <?php if ($page === "product") { ?>
                   <a href="#" data-label="What did we use?" data-activity-id="<?php echo $item->{'id'} ?>" class="btn btn-danger active" role="button" style="float:right;margin-left:5px; margin-right:5px;" data-toggle="modal" data-target="#confirm-delete-activity">Remove Activity</a>        
                <?php }  ?>   
                                 
                    <h4>What did we use?</h4>
                    <p><?php echo $item->{'context'}->{'description'}?> </p>
                    <p><strong>Producer: </strong><?php echo $item->{'context'}->{'producer'}?> </p>
                    <p><strong>Location: </strong><?php echo $item->{'context'}->{'location'}?> </p>
                    
                </div>
                <div class="panel-footer text-center">
                    <a href="#share"><span class="glyphicon glyphicon-share-alt"></span></a>
                </div>
            </div>

