<?php //#########################################################
// Plugin Name: 	PDFGen
// Description: 	Adds print-to-pdf capabilities to your blog
// Version: 		1.0.0
// Author: 			Carlos @ CommAREus
// Author URI: 		http://commareus.com
//#########################################################
namespace PDFGen;

$path = plugin_dir_path(__FILE__);
$vendor = $path . '/vendor' . '/';
$app = $path . '/app' . '/';
$layouts = array();	//List of loaded layouts

//=========================================================
// Load the awesome TCPDF library
//=========================================================
require($vendor . 'tcpdf/tcpdf/config/tcpdf_config.php');
$tcpdf_include_dirs = array($vendor . '/tcpdf/tcpdf/tcpdf.php');
foreach ($tcpdf_include_dirs as $tcpdf_include_path) {
	if (@file_exists($tcpdf_include_path)) {
		require($tcpdf_include_path);
		break;
	}
}

//=========================================================
// Load the Framework of Oz and then the menupages/metaboxes
//=========================================================
require($vendor . 'oz/framework-of-oz/init.php');
require($app 	. 'views/settings.php');				//Settings admin page
require($app 	. 'shortcodes/pdfgen.php');				//Sets up shortcodes

//=========================================================
// Replace the wordpress view with the PDF
//=========================================================
add_action('wp', 'PDFGen\init');
function init(){
	if(isset($_GET['print-pdf'])){
		require(plugin_dir_path(__FILE__) . '/app/views/pdf.php');
		die();
	}
}