<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_spacing_update_footer_padding' ) ) :
/**
 * If our footer widget area has the old default 0 for left and right, set it to 40
 * @since 1.3.42
 * December 19, 2017
 */
add_action( 'admin_init', 'generate_spacing_update_footer_padding' );
function generate_spacing_update_footer_padding() 
{
	// Bail if GP isn't activated
	if ( ! function_exists( 'generate_spacing_get_defaults' ) )
		return;
	
	// Get our migration settings
	$settings = get_option( 'generate_migration_settings', array() );
	
	// If we've already ran this function, bail
	if ( isset( $settings[ 'footer_padding_updated' ] ) && 'true' == $settings[ 'footer_padding_updated' ] )
		return;

	// Get our spacing settings
	$spacing_settings = wp_parse_args( 
		get_option( 'generate_spacing_settings', array() ), 
		generate_spacing_get_defaults() 
	);
	
	// If we don't have a footer widget separator, we don't need to do this
	if ( ! isset( $spacing_settings[ 'footer_widget_separator' ] ) )
		return;
	
	// We're still here, update our left and right footer widget area padding if they're set to 0
	if ( '0' == $spacing_settings[ 'footer_widget_container_right' ] && '0' == $spacing_settings[ 'footer_widget_container_left' ] ) {
		$new_settings[ 'footer_widget_container_right' ] = '40';
		$new_settings[ 'footer_widget_container_left' ] = '40';
		$update_settings = wp_parse_args( $new_settings, $spacing_settings );
		update_option( 'generate_spacing_settings', $update_settings );
	}
	
	// Update our migration option so we don't need to run this again
	$updated[ 'footer_padding_updated' ] = 'true';
	$migration_settings = wp_parse_args( $updated, $settings );
	update_option( 'generate_migration_settings', $migration_settings );
}
endif;