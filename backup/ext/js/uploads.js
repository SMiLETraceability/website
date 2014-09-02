

$( document ).ready(function() {
  
  
  $(function () {
      $('#photo_upload').fileupload({
          dataType: 'json',
          done: function (e, data) {
              $.each(data.result.files, function (index, file) {
                  $('#photo_url').val('http://smile.abdn.ac.uk/smile/server/php/files/'+file.name);                  
              });
          }
      });
  });
  

$(function () {
    $('#photo_upload_recipe').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#recipe_image').val('http://smile.abdn.ac.uk/smile/server/php/files/'+file.name);
            });
        }
    });
})  
 
$(function () {
    $('#photo_upload_ingredient').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#ingredient_image').val('http://smile.abdn.ac.uk/smile/server/php/files/'+file.name);
              
            });
        }
    });
})

$(function () {
    $('#photo_upload_production').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
               $('#production_picture').val('http://smile.abdn.ac.uk/smile/server/php/files/'+file.name);
                
            });
        }
    });
})
  
   
});

