<!--
<div class="panel panel-default">
	<div class="panel-heading">What did we use?</div>
	<div class="panel-body">
		<?php echo $item->{'context'}->{'description'}?>  
	</div>
</div>
-->


            <div class="panel panel-default" id="activity_<?php echo $item->{'id'}?>">
                <div class="panel-heading"><h4>How was it made?
                <?php if ($page === "product") { ?>
                   <a href="#" data-label="H" data-activity-id="<?php echo $item->{'id'} ?>" class="btn btn-danger btn-xs active" role="button" style="float:right;margin-left:5px; margin-right:5px;" data-toggle="modal" data-target="#confirm-delete-activity">Remove</a>
                   <a href="#" data-activity-id="<?php echo $item->{'id'} ?>" class="btn btn-primary btn-xs active" role="button" style="float:right;margin-left:5px; margin-right:5px;" data-toggle="modal" data-target="#edit-production">Edit</a>        

                <?php }  ?> 
                </h4>
                </div>
                <div class="panel-body">
                <p id="activity_<?php echo $item->{'id'}?>_description"><?php echo nl2br($item->{'context'}->{'description'})?></p>
                
                 <?php if ($item->{'context'}->{'video'} != '') { 
                    //extract youtube id from youtube url
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$item->{'context'}->{'video'},$matches);// $matches[1] should contain the youtube id 
                    $youtube_id = $matches[1];?>
                   <div class="js-video">
                    <iframe id="activity_<?php echo $item->{'id'}?>_video" src="http://www.youtube.com/embed/<?php echo $youtube_id?>" url="<?php echo $item->{'context'}->{'video'}?>" frameborder="0" allowfullscreen></iframe>
                   </div>
                 <?php } ?>
                 
                 <?php if ($item->{'context'}->{'image'} != '') { ?>
                   
                   <img id="activity_<?php echo $item->{'id'}?>_picture" src="<?php echo $item->{'context'}->{'image'}?>" class="panel-image-preview">
                 <?php } ?>
                 
                    <p id="activity_<?php echo $item->{'id'}?>_sort" style="display:none;"><?php echo nl2br($item->{'context'}->{'sort'})?></p>
                </div>
                <div class="panel-footer text-center">
                    <a href="#share"><span class="glyphicon glyphicon-share-alt"></span></a>
                </div>
            </div>

