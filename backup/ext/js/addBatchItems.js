function addBatchItems(product_name, product_id){ 
  //  $('#myModal').modal('show');

  $("#model-heading").text("Add items for " + product_name );
 // $('#modal-img').attr('src',image_url);
  $('#modal-add-batch-items').modal();
  $('#hidden_field').val(product_id);
    //return false;
}

$(document).ready(function () {
    $("#add-batch-items-btn").click(function () {
        $('#modal-add-batch-items').modal('hide');
      getProduct($('#hidden_field').val(),$('#no_items').val());
       // alert(  $('#hidden_field').val());
    });
});


function getProduct(prod_id, quantity){   
      $.ajax({
        type: "GET",
        url: "getProduct.php",
        dataType: 'json',
        data: "prodid=" + prod_id,

        success:function(response){
        //alert (response.photos[0]);
        var i=0;
        for (i; i < quantity; i++) {
            addItems(response.fn, response.description);
          }

        alert (i + " items added for " + response.fn);

        //addItems(response.fn, response.description);
        //TODO append in the UI
         
        },
          error: function(response){
          //TODO show error on the UI

                      alert('there was an error!');

          }
      });
}

function addItems(prod_name, item_description){
        $.ajax({
        type: "GET",
        url: "addItem.php",
        dataType: 'json',
        data: "prod_name=" + prod_name +"&item_description=" + item_description,
        async: false,
        success:function(response){
        //alert (response);
        //console.log(response);

        //TODO append in the UI
         // alert('success');
        },
          error: function(response){
          //console.log(response);
          //TODO show error on the UI
            alert('there was an error!');
          }
      });
}

/*for (var i = 0; i < 4; i++) {
    var selector = '' + i;
    if (selector.length == 1)
        selector = '0' + selector;
    selector = '#event' + selector;
    array.push($(selector, response).html());
}*/