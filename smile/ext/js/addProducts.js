$(document).ready(function() {

var maxInputs       = 20; //maximum input boxes allowed
var inputsWrapper   = $("form .products"); //Input boxes wrapper ID
var addButton       = $(".add-products"); //Add button ID

var y = inputsWrapper.length; //initlal text box count
var fieldCount = 1; //to keep track of text box added

	$(addButton).click(function (e)  //on add input button click
	{
	    if(y <= maxInputs) //max input box allowed
	    {
	        fieldCount++; //text box added increment
	        //add input box
	        $(inputsWrapper).append('<div class="form-group"><div class="col-sm-11"><input type="text" class="form-control" name="product_'+ fieldCount +'" id="product_'+ fieldCount +'" placeholder="Product Name" onkeyup="search_product('+fieldCount+')" required autofocus></div><a href="#" class="removeclass2">&times;</a></div>');
	        y++; //text box increment
	    }
		return false;
	});

	$("body").on("click",".removeclass2", function(e){ //user click on remove text
	    if( y > 1 ) {
	            $(this).parent('div.form-group').remove(); //remove text box
	            y--; //decrement textbox
	    }
		return false;
	}) 

});