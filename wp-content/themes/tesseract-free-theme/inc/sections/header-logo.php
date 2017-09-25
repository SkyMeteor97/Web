<?php

/*  

 * section HEADER LOGO

 */	

 

   	$wp_customize->add_section( 'tesseract_header_logo' , array(

    	'title'      => __('Header Logo', 'tesseract'),
    	'description' 		=> '<b><span style="font-color:blue; font-size:20px; padding-left:32px; font-family:caption;" ><a href="http://logomakr.com" target="_blank">Create Your Logo</a></span><b><br/>Make Your Own Logo And Upload Here<br /><p><i>It is also used as Footer Logo</i></p>',

    	'priority'   => 3,

		'panel'		 => 'tesseract_header_options'

	) );	

	$wp_customize->add_setting( 'tesseract_header_logo_type', array(
		'transport'         => 'refresh',
		'default' 			=> 'text'
	) );			

	$wp_customize->add_control( 'tesseract_header_logo_type', array(
		'type'        		=> 'select',
		'section'     		=> 'tesseract_header_logo',
		'settings'     		=> 'tesseract_header_logo_type',
		'label'       		=> 'Logo Type',
		//'description' 		=> 'Make your Own Logo And Upload Here',
		'choices' 		=> array(
			'image' => 'Image',
			'text' => 'Text'
		),
		'priority' 			=> 2,
	) );

	

		$wp_customize->add_setting( 'tesseract_header_logo_image', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'esc_url'

		) );



			$wp_customize->add_control(

				   new WP_Customize_Image_Control(

					   $wp_customize,

					   'tesseract_header_logo_image_control',

					   array(

						   'label'      => __( 'Upload Header Logo', 'tesseract' ),

						   'section'    => 'tesseract_header_logo',

						   'settings'   => 'tesseract_header_logo_image',

						   'active_callback' 	=> 'tesseract_header_logo_choice_image_2',

						   'priority' 	=> 3

					   )

				   )

			   );

			

		$wp_customize->add_setting( 'tesseract_header_logo_height', array(

				'transport'         => 'postMessage',

				'sanitize_callback' => 'absint',

				'default' 			=> 40

		) );			

			

			$wp_customize->add_control( 'tesseract_header_logo_height_control', array(

				'type'        		=> 'range',

				'priority'    		=> 4,

				'section'     		=> 'tesseract_header_logo',

				'settings'     		=> 'tesseract_header_logo_height',

				'label'       		=> 'Header Logo Height',

				'description' 		=> 'Use this range slider to set header logo height',

				'input_attrs' 		=> array(

					'min'   => 30,

					'max'   => 130,

					'step'  => 5,

					'class' => 'tesseract-tho-header-logo-height',

					'style' => 'color: #0a0',

				),

				'active_callback' 	=> 'tesseract_header_logo_height_enable',

				'priority' 			=> 2

			) );

		$wp_customize->add_setting( 'tesseract_header_logo_text',
			array(
				'default' => get_bloginfo(),
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_header_logo_text',
				array(
					'label'          => __( 'Text', 'tesseract' ),
					'section'        => 'tesseract_header_logo',
					'settings'       => 'tesseract_header_logo_text',
					'type'           => 'text',
					'active_callback' 	=> 'tesseract_header_logo_choice_text',
					'priority' 		 => 5						
				)
			)
		);

		$wp_customize->add_setting( 'tesseract_header_logo_text_fonts',
			array(
				'default' => 'Work Sans',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_header_logo_text_fonts',
				array(
					'label'          => __( 'Google Font Style', 'tesseract' ),
					'section'        => 'tesseract_header_logo',
					'settings'       => 'tesseract_header_logo_text_fonts',
					'type'           => 'select',
					'choices' 			=> Menu_Font_Styles::get_google_fonts(),
					'active_callback' 	=> 'tesseract_header_logo_choice_text',
					'priority' 		 => 6						
				)
			)
		);

		$wp_customize->add_setting( 'tesseract_header_logo_text_fonts_styles',
			array(
				'default' => 'normal',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_header_logo_text_fonts_styles',
				array(
					'label'          => __( 'Font Style', 'tesseract' ),
					'section'        => 'tesseract_header_logo',
					'settings'       => 'tesseract_header_logo_text_fonts_styles',
					'type'           => 'select',

					'choices' => array('italic'=>'Italic','normal'=>'Normal'),
					'active_callback' 	=> 'tesseract_header_logo_choice_text',
					'priority' 		 => 7						
				)
			)
		);
		$wp_customize->add_setting( 'tesseract_header_logo_text_fonts_weights',
			array(
				'default' => '900',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_header_logo_text_fonts_weights',
				array(
					'label'          => __( 'Font Weights', 'tesseract' ),
					'section'        => 'tesseract_header_logo',
					'settings'       => 'tesseract_header_logo_text_fonts_weights',
					'type'           => 'select',
					'choices' => array('100'=>'100','200'=>'200','300'=>'300','400'=>'400','500'=>'500','600'=>'600','700'=>'700','800'=>'800','900'=>'900'),
					'active_callback' 	=> 'tesseract_header_logo_choice_text',
					'priority' 		 => 8						
				)
			)
		);
		$wp_customize->add_setting( 'tesseract_header_upper_logo_text_color', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#000000'
		) );

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'tesseract_header_upper_logo_text_color_control',
			array(
				'label'      => __( 'Header Logo Text Color', 'tesseract' ),
				'section'    => 'tesseract_header_colors',
				'settings'   => 'tesseract_header_upper_logo_text_color',
				'active_callback' 	=> 'tesseract_header_logo_choice_text',
				'priority'   => 9
			) )

		);

			   

			   