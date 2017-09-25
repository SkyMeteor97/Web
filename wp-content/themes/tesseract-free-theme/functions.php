<?php

if ( ! defined( 'ELEMENTOR_PARTNER_ID' ) ) {
define( 'ELEMENTOR_PARTNER_ID', 2116 );
}

/* TO MAKE PRODUCTION ENV */
$debug_value = get_option( 'tes_debug_theme', '' ) ? get_option( 'tes_debug_theme', '' ) : 'disable';
if($debug_value == 'disable'){
	ini_set('display_errors','Off');
	ini_set('error_reporting', E_ALL );
	define('WP_DEBUG', false);
	define('WP_DEBUG_DISPLAY', false);
}
else{
	ini_set('display_errors','On');
	ini_set('error_reporting', E_ALL );
}


/**
 * Debug function
 */
function tesseract_dd($obj)
{
  echo("<pre>");
  var_dump($obj);
  debug_print_backtrace();
  echo("</pre>");
  die;
}

/**
 * Tesseract functions and definitions
 *
 * @package Tesseract
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
include_once( get_template_directory() . '/function-menu.php' );
include_once( get_template_directory() . '/function-im-ex.php' );
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

if ( ! function_exists( 'tesseract_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tesseract_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tesseract, use a find and replace
	 * to change 'tesseract' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tesseract', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add tyles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', tesseract_fonts_url() ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Add Woocommerce support
	 */
	add_theme_support( 'woocommerce' );


	/*For WooCommerce 3.0.5 version*/ 

	add_theme_support( 'wc-product-gallery-lightbox' );


	add_theme_support( 'wc-product-gallery-zoom' );

	add_theme_support( 'wc-product-gallery-slider' );






	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Set default size.
	set_post_thumbnail_size( 1580, 480, true );

	// Add default size for single pages.
	add_image_size( 'tesseract-large', '1580', '480', true );

	// Add default size for homepage.
	add_image_size( 'tesseract-thumbnail', '210', '150', true );

	// Add default logo size for Jetpack.
	add_image_size( 'tesseract-site-logo', '300', '9999', false );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Header', 'tesseract' ),
		'primary_right' => __( 'Header Right', 'tesseract' ),
		'secondary' => __( 'Footer', 'tesseract' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tesseract_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );
}
endif; // tesseract_setup
add_action( 'after_setup_theme', 'tesseract_setup' );

