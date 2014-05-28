/*
*    Print item QR code.
*    @param id - int - the id of the item     
*           prodname - the item name
*/
function printItem(id, itemname) {
    var img = "http://smile.abdn.ac.uk:8080/smile-server/api-1.1/qrcode?data=http://smile.abdn.ac.uk:8080/smile-server/api-1.1/item/"+id;    
    var mname = itemname;
    var printWindow = window.open();
    printWindow.document.write("<html><head><title>"+mname+"</title><style>@media screen{body{width:150px;height:150px;}p{margin:-10px -10px -10px -35px;}} @media print{body{width:58mm;height:58mm;margin:0;}img{display:block;width:50mm;height:50mm;margin-left:auto;margin-right:auto;padding:0px;}#bord{width:58mm; margin:0 auto;}p{margin-top:-20px;font-size:14pt;}}</style></head><body><div id=\"bord\"><img src="+img+" /><br/><p align=\"center\">"+mname+"</p></div></body></html>");
    printWindow.window.print();
}

/*
*    Print collection QR code.
*    @param id - int - the id of the collection     
*           prodname - the collection name
*/
function printCollection(id, colname) {
    var img = "http://smile.abdn.ac.uk:8081/smile-server/api-1.1/qrcode?data=http://smile.abdn.ac.uk/smile-server/api-1.1/collections/"+id;    
    var mname = colname;
    var printWindow = window.open();
    printWindow.document.write("<html><head><title>"+mname+"</title><style>@media screen{body{width:150px;height:150px;}p{margin:-10px -10px -10px -35px;}} @media print{body{width:58mm;height:58mm;margin:0;}img{display:block;width:50mm;height:50mm;margin-left:auto;margin-right:auto;padding:0px;}#bord{width:58mm; margin:0 auto;}p{margin-top:-20px;font-size:14pt;}}</style></head><body><div id=\"bord\"><img src="+img+" /><br/><p align=\"center\">"+mname+"</p></div></body></html>");
    printWindow.window.print();
}

function printItems() {
   
   var items_to_print_id = [];
   var items_to_print_name = [];
   
   var items = { 'ids' : [], 'names' : []};
   
   $('.qr-item').each( function() {
   
   	//$(this).attr("name");
   	//$(this).attr("value");
    if($(this).is(':checked')) {
    
     items['ids'].push($(this).attr("value"));
     items['names'].push($(this).attr("name"));
     //items_to_print_id.push($(this).attr("name"));
     //items_to_print_name.push($(this).attr("value"))    
    }
   }
   );
  
         
   //var qrWindow = window.open("about:blank", '_blank');
   
  // alert(JSON.stringify(items));
   
   var mydata = encodeURIComponent(JSON.stringify(items));
   window.open("PrintMultipleQR.php?data=" + mydata);
   
 }