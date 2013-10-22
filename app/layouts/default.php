<?php //#########################################################
// Layout Name: Default
//#########################################################

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Set document information
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($doc['author']);
$pdf->SetAuthor($doc['author']);
$pdf->SetTitle($doc['title']);
$pdf->SetSubject($doc['title']);
$pdf->SetKeywords($doc['keywords']);

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Header
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->SetHeaderData(
	$doc['logo-image'], 
	$doc['logo-width'], 
	$doc['title'], 
	$doc['subtitle'], 
	array(0,64,255), 
	array(0,64,128)
);

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Fonts
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->SetDefaultMonospacedFont($doc['monospaced-font']);
$pdf->setFontSubsetting($doc['font-subsetting']);
$pdf->SetFont($doc['font-family'], '', $doc['font-size'], '', true);

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Styles
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Margins
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->SetMargins($doc['margin-left'], $doc['margin-top'], $doc['margin-right']);
$pdf->SetHeaderMargin($doc['margin-header']);
$pdf->SetFooterMargin($doc['margin-footer']);

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Document Settings
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->SetAutoPageBreak(TRUE, $doc['margin-bottom']);
$pdf->setImageScale($doc['image-scale-ratio']);

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Content
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->AddPage();
$html = apply_filters('the_content', $post->post_content);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

//=========================================================
// Output
//=========================================================
$pdf->Output($post->slug . '.pdf', 'I');
