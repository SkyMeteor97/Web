<?php

/*

 * section WOOCOMMERCE

 */



	//Rename WooCommerce section to 'WooCommert Color Options' IF woocommerce-colors plugin is installed

	if ( is_plugin_active( 'woocommerce-colors/woocommerce-colors.php' ) ) {

	 	$wp_customize->get_section('woocommerce_colors')->title = __( 'WooCommerce Color Options', 'tesseract' );

	}



   	$wp_customize->add_section( 'tesseract_woocommerce' , array(

    	'title'      => __('WooCommerce Layout Options', 'tesseract'),

    	'priority'   => 61

	) );

		$args = array(  
		        'post_type' => 'product',  
		        'posts_per_page' => -1,
		        'post_status' => 'publish'
		    );  
		$pr = get_posts($args); 
		$pr_arr = array(); 
		/*for($i=0;$i<count($pr);$i++)
		{
			 array_push($pr_arr,$i);
		}*/
		for($i=1;$i<=count($pr);$i++)
		{
			$pr_arr[$i] = $i;//array_push($pr_arr,$i);
		}


   		$wp_customize->add_setting( 'tesseract_product_per_page', array(
			'transport'         => 'refresh',
			'default' => 12//floor(count($pr)/2)
			)

		);



		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				'tesseract_product_per_page_control',

				array(

					'label'         => __( 'Products Per Page' ),

					'section'       => 'tesseract_woocommerce',

					'settings'      => 'tesseract_product_per_page',

					'type'          => 'select',

					'choices'		=> $pr_arr,

					'priority' 		=> 1

				)

			)

		);






		$wp_customize->add_setting( 'tesseract_woocommerce_loop_layout_header', array(

			'type'           	=> 'option',

			'transport'         => 'refresh',

			'sanitize_callback' => '__return_false'

			)

		);



			$wp_customize->add_control(

				new Tesseract_Customize_Header_Control(

				$wp_customize,

				'tesseract_woocommerce_loop_layout_header_control',

				array(

					'label' =>  __('Product Listings', 'tesseract' ),

					'section' => 'tesseract_woocommerce',

					'settings' => 'tesseract_woocommerce_loop_layout_header',

					'priority' => 	1

					)

				)

			);



		$wp_customize->add_setting( 'tesseract_woocommerce_loop_layout', array(

				'sanitize_callback' => 'tesseract_sanitize_select_woocommerce_layout_types',

				'default' 			=> 'four-column'

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_woocommerce_loop_layout_control',

					array(

						'label'         => __( 'Choose a layout type for product listings ( main shop and product category/tag archive pages )', 'tesseract' ),

						'section'       => 'tesseract_woocommerce',

						'settings'      => 'tesseract_woocommerce_loop_layout',

						'type'          => 'select',

						'choices'		=> array(

							//'sidebar-left'  	    => 	'Left Sidebar',

							//'sidebar-right'  	    => 	'Right Sidebar',

							//'fullwidth'			    =>  'Full Width',

							// 'one-columnlist'    	=> 	'One Column',

							// 'one-columnlistleft'  	=> 	'One Column with left Sidebar',

							// 'one-columnlistright'  	=> 	'One Column with Right Sidebar',

							'two-columnlist'  	    => 	'Two Column',

							'two-columnlistleft'  	=> 	'Two Column with left Sidebar',

							'two-columnlistright'  	=> 	'Two Column with Right Sidebar',

							'three-column'  	    => 	'Three Column',

							'three-columnlistleft'  => 	'Three Column with left Sidebar',

							'three-columnlistright' => 	'Three Column with Right Sidebar',

							'four-column'		    =>  'Four Column',

							'four-columnlistleft'  	=> 	'Four Column with left Sidebar',

							'four-columnlistright'  => 	'Four Column with Right Sidebar',

							'five-column'		    =>  'Five Column',

							'five-columnlistleft'  	=> 	'Five Column with left Sidebar',

							'five-columnlistright'  => 	'Five Column with Right Sidebar'

						),

						'priority' 		=> 2

					)

				)

			);

        

		$wp_customize->add_setting( 'tesseract_woocommerce_title_size', array(

			'sanitize_callback' => 'tesseract_woocommerce_sanitize_title_size',

			'default' 			=> 'medium'

		) );

		

			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_woocommerce_title_size_control',

					array(

						'label'          => __( 'Choose the Title size', 'tesseract' ),

						'section'        => 'tesseract_woocommerce',

						'settings'       => 'tesseract_woocommerce_title_size',

						'type'           => 'radio',

						'choices'        => array(							

							'small'      =>  'Small size Title',						

							'medium'     =>  'Medium size Title',

							'large'      =>  'Large size Title'

						),

						'priority' 		 => 3									

					)

				)

			);

		

		$wp_customize->add_setting( 'tesseract_woocommerce_titlecolor', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#000000'

		) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_woocommerce_titlecolor_control',

				array(

					'label'      => __( 'Product Title Color', 'tesseract' ),

					'section'    => 'tesseract_woocommerce',

					'settings'   => 'tesseract_woocommerce_titlecolor',

					'priority'   => 4

				) )

			);

		

		$wp_customize->add_setting( 'tesseract_woocommerce_title_underline', array(

			'sanitize_callback' => 'tesseract_woocommerce_sanitize_title_underline',

			'default' 			=> 'notunderline'

		) );

		

			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_woocommerce_title_underline_control',

					array(

						'label'          => __( 'Choose the Title with Underline', 'tesseract' ),

						'section'        => 'tesseract_woocommerce',

						'settings'       => 'tesseract_woocommerce_title_underline',

						'type'           => 'radio',

						'choices'        => array(							

							'underline'      =>  'Title with Underline',						

							'notunderline'     =>  'Title without Underline'

						),

						'priority' 		 => 5									

					)

				)

			);

		

		$wp_customize->add_setting( "tesseract_woocommerce_price_size", array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'esc_html'

		));



		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				"tesseract_woocommerce_price_size_control",

				array(

					'label'          => __( 'Shop page Price size ', 'tesseract' ),

					'section'        => 'tesseract_woocommerce',

					'settings'       => 'tesseract_woocommerce_price_size',

					'type'           => 'text',

					'priority' 		 => 6

				)

			)

		);

			

		$wp_customize->add_setting( 'tesseract_woocommerce_pricecolor', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'sanitize_hex_color',

				'default' 			=> '#000000'

		) );



			$wp_customize->add_control(

				new WP_Customize_Color_Control(

				$wp_customize,

				'tesseract_woocommerce_pricecolor_control',

				array(

					'label'      => __( 'Product Price Color', 'tesseract' ),

					'section'    => 'tesseract_woocommerce',

					'settings'   => 'tesseract_woocommerce_pricecolor',

					'priority'   => 7

				) )

			);

		

		$wp_customize->add_setting( 'tesseract_woocommerce_price_weight', array(

			'sanitize_callback' => 'tesseract_woocommerce_sanitize_price_weight',

			'default' 			=> 'nonbold'

		) );

		

			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_woocommerce_price_weight_control',

					array(

						'label'          => __( 'Choose the Price with Bold Option', 'tesseract' ),

						'section'        => 'tesseract_woocommerce',

						'settings'       => 'tesseract_woocommerce_price_weight',

						'type'           => 'radio',

						'choices'        => array(							

							'bold'      =>  'Price with Bold',						

							'nonbold'     =>  'Price without Bold'

						),

						'priority' 		 => 8									

					)

				)

			);

		

		$wp_customize->add_setting( 'tesseract_woocommerce_shop_ratings', array(

				'sanitize_callback' => 'tesseract_woocommerce_shop_sanitize_ratings',

				'default'			=> 'hideratings'				

		) );

		

		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				'tesseract_woocommerce_shop_ratings_control',

				array(

					'label'          => __( 'Choose to Show or Hide Ratings on shop page', 'tesseract' ),

					'section'        => 'tesseract_woocommerce',

					'settings'       => 'tesseract_woocommerce_shop_ratings',

					'type'           => 'radio',

					'choices'        => array(

						'showratings'  	=> 'Show Ratings',

					    'hideratings' 	=> 'Hide Ratings'

					),

					'priority' 		 => 9										

				)

			)

		);

		

		

		$wp_customize->add_setting( 'tesseract_woocommerce_product_morebutton', array(

				'sanitize_callback' => 'tesseract_woocommerce_product_sanitize_morebutton',

				'default'			=> 'showcartbutton'				

		) );

		

			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_woocommerce_product_morebutton_control',

					array(

						'label'          => __( 'Choose to Show or Hide Cart Button', 'tesseract' ),

						'section'        => 'tesseract_woocommerce',

						'settings'       => 'tesseract_woocommerce_product_morebutton',

						'type'           => 'radio',

						'choices'        => array(

							'showcartbutton'  	=> 'Show Add to Cart Button',

							'hidecartbutton' 	=> 'Hide Add to Cart Button',

							'showmorebutton' 	=> 'Show More Details Button'

						),

						'priority' 		 => 10										

					)

				)

			);

		

		

		$wp_customize->add_setting( 'tesseract_woocommerce_product_button_option', array(

			'type'           	=> 'option',

			'transport'         => 'refresh',

			'sanitize_callback' => '__return_false'

			)

		);



			$wp_customize->add_control(

				new Tesseract_Customize_Header_Control(

				$wp_customize,

				'tesseract_woocommerce_product_button_option_control',

				array(

					'label' =>  __('Add to Cart Button Options', 'tesseract' ),

					'section' => 'tesseract_woocommerce',

					'settings' => 'tesseract_woocommerce_product_button_option',

					'priority' => 11

					)

				)

			);

		

		

		

		$wp_customize->add_setting( 'tesseract_woocommerce_buttonbgcolor', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'tesseract_sanitize_rgba',

				'default' 			=> '#fffff'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_woocommerce_buttonbgcolor_control',

			array(

				'label'      => __( 'Add to Cart/More Details Button Color', 'tesseract' ),

				'section'    => 'tesseract_woocommerce',

				'settings'   => 'tesseract_woocommerce_buttonbgcolor',

				'priority'   => 12

			) )

		);

		

		$wp_customize->add_setting( "tesseract_woocommerce_button_radius", array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'esc_html'

		));



		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				"tesseract_woocommerce_button_radius_control",

				array(

					'label'          => __( 'Add to Cart Button radius for Rounded Corner', 'tesseract' ),

					'section'        => 'tesseract_woocommerce',

					'settings'       => 'tesseract_woocommerce_button_radius',

					'type'           => 'text',

					'priority' 		 => 13

				)

			)

		);

		

		$wp_customize->add_setting( 'tesseract_woocommerce_button_size', array(

			'sanitize_callback' => 'tesseract_woocommerce_sanitize_button_size',

			'default' 			=> 'woomedium'

		) );

		

		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				'tesseract_woocommerce_button_control',

				array(

					'label'          => __( 'Choose the Cart Button size', 'tesseract' ),

					'section'        => 'tesseract_woocommerce',

					'settings'       => 'tesseract_woocommerce_button_size',

					'type'           => 'radio',

					'choices'        => array(							

						'small'      =>  'Small size Button',						

						'medium'     =>  'Medium size Button',

						'large'      =>  'Large size Button',

					),

					'priority' 		 => 14										

				)

			)

		);

		

		

		

		

		

		

		$wp_customize->add_setting( 'tesseract_woocommerce_product_layout_header', array(

			'type'           	=> 'option',

			'transport'         => 'refresh',

			'sanitize_callback' => '__return_false'

			)

		);



			$wp_customize->add_control(

				new Tesseract_Customize_Header_Control(

				$wp_customize,

				'tesseract_woocommerce_product_layout_header_control',

				array(

					'label' =>  __('Single Product Pages', 'tesseract' ),

					'section' => 'tesseract_woocommerce',

					'settings' => 'tesseract_woocommerce_product_layout_header',

					'priority' => 15

					)

				)

			);

		

		$wp_customize->add_setting( 'tesseract_woocommerce_product_breadcrumb', array(

				'sanitize_callback' => 'tesseract_woocommerce_product_sanitize_breadcrumb',

				'default'			=> 'showbreadcrumb'				

		) );

		

		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				'tesseract_woocommerce_product_breadcrumb_control',

				array(

					'label'          => __( 'Choose to Show or Hide Breadcrumb', 'tesseract' ),

					'section'        => 'tesseract_woocommerce',

					'settings'       => 'tesseract_woocommerce_product_breadcrumb',

					'type'           => 'radio',

					'choices'        => array(

						'showbreadcrumb'  	=> 'Show Breadcrumb',

					    'hidebreadcrumb' 	=> 'Hide Breadcrumb'

					),

					'priority' 		 => 16										

				)

			)

		);

		

		

		$wp_customize->add_setting( 'tesseract_woocommerce_product_ratings', array(

				'sanitize_callback' => 'tesseract_woocommerce_product_sanitize_ratings',

				'default'			=> 'showratings'				

		) );

		

		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				'tesseract_woocommerce_product_ratings_control',

				array(

					'label'          => __( 'Choose to Show or Hide Ratings', 'tesseract' ),

					'section'        => 'tesseract_woocommerce',

					'settings'       => 'tesseract_woocommerce_product_ratings',

					'type'           => 'radio',

					'choices'        => array(

						'showratings'  	=> 'Show Ratings',

					    'hideratings' 	=> 'Hide Ratings'

					),

					'priority' 		 => 17										

				)

			)

		);

		

		

		$wp_customize->add_setting( 'tesseract_woocommerce_product_layout', array(

				'sanitize_callback' => 'tesseract_sanitize_select_woocommerce_layout_types',

				'default' 			=> 'fullwidth'

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_woocommerce_product_layout_control',

					array(

						'label'         => __( 'Choose a layout type for single product pages', 'tesseract' ),

						'section'       => 'tesseract_woocommerce',

						'settings'      => 'tesseract_woocommerce_product_layout',

						'type'          => 'select',

						'choices'		=> array(

							'sidebar-left'  	=> 	'Left Sidebar',

							'sidebar-right'  	=> 	'Right Sidebar',

							'fullwidth'			=>  'Full Width'

						),

						'priority' 		=> 18

					)

				)

			);



		$wp_customize->add_setting( 'tesseract_woocommerce_default_layout_header', array(

			'type'           	=> 'option',

			'transport'         => 'refresh',

			'sanitize_callback' => '__return_false'

			)

		);



			$wp_customize->add_control(

				new Tesseract_Customize_Header_Control(

				$wp_customize,

				'tesseract_woocommerce_default_layout_header_control',

				array(

					'label' =>  __('Checkout, Account and Cart pages ', 'tesseract' ),

					'section' => 'tesseract_woocommerce',

					'settings' => 'tesseract_woocommerce_default_layout_header',

					'priority' => 19

					)

				)

			);



		$wp_customize->add_setting( 'tesseract_woocommerce_default_layout', array(

			'type'           	=> 'option',

			'transport'         => 'refresh',

			'sanitize_callback' => '__return_false'

			)

		);



			$wp_customize->add_control(

				new Tesseract_Customize_Header_Control(

				$wp_customize,

				'tesseract_woocommerce_default_layout_control',

				array(

					'label' =>  __('You can set the layout type for the Checkout, Account and Cart pages by using the default page template dropdown on the appropriate page\'s edit screen.', 'tesseract' ),

					'section' => 'tesseract_woocommerce',

					'settings' => 'tesseract_woocommerce_default_layout',

					'priority' => 19

					)

				)

			);



		/*$wp_customize->add_setting( 'tesseract_woocommerce_headercart_header', array(

			'type'           	=> 'option',

			'transport'         => 'refresh',

			'sanitize_callback' => '__return_false'

			)

		);



			$wp_customize->add_control(

				new Tesseract_Customize_Header_Control(

				$wp_customize,

				'tesseract_woocommerce_headercart_header_control',

				array(

					'label' =>  __('Header Cart', 'tesseract' ),

					'section' => 'tesseract_woocommerce',

					'settings' => 'tesseract_woocommerce_headercart_header',

					'priority' => 	19

					)

				)

			);*/



		$wp_customize->add_setting( 'tesseract_woocommerce_headercart', array(

				//'sanitize_callback' => 'tesseract_sanitize_checkbox',

				'default' 			=> 'disable',
				'transport' => 'refresh'

		) );



		$wp_customize->add_control(

			new WP_Customize_Control(

				$wp_customize,

				'tesseract_woocommerce_headercart_control',

				array(

					'label'          => __( 'Display Cart in header', 'tesseract' ),

					'section'        => 'tesseract_woocommerce',

					'settings'       => 'tesseract_woocommerce_headercart',

					'type'           => 'select',

					'choices' => array('enable'=>'Enable', 'disable'=>'Disable'),

					'priority' 		 => 20

				)

			)

		);



		$wp_customize->add_setting( 'tesseract_woocommerce_cartcolor', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'tesseract_sanitize_rgba',

				'default' 			=> '#fff'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_woocommerce_cartcolor_control',

			array(

				'label'      => __( 'Shopping Cart Color', 'tesseract' ),

				'section'    => 'tesseract_woocommerce',

				'settings'   => 'tesseract_woocommerce_cartcolor',

				'priority' 		 => 21

			) )

		);

		$wp_customize->add_setting( 'tesseract_woocommerce_salebgcolor', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'tesseract_sanitize_rgba',

				'default' 			=> '#77a464'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_woocommerce_salebgcolor_control',

			array(

				'label'      => __( 'Sale Tag Background Color', 'tesseract' ),

				'section'    => 'tesseract_woocommerce',

				'settings'   => 'tesseract_woocommerce_salebgcolor',

				'priority'   => 22

			) )

		);

		$wp_customize->add_setting( 'tesseract_woocommerce_saletextcolor', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'tesseract_sanitize_rgba',

				'default' 			=> '#fffff'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_woocommerce_saletextcolor_control',

			array(

				'label'      => __( 'Sale Tag Text Color', 'tesseract' ),

				'section'    => 'tesseract_woocommerce',

				'settings'   => 'tesseract_woocommerce_saletextcolor',

				'priority'   => 23

			) )

		);
		$wp_customize->add_setting( 'tesseract_woocommerce_regular_price_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'tesseract_sanitize_rgba',

				'default' 			=> '#FF0000'

		) );
		$wp_customize->add_setting( 'tesseract_woocommerce_button_text_color', array(

				'transport'         => 'refresh',

				'sanitize_callback' => 'tesseract_sanitize_rgba',

				'default' 			=> '#ffffff'

		) );



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_woocommerce_button_text_color_control',

			array(

				'label'      => __( 'Add To Cart Button Text Color', 'tesseract' ),

				'section'    => 'tesseract_woocommerce',

				'settings'   => 'tesseract_woocommerce_button_text_color',

				'priority'   => 26

			) )

		);



		$wp_customize->add_control(

			new WP_Customize_Color_Control(

			$wp_customize,

			'tesseract_woocommerce_regular_price_color_control',

			array(

				'label'      => __( 'Regular Price Color(In case of sale price exist)', 'tesseract' ),

				'section'    => 'tesseract_woocommerce',

				'settings'   => 'tesseract_woocommerce_regular_price_color',

				'priority'   => 27

			) )

		);

		$wp_customize->add_setting( 'tesseract_cart_button_position', array(

				'transport' => 'refresh',

				'default' 			=> 'left-woo-cart-btn'

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_cart_button_position_control',

					array(

						'label'         => __( 'Add to cart button postion(in shop page)', 'tesseract' ),

						'section'       => 'tesseract_woocommerce',

						'settings'      => 'tesseract_cart_button_position',

						'type'          => 'select',

						'choices'		=> array(

							'left-woo-cart-btn'  	=> 	'Left',

							'center-woo-cart-btn'  	=> 	'Center',

							'right-woo-cart-btn'			=>  'Right'

						),

						'priority' 		=> 28

					)

				)

			);