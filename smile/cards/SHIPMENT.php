<div class="panel panel-default">
	<div class="panel-heading"><?php echo 'Checkin '.$i;?></div>
	<div class="panel-body">
		 <table class="table table-bordered">  
           <tbody>
                   <tr><!-- Service-->
                    <td>          
                        <div class="review-form-group form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label label-default="">Service</label>   
                      </div> 
                  </td>
                    <td>
                        <div class="review-form-group form-group col-xs-6 col-sm-12 col-md-10 col-lg-10">
                         	<label label-default=""><?php echo $item->{'context'}->{'service'};?></label>
                         </div>
                    </td>
                    </tr><!-- Service-->


                    <tr><!-- Timestamp-->
                    <td>          
                        <div class="review-form-group form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label label-default="">Timestamp</label>   
                      </div> 
                  </td>
                    <td>
                        <div class="review-form-group form-group col-xs-6 col-sm-12 col-md-10 col-lg-10">
                         	<label label-default=""><?php echo date("F j, Y, g:i a",$item->{'timestamp'});?></label>
                         </div>
                    </td>
                    </tr><!-- Timestamp-->


                    <tr><!-- City-->
                    <td>          
                        <div class="review-form-group form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label label-default="">City</label>   
                      </div> 
                  </td>
                    <td>
                        <div class="review-form-group form-group col-xs-6 col-sm-12 col-md-10 col-lg-10">
                         	<label label-default=""><?php if(isset($item->{'context'}->{'city'}))echo $item->{'context'}->{'city'};?></label>
                         </div>
                    </td>
                    </tr><!-- City-->

                     <tr><!-- State-->
                    <td>          
                        <div class="review-form-group form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label label-default="">State</label>   
                      </div> 
                  </td>
                    <td>
                        <div class="review-form-group form-group col-xs-6 col-sm-12 col-md-10 col-lg-10">
                         	<label label-default=""><?php if(isset($item->{'context'}->{'state'}))echo $item->{'context'}->{'state'};?></label>
                         </div>
                    </td>
                    </tr><!-- State-->

                    <tr><!-- Country-->
                    <td>          
                        <div class="review-form-group form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label label-default="">Country</label>   
                      </div> 
                  </td>
                    <td>
                        <div class="review-form-group form-group col-xs-6 col-sm-12 col-md-10 col-lg-10">
                         	<label label-default=""><?php if(isset($item->{'context'}->{'country'}))echo $item->{'context'}->{'country'};?></label>
                         </div>
                    </td>
                    </tr><!-- Country-->

                    <tr><!-- Country Code-->
                    <td>          
                        <div class="review-form-group form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label label-default="">Country Code</label>   
                      </div> 
                  </td>
                    <td>
                        <div class="review-form-group form-group col-xs-6 col-sm-12 col-md-10 col-lg-10">
                         	<label label-default=""><?php if(isset($item->{'context'}->{'countryCode'}))echo $item->{'context'}->{'countryCode'};?></label>
                         </div>
                    </td>
                    </tr><!-- Country Code-->
        	</tbody>
      </table>

	</div>
</div>

