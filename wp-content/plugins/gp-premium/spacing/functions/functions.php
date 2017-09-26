<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

// Run any necessary migration
require_once plugin_dir_path( __FILE__ ) . 'migration.php';

if ( ! function_exists( 'generate_spacing_customize_register' ) ) :
add_action( 'customize_register', 'generate_spacing_customize_register', 99 );
function generate_spacing_customize_register( $wp_customize ) {
	
	// Bail if we don't have our defaults
	if ( ! function_exists( 'generate_spacing_get_defaults' ) )
		return;

	$wp_customize->add_setting('generate_spacing_headings');

	require_once plugin_dir_path( __FILE__ ) . 'controls.php';

	$defaults = generate_spacing_get_defaults();
	
	if ( method_exists( $wp_customize,'register_control_type' ) ) {
		$wp_customize->register_control_type( 'Generate_Spacing_Customize_Control' );
		$wp_customize->register_control_type( 'Generate_Customize_Spacing_Slider_Control' );
	}
	
	if ( class_exists( 'WP_Customize_Panel' ) ) :
		if ( ! $wp_customize->get_panel( 'generate_spacing_panel' ) ) {
			$wp_customize->add_panel( 'generate_spacing_panel', array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __( 'Spacing','generate-spacing' ),
				'description'    => __( 'Change the spacing for various elements using pixels.', 'generate-spacing' ),
				'priority'		 => 35
			) );
		}
	endif;
	
	// Include header spacing
	require_once plugin_dir_path( __FILE__ ) . 'header-spacing.php';
	
	// Include content spacing
	require_once plugin_dir_path( __FILE__ ) . 'content-spacing.php';
	
	// Include widget spacing
	require_once plugin_dir_path( __FILE__ ) . 'sidebar-spacing.php';
	
	// Include navigation spacing
	require_once plugin_dir_path( __FILE__ ) . 'navigation-spacing.php';
	
	// Include footer spacing
	require_once plugin_dir_path( __FILE__ ) . 'footer-spacing.php';
	
}
endif;

if ( ! function_exists( 'generate_spacing_customize_preview_css' ) ) :
add_action('customize_controls_print_styles', 'generate_spacing_customize_preview_css');
function generate_spacing_customize_preview_css() {

	?>
	<style>
		.customize-control.customize-control-spacing {display: inline-block;width:25%;clear:none;text-align:center}
		.customize-control.customize-control-spacing label {text-align:left}
		.spacing-area {display: inline-block;width:25%;clear:none;text-align:center;position:relative;bottom:-5px;font-size:11px;font-weight:bold;}
		.customize-control-title.spacing-title {margin-bottom:0;}
		.customize-control.customize-control-spacing-heading {margin-bottom:0px;text-align:center;}
		.customize-control.customize-control-line {margin:8px 0;}
		#customize-control-generate_spacing_settings-separator,
		#customize-control-generate_spacing_settings-sub_menu_item_height {width:100%;}
		#customize-control-generate_spacing_settings-menu_item,
		#customize-control-generate_spacing_settings-menu_item_height,
		#customize-control-generate_menu_item-heading .spacing-area
		{
			width: 50%;
		}
		
		#customize-control-generate_sidebar-heading {
			margin-bottom:10px;
		}
		
		/*.customize-control-title.spacing-title {
			border-top: 1px solid #ddd;
			padding-top: 15px;
			margin-top: 15px;
		}*/
		
		#customize-control-generate_widget-heading .spacing-title,
		#customize-control-generate_header-heading .spacing-title,
		#customize-control-generate_content-heading .spacing-title, 
		#customize-control-generate_menu_item-heading .spacing-title, 
		#customize-control-generate_footer_widget-heading .spacing-title,
		#customize-control-generate_secondary_menu_item-heading .spacing-title {
			margin-top: 0;
			padding-top: 0;
			border: 0;
		}
		
		#customize-control-generate_header_spacing_title,
		#customize-control-generate_content_spacing_title,
		#customize-control-generate_widget_spacing_title,
		#customize-control-generate_content_separating_space,
		#customize-control-generate_navigation_spacing_title,
		#customize-control-generate_sub_navigation_spacing_title,
		#customize-control-generate_secondary_navigation_spacing_title,
		#customize-control-generate_footer_widget_spacing_title, 
		#customize-control-generate_footer_spacing_title {
			margin-bottom: 0;
		}
	</style>
	<?php
}
endif;

if ( ! function_exists( 'generate_right_sidebar_width' ) ) :
add_filter( 'generate_right_sidebar_width', 'generate_right_sidebar_width' );
function generate_right_sidebar_width( $width )
{
	// Bail if we don't have our defaults
	if ( ! function_exists( 'generate_spacing_get_defaults' ) )
		return $width;
	
	$spacing_settings = wp_parse_args( 
		get_option( 'generate_spacing_settings', array() ), 
		generate_spacing_get_defaults() 
	);
	
	return $spacing_settings['right_sidebar_width'];
}
endif;

if ( ! function_exists( 'generate_left_sidebar_width' ) ) :
add_filter( 'generate_left_sidebar_width', 'generate_left_sidebar_width' );
function generate_left_sidebar_width( $width )
{
	// Bail if we don't have our defaults
	if ( ! function_exists( 'generate_spacing_get_defaults' ) )
		return $width;
	
	$spacing_settings = wp_parse_args( 
		get_option( 'generate_spacing_settings', array() ), 
		generate_spacing_get_defaults() 
	);
	
	return $spacing_settings['left_sidebar_width'];
}
endif;

if ( ! function_exists( 'generate_spacing_sanitize_choices' ) ) :
/**
 * Sanitize choices
 */
function generate_spacing_sanitize_choices( $input, $setting ) {
	
	// Ensure input is a slug
	$input = sanitize_key( $input );
	
	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it;
	// otherwise, return the default
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
endif;

if ( ! function_exists( 'generate_spacing_customizer_live_preview' ) ) :
add_action( 'customize_preview_init', 'generate_spacing_customizer_live_preview' );
function generate_spacing_customizer_live_preview()
{
	wp_enqueue_script( 
		  'generate-spacing-customizer',
		  trailingslashit( plugin_dir_url( __FILE__ ) ) . '/js/customizer.js',
		  array( 'jquery','customize-preview' ),
		  GENERATE_SPACING_VERSION,
		  true
	);
	wp_localize_script( 'generate-spacing-customizer', 'gp_spacing', array(
		'breakpoint' => apply_filters( 'generate_mobile_breakpoint', '768px' )
	) );
}
endif;

if ( ! function_exists( 'generate_include_spacing_defaults' ) ) :
/**
 * Check if we should include our default.css file
 * @since 1.3.42
 */
function generate_include_spacing_defaults() {
	return true;
}
endif;