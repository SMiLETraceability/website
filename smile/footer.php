        <div id="footer">
            <div class="container">
                <p class="text-muted">&copy; Copyright <?php echo date('Y'); ?> SMiLE.</p>
            </div><!--End of .container-->
        </div><!--End of .footer-->

        <!--JavaScript files:-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <!--Jquery UI autocomplete-->

        <!--Bootstrap:-->
        <script src="ext/js/bootstrap.min.js"></script>
        <script src="ext/js/docs.min.js"></script>
        <script src="ext/js/bootstrap-select.min.js"></script>
        <script>
            $('select[name="busiKey"]').find('option[value="<?php echo $_SESSION["account"]["currentBusinessKey"]; ?>"]').attr("selected",true);
            $('.selectpicker').selectpicker('show');
        </script>
        <!--Activity-->
        <script src="ext/js/activity.js"></script>

        <script src="ext/js/addBatchItems.js"></script>
        
        <!--Search-->
        <script src="ext/js/search.js"></script>
        <!--Dynamic Forms-->
        <script src="ext/js/addProperties.js"></script>
        <script src="ext/js/addProducts.js"></script>
        <script src="ext/js/addTags.js"></script>
        <script src="ext/js/addIdentifiers.js"></script>
        <script src="ext/js/addCategories.js"></script>
        <script src="ext/js/addIngredients.js"></script>
        <script src="ext/js/addActivities.js"></script>
        
        
        <!--Geolocation-->
        <script src="ext/js/geolocation.js"></script>
        <?php if ($page === "item-add") { ?>
            <script type="text/javascript">
                getLocation();
            </script>
        <?php } ?>
   
        <!--QR-->
        <script src="ext/js/printQR.js"></script>
        
        <!-- Leaflet Maps -->
        <script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
        
        <!--Traceability Web-->
        <script src="ext/js/traceability.js"></script>
        
        <!--Table Pagination-->
       <script src="ext/js/footable.js" type="text/javascript"></script>
       <script src="ext/js/footable.paginate.js" type="text/javascript"></script>
        
        
       <script src="js/vendor/jquery.ui.widget.js"></script>
       <script src="js/jquery.iframe-transport.js"></script>
       <script src="js/jquery.fileupload.js"></script>
        
       <script src="ext/js/uploads.js"></script>
       
       <script src="ext/js/delete.js"></script>
       <script src="ext/js/collections.js"></script>
        
        <script type="text/javascript">
        	$(function () {
        		$('.footable').footable();
        	});
        	
        </script>
        
                
    </body>
</html>