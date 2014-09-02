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

/*
Ajax call for adding the ingredient activity
*/

function addIngredient(prod_id){   
    var i_name = $("#ingredient_name").val();
    var i_description = $("#ingredient_description").val();
    var i_image = $("#ingredient_image").val();
    var i_producer_name = $("#ingredient_producer_name").val();
    var i_producer_location = $("#ingredient_producer_location").val();

    if(i_name=='' || i_description=='' || i_image=='' || i_producer_location=='' || i_producer_name=='')
    {

      alert('Image url, description, producer name or location cannot be empty!');
    }
    else
    {


      $.ajax({
        type: "GET",
        url: "activity.php",
        
        data: "type=" + "INGREDIENT" + "&prodid=" + prod_id +
         "&i_name=" + i_name + "&i_description=" + i_description + "&i_image=" +
          i_image + "&i_producer_name=" + i_producer_name + "&i_producer_location=" + i_producer_location,

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
