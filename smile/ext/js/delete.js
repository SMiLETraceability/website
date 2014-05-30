


$( document ).ready(function() {
  
  
 $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Name: <strong>' + $(e.relatedTarget).attr('data-label') + '</strong>');
        })  
  
  
  
   
});

