$(document).ready(function() {

var maxInputs       = 20; //maximum input boxes allowed
var inputsWrapper   = $("form .theingredients"); //Input boxes wrapper ID
var addButton       = $(".add-more-ingredients"); //Add button ID

var ingredientIndex = inputsWrapper.length; //initlal text box count
var fieldCount = 1; //to keep track of text box added

	$(addButton).click(function (e)  //on add input button click
	{
	    if(ingredientIndex <= maxInputs) //max input box allowed
	    {
	        fieldCount++; //text box added increment
	        console.log(fieldCount);
	        //add input box
	        $(inputsWrapper).append('<div class="ingr"><div class="form-group"><label for="Ingredient Name" class="col-sm-3 control-label">Ingredient Name:</label><div class="col-md-8"><input type="text" class="form-control" id="ingredient_name" name="ingredient_name" placeholder="Ingredient Name" title="Please input a ingredient name." required></div></div><!--End of .form-group--><div class="form-group"><label for="Ingredient Description" class="col-sm-3 control-label">Ingredient Details:</label><div class="col-md-8"><textarea type="text" rows="5" class="form-control" id="ingredient_description" name="ingredient_description" title="Please enter ingredient details." required></textarea></div></div><!--End of .form-group--><div class="form-group"><label for="ingredient_producer_name" class="col-sm-3 control-label">Producer Name:</label><div class="col-md-8"><input type="text" class="form-control" id="ingredient_producer_name" name="ingredient_producer_name" placeholder="Ingredient Producer Name" title="Please input a ingredient producer name." required></div></div><!--End of .form-group--><div class="form-group"><label for="ingredient_producer_location" class="col-sm-3 control-label">Producer Location:</label><div class="col-md-8"><input type="text" class="form-control" id="ingredient_producer_location" name="ingredient_producer_location" placeholder="Ingredient Producer Location" title="Please input a ingredient producer location."  required></div></div><!--End of .form-group--><div class="form-group"><label for="Ingredient Image" class="col-sm-3 control-label">Image URL:</label><div class="col-md-8"><input type="text" class="form-control" id="ingredient_image" name="ingredient_image" placeholder="Please enter an image url" title="Please enter image link." required></div></div><!--End of .form-group--><a href="#" class="removeclass15">&times;</a><br/><hr/><br/></div><!--End ingr-->');
	        ingredientIndex++; //text box increment
	    }
		return false;
	});

	$("body").on("click",".removeclass15", function(e){ //user click on remove text
	    if( ingredientIndex > 1 ) {
	             //remove text box
	            ingredientIndex--; //decrement textbox
	            console.log($(this).parent(".ingr").remove());
	    }
		return false;
	}) 

});