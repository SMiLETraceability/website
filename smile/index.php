<?php include('core/init.core.php'); ?>
<?php include('header.php'); ?>

<style>
span.glyphicon-pencil {
    font-size: 2em;
}
</style>

<!--Add information about the homepage here-->
<script src="" type="text/javascript">
$(document).ready(function(){
    $("#textToggle").click(function(){
      $("#moreInfo").toggle();
    });
});
</script>

<div class="jumbotron">
<div class="container">
  <h1>TrackMyFood!</h1>
  <h3 class="paratop">more than just a label</h3>
  <p class="paratop">TrackMyFood is a tool that enables rural food producers to communicate detailed information about their products to customers. </p>
  
  <div class="container" id="moreInfo">
  
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">How does it work?</h3>
    </div>
    <div class="panel-body">
    
         <div class="row">
            <div class="col-md-1"><span class="glyphicon glyphicon-pencil" style = "font-size: 4em; margin: 8px;"></span></div>
            <div class="col-md-10"><p>Producers can register into TrackMyFood and provide information about their business (name, location and contact details) and their products (ingredients, provenance, selling points and much more)</p></div>
          </div>
    
    <div class="row">
       <div class="col-md-1"><span class="glyphicon glyphicon-qrcode" style = "font-size: 4em; margin: 8px;"></span></div>
       <div class="col-md-10"><p>The producer can create individual items and TrackMyFood generates a unique code which can be applied to the exiting food packaging. The consumer can use this code to retrieve all the information about the item via a free mobile phone App.</p></div>
     </div>
     
     <div class="row">
        <div class="col-md-1"><span class="glyphicon glyphicon-gift" style = "font-size: 4em; margin: 8px;"></span></div>
        <div class="col-md-10"><p>The producer can create collection of items (on-line orders from customers). TrackMyFood generates a unique code for each collection which can be applied on the delivery box. Couriers can use these to inform the producer about the whereabouts of the delivery.</p></div>
      </div>           
    </div>
  </div>
  
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Who are we?</h3>
    </div>
    
    <div class="panel-body">
    
    <div class="row">
       <div class="col-md-1"><span class="glyphicon glyphicon-info-sign" style = "font-size: 4em; margin: 8px;"></span></div>
       <div class="col-md-10"><p>TrackMyFood has been developed by researchers of the University of Aberdeen as part of the SMiLE project. This is one of the projects of the <a href="http://www.dotrural.ac.uk/"> dot.rural RCUK digital economy Hub</a> which focusing on the rural digital economy.</p></div>
     </div>  
            
    </div>
  </div>
  
  
  </div>
 </div>
</div>


<?php include('footer.php'); ?>