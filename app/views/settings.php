<?php //#########################################################
// Settings Page
//######################################################### 
namespace pdfgen;

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Docs Content
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$content = <<<EOF
	<p>This page contains all the global settings, which PDF Gen will use as a default when generating PDF's.
	<p>To fill in any blank fields from the posts metadata. For instance, the title and author will default to the posts actual title and author.
	<p>
		To overwrite a global setting, enable advanced mode and make the changes in the PDFGen metabox within the post. <i>Disabling advanced mode will only hide the metaboxes and not remove your data!</i>
	</p>

	<h2>Shortcodes</h2>
	To add a "Print to PDF" button, simply add <br><code>[pdfgen]</code><br> in your content or use the <br><code>&lt;?php echo PDFGEN_make() ?&gt;</code><br> tag in your scripts.
EOF;

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Load in all templates
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$dirs = array($app . 'layouts/*.php', get_template_directory() . '/pdf-templates/*.php');

foreach($dirs as $dir){
	$files = glob($dir);
	foreach($files as $file){
		$layouts[$file] = basename($file, '.php');
	}
}

//=========================================================
// Metaboxes
//=========================================================
$oz->metabox(array(
	'id'	=> 'docs',
	'page'	=> 'pdfgen',
	'context'=> 'side',
	'content' => $content
));
$oz->metabox(array(
	'id'	=> 'layout',
	'label'	=> 'Layouts and Themes',
	'page' 	=> 'pdfgen',
	'fields'=> array(
		'layout'	=> array(
			'type'		=> 'select',
			'options'	=> $layouts
		)
	)
));
$oz->metabox(array(
	'id'	=> 'general',
	'label'	=> 'General Settings',
	'page'	=> 'pdfgen',
	'fields'=> array(
		'author',
		'title',
		'subject',
		'keywords'	=> 'desc=Comma separated list of keywords.',
	)
));
$oz->metabox(array(
	'id'	=> 'header',
	'label'	=> 'Header Settings',
	'page'	=> 'pdfgen',
	'fields'=> array(
		'logo-image'	=> 'type=file'
	)
));
$oz->metabox(array(
	'id'	=> 'advanced',
	'label'	=> 'Advanced Settings',
	'page'	=> 'pdfgen',
	'fields'=> array(
		'classes'	=> 	'desc=Space separated list of extra classes to apply to the PDFGen links, which by default have .pdfgen',
		'content'	=> 	'desc=The text and/or image to use.'
	)
));

//=========================================================
// Menupages
//=========================================================
$oz->menupage(array(
	'id'	=> 'pdfgen',
	'title'	=> 'PDF Gen',
));
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Icons
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
add_action('admin_init', 'pdfgen\icons');
function icons(){ ?>
	<style>
		#toplevel_page_pdfgen .wp-menu-image {
			background: url(<?php echo plugins_url('../img/icon.png', __FILE__) ?>) no-repeat -3px -4px !important;
		}
		#toplevel_page_pdfgen:hover .wp-menu-image, #toplevel_page_pdfgen.wp-has-current-submenu .wp-menu-image {
			background-position: -3px -40px !important;
		}
		#icon-pdfgen {background: url(<?php echo plugins_url('../img/icon.png', __FILE__) ?>) no-repeat -39px -20px;}			
	</style>
<?php }