/* Backwards compatibility
 * @ https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
 * To enable support in existing themes without breaking backwards compatibility,
 * theme authors can check if the callback function exists, and add a shiv in case
 * it does not:
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) :
	function theme_slug_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
endif;

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tesseract_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'tesseract' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears on the left.', 'tesseract' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'tesseract_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tesseract_scripts() {
	global $wp_styles;

	// Enqueue default style
	wp_enqueue_style( 'tesseract-style', get_stylesheet_uri(), array(), '1.0.0' );

	// Google fonts
	wp_enqueue_style( 'tesseract-fonts', tesseract_fonts_url(), array(), '1.0.0' );

    // Social icons style
	wp_enqueue_style( 'tesseract-icons', get_template_directory_uri() . '/css/typicons.css', array(), '1.0.0' );

	/* only enqueue font-awesome stylesheet if not already enqueued */
	if ( array_search( 'font-awesome', $wp_styles->queue ) === false ) {
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0' );
	}

    // Horizontal menu style
	wp_enqueue_style( 'tesseract-site-banner', get_template_directory_uri() . '/css/site-banner.css', array('tesseract-style'), '1.0.0' );
	wp_enqueue_style( 'tesseract-footer-banner', get_template_directory_uri() . '/css/footer-banner.css', array('tesseract-style'), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'tesseract-sidr-style', get_template_directory_uri() . '/css/jquery.sidr.css', array('tesseract-style'), '1.0.0' );
	// Fittext
	wp_enqueue_script( 'tesseract-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '1.0.0', true );

	//Mobile menu
	wp_enqueue_script( 'tesseract-sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array( 'tesseract-fittext' ), '1.0.0', true );


	// Modernizr for old browsers
	wp_enqueue_script( 'tesseract-modernizr', get_template_directory_uri() . '/js/modernizr.custom.min.js', array(), '1.0.0', false );

    // JS helpers (This is also the place where we call the jQuery in array)
	wp_enqueue_script( 'tesseract-helpers-functions', get_template_directory_uri() . '/js/helpers-functions.js', array( 'tesseract-sidr' ), '1.0.0', true );
	wp_enqueue_script( 'tesseract-helpers', get_template_directory_uri() . '/js/helpers.js', array( 'tesseract-helpers-functions' ), '1.0.0', true );

	if ( is_plugin_active('beaver-builder-lite-version/fl-builder.php') || is_plugin_active('beaver-builder/fl-builder.php') ) {
		wp_enqueue_script( 'tesseract-helpers-beaver', get_template_directory_uri() . '/js/helpers-beaver.js', array( 'tesseract-helpers' ), '1.0.0', true );
	}

	// Skip link fix
	wp_enqueue_script( 'tesseract-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the script
	wp_register_script( 'tesseract_helpers', get_template_directory_uri() . '/js/helpers.js' );

	// Localize script (only few lines in helpers.js)

		// First things first: let's get a lighter version of the user-defined search input color applied in the mobile menu - tricky
		// See @ http://stackoverflow.com/questions/11091695/how-to-find-the-hex-code-for-a-lighter-or-darker-version-of-a-hex-code-in-php
		$watermarkColor = get_theme_mod('tesseract_mobmenu_search_color');
		$col = Array(
			hexdec(substr($watermarkColor,1,2)),
			hexdec(substr($watermarkColor,3,2)),
			hexdec(substr($watermarkColor,5,2))
		);
		$lighter = Array(
			255-(255-$col[0])*0.8,
			255-(255-$col[1])*0.8,
			255-(255-$col[2])*0.8
		);
		$lighter = "#".sprintf("%02X%02X%02X", $lighter[0], $lighter[1], $lighter[2]);

    wp_localize_script( 'tesseract_helpers', 'tesseract_vars', array(
		'hpad' 					  						=> get_theme_mod('tesseract_header_height'),
		'fpad'   										=> get_theme_mod('tesseract_footer_height'),
 	) );

	wp_enqueue_script( 'tesseract_helpers' );

	$header_bckRGB = get_theme_mod('tesseract_header_colors_bck_color') ? get_theme_mod('tesseract_header_colors_bck_color') : '#53a9db';

	$opValue = get_theme_mod('tesseract_header_colors_bck_color_opacity') ? get_theme_mod('tesseract_header_colors_bck_color_opacity') : 100;
	$header_bckOpacity = is_numeric($opValue) ? $opValue : 100;

	$hex = $header_bckRGB;
	$header_bckOpacity = $header_bckOpacity / 100;

	preg_match("/\s*(rgba\(\s*[0-9]+\s*,\s*[0-9]+\s*,\s*[0-9]+\s*,\d+\d*\.\d+\))/", $hex, $match);
	$rgba = $match ? true : false;

	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$header_bckColor = "rgb($r, $g, $b)";
	$header_bckColor_home = "rgba($r, $g, $b, $header_bckOpacity)";
	$tesseract_header_opacity_page = get_theme_mod('tesseract_header_opacity_page') ? get_theme_mod('tesseract_header_opacity_page') : 'home';
	if($tesseract_header_opacity_page=='home'){
		if(is_front_page() && !is_home()){
			//echo "Home";
			$header_bckColor_home = "rgba($r, $g, $b,$header_bckOpacity)";
		}
		else{
			//echo "Not Home";
			$header_bckColor_home = "rgba($r, $g, $b,1)";
		}
	}
	else{
		//echo "string";
		global  $post;
		$posttype = get_post_type($post );
		if(((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')){
			$header_bckColor_home = "rgba($r, $g, $b,1)";
		}elseif(is_plugin_active( 'woocommerce/woocommerce.php' )){
			if(is_shop() || is_product() || is_product_category() || is_product_tag() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url()){
				$header_bckColor_home = "rgba($r, $g, $b,1)";
			}
		}
		else{
			$header_bckColor_home = "rgba($r, $g, $b,$header_bckOpacity)";
		}
		
	}
	
	/* footer bck opacity */
	$header_bckRGB1 = get_theme_mod('tesseract_footer_colors_bck_color') ? get_theme_mod('tesseract_footer_colors_bck_color') : '#53a9db';
	
	$opValue1 = (get_theme_mod('tesseract_footer_colors_bck_color_opacity')) ? get_theme_mod('tesseract_footer_colors_bck_color_opacity') : 100;
	$footer_bckOpacity = is_numeric($opValue1) ? $opValue1 : 100;

	$hex = $header_bckRGB1;
	$footer_bckOpacity = $footer_bckOpacity / 100;

	preg_match("/\s*(rgba\(\s*[0-9]+\s*,\s*[0-9]+\s*,\s*[0-9]+\s*,\d+\d*\.\d+\))/", $hex, $match);
	$rgba = $match ? true : false;

	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	//$footer_bckColor = "rgb($r, $g, $b)";
	//$footer_bckColor_home = "rgba($r, $g, $b, $footer_bckOpacity)";
	/* footer bck opacity ends */
	if($opValue1 == 100)
	{
		$footer_bckColor = get_theme_mod('tesseract_footer_colors_bck_color') ? get_theme_mod('tesseract_footer_colors_bck_color') : '#53a9db';
		$footer_bckColor_home = $footer_bckColor;
	}
	else
	{
		$footer_bckColor = "rgb($r, $g, $b)";
		$footer_bckColor_home = "rgba($r, $g, $b, $footer_bckOpacity)";
	}

	//HEADER and FOOTER
	$header_textColor = get_theme_mod('tesseract_header_colors_text_color') ? get_theme_mod('tesseract_header_colors_text_color') : '#ffffff';

	$header_search_textColor = get_theme_mod('tesseract_header_search_text_color') ? get_theme_mod('tesseract_header_search_text_color') : '#ffffff';

	$header_linkColor = get_theme_mod('tesseract_header_colors_link_color') ? get_theme_mod('tesseract_header_colors_link_color') : '#ffffff';

	$header_linkHoverColor = get_theme_mod('tesseract_header_colors_link_hover_color') ? get_theme_mod('tesseract_header_colors_link_hover_color') : '#d1ecff';

	$footer_bckColor = get_theme_mod('tesseract_footer_colors_bck_color') ? get_theme_mod('tesseract_footer_colors_bck_color') : '#53a9db';

	$footer_textColor = get_theme_mod('tesseract_footer_colors_text_color') ? get_theme_mod('tesseract_footer_colors_text_color') : '#ffffff';

	$footer_headingColor = get_theme_mod('tesseract_footer_colors_heading_color') ? get_theme_mod('tesseract_footer_colors_heading_color') : '#ffffff';

	$footer_linkColor = get_theme_mod('tesseract_footer_colors_link_color') ? get_theme_mod('tesseract_footer_colors_link_color') : '#ffffff';

	$footer_linkHoverColor = get_theme_mod('tesseract_footer_colors_link_hover_color') ? get_theme_mod('tesseract_footer_colors_link_hover_color') : '#d1ecff';

	$header_sub_menu_hover_color = get_theme_mod('tesseract_header_sub_menu_hover_color') ? get_theme_mod('tesseract_header_sub_menu_hover_color') : '#000';
	
	// BLOGLIST TEXT COLOR
	$bloglist_textColor = get_theme_mod('tesseract_blog_titlecolor') ? get_theme_mod('tesseract_blog_titlecolor') : '#000000';

	$bloglist_title = get_theme_mod('tesseract_blog_post_title');
	//echo ' >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>'.$bloglist_textColor." <<<<<<<<<<<<<<< ".$bloglist_title;
	if($bloglist_title)
	{
		if($bloglist_title == 'remove')
		{
			$display_title = 'none';
		}
		else
		{
			$display_title = 'block';
		}
	}
	else
	{
		$display_title = 'block';
	}
	
	// BLOGLIST BUTTON and TEXT COLOR
	$bloglist_buttonColor = get_theme_mod('tesseract_blog_buttoncolor') ? get_theme_mod('tesseract_blog_buttoncolor') : '#ffffff';
	
	$bloglist_buttonbgColor = get_theme_mod('tesseract_blog_buttonbgcolor') ? get_theme_mod('tesseract_blog_buttonbgcolor') : '#ffffff';

	$add_content_borderColor_array = tesseract_hex2rgb( $footer_linkColor );
	$add_content_borderColor = implode( ', ', $add_content_borderColor_array );
	
	
	// WOOCOMMERCE OPTION //
	$wooproduct_buttonbgColor = get_theme_mod('tesseract_woocommerce_buttonbgcolor') ? get_theme_mod('tesseract_woocommerce_buttonbgcolor') : '#000000';
	
	// WOOCOMMERCE PRODUCT TEXT COLOR
	$productlist_textColor = get_theme_mod('tesseract_woocommerce_titlecolor') ? get_theme_mod('tesseract_woocommerce_titlecolor') : '#000000';
	
	// WOOCOMMERCE SHOP PRICE COLOR
	$shopprice_textColor = get_theme_mod('tesseract_woocommerce_pricecolor') ? get_theme_mod('tesseract_woocommerce_pricecolor') : '#000000';
	

	//MOBMENU
	$mobmenu_bckColor = get_theme_mod('tesseract_mobmenu_background_color') ? get_theme_mod('tesseract_mobmenu_background_color') : '#336ca6';
	$mobmenu_linkColor = get_theme_mod('tesseract_mobmenu_link_color') ? get_theme_mod('tesseract_mobmenu_link_color') : '#fff';
	$mobmenu_linkHoverColor = get_theme_mod('tesseract_mobmenu_link_hover_color') ? get_theme_mod('tesseract_mobmenu_link_hover_color') : '#fff';

	list($lc_r, $lc_g, $lc_b) = sscanf($mobmenu_linkColor, "#%02x%02x%02x");
	$mob_rgb_linkColor_submenu = "rgba($lc_r, $lc_g, $lc_b, 0.8)";

	list($lhc_r, $lhc_g, $lhc_b) = sscanf($mobmenu_linkHoverColor, "#%02x%02x%02x");
	$mob_rgb_linkHoverColor_submenu = "rgba($lhc_r, $lhc_g, $lhc_b, 0.8)";

	$mobmenu_linkHoverBckColor_option = get_theme_mod('tesseract_mobmenu_link_hover_background_color') ? get_theme_mod('tesseract_mobmenu_link_hover_background_color') : 'dark';
	$mobmenu_linkHoverBckColor_option_custom = get_theme_mod('tesseract_mobmenu_link_hover_background_color_custom');
	switch ( $mobmenu_linkHoverBckColor_option ) {

		case 'custom':
			$mobmenu_linkHoverBckColor = $mobmenu_linkHoverBckColor_option_custom;
			break;
		case 'light':
			$mobmenu_linkHoverBckColor = 'rgba(255, 255, 255, 0.1)';
			break;
		default:
			$mobmenu_linkHoverBckColor = 'rgba(0, 0, 0, 0.2)';
	}

	$mobmenu_shadowColor_option = get_theme_mod('tesseract_mobmenu_shadow_color') ? get_theme_mod('tesseract_mobmenu_shadow_color') : 'dark';
	$mobmenu_shadowColor_option_custom = get_theme_mod('tesseract_mobmenu_shadow_color_custom') ? get_theme_mod('tesseract_mobmenu_shadow_color_custom') : 'dark';

	switch ( $mobmenu_shadowColor_option ) {
		case 'custom':
			list($shad_r, $shad_g, $shad_b) = sscanf($mobmenu_shadowColor_option_custom, "#%02x%02x%02x");
			break;
		case 'light':
			$shad_r = 255;
			$shad_g = 255;
			$shad_b = 255;
			break;
		default:
			$shad_r = 0;
			$shad_g = 0;
			$shad_b = 0;
	}

	$mobmenu_searchColor = get_theme_mod('tesseract_mobmenu_search_color');
	list($sc_r, $sc_g, $sc_b) = sscanf($mobmenu_searchColor, "#%02x%02x%02x");
	$mobmenu_searchColorRgb = "rgba($sc_r, $sc_g, $sc_b, 0.6)";

	$mobmenu_searchBckColor = get_theme_mod('tesseract_mobmenu_search_background_color');
	$mobmenu_searchBckColor = ( $mobmenu_searchBckColor == 'dark' ) ? 'rgba(0, 0, 0, .15)': 'rgba(255, 255, 255, 0.15)';

	$mobmenu_socialBckColor = get_theme_mod('tesseract_mobmenu_social_background_color');
	$mobmenu_socialBckColor = ( $mobmenu_socialBckColor == 'dark' ) ? 'rgba(0, 0, 0, .15)': 'rgba(255, 255, 255, 0.15)';

	$mobmenu_buttonsBckColor_option = get_theme_mod('tesseract_mobmenu_buttons_background_color') ? get_theme_mod('tesseract_mobmenu_buttons_background_color') : 'dark';
	$mobmenu_buttonsBckColor_option_custom = get_theme_mod('tesseract_mobmenu_buttons_background_color_custom');
	switch ( $mobmenu_buttonsBckColor_option ) {

		case 'custom':
			$mobmenu_buttonsBckColor = $mobmenu_buttonsBckColor_option_custom;
			break;
		case 'light':
			$mobmenu_buttonsBckColor = 'rgba(255, 255, 255, 0.1)';
			break;
		default:
			$mobmenu_buttonsBckColor = 'rgba(0, 0, 0, 0.2)';
	}

	$mobmenu_buttons_textColor = get_theme_mod('tesseract_mobmenu_buttons_text_color');
	$mobmenu_buttons_linkColor = get_theme_mod('tesseract_mobmenu_buttons_link_color');
	$mobmenu_buttons_linkHoverColor = get_theme_mod('tesseract_mobmenu_buttons_link_hover_color');

	$mobmenu_buttons_maxbtnSepColor = get_theme_mod('tesseract_mobmenu_maxbtn_sep_color');
	$mobmenu_buttons_maxbtnSepColor = ( $mobmenu_buttons_maxbtnSepColor == 'dark' ) ? 'inset 0 -1px rgba(0, 0, 0, .1)': 'inset 0 -1px rgba(255, 255, 255, 0.1)';

	$dynamic_styles_mobmenu = ".sidr {
		background-color: " . $mobmenu_bckColor . ";
		}

	.sidr .sidr-class-menu-item a,
	.sidr .sidr-class-menu-item span { color: " . $mobmenu_linkColor . "; }


	.sidr .sidr-class-menu-item ul li a,
	.sidr .sidr-class-menu-item ul li span {
		color: " . $mob_rgb_linkColor_submenu . ";
	}

	.sidr .sidr-class-menu-item a:hover,
	.sidr .sidr-class-menu-item span:hover,
	.sidr .sidr-class-menu-item:first-child a:hover,
	.sidr .sidr-class-menu-item:first-child span:hover { color: " . $mobmenu_linkHoverColor . "; }

	.sidr .sidr-class-menu-item ul li a:hover,
	.sidr .sidr-class-menu-item ul li span:hover,
	.sidr .sidr-class-menu-item ul li:first-child a:hover,
	.sidr .sidr-class-menu-item ul li:first-child span:hover { color: " . $mob_rgb_linkHoverColor_submenu . "; }

	.sidr ul li > a:hover,
	.sidr ul li > span:hover,
	.sidr > div > ul > li:first-child > a:hover,
	.sidr > div > ul > li:first-child > span:hover,
	.sidr ul li ul li:hover > a,
	.sidr ul li ul li:hover > span {
		background: " . $mobmenu_linkHoverBckColor . ";

		}

	/* Shadows and Separators */

	.sidr ul li > a,
	.sidr ul li > span,
	#sidr-id-header-button-container-inner > * {
		-webkit-box-shadow: inset 0 -1px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . " , 0.2);
		-moz-box-shadow: inset 0 -1px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . " , 0.2);
		box-shadow: inset 0 -1px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . " , 0.2);
	}

	.sidr > div > ul > li:last-of-type > a,
	.sidr > div > ul > li:last-of-type > span,
	#sidr-id-header-button-container-inner > *:last-of-type {
		box-shadow: none;
		}

	.sidr ul.sidr-class-hr-social li a,
	.sidr ul.sidr-class-hr-social li a:first-child {
		-webkit-box-shadow: 0 1px 0 0px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . ", .25);
		-moz-box-shadow: 0 1px 0 0px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . ", .25);
		box-shadow: 0 1px 0 0px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . ", .25);
	}

	/* Header Right side content */

	.sidr-class-search-field,
	.sidr-class-search-form input[type='search'] {
		background: " . $mobmenu_searchBckColor . ";
		color: " . $mobmenu_searchColor . ";
	}

	.sidr-class-hr-social {
		background: " . $mobmenu_socialBckColor . ";
	}

	#sidr-id-header-button-container-inner,
	#sidr-id-header-button-container-inner > h1,
	#sidr-id-header-button-container-inner > h2,
	#sidr-id-header-button-container-inner > h3,
	#sidr-id-header-button-container-inner > h4,
	#sidr-id-header-button-container-inner > h5,
	#sidr-id-header-button-container-inner > h6 {
		background: " . $mobmenu_buttonsBckColor . ";
		color: " . $mobmenu_buttons_textColor . ";
	}

	#sidr-id-header-button-container-inner a,
	#sidr-id-header-button-container-inner button {
		color: " . $mobmenu_buttons_linkColor . ";
	}

	#sidr-id-header-button-container-inner a:hover,
	#sidr-id-header-button-container-inner button:hover {
		color: " . $mobmenu_buttons_linkHoverColor . ";
	}

	/*
	.sidr ul li > a,
	.sidr ul li > span,
	#header-button-container *,
	#sidr-id-header-button-container-inner button {
		-webkit-box-shadow: " . $mobmenu_buttons_maxbtnSepColor . ";
		-moz-box-shadow: " . $mobmenu_buttons_maxbtnSepColor . ";
		box-shadow: " . $mobmenu_buttons_maxbtnSepColor . ";
	}
	*/
	";

	wp_add_inline_style( 'tesseract-sidr-style', $dynamic_styles_mobmenu );

	// HEADER & HEADER LOGO HEIGHT, HEADER WIDTH PROPS

	$header_logoHeight = get_theme_mod('tesseract_header_logo_height') ? get_theme_mod('tesseract_header_logo_height') : 40;

	$headerHeightInit = get_theme_mod('tesseract_header_height');
	$headerHeight = is_numeric($headerHeightInit) ? $headerHeightInit : 10;

	$headerWidthProp = is_integer( get_theme_mod('tesseract_header_blocks_width_prop') ) ? get_theme_mod('tesseract_header_blocks_width_prop') : 60;

	$dynamic_styles_header = ".site-header,
	.main-navigation ul ul a,
	#header-right-menu ul ul a,
	.site-header .cart-content-details { background-color: " . $header_bckColor . "; }
	.site-header .cart-content-details:after { border-bottom-color: " . $header_bckColor . "; }

	.home .site-header,
	#page .site-header,
	.home .main-navigation ul ul a,
	.top-navigation li ul.sub-menu li a,
	.home #header-right ul ul a,
	.home .site-header .cart-content-details { background-color: " . $header_bckColor_home . "; }
	.home .site-header .cart-content-details:after { border-bottom-color: " . $header_bckColor_home . "; }

	.site-header,
	#header-button-container-inner,
	#header-button-container-inner a,
	.site-header h1,
	.site-header h2,
	.site-header h3,
	.site-header h4,
	.site-header h5,
	.site-header h6,
    .site-header h2 a{ color: " . $header_textColor . "; }

	#masthead_TesseractTheme .search-field { color: " . $header_search_textColor . "; }
	
	.site-header a,
	.main-navigation ul ul a,
	#header-right-menu ul li a,
	.menu-open,
	.dashicons.menu-open,
	.menu-close,
	.dashicons.menu-close { color: " . $header_linkColor . "; }

	.site-header a:hover,
	.main-navigation ul ul a:hover,
	#header-right-menu ul li a:hover,
	.menu-open:hover,
	.dashicons.menu-open:hover,
	.menu-close:hover,
	.dashicons.menu-open:hover { color: " . $header_linkHoverColor . "; }

	/* Header logo height */

	#site-banner .site-logo img {
		height: " . $header_logoHeight . "px;
		}

	#masthead_TesseractTheme {
		padding-top: " . $headerHeight . "px;
		padding-bottom: " . $headerHeight . "px;
		}

	/* Header width props */

	#site-banner-left {
		width: " . $headerWidthProp . "%;
		}

	#site-banner-right {
		width: " . ( 100 - $headerWidthProp ) . "%;
		}
	.top-navigation li ul.sub-menu li a:hover{ background:". $header_sub_menu_hover_color ."!important;}
	";
	$hcContent = (get_theme_mod('tesseract_header_right_content')) ? get_theme_mod('tesseract_header_right_content') : 'nothing';
	$wooCart = (get_theme_mod('tesseract_woocommerce_headercart')) ? get_theme_mod('tesseract_woocommerce_headercart') : 'disable';
	$displayWooCart = ( is_plugin_active('woocommerce/woocommerce.php') && ( $wooCart == 1 ) );
	$cartColor = get_theme_mod( 'tesseract_woocommerce_cartcolor') ? get_theme_mod('tesseract_woocommerce_cartcolor') : '#fff';
	$hcContent = ( !$displayWooCart && ( $hcContent == 'nothing' ) );

	if ( $hcContent && $wooCart=='disable' ):
		$dynamic_styles_header .= "#site-banner-left {
				width: 100%;
			}

			#site-banner-right {
				display: none;
				padding: 0;
				margin: 0;
			}
		";
	endif;

	//Horizontal - fullwidth header
	if ( get_theme_mod('tesseract_header_width') == 'fullwidth' ) {

        $dynamic_styles_header .= "#site-banner {
			max-width: 100%;
			padding-left: 0;
			padding-right: 0;
		}
		";
	}

	$dynamic_styles_header .= "
		.icon-shopping-cart, .woocart-header .cart-arrow, .woocart-header .cart-contents {
			color: {$cartColor};
		}
	";


	wp_add_inline_style( 'tesseract-site-banner', $dynamic_styles_header );

	// FOOTER & FOOTER LOGO HEIGHT, FOOTER WIDTH PROPS

	$footerWidthProp = get_theme_mod('tesseract_footer_blocks_width_prop') ? get_theme_mod('tesseract_footer_blocks_width_prop') : 60;

	$footer_logoHeight = get_theme_mod('tesseract_footer_logo_height') ? get_theme_mod('tesseract_footer_logo_height') : 40;

	$footerHeightInit = get_theme_mod('tesseract_footer_height');
	$footerHeight = is_numeric($footerHeightInit) ? $footerHeightInit : 10;

	$dynamic_styles_footer = ".site-footer {
		background-color: " . $footer_bckColor . ";
		color: " . $footer_textColor . "
	}
	
	.site-footer { background-color: " . $footer_bckColor . "; }

	.home .site-footer,
	.home .site-footer { background-color: " . $footer_bckColor_home . "; }
	

	#colophon_TesseractTheme .search-field { color: " . $footer_textColor . "; }
	#colophon_TesseractTheme .search-field.watermark { color: #ccc; }

	#colophon_TesseractTheme h1,
	#colophon_TesseractTheme h2,
	#colophon_TesseractTheme h3,
	#colophon_TesseractTheme h4,
	#colophon_TesseractTheme h5,
	#colophon_TesseractTheme h6 { color: " . $footer_headingColor . "; }
	
	
	#bloglist_title h1.entry-title,
	#bloglist_title h2.entry-title,
	#bloglist_title h3.entry-title,
	#bloglist_title h4.entry-title,
	#bloglist_title h5.entry-title,
	#bloglist_title h6.entry-title, 
	#bloglist_title h2.entry-title a,
	#blogpost_title h1.entry-title{ color: " . $bloglist_textColor . "; display: " .$display_title. "; }
	

	#bloglist_morebutton .blmore,
	#bloglist_morebutton .blmore a,
	#bloglist_morebutton .blmore a:hover{ color: " . $bloglist_buttonColor . "; }
	
	
	.summary h1,
	#prodlist_title h3, 
	#prodlist_title h3 a{ color: " . $productlist_textColor . "; }
	
	.woocommerce div.product p.price, .woocommerce div.product span.price,
	.wooshop-price .sales-price, .wooshop-price .regular-pricenew{ color: " . $shopprice_textColor . "; }
	
	
	

	#colophon_TesseractTheme a { color: " . $footer_linkColor . "; }

	#colophon_TesseractTheme a:hover { color: " . $footer_linkHoverColor . "; }

	#horizontal-menu-before,
	#horizontal-menu-after { border-color: rgba(" . $add_content_borderColor . ", 0.25); }

	#footer-banner.footbar-active { border-color: rgba(" . $add_content_borderColor . ", 0.15); }

	#footer-banner .site-logo img { height: " . $footer_logoHeight . "px; }

	#colophon_TesseractTheme {
		padding-top: " . $footerHeight . "px;
		padding-bottom: " . $footerHeight . "px;
		}

	#horizontal-menu-wrap {
		width: " . $footerWidthProp . "%;
		}

	#footer-banner-right	{
		width: " . ( 100 - intval($footerWidthProp) ) . "%;
		}

	";

	//Horizontal - fullwidth footer
	$full_width = (get_theme_mod('tesseract_footer_width')) ? get_theme_mod('tesseract_footer_width') : 'fullwidth';
	if ( $full_width == 'fullwidth' ) {

        $dynamic_styles_footer .= "#footer-banner {
			max-width: 100%;
			padding: 0 20px;
		}";

	}

	wp_add_inline_style( 'tesseract-footer-banner', $dynamic_styles_footer );

}

