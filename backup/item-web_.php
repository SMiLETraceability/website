<?php include('core/init.core.php');?>
<?php

  //URL of the REST call:
  $url      = APIURL."/item/".$_GET['itmid'];

  //Headers of the REST call:
  $headers  = array("Content-Type: application/json","ApplicationAuthorization: aba778b08bf5d2376ce2c7bd0be60ba7");

  //GET the response from the REST call:
  $response =  rest_get($url,$headers);

  //Decode the JSON object:
  $data_arr = json_decode($response);

?>
<?php include('header.php'); ?>
<div class="container-fluid">
        <div class="row">
          
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

              <h2><?php echo $data_arr->{'name'};?></h2>

              <?php
                $photos = (array) $data_arr->{'product'}->{'photos'}; 
          foreach ($photos as $key => $value) {
            echo "<img src=\"".$value."\" alt=\"\" width=\"300\" height=\"300\">";
          }
              ?>

              <h3>Description: </h3>
              <p><?php echo $data_arr->{'description'};?></p>

          </div><!--End of .main-->
      </div><!--End of .row-->

      <div class="row">
          
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <p> Download our App to Access more information</p>
           <?php echo "<img src=\" asads \" alt=\"\" width=\"300\" height=\"300\">"; ?>

          </div><!--End of .main-->
      </div><!--End of .row-->

  </div><!--Container Ends here-->



<?php include('footer.php'); ?>