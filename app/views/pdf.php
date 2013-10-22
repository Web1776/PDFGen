<?php //#########################################################
// View the PDF
// ::Setup defaults
// ::Note, you shouldn't edit this file directly, but instead
// 		overwrite them in your template file!
//#########################################################
namespace PDFGen;

//=========================================================
// Load in data
//=========================================================
$general = get_option('pdfgen-general');
$layout = get_option('pdfgen-layout');
$header = get_option('pdfgen-header');

//=========================================================
// Null out any empty string
//=========================================================
foreach($general as $key=>$data){
	if(!$general[$key]) $general[$key] = null;
}

//=========================================================
// Build out the doc global, which contains our settings
//=========================================================
global $oz;
global $post;
if($post){
	$oz->def($general['author'], 	get_the_author_meta('display_name', $post->post_author));
	$oz->def($general['title'], 	$post->post_title);
	$oz->def($general['subject'], 	'');
	$oz->def($general['keywords'], 	'');


	//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Setup defaults for things not in the Dashboard...yet
	//- - - - - - - - - - - - - - - - - - - - - - - - - - - -
	$doc = array_merge($general, $header);
	//- - - - - - - - - - - - - - - - - - - - - - - - - - - -//

	$oz->def($doc['logo-width'], PDF_HEADER_LOGO_WIDTH);
	$oz->def($doc['subtitle'], 	'By: ' . $doc['author']);

//	$oz->def($doc['monospaced-font'], 	SetDefaultMonospacedFont);
//	$oz->def($doc['monospaced-font'], 	SetDefaultMonospacedFont);
	$oz->def($doc['font-subsetting'], 	true);
	$oz->def($doc['font-family'], 		'dejavusans');
	$oz->def($doc['font-size'], 		14);

	$oz->def($doc['margin-left'], 		PDF_MARGIN_LEFT);
	$oz->def($doc['margin-top'], 		PDF_MARGIN_TOP);
	$oz->def($doc['margin-right'], 		PDF_MARGIN_RIGHT);
	$oz->def($doc['margin-bottom'], 	PDF_MARGIN_BOTTOM);
	$oz->def($doc['margin-header'], 	PDF_MARGIN_HEADER);
	$oz->def($doc['margin-footer'], 	PDF_MARGIN_FOOTER);

	$oz->def($doc['image-scale-ratio'], PDF_IMAGE_SCALE_RATIO);

	//=========================================================
	// Finally, load in our layout and leave wordpress
	// 
	// :: First, look in /pdf-templates/* for a file with the
	// slugified version of the current template name. If not
	// available, then load the default. Otherwise die()
	//=========================================================
	$template = get_template_directory()
				. '/pdf-templates/'
				. basename(get_post_meta($post->ID, '_wp_page_template', true));

	if(is_readable($template))
		require $template;
	elseif(is_readable($layout['layout']))
		require $layout['layout'];

	die();
}