add_action( 'wp_enqueue_scripts', 'tesseract_scripts' );

function tesseract_noscript() {

	echo '<noscript><style>#sidebar-footer aside {border: none!important;}</style></noscript>';

	}

add_action('wp_head', 'tesseract_noscript');

function tesseract_footer_branding() {
	do_action( 'tesseract_footer_branding' );
}

//$str_theme_foob = str_rot13(implode('',array('g','r','f','f','r','e','n','p','g','_','s','b','b','g','r','e','_','o','e','n','a','q','v','a','t')));
$str_theme_foob = 'tesseract_footer_branding';
 
//$str_theme_foob_output = str_rot13(implode('',array('g','r','f','f','r','e','n','p','g','_','s','b','b','g','r','e','_','o','e','n','a','q','v','a','t','_','b','h','g','c','h','g')));
 $str_theme_foob_output = 'tesseract_footer_branding_output';
 
function tesseract_footer_branding_output() {
	
	//$str_foobclass = str_rot13(implode('',array('q','r','f','v','t','a','r','e')));
	$str_foobclass = 'designer';
	
	//$str_foobid = str_rot13(implode('',array('s','b','b','g','r','e','-','o','n','a','a','r','e','-','e','v','t','u','g')));
	$str_foobid = 'footer-banner-right';
	
	//$str_foobtby = str_rot13(implode('',array('G','u','r','z','r',' ','o','l',' ','%','f')));
	$str_foobtby = 'Theme by %s';
	
	//$str_foobturl = str_rot13(implode('',array('g','r','f','f','r','e','n','p','g','g','u','r','z','r','.','p','b','z')));
	$str_foobturl = 'tesseracttheme.com';
	
	//$str_foobtdis = str_rot13(implode('',array('G','r','f','f','r','e','n','p','g')));
	$str_foobtdis = 'Tesseract';
	
	echo '<div id="'.$str_foobid.'" class="'.$str_foobclass.'"><div class="table"><div class="table'.'-cell"><strong>';
	

	/*if(stristr(__( $str_foobtby, 'tesseract' ),'%s') === false){
	
		echo '<a href="http://'.$str_foobturl.'">'.sprintf( __( $str_foobtby, 'tesseract' ),$str_foobtdis).'</a>';
		
	}else{
		
		// if changes in language file
		echo '<a href="http://'.$str_foobturl.'">'.sprintf( $str_foobtby,$str_foobtdis).'</a>';
		
	}*/
	
	if(stristr(__( 'Theme by %s', 'tesseract' ),'%s') === false){
	
		echo '<a href="https://'.$str_foobturl.'">'.sprintf( __( 'Theme by %s', 'tesseract' ),$str_foobtdis).'</a>';
		
	}else{
		
		// if changes in language file
		echo '<a href="https://'.$str_foobturl.'">'.sprintf( 'Theme by %s',$str_foobtdis).'</a>';
		
	}

	//echo '</strong>&nbsp;&nbsp;<strong><a href="http://'.$str_foobturl.'"><img src="//tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" /></a></strong></div></div></div>';
	echo '</strong>&nbsp;&nbsp;<strong><a href="https://'.$str_foobturl.'"><img src="https://tylers.s3.amazonaws.com/uploads/2016/08/10074829/Drawing1.png" alt="Drawing" width="16" height="16" /></a></strong></div></div></div>';

}
 
