$(document).ready(function() {

var maxInputs       = 20; //maximum input boxes allowed
var inputsWrapper   = $("form .categories"); //Input boxes wrapper ID
var addButton       = $(".add-categories"); //Add button ID

var zk = inputsWrapper.length; //initlal text box count
var fieldCount = 1; //to keep track of text box added

	$(addButton).click(function (e)  //on add input button click
	{
	    if(zk <= maxInputs) //max input box allowed
	    {
	        fieldCount++; //text box added increment
	        //add input box
	        $(inputsWrapper).append('<div class="form-group"><div class="col-sm-11"><input type="text" class="form-control" name="category_'+ fieldCount +'" id="category_'+ fieldCount +'" placeholder="Category" required autofocus></div><a href="#" class="removeclass5">&times;</a></div>');
	        zk++; //text box increment
	    }
		return false;
	});

	$("body").on("click",".removeclass5", function(e){ //user click on remove text
	    if( zk > 1 ) {
	            $(this).parent('div.form-group').remove(); //remove text box
	            zk--; //decrement textbox
	    }
		return false;
	}) 

});