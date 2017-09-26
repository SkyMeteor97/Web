<?php
if ( defined( 'GENERATE_COLORS_VERSION' ) ) :
	if ( class_exists( 'Generate_Customize_Alpha_Color_Control' ) && function_exists( 'generate_colors_sanitize_rgba' ) ) {
		$control = 'Generate_Customize_Alpha_Color_Control';
		$sanitize = 'generate_colors_sanitize_rgba';
	} else {
		$control = 'WP_Customize_Color_Control';
		$sanitize = 'generate_colors_sanitize_hex_color';
	}
	
	if ( $wp_customize->get_panel( 'generate_colors_panel' ) ) {
		$colors_panel = 'generate_colors_panel';
	} else {
		$colors_panel = 'secondary_navigation_panel';
	}

	// Add Navigation section
	$wp_customize->add_section(
		// ID
		'secondary_navigation_color_section',
		// Arguments array
		array(
			'title' => __( 'Secondary Navigation','secondary-nav' ),
			'capability' => 'edit_theme_options',
			'priority' => 71,
			'panel' => $colors_panel
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[navigation_background_color]', array(
			'default' => $defaults['navigation_background_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => $sanitize,
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new $control(
			$wp_customize,
			'secondary_navigation_background_color', 
			array(
				'label' => __('Background','secondary-nav'), 
				'section' => 'secondary_navigation_color_section',
				'settings' => 'generate_secondary_nav_settings[navigation_background_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[navigation_text_color]', array(
			'default' => $defaults['navigation_text_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'generate_colors_sanitize_hex_color',
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_navigation_text_color', 
			array(
				'label' => __('Text','secondary-nav'), 
				'section' => 'secondary_navigation_color_section',
				'settings' => 'generate_secondary_nav_settings[navigation_text_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[navigation_background_hover_color]', array(
			'default' => $defaults['navigation_background_hover_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => $sanitize,
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new $control(
			$wp_customize,
			'secondary_navigation_background_hover_color', 
			array(
				'label' => __('Background Hover','secondary-nav'), 
				'section' => 'secondary_navigation_color_section',
				'settings' => 'generate_secondary_nav_settings[navigation_background_hover_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[navigation_text_hover_color]', array(
			'default' => $defaults['navigation_text_hover_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'generate_colors_sanitize_hex_color',
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_navigation_text_hover_color', 
			array(
				'label' => __('Text Hover','secondary-nav'), 
				'section' => 'secondary_navigation_color_section',
				'settings' => 'generate_secondary_nav_settings[navigation_text_hover_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[navigation_background_current_color]', array(
			'default' => $defaults['navigation_background_current_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => $sanitize,
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new $control(
			$wp_customize,
			'secondary_navigation_background_current_color', 
			array(
				'label' => __('Background Current','secondary-nav'), 
				'section' => 'secondary_navigation_color_section',
				'settings' => 'generate_secondary_nav_settings[navigation_background_current_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[navigation_text_current_color]', array(
			'default' => $defaults['navigation_text_current_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'generate_colors_sanitize_hex_color',
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_navigation_text_current_color', 
			array(
				'label' => __('Text Current','secondary-nav'), 
				'section' => 'secondary_navigation_color_section',
				'settings' => 'generate_secondary_nav_settings[navigation_text_current_color]'
			)
		)
	);

	// Add Sub-Navigation section
	$wp_customize->add_section(
		// ID
		'secondary_subnavigation_color_section',
		// Arguments array
		array(
			'title' => __( 'Secondary Sub-Navigation','secondary-nav' ),
			'capability' => 'edit_theme_options',
			'priority' => 72,
			'panel' => $colors_panel
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[subnavigation_background_color]', array(
			'default' => $defaults['subnavigation_background_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => $sanitize,
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new $control(
			$wp_customize,
			'secondary_subnavigation_background_color', 
			array(
				'label' => __('Background','secondary-nav'), 
				'section' => 'secondary_subnavigation_color_section',
				'settings' => 'generate_secondary_nav_settings[subnavigation_background_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[subnavigation_text_color]', array(
			'default' => $defaults['subnavigation_text_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'generate_colors_sanitize_hex_color',
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_subnavigation_text_color', 
			array(
				'label' => __('Text','secondary-nav'), 
				'section' => 'secondary_subnavigation_color_section',
				'settings' => 'generate_secondary_nav_settings[subnavigation_text_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[subnavigation_background_hover_color]', array(
			'default' => $defaults['subnavigation_background_hover_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => $sanitize,
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new $control(
			$wp_customize,
			'secondary_subnavigation_background_hover_color', 
			array(
				'label' => __('Background Hover','secondary-nav'), 
				'section' => 'secondary_subnavigation_color_section',
				'settings' => 'generate_secondary_nav_settings[subnavigation_background_hover_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[subnavigation_text_hover_color]', array(
			'default' => $defaults['subnavigation_text_hover_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'generate_colors_sanitize_hex_color',
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_subnavigation_text_hover_color', 
			array(
				'label' => __('Text Hover','secondary-nav'), 
				'section' => 'secondary_subnavigation_color_section',
				'settings' => 'generate_secondary_nav_settings[subnavigation_text_hover_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[subnavigation_background_current_color]', array(
			'default' => $defaults['subnavigation_background_current_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => $sanitize,
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new $control(
			$wp_customize,
			'secondary_subnavigation_background_current_color', 
			array(
				'label' => __('Background Current','secondary-nav'), 
				'section' => 'secondary_subnavigation_color_section',
				'settings' => 'generate_secondary_nav_settings[subnavigation_background_current_color]'
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[subnavigation_text_current_color]', array(
			'default' => $defaults['subnavigation_text_current_color'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'generate_colors_sanitize_hex_color',
			'transport' => 'postMessage'
		)
	);
	
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_subnavigation_text_current_color', 
			array(
				'label' => __('Text Current','secondary-nav'), 
				'section' => 'secondary_subnavigation_color_section',
				'settings' => 'generate_secondary_nav_settings[subnavigation_text_current_color]'
			)
		)
	);

endif;