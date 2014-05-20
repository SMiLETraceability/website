/*
Ajax call for adding the production activity
*/

function addProduction(prod_id){   
    var p_description = $("#production_description").val();
    var p_video = $("#production_video").val();

    //var dataString = 'description='+ description + '&production_video=' + production_video;

    if(p_video=='' || p_description=='')
    {

      alert('Video url or production cannot be empty!');
    }
    else
    {


      $.ajax({
        type: "GET",
        url: "activity.php",
        
        data: "type=" + "PRODUCTION" + "&prodid=" + prod_id + "&p_description=" + p_description + "&p_video=" + p_video,

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
    }
    return false;
}

/*
Ajax call for adding the recipe activity
*/

function addRecipe(prod_id){   
    var r_description = $("#recipe_description").val();
    var r_image = $("#recipe_image").val();

    //var dataString = 'description='+ description + '&production_video=' + production_video;

    if(r_image=='' || r_description=='')
    {

      alert('Image url or recipe description cannot be empty!');
    }
    else
    {


      $.ajax({
        type: "GET",
        url: "activity.php",
        
        data: "type=" + "RECIPE" + "&prodid=" + prod_id + "&r_description=" + r_description + "&r_image=" + r_image,

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
    }
    return false;
}

function addIngerdient(prod_id){   
    var p_description = $("#production_description").val();
    var p_video = $("#production_video").val();

    //var dataString = 'description='+ description + '&production_video=' + production_video;

    if(p_video=='' || p_description=='')
    {

      alert('Video url or production cannot be empty!');
    }
    else
    {


      $.ajax({
        type: "GET",
        url: "activity.php",
        
        data: "type=" + "PRODUCTION" + "&prodid=" + prod_id + "&p_description=" + p_description + "&p_video=" + p_video,

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
    }
    return false;
}
