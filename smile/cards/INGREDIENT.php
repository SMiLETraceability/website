
<!--
<div class="panel panel-default">
	<div class="panel-heading">What did we use?</div>
	<div class="panel-body">
		<?php echo $item->{'context'}->{'description'}?>  
	</div>
</div>
-->


            <div class="panel panel-default" id="activity_<?php echo $item->{'id'}?>">
            
             <?php if ($item->{'context'}->{'image'} != '') { ?>
                <div class="panel-image">
                    <img id="activity_<?php echo $item->{'id'}?>_image" src="<?php echo $item->{'context'}->{'image'}?>" class="panel-image-preview">
                </div>
             <?php } else { ?>
             <div class="panel-heading"><h4>What did we use?</h4></div>
             <?php } ?>
                
                
                <div class="panel-body">
                <?php if ($page === "product") { ?>
                   <a href="#" data-label="What did we use?" data-activity-id="<?php echo $item->{'id'} ?>" class="btn btn-danger btn-xs active" role="button" style="float:right;margin-left:5px; margin-right:5px;" data-toggle="modal" data-target="#confirm-delete-activity">Remove</a>        
                   <a href="#" data-activity-id="<?php echo $item->{'id'} ?>" class="btn btn-primary btn-xs active" role="button" style="float:right;margin-left:5px; margin-right:5px;" data-toggle="modal" data-target="#edit-ingredient">Edit</a>        

                <?php }  ?>   
                    <?php if ($item->{'context'}->{'image'} != '') { ?>             
                    <h4>What did we use?</h4>
                    <?php } ?>
                    <p id="activity_<?php echo $item->{'id'}?>_name" style="display:none;"><?php echo nl2br($item->{'context'}->{'name'})?></p>
                    <p id="activity_<?php echo $item->{'id'}?>_description"><?php echo nl2br($item->{'context'}->{'description'})?></p>
                    <p id="activity_<?php echo $item->{'id'}?>_producer"><strong>Producer: </strong><?php echo $item->{'context'}->{'producer'}?></p>
                    <p id="activity_<?php echo $item->{'id'}?>_location"><strong>Location: </strong><?php echo $item->{'context'}->{'location'}?></p>
                    <p id="activity_<?php echo $item->{'id'}?>_sort" style="display:none;"><?php echo nl2br($item->{'context'}->{'sort'})?></p>
                </div>
                <div class="panel-footer text-center">
                    <a href="#share"><span class="glyphicon glyphicon-share-alt"></span></a>
                </div>
            </div>

