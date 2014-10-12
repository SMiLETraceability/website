<div class="panel panel-default">
	<div class="panel-heading"><h4></h4></div>
	<div class="panel-body">
		<?php
		//var_dump($item);
		 //echo ;
		 echo date("F j, Y, g:i a",$item->{'timestamp'});
		 echo $item->{'context'}->{'service'};
		 if(isset($item->{'context'}->{'city'}))echo $item->{'context'}->{'city'};
		 if(isset($item->{'context'}->{'state'}))echo $item->{'context'}->{'state'};
		 if(isset($item->{'context'}->{'country'}))echo $item->{'context'}->{'country'};
		 if(isset($item->{'context'}->{'countryCode'}))echo $item->{'context'}->{'countryCode'};
		 ?>

	</div>
</div>