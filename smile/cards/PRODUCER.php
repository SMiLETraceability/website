<div class="panel panel-default">
						<div class="panel-heading"><h4>Produced By</h4></div>
	<div class="panel-body">
		<h4><?php echo $b_data_arr->{'name'}; ?></h4>
		<div id="bdesc-txt" class="collapse">
		<p><?php echo $b_data_arr->{'description'}; ?></p>
		<p><strong>Website: </strong><?php echo $b_data_arr->{'websiteUrl'}; ?></p> 
		<p><strong>Email: </strong><?php echo $b_data_arr->{'email'}; ?></p>
		</div>
		
			<p><a href="#" id="bdesc" class="btn btn-primary btn-lg" role="button">Find out more »</a></p>
	
		
		<div>
			<iframe id="producer-map" width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/?output=embed"></iframe>	
		</div>
		
		<div id="map-producer">
		</div>
		
		<!-- to be replaced with openstreetmap -->
		<script type="text/javascript">
		 document.getElementById('producer-map').setAttribute('src', 'https://maps.google.co.uk/?q=<?php echo $b_data_arr->{'address'}->{'postcode'}; ?>&z=10&output=embed');
		</script>
		
	</div>
</div>

