$(document).ready(function() {

var maxInputs       = 20; //maximum input boxes allowed
var inputsWrapper   = $("form .properties"); //Input boxes wrapper ID
var addButton       = $(".add-properties"); //Add button ID

var x = inputsWrapper.length; //initlal text box count
var fieldCount = 1; //to keep track of text box added

	$(addButton).click(function (e)  //on add input button click
	{
	    if(x <= maxInputs) //max input box allowed
	    {
	        fieldCount++; //text box added increment
	        //add input box
	        $(inputsWrapper).append('<div class="form-group"><div class="col-sm-2"><input type="text" class="form-control property" name="property_label_'+ fieldCount +'" id="property_label_'+ fieldCount +'" placeholder="Name" onkeyup="search_property('+fieldCount+')" required autofocus></div><div class="col-sm-9"><input type="text" class="form-control" name="property_value_'+ fieldCount +'" id="property_value_'+ fieldCount +'" placeholder="Value" required autofocus></div><a href="#" class="removeclass">&times;</a></div>');
	        x++; //text box increment
	    }
		return false;
	});

	$("body").on("click",".removeclass", function(e){ //user click on remove text
	    if( x > 1 ) {
	            $(this).parent('div.form-group').remove(); //remove text box
	            x--; //decrement textbox
	    }
		return false;
	}) 

});