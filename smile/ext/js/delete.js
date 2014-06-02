


$( document ).ready(function() {
  
  
 $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Name: <strong>' + $(e.relatedTarget).attr('data-label') + '</strong>');
        })  
  


$('#confirm-delete-activity').on('show.bs.modal', function(e) {
           $(this).find('.danger').attr('onclick', 'deleteActivity(\"' + $(e.relatedTarget).data('activity-id') + '\");');
           $('.debug-url').html('Name: <strong>' + $(e.relatedTarget).attr('data-label') + '</strong>');
           
           
       })   
       


   
});


function deleteActivity(activityID) {
  //alert(activityID);
  $('.modal-header button').click();
  
   $.ajax({
          type: "GET",
          url: "activity-delete.php",
          
          data: "actid=" + activityID, 
          
         
  
          success:function(response){
          console.log(response);
           //TODO append in the UI
           // alert('success');
          },
            error: function(response){
            //TODO show error on the UI
              alert(response);
            }
        });
  
  $('#activity_'+activityID).remove();
   
  return false;
}
  