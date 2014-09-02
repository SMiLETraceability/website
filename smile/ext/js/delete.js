


$( document ).ready(function() {
  
  
 $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Name: <strong>' + $(e.relatedTarget).attr('data-label') + '</strong>');
        })  
  


$('#confirm-delete-activity').on('show.bs.modal', function(e) {
           $(this).find('.danger').attr('onclick', 'deleteActivity(\"' + $(e.relatedTarget).data('activity-id') + '\");');
           $('.debug-url').html('Name: <strong>' + $(e.relatedTarget).attr('data-label') + '</strong>');
           
       })   
       

/*Editing activity*/

$('#edit-ingredient').on('show.bs.modal', function(e) {
          var id = $(e.relatedTarget).data('activity-id');

          var name = $("#activity_"+id+"_name").text();
          var description = $("#activity_"+id+"_description").text();
          var producer = $("#activity_"+id+"_producer").text().replace('Producer: ','');
          var location = $("#activity_"+id+"_location").text().replace('Location: ','');
          var image = $("#activity_"+id+"_image").attr("src");
          var form_action = $("#edit-ingredient .edit-ingredient-form").attr("action");

          $("#edit-ingredient #ingredient_name").val(name);
          $("#edit-ingredient #ingredient_description").val(description);
          $("#edit-ingredient #ingredient_producer_name").val(producer);
          $("#edit-ingredient #ingredient_producer_location").val(location);
          $("#edit-ingredient #ingredient_image").val(image);

          $("#edit-ingredient .edit-ingredient-form").attr("action",form_action+id);
       })      


$('#edit-production').on('show.bs.modal', function(e) {
          var id = $(e.relatedTarget).data('activity-id');

          var description = $("#activity_"+id+"_description").text();
          var video = $("#activity_"+id+"_video").attr("src");
          var picture = $("#activity_"+id+"_picture").attr("src");
          var form_action = $("#edit-production .edit-production-form").attr("action");

          $("#edit-production #production_description").val(description);
          $("#edit-production #production_video").val(video);
          $("#edit-production #production_picture").val(picture);

          $("#edit-production .edit-production-form").attr("action",form_action+id);
       })      


$('#edit-recipe').on('show.bs.modal', function(e) {
          var id = $(e.relatedTarget).data('activity-id');

          var description = $("#activity_"+id+"_description").text();
          var image = $("#activity_"+id+"_image").attr("src");
          var form_action = $("#edit-recipe .edit-recipe-form").attr("action");

          $("#edit-recipe #recipe_description").val(description);
          $("#edit-recipe #recipe_image").val(image);

          $("#edit-recipe .edit-recipe-form").attr("action",form_action+id);
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
  