add_action($str_theme_foob,$str_theme_foob_output, 10);


/**
 * Output featured image on blog and archive pages.
 */

function tesseract_output_featimg_blog() {

	global $post;

	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$featImg_display = (get_theme_mod('tesseract_blog_display_featimg2')) ? get_theme_mod('tesseract_blog_display_featimg2') : 'yes';
	$featImg_pos = (get_theme_mod('tesseract_blog_featimg_pos')) ? get_theme_mod('tesseract_blog_featimg_pos') : 'below';

	$w = $thumbnail[1];
	$h = $thumbnail[2];
	$bw = 720;
	$wr = $w/$bw;
	$hr = $h/$wr;

	$origRatio = $hr;

	$ratio = get_theme_mod( 'tesseract_blog_featimg_size' );
	$ratio = ( isset($ratio) ) ? $ratio : 'default';
	switch ( $ratio ) :

		case 'tv': $featImg_height = ( $origRatio >= 540 ) ? 540 : $origRatio; break;
		case 'hdtv': $featImg_height = ( $origRatio >= 405 ) ? 405 : $origRatio; break;
		case 'theater1': $featImg_height = ( $origRatio >= 390 ) ? 390 : $origRatio; break;
		case 'theater2': $featImg_height = ( $origRatio >= 306 ) ? 306 : $origRatio; break;
		case 'default';
		case 'pixel';
		default: $featImg_height = $origRatio; break;

	endswitch;

	$pxratio = get_theme_mod( 'tesseract_blog_featimg_px_size' );
	$featImg_height = ( isset($pxratio) && ( $ratio == 'pixel' ) ) ? $pxratio : $featImg_height;
	//echo "----> ".$featImg_display;
	if ( isset($featImg_display) && ( $featImg_display == 'imgBlogList' ) || ( $featImg_display == 'yes' ) ) { ?>

    	<?php if ($featImg_pos == 'below'){'below-title';} elseif ($featImg_pos == 'above'){'above-title';} elseif ($featImg_pos == 'left'){'left-title';} elseif ($featImg_pos == 'right'){'right-title';}  ?>
		<a class="entry-post-thumbnail <?php echo $featImg_pos; ?>" href="<?php the_permalink(); ?>">
			<img src="<?php echo esc_url( $thumbnail[0] ); ?>" />
		</a>
	<?php }

}
/**
 * Output featured image on blog single pages.
 */

function tesseract_output_featimg_blog_single() {

	global $post;

	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$featImg_display = (get_theme_mod('tesseract_blog_display_featimg2')) ? get_theme_mod('tesseract_blog_display_featimg2') : 'yes';
	$featImg_pos = (get_theme_mod('tesseract_blog_featimg_pos')) ? get_theme_mod('tesseract_blog_featimg_pos') : 'below';
	//echo "---| ".$featImg_display." | --- ".$featImg_pos;
	$w = $thumbnail[1];
	$h = $thumbnail[2];
	$bw = 720;
	$wr = $w/$bw;
	$hr = $h/$wr;

	$origRatio = $hr;

	$ratio = get_theme_mod( 'tesseract_blog_featimg_size' );
	$ratio = ( isset($ratio) ) ? $ratio : 'default';
	switch ( $ratio ) :

		case 'tv': $featImg_height = ( $origRatio >= 540 ) ? 540 : $origRatio; break;
		case 'hdtv': $featImg_height = ( $origRatio >= 405 ) ? 405 : $origRatio; break;
		case 'theater1': $featImg_height = ( $origRatio >= 390 ) ? 390 : $origRatio; break;
		case 'theater2': $featImg_height = ( $origRatio >= 306 ) ? 306 : $origRatio; break;
		case 'default';
		case 'pixel';
		default: $featImg_height = $origRatio; break;

	endswitch;

	$pxratio = get_theme_mod( 'tesseract_blog_featimg_px_size' );
	$featImg_height = ( isset($pxratio) && ( $ratio == 'pixel' ) ) ? $pxratio : $featImg_height;
	//echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> '.get_theme_mod('tesseract_blog_display_featimg2');
	if ( isset($featImg_display) && ( $featImg_display == 'imgBlogSngl' ) || ( $featImg_display == 'yes' ) ) { ?>

    	<?php if ($featImg_pos == 'below'){'below-title';} elseif ($featImg_pos == 'above'){'above-title';} elseif ($featImg_pos == 'left'){'left-title';} elseif ($featImg_pos == 'right'){'right-title';}  ?>
		<a class="entry-post-thumbnail <?php echo $featImg_pos; ?>" href="<?php the_permalink(); ?>">
			<img src="<?php echo esc_url( $thumbnail[0] ); ?>" />
		</a>
	<?php }

}

