

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
  
  
  
  
   
});

