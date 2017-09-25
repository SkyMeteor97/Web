<?php

/*

 * section HEADER COLORS

 */



   	$wp_customize->add_section( 'tesseract_header_colors' , array(

    	'title'      => __('Header Colors', 'tesseract'),

    	'priority'   => 1,

		'panel'      => 'tesseract_header_options'

	) );



		//Register setting with the custom ALPHA enabled colorpicker

		// See full blog post here

		// http://pluto.kiwi.nz/2014/07/how-to-add-a-color-control-with-alphaopacity-to-the-wordpress-theme-customizer/



		$wp_customize->add_setting( 'tesseract_header_colors_bck_color', array(

				'transport'         => 'postMessage',

				'sanitize_callback' => 'tesseract_sanitize_rgba',

				'default' 			=> '#53a9db'

		) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_header_colors_bck_color_control',

				array(

					'label'      => __( 'Header Background Color', 'tesseract' ),

					'section'    => 'tesseract_header_colors',

					'settings'   => 'tesseract_header_colors_bck_color',

					'priority'   => 1

				) )

			);



		$wp_customize->add_setting( 'tesseract_header_colors_bck_color_opacity', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'esc_html',

				'default' 			=> 100

		) );



			$wp_customize->add_control( 'tesseract_header_colors_bck_color_opacity_control', array(

				'type'        => 'range',

				'priority'    => 2,

				'section'     => 'tesseract_header_colors',

				'settings'     => 'tesseract_header_colors_bck_color_opacity',

				'label'       => 'Header Opacity',

				'description' => 'Use this range slider to set background opacity',

				'input_attrs' => array(

					'min'   => 0,

					'max'   => 100,

					'step'  => 1,

					'class' => 'tesseract-tho-header-colors-bck-opacity',

					'style' => 'color: #0a0',

				),

				//'active_callback' => 'tesseract_show_header_opacity_control'

			) );
			$wp_customize->add_setting( 'tesseract_header_opacity_page', array(
		'transport'         => 'refresh',
		'default' 			=> 'home'
	) );			

	$wp_customize->add_control( 'tesseract_header_opacity_page', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_colors',
		'settings'     		=> 'tesseract_header_opacity_page',
		'label'       		=> 'Opacity effected page',
		//'description' 		=> 'Make your Own Logo And Upload Here',
		'choices' 		=> array(
			'home' => 'Home',
			'every' => 'Every'
		),
		'priority' 			=> 3,
	) );




		$wp_customize->add_setting( 'tesseract_header_colors_text_color', array(

				'transport'         => 'postMessage',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#ffffff'

		) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_header_colors_text_color_control',

				array(

					'label'      => __( 'Header Text Color', 'tesseract' ),

					'section'    => 'tesseract_header_colors',

					'settings'   => 'tesseract_header_colors_text_color',

					'priority'   => 4

				) )

			);



		$wp_customize->add_setting( 'tesseract_header_colors_link_color', array(

				'transport'         => 'postMessage',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#ffffff'

		) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_header_colors_link_color_control',

				array(

					'label'      => __( 'Header Link Color', 'tesseract' ),

					'section'    => 'tesseract_header_colors',

					'settings'   => 'tesseract_header_colors_link_color',

					'priority' 	 => 5

				) )

			);

			$wp_customize->add_setting( 'sub_menu_color', array(

				'transport'         => 'refresh',


				'default' 			=> '#000000'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'sub_menu_color_control',

			array(

				'label'      => __( 'Header Link Color(Submenu)', 'tesseract' ),

				'section'    => 'tesseract_header_colors',

				'settings'   => 'sub_menu_color',

				'priority' 	 => 6

			) )

		);



		$wp_customize->add_setting( 'tesseract_header_colors_link_hover_color', array(

				'transport'         => 'postMessage',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#d1ecff'

		) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_header_colors_link_hover_color_control',

				array(

					'label'      => __( 'Header Hovered Link Color', 'tesseract' ),

					'section'    => 'tesseract_header_colors',

					'settings'   => 'tesseract_header_colors_link_hover_color',

					'priority'   => 7

				) )

			);
		$wp_customize->add_setting( 'tesseract_header_activated_link_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#e8e8e8'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_header_activated_link_color_control',

			array(

				'label'      => __( 'Header Activated Link Color', 'tesseract' ),

				'section'    => 'tesseract_header_colors',

				'settings'   => 'tesseract_header_activated_link_color',

				'priority'   => 8

			) )

		);

		$wp_customize->add_setting( 'tesseract_header_search_text_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#fff'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_header_search_text_color_control',

			array(

				'label'      => __( 'Header Search Text Color', 'tesseract' ),

				'section'    => 'tesseract_header_colors',

				'settings'   => 'tesseract_header_search_text_color',

				'priority'   => 9

			) )

		);

		$wp_customize->add_setting( 'tesseract_header_sub_menu_hover_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#cecece'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_header_sub_menu_hover_color_control',

			array(

				'label'      => __( 'Submenu Hover Background Color', 'tesseract' ),

				'section'    => 'tesseract_header_colors',

				'settings'   => 'tesseract_header_sub_menu_hover_color',

				'priority'   => 10

			) )

		);



		