$(document).ready(function() {

var maxInputs       = 20; //maximum input boxes allowed
var inputsWrapper   = $("form .tags"); //Input boxes wrapper ID
var addButton       = $(".add-tags"); //Add button ID

var z = inputsWrapper.length; //initlal text box count
var fieldCount = 1; //to keep track of text box added

	$(addButton).click(function (e)  //on add input button click
	{
	    if(z <= maxInputs) //max input box allowed
	    {
	        fieldCount++; //text box added increment
	        //add input box
	        $(inputsWrapper).append('<div class="form-group"><div class="col-sm-11"><input type="text" class="form-control" name="tag_'+ fieldCount +'" id="tag_'+ fieldCount +'" placeholder="Tag" required autofocus></div><a href="#" class="removeclass3">&times;</a></div>');
	        z++; //text box increment
	    }
		return false;
	});

	$("body").on("click",".removeclass3", function(e){ //user click on remove text
	    if( z > 1 ) {
	            $(this).parent('div.form-group').remove(); //remove text box
	            z--; //decrement textbox
	    }
		return false;
	}) 

});