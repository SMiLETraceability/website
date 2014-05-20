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
                    <h4>What did we use?</h4>
                    <p><?php echo $item->{'context'}->{'description'}?> </p>
                </div>
                <div class="panel-footer text-center">
                    <a href="#share"><span class="glyphicon glyphicon-share-alt"></span></a>
                </div>
            </div>

