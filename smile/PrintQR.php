<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


$item_id = $_REQUEST['itmid'];
$item_name = $_REQUEST['itmname'];



$custom_layout = array(30, 62);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);  

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SMiLE');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// NOTE: 2D barcode algorithms must be implemented on 2dbarcode.php class file.

// set font
$pdf->SetFont('helvetica', '', 10);


// add a page
$resolution= array(62, 29);
$pdf->AddPage('L', $resolution);


$pdf->MultiCell(0,0, 'TrackMyFood! <br/><strong>ID:</strong> ' . $item_id . '<br /> <br />' . $item_name , 0, 'L', 0, 0, '30mm', '3mm', true, 0, true);

// set style for barcode
$style = array(
	'border' => false,
	//'vpadding' => 'auto',
	//'hpadding' => 'auto',
	'padding' => 0,
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 2, // width of a single module in points
	'module_height' => 2 // height of a single module in points
);

//$pdf->MultiCell(5, 5, "la la la la la la ", 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
//$pdf->MultiCell(5, 5, "la la la la la la ", 0, 'L');



// QRCODE,L : QR-CODE Low error correction
$pdf->write2DBarcode('http://smile.abdn.ac.uk:8080/smile-server/api-1.1/item/' . $item_id, 'QRCODE,M', 3, 3, 10, 10, $style, 'N');



//$pdf->Text(30, 6, $item_name, fasle, );



//$pdf->Write(0, $item_name, '', 0, 'C', true, 0, false, false, 0);

//$pdf->Text(30, 12, 'Brisket1');
//$pdf->Text(30, 18, 'Brisket1');


//Close and output PDF document
$pdf->Output('QR-code.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
