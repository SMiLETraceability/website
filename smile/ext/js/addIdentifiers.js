$(document).ready(function() {

var maxInputs       = 20; //maximum input boxes allowed
var inputsWrapper   = $("form .identifiers"); //Input boxes wrapper ID
var addButton       = $(".add-identifiers"); //Add button ID

var xk = inputsWrapper.length; //initlal text box count
var fieldCount = 1; //to keep track of text box added

	$(addButton).click(function (e)  //on add input button click
	{
	    if(xk <= maxInputs) //max input box allowed
	    {
	        fieldCount++; //text box added increment
	        //add input box
	        $(inputsWrapper).append('<div class="form-group"><div class="col-sm-2"><input type="text" class="form-control" name="identifier_label_'+ fieldCount +'" id="identifier_label_'+ fieldCount +'" placeholder="Name" onkeyup="search_identifier('+fieldCount+')" required autofocus></div><div class="col-sm-9"><input type="text" class="form-control" name="identifier_value_'+ fieldCount +'" id="identifier_value_'+ fieldCount +'" placeholder="Value" required autofocus></div><a href="#" class="removeclass4">&times;</a></div>');
	        xk++; //text box increment
	    }
		return false;
	});

	$("body").on("click",".removeclass4", function(e){ //user click on remove text
	    if( xk > 1 ) {
	            $(this).parent('div.form-group').remove(); //remove text box
	            xk--; //decrement textbox
	    }
		return false;
	}) 

});