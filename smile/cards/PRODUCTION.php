<!--
<div class="panel panel-default">
	<div class="panel-heading">What did we use?</div>
	<div class="panel-body">
		<?php echo $item->{'context'}->{'description'}?>  
	</div>
</div>
-->


            <div class="panel panel-default">
                <div class="panel-heading"><h4>How was it made?</h4></div>
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

