<?php

/*

 * section FOOTER CONTENT

 */



   	$wp_customize->add_section( 'tesseract_footer_content' , array(

    	'title'      => __('Footer Content', 'tesseract'),

    	'priority'   => 10,

		'panel'      => 'tesseract_footer_options'

	) );
	




		$wp_customize->add_setting( 'tesseract_footer_content_header', array(

			'default'           => '',

			'type'           	=> 'option',

			'transport'         => 'refresh',

			'sanitize_callback' => '__return_false'

			)

		);



			$wp_customize->add_control(

				new Tesseract_Customize_Footer_Control(

				$wp_customize,

				'tesseract_footer_content_header_control',

				array(

					'label' =>  __('Left Footer Area:', 'tesseract' ),

					'description' =>  __('Choose the content to be displayed on the left area of the footer.', 'tesseract' ),

					'section' => 'tesseract_footer_content',

					'settings' => 'tesseract_footer_content_header',

					'priority' => 	1

					)

				)

			);



		$wp_customize->add_setting( 'tesseract_footer_additional_content', array(

				'sanitize_callback' => 'tesseract_sanitize_radio_nextToMenu_left',

				'default'			=> 'nothing'

		) );



		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				'tesseract_footer_additional_content_control',

				array(

					'section'        => 'tesseract_footer_content',

					'settings'       => 'tesseract_footer_additional_content',

					'type'           => 'radio',

					'choices' 		 => array(

						'nothing' 	 => 'Nothing',

						'html'       => 'HTML',

						'logo' 		 => 'Logo',

						'social'     => 'Social Icons',

						'search' 	 => 'Search Bar',

						'menu' 	 	 => 'Menu',

					),

					'priority' 		 => 2,

					''

				)

			)

		);
		$default_html = '<strong>Theme by <a href="http://tesseracttheme.com">Tesseract</a></strong>

                        &nbsp;&nbsp;

                        <strong>

                        	<a href="http://tesseracttheme.com">

                        		<img src="http://tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />

                            </a>

                        </strong>';


		$wp_customize->add_setting( 'tesseract_footer_left_content_html', array(

				'sanitize_callback' => 'tesseract_sanitize_textarea_html',

				'default' 			=> $default_html

			) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_footer_left_content_control_type_html',

					array(

						'label'          => __( 'HTML', 'tesseract-remove-branding' ),

						'section'        => 'tesseract_footer_content',

						'settings'       => 'tesseract_footer_left_content_html',

						'type'           => 'textarea',

						'priority' 		 => 4,

						'active_callback' => 'tesseract_left_area_html_enable'

					)

				)

			);




		$tesseract_menu_selector_menus = get_terms( 'nav_menu' );
		$menus = get_nav_menu_locations();
		

		if ( $tesseract_menu_selector_menus && $menus['secondary']) :



			$tesseract_menu_selector_items = array();

			$item_keys = array( 'none' ); $item_values = array( 'None' );

			foreach ( $tesseract_menu_selector_menus as $items ) {

				array_push( $item_keys, $items->slug);

				array_push( $item_values, $items->name);

			}



			$tesseract_menu_selector_items = array_combine( $item_keys, $item_values );



			$wp_customize->add_setting( 'tesseract_footer_menu_select', array(

				'sanitize_callback' => 'tesseract_sanitize_select',
				'default' => 'none'

			) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_footer_menu_select_control',

					array(

						'label'          => __( 'Select Menu', 'tesseract' ),

						'section'        => 'tesseract_footer_content',

						'settings'       => 'tesseract_footer_menu_select',

						'type'           => 'select',

						'choices'        => $tesseract_menu_selector_items,

						'active_callback' => 'tesseract_footer_left_menu_select_enable_2',

						'priority' 		 => 3

					)

				)

			);

		endif;
		if(!class_exists('Tesseract_Remove_Branding_Customizer')):
					
					$wp_customize->add_setting( 'tesseract_footer_content_right', array(

						'default'           => '',

						'type'           	=> 'option',

						'transport'         => 'refresh',

						'sanitize_callback' => '__return_false'

						)

					);



				$wp_customize->add_control(

					new Tesseract_Customize_Footer_Control(

					$wp_customize,

					'tesseract_footer_content_right_control',

					array(

						'label' =>  __('Right Footer Area:', 'tesseract' ),

						'description' =>  __('Choose the content to be displayed on the right area of the footer.', 'tesseract' ),

						'section' => 'tesseract_footer_content',

						'settings' => 'tesseract_footer_content_right',

						'priority' => 	5

						)

					)

				);

				$wp_customize->add_setting( 'tesseract_footer_content_centre', array(

			'default'           => '',

			'type'           	=> 'option',

			'transport'         => 'refresh',

			'sanitize_callback' => '__return_false'

			)

		);



			$wp_customize->add_control(

				new Tesseract_Customize_Footer_Control(

				$wp_customize,

				'tesseract_footer_content_centre_control',

				array(

					'label' =>  __('Center Footer Area:', 'tesseract' ),

					'description' =>  __('Choose the content to be displayed on the center area of the footer.', 'tesseract' ),

					'section' => 'tesseract_footer_content',

					'settings' => 'tesseract_footer_content_centre',

					'priority' => 	7

					)

				)

			);



					$wp_customize->add_setting( 'tesseract_footer_centre_content_blank', array( 'sanitize_callback' => '__return_false'	) );

					$wp_customize->add_control(

						new Tesseract_Customize_Footer2_Control(

						$wp_customize,

						'tesseract_footer_centre_content_blank',

						array(

							'description' =>  __('<a href="http://tesseracttheme.com/designer/" target="_blank"><img src="https://s3.amazonaws.com/tesseracttheme/unlock.png" /></a>', 'tesseract' ),

							'section' => 'tesseract_footer_content',

							'settings' => 'tesseract_footer_centre_content_blank',

							'priority' => 8

							)

						)

					);
					$wp_customize->add_setting( 'tesseract_footer_centre_content_blank1', array( 'sanitize_callback' => '__return_false'	) );

					$wp_customize->add_control(

						new Tesseract_Customize_Footer2_Control(

						$wp_customize,

						'tesseract_footer_centre_content_blank1',

						array(

							'description' =>  __('<a href="http://tesseracttheme.com/designer/" target="_blank"><img src="https://s3.amazonaws.com/tesseracttheme/unlock.png" /></a>', 'tesseract' ),

							'section' => 'tesseract_footer_content',

							'settings' => 'tesseract_footer_centre_content_blank1',

							'priority' => 6

							)

						)

					);
				endif;


		