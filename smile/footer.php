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
        <!--Geolocation-->
        <script src="ext/js/geolocation.js"></script>
        <?php if ($page === "item-add") { ?>
            <script type="text/javascript">
                getLocation();
            </script>
        <?php } ?>
        <!--QR-->
        <script src="ext/js/printQR.js"></script>
    </body>
</html>