function tesseract_output_menu( $cont, $contClass, $location, $depth ) {

	switch( $location ) :

		case 'primary': $hblox = 'header'; break;
		case 'primary_right': $hblox = 'header_right'; break;
		case 'secondary': $hblox = 'footer'; break;
		case 'secondary_right': $hblox = 'footer_right'; break;

	endswitch;

    $locs = get_theme_mod('nav_menu_locations');

	$menu = get_theme_mod('tesseract_' . $hblox . '_menu_select');
	$locs['secondary_right']=3;
    $locs['primary_right']=2;
    $isMenu = get_terms( 'nav_menu' ) ? TRUE : FALSE;
    $locReserved = ( $locs[$location] ) ? TRUE : FALSE;
	$menuSelected = ( is_string($menu) ) ? TRUE : FALSE;

    // IF the location set as parameter has an associated menu, it's returned as a key-value pair in the $locs array - where the key is the location and the value is the menu ID. We need this latter to get the menu slug required later -in some cases- in the wp_nav_menu params array.
    if ( $locReserved ) {
        $menu_id = $locs[$location]; // $value = $array[$key]
        $menuObject = wp_get_nav_menu_object( $menu_id );
        $menu_slug = $menuObject->slug;
    };
	$custSet = ( $menuSelected && ( $menu !== 'none' ) );

    if ( empty( $isMenu ) ) : //Case 1 - IF THERE'S NO MENU CREATED -> easy scenario: no location setting, no customizer setting ( this latter only appears if there IS at least one menu created by the theme user ) => display basic menu

        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_class' => 'nav-menu',
			'container_class' => '',
            'container' => FALSE,
            'depth' => $depth
            )
        );

    elseif ( !empty( $isMenu ) ) : //Case 2 - THERE'S AT LEAST ONE MENU CREATED

        if ( !$custSet && $locReserved ) { //no setting in customizer OR dropdown is set to blank value, location SET in Menus section => display menu associated with this location in Appearance ->
            wp_nav_menu( array(
               // 'menu' => $menuSlug,
				'menu' => $menu_slug, 
                'theme_location' => $location,
                'menu_class' => 'nav-menu',
				'container_class' => $contClass,
                'container' => $cont,
                'depth' => $depth
                )
            );

        } else if ( !$custSet && !$locReserved ) { //no setting in customizer OR dropdown is set to blank value, location NOT SET in Menus section => display basic menu

			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class' => 'nav-menu',
				'container_class' => '',
				'container' => FALSE,
				'depth' => $depth
				)
			);

        } else if ( $custSet ) { //menu set in customizer AND dropdown is NOT set to blank value, location SET OR NOT SET in Menus section => display menu set in customizer ( setting a menu to the given location in customizer will update any existing location-menu association in Appearance -> Menus, see function tesseract_set_menu_location() in functions.php )

            wp_nav_menu( array(
                'menu' => $menu,
                'theme_location' => $location,
                'menu_class' => 'nav-menu',
				'container_class' => $contClass,
                'container' => $cont,
                'depth' => $depth
                )
            );

        }

    endif;

}

function tesseract_set_menu_location_menuupdate() {

	$selectorLocs = array(
		'tesseract_header_menu_select' => 'primary',
		'tesseract_footer_menu_select' => 'secondary',
		'tesseract_header_right_menu_select' => 'primary_right'
		);

	//Location 'secondary_right' is available ONLY if the branding removal plugin is installed
	if ( is_plugin_active('tesseract-remove-branding/tesseract-remove-branding.php') ) {
		$selectorLocs = array_merge($selectorLocs, array('tesseract_footer_right_menu_select' => 'secondary_right'));
	}

	//Returns the array of locations reserved
	$locs = get_theme_mod('nav_menu_locations');

	foreach( $selectorLocs as $selector => $loc ) :

		$selection = get_theme_mod( $selector ); // = menu slug

		if ( $selection !== 'none' ) {
			//Let's see if there's a menu associated with current location (if any)
			$locReserved = ! empty( $locs[ $loc ] );

			switch ( $loc ) :
				case 'primary_right': 	$hiderSect = 'tesseract_header_right_content'; break;
				case 'secondary_right': $hiderSect = 'tesseract_footer_right_content'; break;
			endswitch;

			if ( $locReserved ) :

				$menu_id = $locs[ $loc ]; // $value = $array[$key]
				$menuObject = wp_get_nav_menu_object( $menu_id );
				$menu_slug = $menuObject->slug;
				//Update customizer setting
				set_theme_mod( $selector, $menu_slug );

			elseif ( !$locReserved && is_string( $selection ) ) : // if no location set at Appearance -> Menus AND WE'RE NOT IN INSTALL PHASE ( when there's no $selection value )

				set_theme_mod( $selector, 'none' );

				//Update visibility
				switch ( $loc ) :
					case 'primary_right': 	if ( get_theme_mod( $hiderSect ) == 'menu' ) set_theme_mod( $hiderSect, 'nothing' ); break;
					case 'secondary_right': if ( get_theme_mod( $hiderSect ) == 'menu' ) set_theme_mod( $hiderSect, 'nothing' ); break;
				endswitch;

			endif;
		}

	endforeach;

}

function tesseract_set_menu_location_customizerupdate() {

	$selectorLocs = array(
		'tesseract_header_menu_select' => 'primary',
		'tesseract_footer_menu_select' => 'secondary',
		'tesseract_header_right_menu_select' => 'primary_right'
		);

	//Location 'secondary_right' is available ONLY if the branding removal plugin is installed
	if ( is_plugin_active('tesseract-remove-branding/tesseract-remove-branding.php') ) {
		$selectorLocs = array_merge($selectorLocs, array('tesseract_footer_right_menu_select' => 'secondary_right'));
	}

	//Returns the array of locations reserved
	$locs = get_theme_mod('nav_menu_locations');

	foreach( $selectorLocs as $selector => $loc ) :
		$selection = get_theme_mod( $selector ); // = menu slug

		if ( $selection !== 'none' ) {
			//Let's see if there's a menu associated with current location (if any)
			$locReserved = ! empty( $locs[ $loc ] );

			switch ( $loc ) :
				case 'primary_right': 	$hiderSect = 'tesseract_header_right_content'; break;
				case 'secondary_right': $hiderSect = 'tesseract_footer_right_content'; break;
			endswitch;

			if ( $locReserved ) :

				$menu_id = $locs[ $loc ]; // $value = $array[$key]
				$menuObject = wp_get_nav_menu_object( $menu_id );
				$menu_slug = $menuObject->slug;
				//Update customizer setting
				set_theme_mod( $selector, $menu_slug );

			elseif ( !$locReserved && is_string( $selection ) ) : // if no location set at Appearance -> Menus AND WE'RE NOT IN INSTALL PHASE ( when there's no $selection value )

				set_theme_mod( $selector, 'none' );

				//Update visibility
				switch ( $loc ) :
					case 'primary_right': 	if ( get_theme_mod( $hiderSect ) == 'menu' ) set_theme_mod( $hiderSect, 'nothing' ); break;
					case 'secondary_right': if ( get_theme_mod( $hiderSect ) == 'menu' ) set_theme_mod( $hiderSect, 'nothing' ); break;
				endswitch;

			endif;
		}

	endforeach;

}

//Let's call this on both side's init action
add_action('customize_save_after', 'tesseract_set_menu_location_customizerupdate', 77);
add_action('init', 'tesseract_set_menu_location_menuupdate', 77);

/*function tesseract_new_excerpt_more($more) {
	global $post;

	return ' ' . '<a class="moretag" href="'. get_permalink($post->ID) . '">' . __( 'Read More ...', 'tesseract' ) . '</a>';
}
add_filter('excerpt_more', 'tesseract_new_excerpt_more');
*/
/*
 * Beaver Builder - remove page title
 */
function my_theme_show_page_header() {

	if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_enabled() ) {

        $global_settings = FLBuilderModel::get_global_settings();

        if ( ! $global_settings->show_default_heading ) {
            return false;
        }
    }

    if ( is_plugin_active('elementor/elementor.php') ){
    	return false;
    }

    return true;

}

/**
 * Register Google fonts.
 *
 */
