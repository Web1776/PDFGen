<?php //#########################################################
// Setup the PDF Gen shortcode
//#########################################################
namespace PDFGen;

add_shortcode('pdfgen', 'PDFGen\shortcode');
function shortcode(){
	global $post;

	$advanced = get_option('pdfgen-advanced');
	$permalink = get_permalink($post->ID);

	$link = '<a href="'.add_query_arg('print-pdf', '1', $permalink).'" class="'.$advanced['classes'].'">'.$advanced['content'].'</a>';
	return $link;
}