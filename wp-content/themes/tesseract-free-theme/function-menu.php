<?php
class Menu_Font_Styles{
	public static function register( $wp_customize ) {
		//  HEADER
		$wp_customize->add_section( 
			'header_menu_font_styles', 
			array(
				'title'       => __( 'Header Menu Font Styles', 'tesseract' ),
				'panel'		=> 'tesseract_header_options',
				'priority'    => 20,
				'capability'  => 'edit_theme_options',
				'description' => __('Change header menu font styles from here.', 'tesseract'), 
			) 
		);
		$wp_customize->add_setting( 'header_menu_text_fonts',
			array(
				'default' => 'Open Sans',
				'transport' => 'postMessage',
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'header_menu_text_fonts',
				array(
					'label'          => __( 'Google Font Style', 'tesseract' ),
					'section'        => 'header_menu_font_styles',
					'settings'       => 'header_menu_text_fonts',
					'type'           => 'select',

					'choices' => Menu_Font_Styles::get_google_fonts(),
					'priority' 		 => 1						
				)
			)
		);

		$wp_customize->add_setting( 'header_menu_text_fonts_styles',
			array(
				'default' => 'normal',
				'transport' => 'postMessage'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'header_menu_text_fonts_styles',
				array(
					'label'          => __( 'Font Style', 'tesseract' ),
					'section'        => 'header_menu_font_styles',
					'settings'       => 'header_menu_text_fonts_styles',
					'type'           => 'select',

					'choices' => array('italic'=>'Italic','normal'=>'Normal'),
					'priority' 		 => 2						
				)
			)
		);
		$wp_customize->add_setting( 'header_menu_text_fonts_weights',
			array(
				'default' => '100',
				'transport' => 'postMessage'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'header_menu_text_fonts_weights',
				array(
					'label'          => __( 'Font Weights', 'tesseract' ),
					'section'        => 'header_menu_font_styles',
					'settings'       => 'header_menu_text_fonts_weights',
					'type'           => 'select',
					'choices' => array('100'=>'100','200'=>'200','300'=>'300','400'=>'400','500'=>'500','600'=>'600','700'=>'700','800'=>'800','900'=>'900'),
					'priority' 		 => 3						
				)
			)
		);

		$wp_customize->add_setting( 'header_separator_symbol',
			array(
				'default' => 'sp-none',
				'transport' => 'postMessage'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'header_separator_symbol',
				array(
					'label'          => __( 'Header Menu Separator Symbol', 'tesseract' ),
					'section'        => 'header_menu_font_styles',
					'settings'       => 'header_separator_symbol',
					'type'           => 'select',
					'choices' => array('sp-none'=>'None','sp-pipeline'=>'|','sp-colon'=>':'),
					'priority' 		 => 3						
				)
			)
		);

		

		// $wp_customize->add_setting( 'header_menu_text_size',
		// 	array(
		// 		'default' => 'h1',
		// 		'transport' => 'postMessage'
		// 	)
		// ); 
		// $wp_customize->add_control( 
		// 	new WP_Customize_Control(
		// 		$wp_customize,
		// 		'header_menu_text_size',
		// 		array(
		// 			'label'          => __( 'Font Size', 'tesseract' ),
		// 			'section'        => 'header_menu_font_styles',
		// 			'settings'       => 'header_menu_text_size',
		// 			'type'           => 'select',
		// 			'choices' 		=> array("h1"=>"H1","h2"=>"H2","h3"=>"H3","h4"=>"H4","custom"=>"Custom Value"),
		// 			'priority' 		 => 4						
		// 		)
		// 	)
		// );
		$wp_customize->add_setting( 'header_menu_text_size_custom',
			array(
				'default' => 16,
				'transport' => 'postMessage'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'header_menu_text_size_custom',
				array(
					'label'          => __( 'Font Size(In px.)', 'tesseract' ),
					'section'        => 'header_menu_font_styles',
					'settings'       => 'header_menu_text_size_custom',
					'type'           => 'number',
					'priority' 		 => 5						
				)
			)
		);

		$wp_customize->add_setting( 'header_menu_text_spacing',
			array(
				'default' => 0,
				'transport' => 'postMessage'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'header_menu_text_spacing',
				array(
					'label'          => __( 'Font Spacing(In px.)', 'tesseract' ),
					'section'        => 'header_menu_font_styles',
					'settings'       => 'header_menu_text_spacing',
					'type'           => 'number',
					'priority' 		 => 6						
				)
			)
		);

		

		// FOOTER
		$wp_customize->add_section( 
			'footer_menu_font_styles', 
			array(
				'title'       => __( 'Footer Font Styles', 'tesseract' ),
				'panel'		=> 'tesseract_footer_options',
				'priority'    => 20,
				'capability'  => 'edit_theme_options',
				'description' => __('Change footer font styles from here.', 'tesseract'), 
			) 
		);
		$wp_customize->add_setting( 'footer_menu_text_fonts',
			array(
				'default' => 'Oswald',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_menu_text_fonts',
				array(
					'label'          => __( 'Google Font Style', 'tesseract' ),
					'section'        => 'footer_menu_font_styles',
					'settings'       => 'footer_menu_text_fonts',
					'type'           => 'select',
					'choices' => Menu_Font_Styles::get_google_fonts(),
					'priority' 		 => 1						
				)
			)
		);
		$wp_customize->add_setting( 'footer_menu_text_fonts_styles',
			array(
				'default' => 'normal',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_menu_text_fonts_styles',
				array(
					'label'          => __( 'Font Style', 'tesseract' ),
					'section'        => 'footer_menu_font_styles',
					'settings'       => 'footer_menu_text_fonts_styles',
					'type'           => 'select',

					'choices' => array('italic'=>'Italic','normal'=>'Normal'),
					'priority' 		 => 2						
				)
			)
		);
		$wp_customize->add_setting( 'footer_menu_text_fonts_weights',
			array(
				'default' => '900',
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_menu_text_fonts_weights',
				array(
					'label'          => __( 'Font Weights', 'tesseract' ),
					'section'        => 'footer_menu_font_styles',
					'settings'       => 'footer_menu_text_fonts_weights',
					'type'           => 'select',
					'choices' 		 => array('100'=>'100','200'=>'200','300'=>'300','400'=>'400','500'=>'500','600'=>'600','700'=>'700','800'=>'800','900'=>'900'),
					'priority' 		 => 3						
				)
			)
		);

		

		// $wp_customize->add_setting( 'header_menu_text_size',
		// 	array(
		// 		'default' => 'h1',
		// 		'transport' => 'postMessage'
		// 	)
		// ); 
		// $wp_customize->add_control( 
		// 	new WP_Customize_Control(
		// 		$wp_customize,
		// 		'header_menu_text_size',
		// 		array(
		// 			'label'          => __( 'Font Size', 'tesseract' ),
		// 			'section'        => 'header_menu_font_styles',
		// 			'settings'       => 'header_menu_text_size',
		// 			'type'           => 'select',
		// 			'choices' 		=> array("h1"=>"H1","h2"=>"H2","h3"=>"H3","h4"=>"H4","custom"=>"Custom Value"),
		// 			'priority' 		 => 4						
		// 		)
		// 	)
		// );
		$wp_customize->add_setting( 'footer_menu_text_size_custom',
			array(
				'default' => 16,
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_menu_text_size_custom',
				array(
					'label'          => __( 'Font Size(In px.)', 'tesseract' ),
					'section'        => 'footer_menu_font_styles',
					'settings'       => 'footer_menu_text_size_custom',
					'type'           => 'number',
					'priority' 		 => 5						
				)
			)
		);

		$wp_customize->add_setting( 'footer_menu_text_spacing',
			array(
				'default' => 0,
				'transport' => 'refresh'
			)
		); 
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'footer_menu_text_spacing',
				array(
					'label'          => __( 'Font Spacing(In px.)', 'tesseract' ),
					'section'        => 'footer_menu_font_styles',
					'settings'       => 'footer_menu_text_spacing',
					'type'           => 'number',
					'priority' 		 => 6						
				)
			)
		);
		if(class_exists('Tesseract_Remove_Branding_Customizer')):
			$wp_customize->add_section( 'tesseract_footer_centre', array(

				'title'      => __('Footer Center Block Content', 'tesseract'),

				'priority'   => 6,

				'panel'      => 'tesseract_footer_options'
			) );

			$wp_customize->add_setting( 'tesseract_footer_centre_content_header', array(

				'default'           => '',

				'type'           	=> 'option',

				//'transport'         => 'refresh',

				//'sanitize_callback' => '__return_false'

				)
			);

			$wp_customize->add_control(

				new Tesseract_Customize_Footer_Control(

				$wp_customize,

				 'tesseract_footer_centre_content_header_control',

				array(

					'label' =>  __('Choose the content to be displayed in the centre block of the footer area', 'tesseract-remove-branding' ),

					'section' => 'tesseract_footer_centre',

					'settings' => 'tesseract_footer_centre_content_header',

					'priority' => 	1

					)

				)
			);
			$wp_customize->add_setting( 'tesseract_footer_centre_content', array(
					'default'			=> 'nothing'
			) );

			$choices = array(

				'nothing' 	 => __( 'Nothing', 'tesseract' ),

				'logo'		=> __('Logo','tesseract'),

				'html' 	 => __( 'HTML', 'tesseract' ),

				'social'     => __( 'Social Icons', 'tesseract' ),

				'search' 	 => __( 'Search Bar', 'tesseract' ),

				'menu'		=> __('Menu', 'tesseract')
			);


			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_footer_centre_content_control',

					array(

						'section'        => 'tesseract_footer_centre',

						'settings'       => 'tesseract_footer_centre_content',

						'type'           => 'radio',

						'choices' 		 => $choices,

						'priority' 		 => 2

					)

				)
			);

			$default_html = '<strong>Theme by <a href="https://tesseracttheme.com">Tesseract</a></strong>

                        &nbsp;&nbsp;

                        <strong>

                        	<a href="https://tesseracttheme.com">

                        		<img src="https://tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />

                            </a>

                        </strong>';



			$wp_customize->add_setting( 'tesseract_footer_centre_content_html', array(

				'sanitize_callback' => 'tesseract_sanitize_textarea_html',

				'default' 			=> $default_html

			) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_footer_centre_content_control_type_html',

					array(

						'label'          => __( 'HTML', 'tesseract-remove-branding' ),

						'section'        => 'tesseract_footer_centre',

						'settings'       => 'tesseract_footer_centre_content_html',

						'type'           => 'textarea',

						'priority' 		 => 4,

						'active_callback' => 'tesseract_footer_centre_menu_select_enable_2'

					)

				)

			);

			
		$footer_centre_content_menu_selector_menus = get_terms( 'nav_menu' );

		$menus = get_nav_menu_locations();

		if ( empty( $footer_centre_content_menu_selector_menus ) ||  !$menus['secondary']) {

			$footer_centre_content_menu_selector_items = array( 'none' => "You haven't made any menus!" );

		} else {

			$footer_centre_content_menu_selector_items = array();

			$item_keys = array( 'none' ); $item_values = array( 'None' );

			foreach ( $footer_centre_content_menu_selector_menus as $items ) {

				array_push( $item_keys, $items->slug);

				array_push( $item_values, $items->name);

			}



			$footer_centre_content_menu_selector_items = array_combine( $item_keys, $item_values );

		}

		$wp_customize->add_setting( 'tesseract_footer_centre_menu_select', array(

			'sanitize_callback' => 'tesseract_sanitize_select',

			'default' 			=> 'none'

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_footer_centre_content_control_type_menu',

					array(

						'label'          => __( 'Select menu', 'tesseract-remove-branding' ),

						'section'        => 'tesseract_footer_centre',

						'settings'       => 'tesseract_footer_centre_menu_select',

						'type'           => 'select',

						'choices'        => $footer_centre_content_menu_selector_items,

						'priority' 		 => 5,

						'active_callback' 	=> 'tesseract_footer_centre_menu_select_enable'

					)

				)

			);

		$wp_customize->add_setting( 'tesseract_footer_centre_menuhtml_select', array(

			'sanitize_callback' => 'tesseract_sanitize_select',

			'default' 			=> 'none'

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					'tesseract_footer_centre_content_control_type_menuhtml',

					array(

						'label'          => __( 'Select menu', 'tesseract-remove-branding' ),

						'section'        => 'tesseract_footer_centre',

						'settings'       => 'tesseract_footer_centre_menuhtml_select',

						'type'           => 'select',

						'choices'        => $footer_centre_content_menu_selector_items,

						'priority' 		 => 5,

						'active_callback' 	=> 'tesseract_footer_centre_menuhtml_select_enable'

					)

				)

			);

		endif;	
	}

	
	public static function get_google_fonts()
	{
		
		$googlefonts = array("none"=>"Select a font",
			"0"=>"------ Top 40 Fonts ------",
			/*"Open Sans" => "Open Sans",
			"Josefin Slab" => "Josefin Slab",
			"Arvo" => "Arvo",
			"Lato" => "Lato",
			"Vollkorn" => "Vollkorn",
			"Abril Fatface" => "Abril Fatface",
			"Ubuntu" => "Ubuntu",
			"PT Sans PT Serif" => "PT Sans PT Serif",
			"Old Standard TT" => "Old Standard TT",
			"Droid Sans" => "Droid Sans",
			"Anivers" => "Anivers",
			"Junction" => "Junction",
			"Fertigo" => "Fertigo",
			"Aller" => "Aller",
			"Audimat" => "Audimat",
			"Delicious" => "Delicious",
			"Prociono" => "Prociono",
			"Fontin" => "Fontin",
			"Fontin Sans" => "Fontin Sans",
			"Chunkfive" => "Chunkfive",*/
			"Playfair Display" => "Playfair Display",
			"Work Sans" => "Work Sans",
			"Rubik" => "Rubik",
			"Cormorant Garamond" => "Cormorant Garamond",
			"Libre Franklin" => "Libre Franklin",
			"Space Mono" => "Space Mono",
			"Fira Sans" => "Fira Sans",
			"Eczar" => "Eczar",
			"Alegreya Sans" => "Alegreya Sans",
			"Alegreya" => "Alegreya",
			"Karla" => "Karla",
			"Lora" => "Lora",
			"Source Sans Pro" => "Source Sans Pro",
			"Source Serif Pro" => "Source Serif Pro",
			"Roboto" => "Roboto",
			"Roboto Slab" => "Roboto Slab",
			"Poppins" => "Poppins",
			"BioRhyme" => "BioRhyme",
			"Archivo Narrow" => "Archivo Narrow",
			"Libre Baskerville" => "Libre Baskerville",
			"Crimson Text" => "Crimson Text",
			"Chivo" => "Chivo",
			"Montserrat" => "Montserrat",
			"Old Standard TT" => "Old Standard TT",
			"Domine" => "Domine",
			"Rajdhani" => "Rajdhani",
			"Bitter" => "Bitter",
			"Cardo" => "Cardo",
			"PT Sans" => "PT Sans",
			"PT Serif" => "PT Serif",
			"Raleway" => "Raleway",
			"Gentium Basic" => "Gentium Basic",
			"Open Sans" => "Open Sans",
			"Neuton" => "Neuton",
			"Inconsolata" => "Inconsolata",
			"Cabin" => "Cabin",
			"Lato" => "Lato",
			"Anonymous Pro" => "Anonymous Pro",
			"Arvo" => "Arvo",
			"Merriweather" => "Merriweather",
			" "=>"------ All Fonts -----",
			"ABeeZee" => "ABeeZee",
			"Abel" => "Abel",
			"Abril Fatface" => "Abril Fatface",
			"Aclonica" => "Aclonica",
			"Acme" => "Acme",
			"Actor" => "Actor",
			"Adamina" => "Adamina",
			"Advent Pro" => "Advent Pro",
			"Aguafina Script" => "Aguafina Script",
			"Akronim" => "Akronim",
			"Aladin" => "Aladin",
			"Aldrich" => "Aldrich",
			"Alegreya" => "Alegreya",
			"Alegreya SC" => "Alegreya SC",
			"Alex Brush" => "Alex Brush",
			"Alfa Slab One" => "Alfa Slab One",
			"Alice" => "Alice",
			"Alike" => "Alike",
			"Alike Angular" => "Alike Angular",
			"Allan" => "Allan",
			"Allerta" => "Allerta",
			"Allerta Stencil" => "Allerta Stencil",
			"Allura" => "Allura",
			"Almendra" => "Almendra",
			"Almendra Display" => "Almendra Display",
			"Almendra SC" => "Almendra SC",
			"Amarante" => "Amarante",
			"Amaranth" => "Amaranth",
			"Amatic SC" => "Amatic SC",
			"Amethysta" => "Amethysta",
			"Anaheim" => "Anaheim",
			"Andada" => "Andada",
			"Andika" => "Andika",
			"Angkor" => "Angkor",
			"Annie Use Your Telescope" => "Annie Use Your Telescope",
			"Anonymous Pro" => "Anonymous Pro",
			"Antic" => "Antic",
			"Antic Didone" => "Antic Didone",
			"Antic Slab" => "Antic Slab",
			"Anton" => "Anton",
			"Arapey" => "Arapey",
			"Arbutus" => "Arbutus",
			"Arbutus Slab" => "ArbutusSlab",
			"Architects Daughter" => "Architects Daughter",
			"Archivo Black" => "Archivo Black",
			"Archivo Narrow" => "Archivo Narrow",
			"Arimo" => "Arimo",
			"Arizonia" => "Arizonia",
			"Armata" => "Armata",
			"Artifika" => "Artifika",
			"Arvo" => "Arvo",
			"Asap" => "Asap",
			"Asset" => "Asset",
			"Astloch" => "Astloch",
			"Asul" => "Asul",
			"Atomic Age" => "Atomic Age",
			"Aubrey" => "Aubrey",
			"Audiowide" => "Audiowide",
			"Autour One" => "Autour One",
			"Average" => "Average",
			"Average Sans" => "Average Sans",
			"Averia Gruesa Libre" => "Averia Gruesa Libre",
			"Averia Libre" => "Averia Libre",
			"Averia Sans Libre" => "Averia Sans Libre",
			"Averia Serif Libre" => "Averia Serif Libre",
			"Bad Script" => "Bad Script",
			"Balthazar" => "Balthazar",
			"Bangers" => "Bangers",
			"Basic" => "Basic",
			"Battambang" => "Battambang",
			"Baumans" => "Baumans",
			"Bayon" => "Bayon",
			"Belgrano" => "Belgrano",
			"Belleza" => "Belleza",
			"BenchNine" => "BenchNine",
			"Bentham" => "Bentham",
			"Berkshire Swash" => "Berkshire Swash",
			"Bevan" => "Bevan",
			"Bigelow Rules" => "Bigelow Rules",
			"Bigshot One" => "Bigshot One",
			"Bilbo" => "Bilbo",
			"Bilbo Swash Caps" => "Bilbo Swash Caps",
			"Bitter" => "Bitter",
			"Black Ops One" => "Black Ops One",
			"Bokor" => "Bokor",
			"Bonbon" => "Bonbon",
			"Boogaloo" => "Boogaloo",
			"Bowlby One" => "Bowlby One",
			"Bowlby One SC" => "Bowlby One SC",
			"Brawler" => "Brawler",
			"Bree Serif" => "Bree Serif",
			"Bubblegum Sans" => "Bubblegum Sans",
			"Bubbler One" => "Bubbler One",
			"Buda" => "Buda",
			"Buenard" => "Buenard",
			"Butcherman" => "Butcherman",
			"Butterfly Kids" => "Butterfly Kids",
			"Cabin" => "Cabin",
			"Cabin Condensed" => "Cabin Condensed",
			"Cabin Sketch" => "Cabin Sketch",
			"Caesar Dressing" => "Caesar Dressing",
			"Cagliostro" => "Cagliostro",
			"Calligraffitti" => "Calligraffitti",
			"Cambo" => "Cambo",
			"Candal" => "Candal",
			"Cantarell" => "Cantarell",
			"Cantata One" => "Cantata One",
			"Cantora One" => "Cantora One",
			"Capriola" => "Capriola",
			"Cardo" => "Cardo",
			"Carme" => "Carme",
			"Carrois Gothic" => "Carrois Gothic",
			"Carrois Gothic SC" => "Carrois Gothic SC",
			"Carter One" => "Carter One",
			"Caudex" => "Caudex",
			"Cedarville Cursive" => "Cedarville Cursive",
			"Ceviche One" => "Ceviche One",
			"Changa One" => "Changa One",
			"Chango" => "Chango",
			"Chau Philomene One" => "Chau Philomene One",
			"Chela One" => "Chela One",
			"Chelsea Market" => "Chelsea Market",
			"Chenla" => "Chenla",
			"Cherry Cream Soda" => "Cherry Cream Soda",
			"Cherry Swash" => "Cherry Swash",
			"Chewy" => "Chewy",
			"Chicle" => "Chicle",
			"Chivo" => "Chivo",
			"Cinzel" => "Cinzel",
			"Cinzel Decorative" => "Cinzel Decorative",
			"Clicker Script" => "Clicker Script",
			"Coda" => "Coda",
			"Coda Caption" => "Coda Caption",
			"Codystar" => "Codystar",
			"Combo" => "Combo",
			"Comfortaa" => "Comfortaa",
			"Coming Soon" => "Coming Soon",
			"Concert One" => "Concert One",
			"Condiment" => "Condiment",
			"Content" => "Content",
			"Contrail One" => "Contrail One",
			"Convergence" => "Convergence",
			"Cookie" => "Cookie",
			"Copse" => "Copse",
			"Corben" => "Corben",
			"Courgette" => "Courgette",
			"Cousine" => "Cousine",
			"Coustard" => "Coustard",
			"Covered By Your Grace" => "Covered By Your Grace",
			"Crafty Girls" => "Crafty Girls",
			"Creepster" => "Creepster",
			"Crete Round" => "Crete Round",
			"Crimson Text" => "Crimson Text",
			"Croissant One" => "Croissant One",
			"Crushed" => "Crushed",
			"Cuprum" => "Cuprum",
			"Cutive" => "Cutive",
			"Cutive Mono" => "Cutive Mono",
			"Damion" => "Damion",
			"Dancing Script" => "Dancing Script",
			"Dangrek" => "Dangrek",
			"Dawning of a New Day" => "Dawning of a New Day",
			"Days One" => "Days One",
			"Delius" => "Delius",
			"Delius Swash Caps" => "Delius Swash Caps",
			"Delius Unicase" => "Delius Unicase",
			"Della Respira" => "Della Respira",
			"Denk One" => "Denk One",
			"Devonshire" => "Devonshire",
			"Didact Gothic" => "Didact Gothic",
			"Diplomata" => "Diplomata",
			"Diplomata SC" => "Diplomata SC",
			"Domine" => "Domine",
			"Donegal One" => "Donegal One",
			"Doppio One" => "Doppio One",
			"Dorsa" => "Dorsa",
			"Dosis" => "Dosis",
			"Dr Sugiyama" => "Dr Sugiyama",
			"Droid Sans" => "Droid Sans",
			"Droid Sans Mono" => "Droid Sans Mono",
			"Droid Serif" => "Droid Serif",
			"Duru Sans" => "Duru Sans",
			"Dynalight" => "Dynalight",
			"EB Garamond" => "EB Garamond",
			"Eagle Lake" => "Eagle Lake",
			"Eater" => "Eater",
			"Economica" => "Economica",
			"Electrolize" => "Electrolize",
			"Elsie" => "Elsie",
			"Elsie Swash Caps" => "Elsie Swash Caps",
			"Emblema One" => "Emblema One",
			"Emilys Candy" => "Emilys Candy",
			"Engagement" => "Engagement",
			"Englebert" => "Englebert",
			"Enriqueta" => "Enriqueta",
			"Erica One" => "Erica One",
			"Esteban" => "Esteban",
			"Euphoria Script" => "Euphoria Script",
			"Ewert" => "Ewert",
			"Exo" => "Exo",
			"Expletus Sans" => "Expletus Sans",
			"Fanwood Text" => "Fanwood Text",
			"Fascinate" => "Fascinate",
			"Fascinate Inline" => "Fascinate Inline",
			"Faster One" => "Faster One",
			"Fasthand" => "Fasthand",
			"Federant" => "Federant",
			"Federo" => "Federo",
			"Felipa" => "Felipa",
			"Fenix" => "Fenix",
			"Finger Paint" => "Finger Paint",
			"Fjalla One" => "Fjalla One",
			"Fjord One" => "Fjord One",
			"Flamenco" => "Flamenco",
			"Flavors" => "Flavors",
			"Fondamento" => "Fondamento",
			"Fontdiner Swanky" => "Fontdiner Swanky",
			"Forum" => "Forum",
			"Francois One" => "Francois One",
			"Freckle Face" => "Freckle Face",
			"Fredericka the Great" => "Fredericka the Great",
			"Fredoka One" => "Fredoka One",
			"Freehand" => "Freehand",
			"Fresca" => "Fresca",
			"Frijole" => "Frijole",
			"Fruktur" => "Fruktur",
			"Fugaz One" => "Fugaz One",
			"GFS Didot" => "GFS Didot",
			"GFS Neohellenic" => "GFS Neohellenic",
			"Gabriela" => "Gabriela",
			"Gafata" => "Gafata",
			"Galdeano" => "Galdeano",
			"Galindo" => "Galindo",
			"Gentium Basic" => "Gentium Basic",
			"Gentium Book Basic" => "Gentium Book Basic",
			"Geo" => "Geo",
			"Geostar" => "Geostar",
			"Geostar Fill" => "Geostar Fill",
			"Germania One" => "Germania One",
			"Gilda Display" => "Gilda Display",
			"Give You Glory" => "Give You Glory",
			"Glass Antiqua" => "Glass Antiqua",
			"Glegoo" => "Glegoo",
			"Gloria Hallelujah" => "Gloria Hallelujah",
			"Goblin One" => "Goblin One",
			"Gochi Hand" => "Gochi Hand",
			"Gorditas" => "Gorditas",
			"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
			"Graduate" => "Graduate",
			"Grand Hotel" => "Grand Hotel",
			"Gravitas One" => "Gravitas One",
			"Great Vibes" => "Great Vibes",
			"Griffy" => "Griffy",
			"Gruppo" => "Gruppo",
			"Gudea" => "Gudea",
			"Habibi" => "Habibi",
			"Hammersmith One" => "Hammersmith One",
			"Hanalei" => "Hanalei",
			"Hanalei Fill" => "Hanalei Fill",
			"Handlee" => "Handlee",
			"Hanuman" => "Hanuman",
			"Happy Monkey" => "Happy Monkey",
			"Headland One" => "Headland One",
			"Henny Penny" => "Henny Penny",
			"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
			"Holtwood One SC" => "Holtwood One SC",
			"Homemade Apple" => "Homemade Apple",
			"Homenaje" => "Homenaje",
			"IM Fell DW Pica" => "IM Fell DW Pica",
			"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
			"IM Fell Double Pica" => "IM Fell Double Pica",
			"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
			"IM Fell English" => "IM Fell English",
			"IM Fell English SC" => "IM Fell English SC",
			"IM Fell French Canon" => "IM Fell French Canon",
			"IM Fell French Canon SC" => "IM Fell French Canon SC",
			"IM Fell Great Primer" => "IM Fell Great Primer",
			"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
			"Iceberg" => "Iceberg",
			"Iceland" => "Iceland",
			"Imprima" => "Imprima",
			"Inconsolata" => "Inconsolata",
			"Inder" => "Inder",
			"Indie Flower" => "Indie Flower",
			"Inika" => "Inika",
			"Irish Grover" => "Irish Grover",
			"Istok Web" => "Istok Web",
			"Italiana" => "Italiana",
			"Italianno" => "Italianno",
			"Jacques Francois" => "Jacques Francois",
			"Jacques Francois Shadow" => "Jacques Francois Shadow",
			"Jim Nightshade" => "Jim Nightshade",
			"Jockey One" => "Jockey One",
			"Jolly Lodger" => "Jolly Lodger",
			"Josefin Sans" => "Josefin Sans",
			"Josefin Slab" => "Josefin Slab",
			"Joti One" => "Joti One",
			"Judson" => "Judson",
			"Julee" => "Julee",
			"Julius Sans One" => "Julius Sans One",
			"Junge" => "Junge",
			"Jura" => "Jura",
			"Just Another Hand" => "Just Another Hand",
			"Just Me Again Down Here" => "Just Me Again Down Here",
			"Kameron" => "Kameron",
			"Karla" => "Karla",
			"Kaushan Script" => "Kaushan Script",
			"Kavoon" => "Kavoon",
			"Keania One" => "Keania One",
			"Kelly Slab" => "Kelly Slab",
			"Kenia" => "Kenia",
			"Khmer" => "Khmer",
			"Kite One" => "Kite One",
			"Knewave" => "Knewave",
			"Kotta One" => "Kotta One",
			"Koulen" => "Koulen",
			"Kranky" => "Kranky",
			"Kreon" => "Kreon",
			"Kristi" => "Kristi",
			"Krona One" => "Krona One",
			"La Belle Aurore" => "La Belle Aurore",
			"Lancelot" => "Lancelot",
			"Lato" => "Lato",
			"League Script" => "League Script",
			"Leckerli One" => "Leckerli One",
			"Ledger" => "Ledger",
			"Lekton" => "Lekton",
			"Lemon" => "Lemon",
			"Libre Baskerville" => "Libre Baskerville",
			"Life Savers" => "Life Savers",
			"Lilita One" => "Lilita One",
			"Limelight" => "Limelight",
			"Linden Hill" => "Linden Hill",
			"Lobster" => "Lobster",
			"Lobster Two" => "Lobster Two",
			"Londrina Outline" => "Londrina Outline",
			"Londrina Shadow" => "Londrina Shadow",
			"Londrina Sketch" => "Londrina Sketch",
			"Londrina Solid" => "Londrina Solid",
			"Lora" => "Lora",
			"Love Ya Like A Sister" => "Love Ya Like A Sister",
			"Loved by the King" => "Loved by the King",
			"Lovers Quarrel" => "Lovers Quarrel",
			"Luckiest Guy" => "Luckiest Guy",
			"Lusitana" => "Lusitana",
			"Lustria" => "Lustria",
			"Macondo" => "Macondo",
			"Macondo Swash Caps" => "Macondo Swash Caps",
			"Magra" => "Magra",
			"Maiden Orange" => "Maiden Orange",
			"Mako" => "Mako",
			"Marcellus" => "Marcellus",
			"Marcellus SC" => "Marcellus SC",
			"Marck Script" => "Marck Script",
			"Margarine" => "Margarine",
			"Marko One" => "Marko One",
			"Marmelad" => "Marmelad",
			"Marvel" => "Marvel",
			"Mate" => "Mate",
			"Mate SC" => "Mate SC",
			"Maven Pro" => "Maven Pro",
			"McLaren" => "McLaren",
			"Meddon" => "Meddon",
			"MedievalSharp" => "MedievalSharp",
			"Medula One" => "Medula One",
			"Megrim" => "Megrim",
			"Meie Script" => "Meie Script",
			"Merienda" => "Merienda",
			"Merienda One" => "Merienda One",
			"Merriweather" => "Merriweather",
			"Merriweather Sans" => "Merriweather Sans",
			"Metal" => "Metal",
			"Metal Mania" => "Metal Mania",
			"Metamorphous" => "Metamorphous",
			"Metrophobic" => "Metrophobic",
			"Michroma" => "Michroma",
			"Milonga" => "Milonga",
			"Miltonian" => "Miltonian",
			"Miltonian Tattoo" => "Miltonian Tattoo",
			"Miniver" => "Miniver",
			"Miss Fajardose" => "Miss Fajardose",
			"Modern Antiqua" => "Modern Antiqua",
			"Molengo" => "Molengo",
			"Molle" => "Molle",
			"Monda" => "Monda",
			"Monofett" => "Monofett",
			"Monoton" => "Monoton",
			"Monsieur La Doulaise" => "Monsieur La Doulaise",
			"Montaga" => "Montaga",
			"Montez" => "Montez",
			"Montserrat" => "Montserrat",
			"Montserrat Alternates" => "Montserrat Alternates",
			"Montserrat Subrayada" => "Montserrat Subrayada",
			"Moul" => "Moul",
			"Moulpali" => "Moulpali",
			"Mountains of Christmas" => "Mountains of Christmas",
			"Mouse Memoirs" => "Mouse Memoirs",
			"Mr Bedfort" => "Mr Bedfort",
			"Mr Dafoe" => "Mr Dafoe",
			"Mr De Haviland" => "Mr De Haviland",
			"Mrs Saint Delafield" => "Mrs Saint Delafield",
			"Mrs Sheppards" => "Mrs Sheppards",
			"Muli" => "Muli",
			"Mystery Quest" => "Mystery Quest",
			"Neucha" => "Neucha",
			"Neuton" => "Neuton",
			"New Rocker" => "New Rocker",
			"News Cycle" => "News Cycle",
			"Niconne" => "Niconne",
			"Nixie One" => "Nixie One",
			"Nobile" => "Nobile",
			"Nokora" => "Nokora",
			"Norican" => "Norican",
			"Nosifer" => "Nosifer",
			"Nothing You Could Do" => "Nothing You Could Do",
			"Noticia Text" => "Noticia Text",
			"Nova Cut" => "Nova Cut",
			"Nova Flat" => "Nova Flat",
			"Nova Mono" => "Nova Mono",
			"Nova Oval" => "Nova Oval",
			"Nova Round" => "Nova Round",
			"Nova Script" => "Nova Script",
			"Nova Slim" => "Nova Slim",
			"Nova Square" => "Nova Square",
			"Numans" => "Numans",
			"Nunito" => "Nunito",
			"Odor Mean Chey" => "Odor Mean Chey",
			"Offside" => "Offside",
			"Old Standard TT" => "Old Standard TT",
			"Oldenburg" => "Oldenburg",
			"Oleo Script" => "Oleo Script",
			"Oleo Script Swash Caps" => "Oleo Script Swash Caps",
			"Open Sans" => "Open Sans",
			"Open Sans Condensed" => "Open Sans Condensed",
			"Oranienbaum" => "Oranienbaum",
			"Orbitron" => "Orbitron",
			"Oregano" => "Oregano",
			"Orienta" => "Orienta",
			"Original Surfer" => "Original Surfer",
			"Oswald" => "Oswald",
			"Over the Rainbow" => "Over the Rainbow",
			"Overlock" => "Overlock",
			"Overlock SC" => "Overlock SC",
			"Ovo" => "Ovo",
			"Oxygen" => "Oxygen",
			"Oxygen Mono" => "Oxygen Mono",
			"PT Mono" => "PT Mono",
			"PT Sans" => "PT Sans",
			"PT Sans Caption" => "PT Sans Caption",
			"PT Sans Narrow" => "PT Sans Narrow",
			"PT Serif" => "PT Serif",
			"PT Serif Caption" => "PT Serif Caption",
			"Pacifico" => "Pacifico",
			"Paprika" => "Paprika",
			"Parisienne" => "Parisienne",
			"Passero One" => "Passero One",
			"Passion One" => "Passion One",
			"Patrick Hand" => "Patrick Hand",
			"Patrick Hand SC" => "Patrick Hand SC",
			"Patua One" => "Patua One",
			"Paytone One" => "Paytone One",
			"Peralta" => "Peralta",
			"Permanent Marker" => "Permanent Marker",
			"Petit Formal Script" => "Petit Formal Script",
			"Petrona" => "Petrona",
			"Philosopher" => "Philosopher",
			"Piedra" => "Piedra",
			"Pinyon Script" => "Pinyon Script",
			"Pirata One" => "Pirata One",
			"Plaster" => "Plaster",
			"Play" => "Play",
			"Playball" => "Playball",
			"Playfair Display" => "Playfair Display",
			"Playfair Display SC" => "Playfair Display SC",
			"Podkova" => "Podkova",
			"Poiret One" => "Poiret One",
			"Poller One" => "Poller One",
			"Poly" => "Poly",
			"Pompiere" => "Pompiere",
			"Pontano Sans" => "Pontano Sans",
			"Port Lligat Sans" => "Port Lligat Sans",
			"Port Lligat Slab" => "Port Lligat Slab",
			"Prata" => "Prata",
			"Preahvihear" => "Preahvihear",
			"Press Start 2P" => "Press Start 2P",
			"Princess Sofia" => "Princess Sofia",
			"Prociono" => "Prociono",
			"Prosto One" => "Prosto One",
			"Puritan" => "Puritan",
			"Purple Purse" => "Purple Purse",
			"Quando" => "Quando",
			"Quantico" => "Quantico",
			"Quattrocento" => "Quattrocento",
			"Quattrocento Sans" => "Quattrocento Sans",
			"Questrial" => "Questrial",
			"Quicksand" => "Quicksand",
			"Quintessential" => "Quintessential",
			"Qwigley" => "Qwigley",
			"Racing Sans One" => "Racing Sans One",
			"Radley" => "Radley",
			"Raleway" => "Raleway",
			"Raleway Dots" => "Raleway Dots",
			"Rambla" => "Rambla",
			"Rammetto One" => "Rammetto One",
			"Ranchers" => "Ranchers",
			"Rancho" => "Rancho",
			"Rationale" => "Rationale",
			"Redressed" => "Redressed",
			"Reenie Beanie" => "Reenie Beanie",
			"Revalia" => "Revalia",
			"Ribeye" => "Ribeye",
			"Ribeye Marrow" => "Ribeye Marrow",
			"Righteous" => "Righteous",
			"Risque" => "Risque",
			"Roboto" => "Roboto",
			"Roboto Condensed" => "Roboto Condensed",
			"Rochester" => "Rochester",
			"Rock Salt" => "Rock Salt",
			"Rokkitt" => "Rokkitt",
			"Romanesco" => "Romanesco",
			"Ropa Sans" => "Ropa Sans",
			"Rosario" => "Rosario",
			"Rosarivo" => "Rosarivo",
			"Rouge Script" => "Rouge Script",
			"Ruda" => "Ruda",
			"Rufina" => "Rufina",
			"Ruge Boogie" => "Ruge Boogie",
			"Ruluko" => "Ruluko",
			"Rum Raisin" => "Rum Raisin",
			"Ruslan Display" => "Ruslan Display",
			"Russo One" => "Russo One",
			"Ruthie" => "Ruthie",
			"Rye" => "Rye",
			"Sacramento" => "Sacramento",
			"Sail" => "Sail",
			"Salsa" => "Salsa",
			"Sanchez" => "Sanchez",
			"Sancreek" => "Sancreek",
			"Sansita One" => "Sansita One",
			"Sarina" => "Sarina",
			"Satisfy" => "Satisfy",
			"Scada" => "Scada",
			"Schoolbell" => "Schoolbell",
			"Seaweed Script" => "Seaweed Script",
			"Sevillana" => "Sevillana",
			"Seymour One" => "Seymour One",
			"Shadows Into Light" => "Shadows Into Light",
			"Shadows Into Light Two" => "Shadows Into Light Two",
			"Shanti" => "Shanti",
			"Share" => "Share",
			"Share Tech" => "Share Tech",
			"Share Tech Mono" => "Share Tech Mono",
			"Shojumaru" => "Shojumaru",
			"Short Stack" => "Short Stack",
			"Siemreap" => "Siemreap",
			"Sigmar One" => "Sigmar One",
			"Signika" => "Signika",
			"Signika Negative" => "Signika Negative",
			"Simonetta" => "Simonetta",
			"Sintony" => "Sintony",
			"Sirin Stencil" => "Sirin Stencil",
			"Six Caps" => "Six Caps",
			"Skranji" => "Skranji",
			"Slackey" => "Slackey",
			"Smokum" => "Smokum",
			"Smythe" => "Smythe",
			"Sniglet" => "Sniglet",
			"Snippet" => "Snippet",
			"Snowburst One" => "Snowburst One",
			"Sofadi One" => "Sofadi One",
			"Sofia" => "Sofia",
			"Sonsie One" => "Sonsie One",
			"Sorts Mill Goudy" => "Sorts Mill Goudy",
			"Source Code Pro" => "Source Code Pro",
			"Source Sans Pro" => "Source Sans Pro",
			"Special Elite" => "Special Elite",
			"Spicy Rice" => "Spicy Rice",
			"Spinnaker" => "Spinnaker",
			"Spirax" => "Spirax",
			"Squada One" => "Squada One",
			"Stalemate" => "Stalemate",
			"Stalinist One" => "Stalinist One",
			"Stardos Stencil" => "Stardos Stencil",
			"Stint Ultra Condensed" => "Stint Ultra Condensed",
			"Stint Ultra Expanded" => "Stint Ultra Expanded",
			"Stoke" => "Stoke",
			"Strait" => "Strait",
			"Sue Ellen Francisco" => "Sue Ellen Francisco",
			"Sunshiney" => "Sunshiney",
			"Supermercado One" => "Supermercado One",
			"Suwannaphum" => "Suwannaphum",
			"Swanky and Moo Moo" => "Swanky and Moo Moo",
			"Syncopate" => "Syncopate",
			"Tangerine" => "Tangerine",
			"Taprom" => "Taprom",
			"Tauri" => "Tauri",
			"Telex" => "Telex",
			"Tenor Sans" => "Tenor Sans",
			"Text Me One" => "Text Me One",
			"The Girl Next Door" => "The Girl Next Door",
			"Tienne" => "Tienne",
			"Tinos" => "Tinos",
			"Titan One" => "Titan One",
			"Titillium Web" => "Titillium Web",
			"Trade Winds" => "Trade Winds",
			"Trocchi" => "Trocchi",
			"Trochut" => "Trochut",
			"Trykker" => "Trykker",
			"Tulpen One" => "Tulpen One",
			"Ubuntu" => "Ubuntu",
			"Ubuntu Condensed" => "Ubuntu Condensed",
			"Ubuntu Mono" => "Ubuntu Mono",
			"Ultra" => "Ultra",
			"Uncial Antiqua" => "Uncial Antiqua",
			"Underdog" => "Underdog",
			"Unica One" => "Unica One",
			"UnifrakturCook" => "UnifrakturCook",
			"UnifrakturMaguntia" => "UnifrakturMaguntia",
			"Unkempt" => "Unkempt",
			"Unlock" => "Unlock",
			"Unna" => "Unna",
			"VT323" => "VT323",
			"Vampiro One" => "Vampiro One",
			"Varela" => "Varela",
			"Varela Round" => "Varela Round",
			"Vast Shadow" => "Vast Shadow",
			"Vibur" => "Vibur",
			"Vidaloka" => "Vidaloka",
			"Viga" => "Viga",
			"Voces" => "Voces",
			"Volkhov" => "Volkhov",
			"Vollkorn" => "Vollkorn",
			"Voltaire" => "Voltaire",
			"Waiting for the Sunrise" => "Waiting for the Sunrise",
			"Wallpoet" => "Wallpoet",
			"Walter Turncoat" => "Walter Turncoat",
			"Warnes" => "Warnes",
			"Wellfleet" => "Wellfleet",
			"Wendy One" => "Wendy One",
			"Wire One" => "Wire One",
			"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
			"Yellowtail" => "Yellowtail",
			"Yeseva One" => "Yeseva One",
			"Yesteryear" => "Yesteryear",
			"Zeyada" => "Zeyada",
		);
 		return $googlefonts;
	}
	public static function header_output() 
	{
		// The live CSS is added here
		
		$menu_sp = get_theme_mod('header_separator_symbol');
		$color = get_theme_mod('tesseract_header_colors_link_color');
		if($menu_sp == 'sp-pipeline')
		{
			?>
			<style type='text/css'>
			@media (min-width:769px){
				#header-right-menu .nav-menu>.menu-item:after{content:"|";position:absolute;right:-7px;top: 50%;margin-top:-10px; height:20px;color:<?php echo $color; ?>;}
    			#header-right-menu .nav-menu>.menu-item:last-child:after{content:"";}

    			.top-navigation .nav-menu>.menu-item:after{content:"|";position:absolute;right:-7px;top: 50%;margin-top:-10px; height:20px;color:<?php echo $color; ?>;}
    			.top-navigation .nav-menu>.menu-item:last-child:after{content:"";}
    		}

			</style>
			<?php
		}
		elseif($menu_sp == 'sp-colon')
		{
		?>
			<style type='text/css'>
			@media (min-width:769px){
				#header-right-menu .nav-menu>.menu-item:after{content:":";position:absolute; margin-top:-10px; height:20px; right:-7px;top: 50%;color:<?php echo $color; ?>;}
    			#header-right-menu .nav-menu>.menu-item:last-child:after{content:"";}

    			.top-navigation .nav-menu>.menu-item:after{content:":";position:absolute;margin-top:-10px; height:20px;right:-7px;top: 50%;color:<?php echo $color; ?>;}
    			.top-navigation .nav-menu>.menu-item:last-child:after{content:"";}
    		}
			</style>
		<?php
		}
		$h_fonts = (get_theme_mod('header_menu_text_fonts')) ? get_theme_mod('header_menu_text_fonts') : 'Open Sans';
		$f_fonts = (get_theme_mod('footer_menu_text_fonts')) ? get_theme_mod('footer_menu_text_fonts') : 'Oswald';
		$tesseract_header_activated_link_color = (get_theme_mod('tesseract_header_activated_link_color')) ? get_theme_mod('tesseract_header_activated_link_color') : '#e8e8e8';
		$link_color = (get_theme_mod('tesseract_header_colors_link_color')) ? get_theme_mod('tesseract_header_colors_link_color') : '#ffffff';
		$tesseract_woocommerce_regular_price_color = (get_theme_mod('tesseract_woocommerce_regular_price_color')) ? get_theme_mod('tesseract_woocommerce_regular_price_color') : '#FF0000';
		$tesseract_header_upper_logo_text_color = (get_theme_mod('tesseract_header_upper_logo_text_color')) ? get_theme_mod('tesseract_header_upper_logo_text_color') : '#000000';

		$header_menu_text_fonts_weights = (get_theme_mod('header_menu_text_fonts_weights')) ? get_theme_mod('header_menu_text_fonts_weights') : '100';
		?>
		<style type='text/css'>
			#footer-banner-right{
				font-family:<?php echo $f_fonts ; ?> ;
			}
			#footer-banner-centre{
				font-family:<?php echo $f_fonts ; ?> ;
			}
			.site-title span{
				color:<?php echo $tesseract_header_upper_logo_text_color; ?>;
			}

			.regular-price{color: <?php echo $tesseract_woocommerce_regular_price_color; ?> !important;}
			.price del{ color: <?php echo $tesseract_woocommerce_regular_price_color; ?> !important;}
 			.wooshop-price.wooprice-nonbold.price-tesseract del{ color: <?php echo $tesseract_woocommerce_regular_price_color; ?> !important;}

			.top-navigation li.current-menu-item.current_page_item a
			{
				color: <?php echo get_theme_mod('tesseract_header_activated_link_color'); ?> !important;
			}
		
			.top-navigation ul li > a{
					font-family:<?php echo $h_fonts ; ?> ;
					color: <?php echo $link_color ?>;
				}
			#header-right-menu ul li > a{
					font-family:<?php echo $h_fonts; ?>;
				}

			.top-navigation ul ul li > a{
				font-family:<?php echo $h_fonts; ?>;
			}
			#header-right-menu ul ul li > a{
				font-family:<?php echo $h_fonts; ?>;
			}

			.top-navigation ul li > a{
					letter-spacing:<?php echo get_theme_mod('header_menu_text_spacing').'px'; ?> ;
				}
			#header-right-menu ul li > a{
					letter-spacing:<?php echo get_theme_mod('header_menu_text_spacing').'px'; ?> ;
				}

			.top-navigation ul ul li > a{
				letter-spacing:<?php echo get_theme_mod('header_menu_text_spacing').'px'; ?> ;
			}
			#header-right-menu ul ul li > a{
				letter-spacing:<?php echo get_theme_mod('header_menu_text_spacing').'px'; ?> ;
			}

			.top-navigation ul li > a{
					font-size:<?php echo get_theme_mod('header_menu_text_size_custom').'px'; ?> ;
				}
			#header-right-menu ul li > a{
					font-size:<?php echo get_theme_mod('header_menu_text_size_custom').'px'; ?> ;
				}

			.top-navigation ul ul li > a{
				font-size:<?php echo get_theme_mod('header_menu_text_size_custom').'px'; ?> ;
			}
			#header-right-menu ul ul li > a{
				font-size:<?php echo get_theme_mod('header_menu_text_size_custom').'px'; ?> ;
			}

			.top-navigation ul li > a{
					font-weight:<?php echo $header_menu_text_fonts_weights; ?> ;
				}
			#header-right-menu ul li > a{
					font-weight:<?php echo $header_menu_text_fonts_weights; ?> ;
				}

			.top-navigation ul ul li > a{
				font-weight:<?php echo $header_menu_text_fonts_weights; ?> ;
			}
			#header-right-menu ul ul li > a{
				font-weight:<?php echo $header_menu_text_fonts_weights; ?> ;
			}

			.top-navigation ul li > a{
					font-style:<?php echo get_theme_mod('header_menu_text_fonts_styles'); ?> ;
				}
			#header-right-menu ul li > a{
					font-style:<?php echo get_theme_mod('header_menu_text_fonts_styles'); ?> ;
				}


			#footer-right-menu ul li > a{
					font-family:<?php echo $f_fonts; ?> ;
			}
			
			#footer-horizontal-menu ul li > a{
					font-family:<?php echo $f_fonts; ?> ;
			}
			.banner-right.content-html{
					font-family:<?php echo $f_fonts; ?> ;
			}
			#footer-banner-right{
					letter-spacing:<?php echo get_theme_mod('footer_menu_text_spacing').'px'; ?> ;
				}
			#footer-banner-centre{
					letter-spacing:<?php echo get_theme_mod('footer_menu_text_spacing').'px'; ?> ;
				}
			

			#footer-right-menu ul li > a{
					letter-spacing:<?php echo get_theme_mod('footer_menu_text_spacing').'px'; ?> ;
				}
			#footer-horizontal-menu ul li > a{
					letter-spacing:<?php echo get_theme_mod('footer_menu_text_spacing').'px'; ?> ;
				}
			
			#footer-right-menu ul li > a{
					font-size:<?php echo get_theme_mod('footer_menu_text_size_custom').'px'; ?> ;
				}
			#footer-horizontal-menu ul li > a{
					font-size:<?php echo get_theme_mod('footer_menu_text_size_custom').'px'; ?> ;
				}
			#footer-banner-centre{
					font-size:<?php echo get_theme_mod('footer_menu_text_size_custom').'px'; ?> ;
				}
			#footer-banner-right{
					font-size:<?php echo get_theme_mod('footer_menu_text_size_custom').'px'; ?> ;
				}

			#footer-right-menu ul li > a{
					font-weight:<?php echo get_theme_mod('footer_menu_text_fonts_weights'); ?> ;
				}
			#footer-horizontal-menu ul li > a{
					font-weight:<?php echo get_theme_mod('footer_menu_text_fonts_weights'); ?> ;
				}

			#footer-banner-centre{
					font-weight:<?php echo get_theme_mod('footer_menu_text_fonts_weights'); ?> ;
				}
			#footer-banner-right{
					font-weight:<?php echo get_theme_mod('footer_menu_text_fonts_weights'); ?> ;
				}

			#footer-right-menu ul li > a{
					font-style:<?php echo get_theme_mod('footer_menu_text_fonts_styles'); ?> ;
				}
			#footer-horizontal-menu ul li > a{
					font-style:<?php echo get_theme_mod('footer_menu_text_fonts_styles'); ?> ;
				}

			#footer-banner-right{
					font-style:<?php echo get_theme_mod('footer_menu_text_fonts_styles'); ?> ;
				}
				#footer-banner-centre{
					font-style:<?php echo get_theme_mod('footer_menu_text_fonts_styles'); ?> ;
				}
			#horizontal-menu-before{
					font-style:<?php echo get_theme_mod('footer_menu_text_fonts_styles'); ?> ;
					font-size:<?php echo get_theme_mod('footer_menu_text_size_custom').'px'; ?> ;
					font-weight:<?php echo get_theme_mod('footer_menu_text_fonts_weights'); ?> ;
					letter-spacing:<?php echo get_theme_mod('footer_menu_text_spacing').'px'; ?> ;
					font-family:<?php echo $f_fonts; ?> ;
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
	public static function load_google_fonts()
	{
			
			//$header_fonts = get_theme_mod('header_menu_text_fonts');
			$header_fonts = (get_theme_mod('header_menu_text_fonts')) ? get_theme_mod('header_menu_text_fonts') : 'Open Sans';
			wp_register_style('googleFontsHeader','https://fonts.googleapis.com/css?family='.$header_fonts);
   			wp_enqueue_style('googleFontsHeader');

   			//$footer_fonts = str_replace(" ","+",get_theme_mod('footer_menu_text_fonts'));
   			$footer_text = (get_theme_mod('footer_menu_text_fonts')) ? get_theme_mod('footer_menu_text_fonts') : 'Oswald';
			wp_register_style('googleFontsFooter','https://fonts.googleapis.com/css?family='.$footer_text);
	   		wp_enqueue_style('googleFontsFooter');


	}
	public static function footer_centre_content()
	{
		$content_centre = (get_theme_mod('tesseract_footer_centre_content')) ? get_theme_mod('tesseract_footer_centre_content') : 'nothing';
		$default_html = '<strong>Theme by <a href="https://tesseracttheme.com">Tesseract</a></strong>

                        &nbsp;&nbsp;

                        <strong>

                        	<a href="https://tesseracttheme.com">

                        		<img src="https://tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />

                            </a>

                        </strong>';
		$content_default_html_centre = (get_theme_mod('tesseract_footer_centre_content_html')) ? get_theme_mod('tesseract_footer_centre_content_html') : $default_html;
		if ( $content_centre && $content_centre!='nothing' ) : ?>
				<div id="footer-banner-centre" class="banner-centre <?php echo 'content-' . $content_centre; ?>">
					<?php switch( $content_centre ) 
						{

							default:
							break;
							case 'html':
							echo '<div id="footer-button-container-centre"><div id="footer-button-container-inner-centre">' . $content_default_html_centre . '</div></div>';
							break;
							case 'menuhtml':
								$footer_centre_menuhtml  = (get_theme_mod("tesseract_footer_centre_menuhtml_select")) ? get_theme_mod("tesseract_footer_centre_menuhtml_select") : 'none';
								if($footer_centre_menuhtml != 'none')
								{
							?>
								<section id="footer-horizontal-menu" class="cf <?php echo $footerNav_class; ?>"><?php wp_nav_menu(array('menu'=>$footer_centre_menuhtml));//( FALSE, FALSE, 'Footer101', 1 ); ?></section>
							<?php } 
									echo '<div id="footer-button-container-centre"><div id="footer-button-container-inner-centre">' . $content_default_html_centre . '</div></div>';
							break;

							case 'social': ?>
								<ul class="hr-social">
									<?php 
										$bln_tesseract_social_account_right = false;
										for ( $i = 1; $i <= 10; $i++ ) 
										{
											$account_number = sprintf( '%02d', $i );
											$sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
											if ( $sn_img ) 
											{
												$sn_name = get_theme_mod( "tesseract_social_account{$account_number}_name" );
												$sn_url = get_theme_mod( "tesseract_social_account{$account_number}_url" );
												if ( $sn_name && $sn_url ) 
												{
													$bln_tesseract_social_account_right = true;
													echo '<li><a title="Follow Us on ' . $sn_name . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_name . ' icon" /></a></li>';
												}
											}
										}	
										if($bln_tesseract_social_account_right == false)
										{
											echo "<li>Add your social accounts and they'll appear here.</li>";
										}	
									?>
								</ul>
							<?php 

							break;
							case 'search':
								get_search_form();
							break;
							case 'menu':
							$footer_centre_menu  = (get_theme_mod("tesseract_footer_centre_menu_select")) ? get_theme_mod("tesseract_footer_centre_menu_select") : 'none';
								if($footer_centre_menu != 'none'){

									?>
									<section id="footer-horizontal-menu" class="cf <?php echo $footerNav_class; ?>"><?php wp_nav_menu(array('menu'=>$footer_centre_menu,'depth'=>1));//( FALSE, FALSE, 'Footer101', 1 ); ?></section>
									<?php
								}
							break;
							case 'logo':
									$headerLogo = get_theme_mod('tesseract_header_logo_image');

									$footerLogo = get_theme_mod('tesseract_footer_logo_image');

									$footerLogoEnable = ( get_theme_mod('tesseract_footer_logo_enable') == 'yes' ) ? true : false;

									$header_logo_choice = (get_theme_mod('tesseract_header_logo_type')) ? get_theme_mod('tesseract_header_logo_type') : 'image';

								    $header_text        = (get_theme_mod('tesseract_header_logo_text')) ? get_theme_mod('tesseract_header_logo_text') : get_bloginfo();

								   	$header_fonts       = (get_theme_mod('tesseract_header_logo_text_fonts')) ? get_theme_mod('tesseract_header_logo_text_fonts') : 'Work Sans';
								    $header_font_styles = (get_theme_mod('tesseract_header_logo_text_fonts_styles')) ? get_theme_mod('tesseract_header_logo_text_fonts_styles') : 'normal';
								    $header_font_weight = (get_theme_mod('tesseract_header_logo_text_fonts_weights')) ? get_theme_mod('tesseract_header_logo_text_fonts_weights') : '900';

									$logoImg = ( $footerLogoEnable && $footerLogo ) ? $footerLogo : $headerLogo;
									if ( $header_logo_choice == 'image' && $logoImg ) : ?>
										<div class="site-branding">
											<h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>
										</div>
									<?php else : ?>
									<div class="site-branding">

										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

					                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
					                    <?php echo $header_text; ?>
					                  </span>

					                  </a></h1>
									</div>
									<?php endif;
								break;
							
							} ?>
				</div>
				<?php endif;
	}
	public static function woo_page_full_width()
	{
		if(!get_post_meta(get_option( 'woocommerce_shop_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_shop_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_cart_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_cart_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_checkout_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_checkout_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_myaccount_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_myaccount_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_thanks_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_thanks_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_edit_address_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_edit_address_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_pay_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_pay_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_view_order_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_view_order_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	    if(!get_post_meta(get_option( 'woocommerce_terms_page_id' ), '_wp_page_template')){
	    	update_post_meta(get_option( 'woocommerce_terms_page_id' ), '_wp_page_template', 'full-width-page.php'); 
	    }
	}
	
}
new Menu_Font_Styles();
function tesseract_footer_centre_menu_select_enable_2()
{
	$select_enable = get_theme_mod( 'tesseract_footer_centre_content' );
	
	$bool_0 = ( $select_enable == 'menuhtml' || $select_enable == 'html' ) ? true : false;
	return $bool_0;
}
function tesseract_footer_centre_menuhtml_select_enable()
{
	$select_enable = get_theme_mod( 'tesseract_footer_centre_content' );
	
	$bool = ( $select_enable == 'menuhtml' ) ? true : false;

	//return true;

	return $bool;
}
function tesseract_footer_centre_menu_select_enable()
{
	$select_enable = get_theme_mod( 'tesseract_footer_centre_content' );
	
	$bool = ( $select_enable == 'menu' ) ? true : false;

	//return true;

	return $bool;
}
if(class_exists('Tesseract_Remove_Branding_Customizer')):
	add_action( 'tesseract_footer_branding', array('Menu_Font_Styles','footer_centre_content'),8 );
endif;

add_action( 'admin_enqueue_scripts', array( 'Menu_Font_Styles' ,'load_google_fonts'));
add_action( 'wp_enqueue_scripts', array( 'Menu_Font_Styles' ,'load_google_fonts'));
add_action( 'customize_register' , array( 'Menu_Font_Styles' , 'register' ) );
add_action( 'wp_head' , array( 'Menu_Font_Styles' , 'header_output' ) );
add_action( 'customize_preview_init' , array( 'Menu_Font_Styles' , 'live_preview' ) );
add_action('after_setup_theme', array( 'Menu_Font_Styles' ,'woo_page_full_width'),0);


if(is_plugin_active('tesseract-remove-branding-master/tesseract-remove-branding.php')){
	add_action( 'admin_notices', 'tesseract_old_unbranding_activate_notice'  );
	return false;
}

function tesseract_old_unbranding_activate_notice() {
		echo '<div class="error"><p>Looks like you have the OLD <b>Tesseract Remove Branding</b> Plugin. You will need to upgrade to the new Tesseract Remove Branding Plugin" to get the newest features. <a href="https://tesseracttheme.com/unbranding-update/" target="_blank">Click Here</a></p></div>';
	}