function tesseract_fonts_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'tesseract' ) ) {
		$font_url = add_query_arg( 'family', 'Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,cyrillic,latin-ext', "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function tesseract_admin_fonts() {
	wp_enqueue_style( 'tesseract-font', tesseract_fonts_url(), array(), '1.0.0' );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'tesseract_admin_fonts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-functions.php';
require get_template_directory() . '/inc/customizer-frontend-functions.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( is_plugin_active('woocommerce/woocommerce.php') )
	require get_template_directory() . '/woocommerce/woocommerce-functions.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Content Importer
 */

require get_template_directory() . '/importer/load.php';
require get_template_directory() . '/inc/beaver-builder-modules/beaver-builder-modules.php';


/*
 * Auto-check theme udpates
 */
//Initialize the update checker.
require 'theme-update-checker.php';
$update_checker = new ThemeUpdateChecker(
  'tesseract-free-theme', // This theme folder name (must match)
  'https://s3.amazonaws.com/tesseracttheme/version_free.json'
);
if(false)
{
  $update_checker->checkForUpdates();
}

/* check if a plugin exists in the plugins directory and if it's already active */
function is_plugin_installed( $slug ) {
	$plugins = get_plugins();

	foreach ( $plugins as $plugin_key => $plugin_info ) {
		if ( preg_match( "/^{$slug}\//", $plugin_key ) ) {
			return is_plugin_active( $plugin_key );
		}
	}

	return false;
}

function display_notice() {
  echo '<script type="text/javascript">
    jQuery(function($){
        $("a").each(function(){
            strhref = $(this).attr("href");
            if(typeof strhref != "undefined" && strhref.toLowerCase().indexOf("wpbeaverbuilder.com") >= 0){
                $(this).attr("href","https://www.wpbeaverbuilder.com/?fla=50");
            }
        });
    });
    </script>';
	/*if ( ! class_exists( 'Tesseract_Remove_Branding' ) ) {
		if ( false === ( $dismissed = get_transient( 'dismiss_unbranding' ) ) ) {
?>
		<div id="unbranding-plugin-notice" class="updated notice">
			
			<a href="http://tesseracttheme.com/unbranding-plugin-2-2/" ><img src="https://s3.amazonaws.com/tesseracttheme/tesseract_team.jpg" alt="Tesseract Team" /></a>
            <p>To edit the "Theme by Tesseract" at the bottom of your website you can get the Unbranding Plugin. <b>Thanks for your support!</b> </p>
            	<p>
            	<span>-The Tesseract Team</span>
				<a id="dismiss-unbranding" href="javascript:void(0);">maybe later</a>                
				<a id="get-unbranding" href="http://tesseracttheme.com/unbranding-plugin-2/" target="_blank">check it out</a>

                </p>
			
		</div>
<?php
		}
	}*/
}
add_action( 'admin_notices', 'display_notice' );

function dismiss_unbranding() {
	set_transient( 'dismiss_unbranding', true, 3 * DAY_IN_SECONDS ); // dismissed for 3 days

	die();
}
add_action( 'wp_ajax_dismiss_unbranding', 'dismiss_unbranding' );

/* load custom admin scripts and styles */
function tesseract_enqueue_custom_scripts() {
	wp_enqueue_script( 'tesseract-custom', get_template_directory_uri() . '/importer/js/custom.js', array( 'jquery' ) );
	wp_enqueue_style( 'tesseract-custom', get_template_directory_uri() . '/importer/css/custom.css' );
}
add_action( 'admin_enqueue_scripts', 'tesseract_enqueue_custom_scripts' );

/* clear the dismiss unbranding transient when logging out */
function tesseract_clear_dismiss_transient() {
    delete_transient( 'dismiss_unbranding' );
}
add_action( 'wp_logout', 'tesseract_clear_dismiss_transient' );
add_action( 'wp_login', 'tesseract_clear_dismiss_transient', 10 );

/* remove emoji scripts */
function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	}
	else {
		return array();
	}
}

function disable_wp_emojicons() {
	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

// Remove ... from excerpt //
//This should remove the 3 dots at the end of the excerpt
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// My woocommerce customization //

/* Display a notice for tesseractplus when not active */

function display_tesseractplusnotice()
{
	global $pagenow;
	if(get_option('tesseract_advertisement_banner',true)%2 == 1)
	{
	  	//echo "----------------------------------------------------- ODD";
	  	$div1_class = 'rotating-item-show';
	  	$div2_class = 'rotating-item-hide';
	}
	else
	{
	  	//echo "----------------------------------------------------- EVEN";
	  	$div1_class = 'rotating-item-hide';
	  	$div2_class = 'rotating-item-show';
	}
	if ( ! is_plugin_active( 'tesseract-remove-branding/tesseract-remove-branding.php' ) ) {
		if ( false === ( $dismissed = get_transient( 'dismiss_tesseractpls' ) ) ) {
	?>
		<div id="tesseract-pro-plugin-notice" class="updated notice custom-notice <?php echo $div1_class; ?>">
			<?php
			function readCSV($csvFile){
			$file_handle = fopen($csvFile, 'r');
			while (!feof($file_handle) ) {
				$line_of_text[] = fgetcsv($file_handle, 1024);
			}
			fclose($file_handle);
			return $line_of_text;
			}
			$adminmfile = 'https://s3.amazonaws.com/tesseracttheme/banner/unbranding_message.csv';
			$array = get_headers($adminmfile);
			$string = $array[0];
			if(strpos($string,"200"))
			{
			    $csv = readCSV($adminmfile);
			}
			else
			{
			    $adminmfile = get_template_directory() . '/unbranding_message.csv';
				$csv = readCSV($adminmfile);
			}
			
			if($csv[1][4]=='active')
			{
			//echo '<pre>';
			//print_r($csv);
			//echo '</pre>';
			?>
			<div class="logo-notice">
			<?php
			echo $csvimg = '<a target="_blank" href=" ' . $csv[1][3] .  ' " ><img width="300" src=" ' . $csv[1][1]. ' " alt="Tesseract Team" /></a>'; ?>
			</div>
			<div class="right-cont-noice">
				<?php echo $csvmsg = '<p>' .$csv[1][2] . '</p>'; ?>
				<div class="btn-group">	
				  <?php echo '<a id="get-unbranding" href=" ' . $csv[1][3] .  ' " target="_blank">check it out</a>'; ?> 
				  <a id="dismiss-tesseractplus" href="javascript:void(0);">maybe later</a>                
				</div>
			</div>
			<?php } ?>
			
		</div>
		
	<?php
		}	
	}
	
	if ( false === ( $dismissed = get_transient( 'dismiss_tesseractpls' ) ) ) {
	?>
		<div id="tesseract-pro-plugin-notice" class="updated notice custom-notice rotating-item <?php echo $div2_class; ?>">
			<?php
			function readCSV_general($csvFile){
			$file_handle = fopen($csvFile, 'r');
			while (!feof($file_handle) ) {
				$line_of_text[] = fgetcsv($file_handle, 1024);
			}
			fclose($file_handle);
			return $line_of_text;
			}
			$adminmfile = 'https://s3.amazonaws.com/tesseracttheme/banner/designer_theme_message.csv';
			$array = get_headers($adminmfile);
			$string = $array[0];
			if(strpos($string,"200"))
			{
			    $csv = readCSV_general($adminmfile);
			}
			else
			{
			    $adminmfile = get_template_directory() . '/designer_theme_message.csv';
				$csv = readCSV_general($adminmfile);
			}
			
			
			if($csv[1][4]=='active')
			{
			
			?>
			<div class="logo-notice">
			<?php
			echo $csvimg = '<a target="_blank" href=" ' . $csv[1][3] .  ' " ><img width="300" src=" ' . $csv[1][1]. ' " alt="Tesseract Team" /></a>'; ?>
			</div>
			<div class="right-cont-noice">
				<?php echo $csvmsg = '<p>' .$csv[1][2] . '</p>'; ?>
				<div class="btn-group">	
				  <?php echo '<a id="get-unbranding" href=" ' . $csv[1][3] .  ' " target="_blank">check it out</a>'; ?> 
				  <a id="dismiss-tesseractplus" href="javascript:void(0);">maybe later</a>                
				</div>
			</div>
			<?php } ?>
		</div>
		<style>
			.rotating-item-show{
				display: block !important;
			}
			.rotating-item-hide{
				display: none !important;
			}
		</style>
<?php
	}
	?>
	<script>
		var $ =jQuery.noConflict();
		$("#dismiss-tesseractplus").click(function(){
			location.reload(true);
		});
	</script>
	<?php
}
add_action( 'admin_notices', 'display_tesseractplusnotice' );

function dismiss_tesseractpls_action_call() {
	set_transient( 'dismiss_tesseractpls', false, 1 *  DAY_IN_SECONDS); // dismissed for 3 days

	die();
}
add_action( 'wp_ajax_dismiss_tesseractpls', 'dismiss_tesseractpls_action_call' );



/* Display a notice when both plugin active */

add_action('admin_notices', 'example_admin_notice');

function example_admin_notice() {
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'example_ignore_notice') ) {
		if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) && is_plugin_active( 'beaver-builder-lite-version/fl-builder.php' ) ) {
			echo '<div class="error notice"><p>'; 
			//printf(__('<p><b>NOTICE</b>: It looks like you have both beaver builder and site origins installed, note that these two conflict and cause errors. We recommend using beaver builder and deactivating site origins. This will ensure that your site runs smoothly.</p>'), '?example_nag_ignore=0');
			echo '<p><b>NOTICE</b>: It looks like you have both beaver builder and site origins activated, note that these two conflict and cause errors. We recommend using beaver builder and deactivating site origins. This will ensure that your site runs smoothly.</p>';
			echo "</p></div>";
		} elseif ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) && is_plugin_active( 'tesseract-pro-plugin/fl-builder.php' ) ) {
			echo '<div class="error notice"><p>'; 
			//printf(__('<p><b>NOTICE</b>: It looks like you have both beaver builder and site origins installed, note that these two conflict and cause errors. We recommend using beaver builder and deactivating site origins. This will ensure that your site runs smoothly.</p>'), '?example_nag_ignore=0');
			echo '<p><b>NOTICE</b>: It looks like you have beaver builder builder and site origins activated, note that these two conflict and cause errors. We recommend using beaver builder and deactivating site origins. This will ensure that your site runs smoothly.</p>';
			echo "</p></div>";
		}

		/* $installedPlugins = get_plugins();
		// echo '<pre>';
	    // print_r($installedPlugins); 
		// echo '</pre>';
		foreach ($installedPlugins as $installedPlugin => $data) {
		$arrname[]=$data['Name'];
		}

		$find = array("Page Builder by SiteOrigin", "Beaver Builder Plugin (Lite Version)");
		if(count(array_intersect($arrname, $find)) == count($find)){
		    echo '<div class="error notice"><p>'; 
			//printf(__('<p><b>NOTICE</b>: It looks like you have both beaver builder and site origins installed, note that these two conflict and cause errors. We recommend using beaver builder and deactivating site origins. This will ensure that your site runs smoothly.</p>'), '?example_nag_ignore=0');
			echo '<p><b>NOTICE</b>: It looks like you have both beaver builder and site origins installed, note that these two conflict and cause errors. We recommend using beaver builder and deactivating site origins. This will ensure that your site runs smoothly.</p>';
			echo "</p></div>";
		} */	
	}
}

