/*
* Search a property value using rest:
* @param index - int - the property number.
*/
function search_property(index){   
      //If the input exists:
      if($('#property_label_'+index).length){
            //Get the value of this input:
            var value = $('#property_label_'+index).val();
            //console.log(value);
            //If the input value is not empty:
            if(value != ''){
                  //Make the AJAX call:
                  $.ajax({
                      headers: { "Content-Type": "application/json","ApplicationAuthorization":" aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization":" <?php echo $_SESSION['account']['currentBusinessKey'];?>","Authorization":" <?php echo $_SESSION['account']['apiKey'];?>"},
                      type: "GET",
                      dataType: "json",
                      url: "http://smile.abdn.ac.uk:8080/smile-server/api-1.1/search/property/key/",
                      data: ""+ value,
                      success: function(response){
                                      $('.property_results'+index).html(response);
                                  }
                  });
            //Else, if the input is empty:
            }else{
                  $('.property_results'+index).html("");
            }
      }     
      return false;
}

/*
* Search an identifier value using rest:
* @param index - int - the property number.
*/
function search_identifier(index){   
      //If the input exists:
      if($('#identifier_label_'+index).length){
            //Get the value of this input:
            var value = $('#identifier_label_'+index).val();
            //console.log(value);
            //If the input value is not empty:
            if(value != ''){
                  //Make the AJAX call:
                  $.ajax({
                      headers: { "Content-Type": "application/json","ApplicationAuthorization":" aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization":" <?php echo $_SESSION['account']['currentBusinessKey'];?>","Authorization":" <?php echo $_SESSION['account']['apiKey'];?>"},
                      type: "GET",
                      dataType: "json",
                      url: "http://smile.abdn.ac.uk:8080/smile-server/api-1.1/search/identifier/key/",
                      data: ""+ value,
                      success: function(response){
                                      $('.identifier-results-'+index).html(response);
                                  }
                  });
            //Else, if the input is empty:
            }else{
                  $('.identifier-results-'+index).html("");
            }
      }
      //Mandatory return false statement:
      return false;
}

/*
* Search a product value using rest:
* @param index - int - the property number.
*/
function search_product(index){   
      //If the input exists:
      if($('#product_'+index).length){
            //Get the value of this input:
            var value = $('#product_'+index).val();
            //console.log(value);
            //If the input value is not empty:
            if(value != ''){
                  //Make the AJAX call:
                  $.ajax({
                      headers: { "Content-Type": "application/json","ApplicationAuthorization":" aafa460be460462dcb7e56fda6d2217a","BusinessAuthorization":" <?php echo $_SESSION['account']['currentBusinessKey'];?>","Authorization":" <?php echo $_SESSION['account']['apiKey'];?>"},
                      type: "GET",
                      dataType: "json",
                      url: "http://smile.abdn.ac.uk:8080/smile-server/api-1.1/search/product/fn/",
                      data: ""+ value,
                      success: function(response){
                                      $('.product-results-'+index).html(response);
                                  }
                  });
            //Else, if the input is empty:
            }else{
                  $('.product-results-'+index).html("");
            }
      }
      //Mandatory return false statement:
      return false;
}