/*add_action('admin_init', 'example_nag_ignore');

function example_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['example_nag_ignore']) && '0' == $_GET['example_nag_ignore'] ) {
             add_user_meta($user_id, 'example_ignore_notice', 'true', true);
	}
}*/


/* Deactive one plugin when other active */

//if ( is_plugin_active( 'tesseract-plus-plugin/fl-builder.php' ) ) {
//deactivate_plugins( 'beaver-builder-lite-version/fl-builder.php' );
//} //else {
//activate_plugins( 'beaver-builder-lite-version/fl-builder.php' );
//}


//Initialize the update checker.
/*require 'theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
    'tesseract',
    'http://testyourprojects.net/matrix/wpnew/aurora-safaritest/info.json'
);*/

/*
* Add for creating color option for submenu, @mit.
*/


class Color_submenu{
	public static function register( $wp_customize ) {
		// Sections, settings and controls will be added here
		/*$wp_customize->add_section( 
			'submenu_color_option', 
			array(
				'title'       => __( 'Submenu Color', 'tesseract' ),
				'panel'		=> 'tesseract_header_options',
				'priority'    => 20,
				'capability'  => 'edit_theme_options',
				'description' => __('Change submenu color from here.', 'tesseract'), 
			) 
		);
		$wp_customize->add_setting( 'sub_menu_color',
			array(
				'default' => 'f1f1f1',
				'transport' => 'postMessage'
			)
		); 
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'footer_bg_color_control',
			array(
				'label'    => __( 'Submenu Text Color', 'tesseract' ), 
				'section'  => 'submenu_color_option',
				'settings' => 'sub_menu_color',
				'priority' => 10,
			) 
		));*/

		
		
		
	}
	public static function header_output() {
			$header_linkColor = get_theme_mod('sub_menu_color') ? get_theme_mod('sub_menu_color') : '#000000';
		?>
		<style type='text/css'>
			.top-navigation ul ul li > a{
				color:<?php echo $header_linkColor; ?> ;
			}
		</style>
	<?php
	}
	public static function live_preview() {
		wp_enqueue_script( 
			'tesseract_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array(  'jquery', 'customize-preview' ),
			'',
			true
		);
	}
}
new Color_submenu();

add_action( 'customize_register' , array( 'Color_submenu' , 'register' ) );
add_action( 'wp_head' , array( 'Color_submenu' , 'header_output' ) );
add_action( 'customize_preview_init' , array( 'Color_submenu' , 'live_preview' ) );


function clear_transient_on_logout() {
    delete_transient('dismiss_tesseractpls');
}
add_action('wp_logout', 'clear_transient_on_logout');

add_action( 'init', 'unregister_taxonomy_123');
function unregister_taxonomy_123(){
    global $wp_taxonomies;
    $taxonomy = 'fl-builder-template-category';
    if ( taxonomy_exists( $taxonomy))
        unset( $wp_taxonomies[$taxonomy]);
}




add_action( 'init', 'setting_my_first_cookie' );

function setting_my_first_cookie() {
  if(get_option('tesseract_advertisement_banner',true))
  {
  	$flag =  get_option('tesseract_advertisement_banner',true);
  }
  else
  {
  	$flag = 1;
  }
  update_option('tesseract_advertisement_banner',$flag+1);
  
  //echo "--------------------------------------------------------------------------- Option Value: ".get_option('tesseract_advertisement_banner',true);;
}
function short_woocommerce_product_titles_words( $title, $id ) {
  if ( ( is_shop() || is_product_tag() || is_product_category() ) && get_post_type( $id ) === 'product' ) {
   // echo ":- ".strlen($title);
    $tesseract_woocommerce_title_size = (get_theme_mod('tesseract_woocommerce_title_size')) ? get_theme_mod('tesseract_woocommerce_title_size') : 'medium';
    switch ($tesseract_woocommerce_title_size) {
    	case 'small':
    		if ( strlen($title) > 31 ) { 
		       $title =  substr( $title, 0, 31	 ) . '...';
		    }
    		break;
    	case 'medium':
    		if ( strlen($title) > 28 ) { 
		       $title =  substr( $title, 0, 28	 ) . '...';
		    }
    		break;
    	case 'large':
    		if ( strlen($title) > 24 ) { 
		       $title =  substr( $title, 0, 24	 ) . '...';
		    }
    		break;
    	
    	default:
    		$title =  $title;
    		break;
    }
    return $title;
  //   if ( strlen($title) > 16 ) { // Kicks in if the product title is longer than 5 words
  //     // Shortens the title to 5 words and adds ellipsis at the end
  //      return substr( $title, 0, 10	 ) . '...';
  //   } else {
  //     return $title; // If the title isn't longer than 5 words, it will be returned in its full length without the ellipsis
  //   }
  } else {
    return $title;
  }
}
if(is_plugin_active('woocommerce/woocommerce.php'))
{
	add_filter( 'the_title', 'short_woocommerce_product_titles_words', 10, 2 );
}

$new_tes_general_setting = new new_tes_general_setting();

class new_tes_general_setting {
    public function __construct(){
    	 add_filter( 'admin_init' , array( $this , 'register_fields' ) );
    }
   
    public function register_fields() {
        add_settings_field('fav_color', '<label for="favorite_color">'.__('Want to Reset Content Blocks?' , 'favorite_color' ).'</label>' , array($this, 'fields_html') , 'general' );
    }
    public function fields_html() {
    	?>
    		
    		<div id="resetConetntBlock"><a href="javascript:void(0);" onclick="resetConetntBlock()" >Reset</a></div>
    		<div class="tes-loader-div" style="display:none;"><img src="<?php echo get_template_directory_uri(); ?>/images/load-new.gif" /></div>
    		<script>
    			function resetConetntBlock(){
    				var data = {
				      'action': 'tes_designer_content_block_reset',
				      'dataType': "html",
				    };
				    $('.tes-loader-div').show();
				    jQuery.post(ajaxurl, data, function(response) {
				        $("#resetConetntBlock").html(response);
				        $('.tes-loader-div').hide();
				    });
    			}
    		</script>
    	<?php
    }
}
add_action( 'wp_ajax_tes_designer_content_block_reset', 'tes_designer_content_block_reset' );
function tes_designer_content_block_reset(){
	if(update_option( 'tesseract_doing_import', 0 )){
		echo "<span style='color: black; font-family: Times New Roman; font-size: 18px; font-style: italic; border-bottom: 0.5px solid red; border-color: lime;'>Content Blocks Are Reset <b>Successfully</b>. Don't Forgot To <b>Deactivate and Re-Activate</b> the Designer Theme.<span/>";
	}
	else{
		echo "<span style='color: black; font-family: Times New Roman; font-size: 18px; font-style: italic; border-bottom: 0.5px solid red; border-color: red;'>Looks like a problem occurred. Please refresh the page and try again</span>";
	}
	exit;

}

/* Reset Theme settings */

$reset_theme_tes_general_settings = new reset_theme_tes_general_settings();
class reset_theme_tes_general_settings{
	public function __construct(){
        add_filter( 'admin_init' , array( &$this , 'reset_theme_register_fields' ) );
    }
    public function reset_theme_register_fields() {
        add_settings_field('reset_theme', '<label for="reset_theme">'.__('Restore Theme Settings' , 'tesseract' ).'</label><p class="description">This helps you to set all the default values of theme settings</p>' , array(&$this, 'reset_theme_fields_html') , 'general' );
    }
    public function reset_theme_fields_html() {
    	?>
    		<div id="resetThemeSettings"><a href="javascript:void(0);" onclick="resetThemeSettings()" >Reset</a></div>
    		<div class="resetThemeSettings-tes-loader-div" style="display:none;"><img src="<?php echo get_template_directory_uri(); ?>/images/load-new.gif" /></div>
    		<script>
    			function resetThemeSettings(){
    				if(confirm('Note: Restoring your theme settings will reset your Header and Footer to default options. This means you may need to re-add your Header Footer content.'))
    				{
	    				var data = {
					      'action': 'tes_free_content_theme_settings_reset',
					      'dataType': "html",
					    };
					    $('.resetThemeSettings-tes-loader-div').show();
					    jQuery.post(ajaxurl, data, function(response) {
					        $("#resetThemeSettings").html(response);
					        $('.resetThemeSettings-tes-loader-div').hide();
					    });
					}
    			}
    		</script>
    	<?php
    }
}

add_action( 'wp_ajax_tes_free_content_theme_settings_reset', 'tes_free_content_theme_settings_reset' );
function tes_free_content_theme_settings_reset(){
	remove_theme_mods();
	echo "<span style='color: black; font-family: Times New Roman; font-size: 18px; font-style: italic; border-bottom: 0.5px solid red; border-color: lime;'>Theme Settings Are Reset <b>Successfully</b>. Don't Forgot To <b>Deactivate and Re-Activate</b> the Free Theme.<span/>";
	exit;
}

/* Start Debug Mode */
function debug_register_fields()
{
    register_setting('general', 'tes_debug_theme', 'esc_attr');
    add_settings_field('tes_debug_theme', '<label for="tes_debug_theme">'.__('Debug Mode' , 'tes_debug_theme' ).'</label><p class="description">Only for Developer\'s</p>' , 'tes_debug_html', 'general');
}

function tes_debug_html()
{
    $value = get_option( 'tes_debug_theme', '' ) ? get_option( 'tes_debug_theme', '' ) : 'disable';
    //echo '<input type="text" id="tes_debug_theme" name="tes_debug_theme" value="' . $value . '" />';
    ?>
    <select id="tes_debug_theme" name="tes_debug_theme">
    	<option value='enable' <?php if( $value == 'enable' ){ echo 'selected';} ?> >Enable</option>
    	<option value='disable' <?php if( $value == 'disable' ){ echo 'selected';} ?> >Disable</option>
    </select>
    <?php
}
add_filter('admin_init', 'debug_register_fields');
/* End Debug Mode */

/* Plugin Recommendation */
require_once( get_template_directory() . '/class-tgm-plugin-activation.php' );
add_action( 'tgmpa_register', 'tessearact_register_required_plugins' );
function tessearact_register_required_plugins()
    {
		$plugins = array(
			array(
				'name'   	=> 'WooCommerce',
				'slug'		=> 'woocommerce',
				'required'	=> false, 
			),
			array(
				'name'		=> 'Elementor',
				'slug'		=> 'elementor',
				'required'	=> false,
			),
			array(
				'name'		=> 'W3 Total Cache',
				'slug'		=> 'w3-total-cache',
				'required'	=> false,
			),
			/*array(
				'name'		=> 'YITH WooCommerce Zoom Magnifier',
				'slug'		=> 'yith-woocommerce-zoom-magnifier',
				'required'	=> false,
			)*/
			
		);
		$config = array(
			'id'           => 'tgmpa',                 
			'default_path' => '',                      
			'menu'         => 'tgmpa-install-plugins', 
			'parent_slug'  => 'themes.php',            
			'capability'   => 'edit_theme_options',    
			'has_notices'  => true,                    
			'dismissable'  => true,                    
			'dismiss_msg'  => '',                      
			'is_automatic' => false,                   
			'message'      => '',                      
			
		);
		tgmpa( $plugins, $config );
	}

/*add_filter( 'woocommerce_cart_item_name', 'tes_cart_product_title', 20, 3);

function tes_cart_product_title( $title, $values, $cart_item_key ) {
	if(count($values['variation'])) //apply if condition here in if()
	{
		$targetPath = get_template_directory_uri().'/images/load-new.gif';
		return $title . '<br><span class="tes_cart_variation_update_button " id="'.$cart_item_key.'" >Edit License</span>'.'<img src="'.$targetPath.'" alt="Smiley face" height="42" width="42" id="loder_img" style="display:none;">';
	}else{ 
		return $title;
	}
}

add_action('wp_head','tes_cart_hook_js');
function tes_cart_hook_js() {
	if(is_cart())
	{
		?>
			<script type="text/javascript">
				jQuery(document).on('click', '.tes_cart_variation_update_button', function(){
					jQuery('#loder_img').css('display','block');
					var cart_item_html;
					var current_item_product;
					
					current_item_product = jQuery(this).closest('tr');
					current_item_product.fadeTo(300,0);
					
					var cart_item_key = jQuery(this).attr('id');

					jQuery.ajax({                                   
					    url: '<?php echo admin_url('admin-ajax.php'); ?>',               
					    type: 'POST',
					    dataType: 'html',
					    data: {
					        current_key_value: cart_item_key,
					        action: 'get_variation_form'
					    },
					    success: function( result ) { 

					    	jQuery('#loder_img').css('display','none');
					    	var form_present = jQuery('tr.new_row_'+cart_item_key).length;         
				                
				            if ( form_present == 0 ) {	        
						        current_item_product.after('<tr class="new_row_'+cart_item_key+'" id="new_row"><td colspan="6"><table class="update_variation_form"><tr><td id="thumbnail_'+cart_item_key+'" class="WOO_CK_WUVIC_thumbnail"></td><td class="variations">'+result+'</td></tr></table></td></tr>').hide();
					            jQuery('tr.new_row_'+cart_item_key+' .variations_form').attr('id', 'uvc_form_'+cart_item_key);
						        current_item_product.addClass('old_row_'+cart_item_key).fadeOut(300);
						        //add thumbail to the form
						        var thumbnail = jQuery('tr.new_row_'+cart_item_key+' input#product_thumbnail').val();
						        jQuery('tr.new_row_'+cart_item_key+' td#thumbnail_'+cart_item_key).append(thumbnail);
								jQuery('tr.new_row_'+cart_item_key).fadeIn(300);
				            }
					    }
					});
				}); 		

				function cancel_update_variations( cart_item_key ){
					jQuery('tr.new_row_'+cart_item_key).remove();
					jQuery('tr.old_row_'+cart_item_key).fadeIn(150).fadeTo(150,1);
				};
				        
				jQuery(document).on('click', ' #new_row .single_add_to_cart_button', function( e ){
					e.preventDefault();
					jQuery('#loder_img_btn').css('display','block');
					var form_id = this.form.id;
					
					var old_key =jQuery("#"+form_id+' .old_key').val();
					jQuery.ajax({
						url: '<?php echo admin_url('admin-ajax.php'); ?>',
						type: 'post',
						dataType: 'html',
						data: {
							action: 'update_product_in_cart',
							form_data: jQuery('#'+form_id).serialize(),
							old_key : old_key
						},
						
						success: function(response) {
							jQuery('#loder_img_btn').css('display','none');
							var html       = jQuery.parseHTML( response );
							alert(">>> "+html);
							var new_form   = jQuery( 'table.shop_table.cart', html ).closest( 'form' );
							var new_totals = jQuery( '.cart_totals', html );

							jQuery( 'table.shop_table.cart' ).closest( 'form' ).replaceWith( new_form );			
						    jQuery( '.cart_totals' ).replaceWith( new_totals );
						    if( jQuery('div.woocommerce-message').length == 0 ){
						        jQuery('div.entry-content div.woocommerce').prepend('<div class="woocommerce-message">Cart Updated</div>');
						    }
						}
					});
				});
			</script>
		<?php
	}
}

add_action( 'wp_ajax_get_variation_form', 'get_variation_form' );
add_action( 'wp_ajax_nopriv_get_variation_form', 'get_variation_form' );
function get_variation_form(){
	global $woocommerce;
	$items = $woocommerce->cart->get_cart_item($_POST['current_key_value']);
	$product_woo_ck = wc_get_product($items['product_id']);
	$selected_variation=$items['variation'];
	$selected_qty=$items['quantity'];
	$available_variations=$product_woo_ck->get_available_variations();
	$attributes=$product_woo_ck->get_variation_attributes();
	?>
	<script type='text/javascript' src='<?php echo plugins_url(); ?>/woocommerce/assets/js/frontend/add-to-cart-variation.js?ver=2.6.8'></script>
	<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product_woo_ck->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
			<table class="variations" cellspacing="0">
				<tbody>
					<?php foreach ( $attributes as $attribute_name => $options ) : ?>
						<tr>
							<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
							<td class="value">
								<?php $selected=$selected_variation[ 'attribute_' . sanitize_title( $attribute_name ) ];
									wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product_woo_ck, 'selected' => $selected ) );
								?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<div class="single_variation_wrap">
				<div class="woocommerce-variation single_variation" style="">
					<div class="woocommerce-variation-description"></div>
					<div class="woocommerce-variation-price">
						<span class="price"></span>
					</div>
					<div class="woocommerce-variation-availability"></div>
				</div>
				<div class="woocommerce-variation-add-to-cart variations_button woocommerce-variation-add-to-cart-enabled">
					<?php $targetPath = get_template_directory_uri().'/images/load-new.gif'; ?>
					<img src="<?php echo $targetPath; ?>" alt="Smiley face" height="42" width="42" id="loder_img_btn" style="display:none;">
				</div>
				<input type="hidden" id="product_thumbnail" value='<?php echo $product_woo_ck->get_image();  ?>'>
				<button type="submit" class="single_add_to_cart_button button alt" id="single_add_to_cart_button_id">
					Submit
				</button>

				<span id="cancel" class="" onclick="cancel_update_variations('<?php echo $_POST['current_key_value']; ?>');" title="Close" style="cursor: pointer; ">
					Cancel
				</span>
			</div>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product_woo_ck->id ); ?>">
			<input type="hidden" name="product_id" value="<?php echo absint( $product_woo_ck->id ); ?>">
			<input type="hidden" name="variation_id" class="variation_id" value="9">
			<input name="old_key" class="old_key" type="hidden" value="<?php echo $_POST['current_key_value']; ?>">
	</form>

	<?php
	exit;
}

add_action( 'wp_ajax_update_product_in_cart', 'update_product_in_cart' );
add_action( 'wp_ajax_nopriv_update_product_in_cart', 'update_product_in_cart' ); 
function update_product_in_cart(){
	global $wpdb,$woocommerce;
	//echo "<pre>"; print_r($_POST); echo "</pre>"; die;
	$cart_url = $woocommerce->cart->get_cart_url();
	$woocommerce->cart->remove_cart_item($_POST['old_key']);

	wp_redirect($cart_url.'?'.$_POST['form_data']);
	die();
}
echo "<pre>"; print_r($_SESSION); echo "</pre>"; die;*/