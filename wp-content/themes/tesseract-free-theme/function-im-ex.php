<?php
class Tesseract_Import_Export{

	public function __construct() {
		if(isset($_POST['tesseract_im_ex']))
		{
			if($_POST['tesseract_im_ex'] == 1){
				if($_POST['submit'] == 'Import')
				{
					$this->import();
				}
				if($_POST['submit'] == 'Export')
				{
					$this->export();
				}
			}
		}
		add_action( 'admin_menu', array($this, 'tesseract_im_ex_menu' ));
		//add_action( 'init', array($this,'ccw_set_permalinks' ));
       
    }
    /*public function ccw_set_permalinks() {
	    global $wp_rewrite;
	    $wp_rewrite->set_permalink_structure( '/%postname%/' );
	}*/

    public function tesseract_im_ex_menu()
    {
    	$page_title = '';
	    $menu_title = 'Theme Settings Im/Ex';
	    $capability = '';
	    $menu_slug  = 'tesseract_im_ex';
	    $function   = '';
	    $icon_url   = 'dashicons-admin-site';
	    $position   = 99;

	    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	    add_submenu_page( 'tesseract_im_ex', 'Import', 'Import', 'manage_options', 'tesseract_im', array($this,'im_html' ));
	    add_submenu_page( 'tesseract_im_ex', 'Export', 'Export', 'manage_options', 'tesseract_ex', array($this,'ex_html' ));
    }

    public function ex_html()
    {
    	?>
    		<div class="wrap">
				<h1>Export</h1>
				<p>*Don`t change anything into the CSV file, generated by the system. Let the system will do all you want.*
				<form method="post" action="" novalidate="novalidate" name="tesseract_export" id="tesseract_export">
					<table class="form-table">
						<tr>
							<th scope="row">Export Theme Settings Current Data into a CSV(.csv) file.</th>
							
						</tr>
						<tr>
							<td>
								<input type="hidden" name="tesseract_im_ex" value="1" />
								<p class="submit"><input name="submit" id="submit" class="button button-primary" value="Export" type="submit"></p>
							</td>
						</tr>
					</table>
				</form>

			</div>
    	<?php
    }

    public function im_html()
    {
    	?>
    		<div class="wrap">
				<h1>Import</h1>
				<form method="post" action="" novalidate="novalidate" id="tesseract_import" name="tesseract_import" enctype="multipart/form-data">
					<table class="form-table">
						
						<tr><th scope="row">File:</th><td><input type="file" name="import_file" /><p>Upload theme settings CSV(.csv), which is generated by our theme, or you got from us.</p></td></tr>
						<tr>
							<td>
								<input type="hidden" name="tesseract_im_ex" value="1" />
								<p class="submit"><input name="submit" id="submit" class="button button-primary" value="Import" type="submit"></p>
							</td>
						</tr>
					</table>
				</form>

			</div>
    	<?php
    }

    public function import()
    {
    	//echo "<pre>"; print_r($_FILES); echo "</pre>";
    	if($_FILES["import_file"]["type"] != "text/csv"){
    		add_action('admin_notices', array($this,'error_msg'	));
    		return;
    	}
    	
    	$handle = fopen($_FILES['import_file']['tmp_name'], "r");
    	$count = 1;
    	
    		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
    		{
    		 	if($count ==1 )
    		 	{
    		 		if( $data[0]!='option_name' || $data[1]!='option_field' || $data[2]!='value' )
    		 		{
    		 			add_action('admin_notices', array($this,'error_msg'	));
    					return;
    		 		}
    		 	}
    		 	else
    		 	{
    		 		set_theme_mod($data[1],$data[2]);
    		 	}
    		 	$count++;
    		}
    	
    	
    	fclose($handle);
    	$blog   = get_page_by_title( 'Blog' );
    	if($blog)
    	{
    		update_option( 'page_for_posts', $blog->ID );
    	}
		
    	add_action('admin_notices', array($this,'success_msg' ));
    }

    public function upload_image($image_url, $post_id, $postType)
    {
		$url_arr = explode ('/', $image_url);
		$ct = count($url_arr);
		$image_name = $url_arr[$ct-1];
		$upload_dir       = wp_upload_dir(); // Set upload folder
		$image_data       = file_get_contents($image_url); // Get image data
		$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
		$filename         = basename( $unique_file_name ); // Create image file name

		// Check folder permission and define file location
		if( wp_mkdir_p( $upload_dir['path'] ) ) {
		    $file = $upload_dir['path'] . '/' . $filename;
		} else {
		    $file = $upload_dir['basedir'] . '/' . $filename;
		}

		// Create the image  file on the server
		file_put_contents( $file, $image_data );

		// Check image file type
		$wp_filetype = wp_check_filetype( $filename, null );

		// Set attachment data
		$attachment = array(
		    'post_mime_type' => $wp_filetype['type'],
		    'post_title'     => sanitize_file_name( $filename ),
		    'post_content'   => '',
		    'post_status'    => 'inherit'
		);

		// Create the attachment
		$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

		// Include image.php
		require_once(ABSPATH . 'wp-admin/includes/image.php');

		// Define attachment metadata
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

		// Assign metadata to attachment
		wp_update_attachment_metadata( $attach_id, $attach_data );

		// And finally assign featured image to post
		if($postType =='collection' || $postType =='page' || $postType =='post'){
			return set_post_thumbnail( $post_id, $attach_id );
		}
		if($postType=='banner'){
			return update_post_meta( $post_id, '_banner_image_id', $attach_id );
		}
    }

    public function export()
    {
    	$filename = "Free_Theme_Settings_Data_".date('Y-m-d')."_".date('H:i:s').".csv";
		$fp = fopen('php://output', 'w');
		
			$header = array('option_name','option_field','value');
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			fputcsv($fp, $header);
			$data = array();

			/* Header Colour START  */
			// $data[] = array('Header Text Color(Top Part)', 'tesseract_header_upper_text_color', (get_theme_mod('tesseract_header_upper_text_color')) ? get_theme_mod('tesseract_header_upper_text_color') : '#ffffff');

			// $data[] = array('Header Background Color(Top Part)', 'tesseract_header_upper_color_top_part', (get_theme_mod('tesseract_header_upper_color_top_part')) ? get_theme_mod('tesseract_header_upper_color_top_part') : '#000000');

			$data[] = array('Header Background Color', 'tesseract_header_colors_bck_color', (get_theme_mod('tesseract_header_colors_bck_color')) ? get_theme_mod('tesseract_header_colors_bck_color') : '#ffffff');

			$data[] = array('Header Opacity', 'tesseract_header_colors_bck_color_opacity', (get_theme_mod('tesseract_header_colors_bck_color_opacity')) ? get_theme_mod('tesseract_header_colors_bck_color_opacity') : '100');

			$data[] = array('Opacity effected page', 'tesseract_header_opacity_page', (get_theme_mod('tesseract_header_opacity_page')) ? get_theme_mod('tesseract_header_opacity_page') : 'home');

			$data[] = array('Header Text Color', 'tesseract_header_colors_text_color', (get_theme_mod('tesseract_header_colors_text_color')) ? get_theme_mod('tesseract_header_colors_text_color') : '#ffffff');

			$data[] = array('Header Link Color', 'tesseract_header_colors_link_color', (get_theme_mod('tesseract_header_colors_link_color')) ? get_theme_mod('tesseract_header_colors_link_color') : '#000000');

			$data[] = array('Submenu Text Color', 'sub_menu_color', (get_theme_mod('sub_menu_color')) ? get_theme_mod('sub_menu_color') : '#000000');

			$data[] = array('Header Hovered Link Color', 'tesseract_header_colors_link_hover_color', (get_theme_mod('tesseract_header_colors_link_hover_color')) ? get_theme_mod('tesseract_header_colors_link_hover_color') : '#d1ecff');

			$data[] = array('Header Activated Link Color', 'tesseract_header_activated_link_color', (get_theme_mod('tesseract_header_activated_link_color')) ? get_theme_mod('tesseract_header_activated_link_color') : '#8BB6C7');

			$data[] = array('Header Search Text Color', 'tesseract_header_search_text_color', (get_theme_mod('tesseract_header_search_text_color')) ? get_theme_mod('tesseract_header_search_text_color') : '#fff');

			// $data[] = array('Separator, Between Menu & Social Icon Color', 'tesseract_header_social_separator_color', (get_theme_mod('tesseract_header_social_separator_color')) ? get_theme_mod('tesseract_header_social_separator_color') : '#000');

			$data[] = array('Submenu Hover Background Color', 'tesseract_header_sub_menu_hover_color', (get_theme_mod('tesseract_header_sub_menu_hover_color')) ? get_theme_mod('tesseract_header_sub_menu_hover_color') : '#cecece');



			/* Header Colour END  */



			/* Header Layout START */
			// $data[] = array('Header Layout Option', 'tesseract_header_layout_setting', (get_theme_mod('tesseract_header_layout_setting')) ? get_theme_mod('tesseract_header_layout_setting') : 'defaultlayout');

			// $data[] = array('Fixed Header Menu', 'tesseract_vertical_header_menu_fixed', (get_theme_mod('tesseract_vertical_header_menu_fixed')) ? get_theme_mod('tesseract_vertical_header_menu_fixed') : 'disable');

			// $data[] = array('Header Layout Background Image', 'tesseract_header_layout_bck_image', (get_theme_mod('tesseract_header_layout_bck_image')) ? get_theme_mod('tesseract_header_layout_bck_image') : '');

			// $data[] = array('Header Background Image Repeat', 'tesseract_vertical_header_bck_img_rpt', (get_theme_mod('tesseract_vertical_header_bck_img_rpt')) ? get_theme_mod('tesseract_vertical_header_bck_img_rpt') : 'disable');

			// $data[] = array('Vertical Nav Width', 'tesseract_vertical_header_width', (get_theme_mod('tesseract_vertical_header_width')) ? get_theme_mod('tesseract_vertical_header_width') : '230');

			// $data[] = array('Social Icon', 'tesseract_vertical_menu_social_icon', (get_theme_mod('tesseract_vertical_menu_social_icon')) ? get_theme_mod('tesseract_vertical_menu_social_icon') : 'disable');

			// $data[] = array('Header Upper Section', 'tesseract_header_upper_status', (get_theme_mod('tesseract_header_upper_status')) ? get_theme_mod('tesseract_header_upper_status') : 'disable');

			// $data[] = array('Left Content Type(Top)', 'tesseract_header_upper_left_content_type', (get_theme_mod('tesseract_header_upper_left_content_type')) ? get_theme_mod('tesseract_header_upper_left_content_type') : 'none');

			// $data[] = array('Left Content Text(Top)', 'tesseract_header_upper_left_content_text', (get_theme_mod('tesseract_header_upper_left_content_text')) ? get_theme_mod('tesseract_header_upper_left_content_text') : 'Text On Upper Header Left Panel');

			// $data[] = array('Center Content Type(Top)', 'tesseract_header_upper_centre_content_type', (get_theme_mod('tesseract_header_upper_centre_content_type')) ? get_theme_mod('tesseract_header_upper_centre_content_type') : 'cartwoolink');

			// $data[] = array('Right Content Type(Top)', 'tesseract_header_upper_right_content_type', (get_theme_mod('tesseract_header_upper_right_content_type')) ? get_theme_mod('tesseract_header_upper_right_content_type') : 'searchcurrency');

			/* Header Layout END */

			/* Header Logo START */

			$data[] = array('Logo Type', 'tesseract_header_logo_type', (get_theme_mod('tesseract_header_logo_type')) ? get_theme_mod('tesseract_header_logo_type') : 'text');

			$data[] = array('Header Logo Height', 'tesseract_header_logo_height', (get_theme_mod('tesseract_header_logo_height')) ? get_theme_mod('tesseract_header_logo_height') : '40');

			$data[] = array('Text', 'tesseract_header_logo_text', (get_theme_mod('tesseract_header_logo_text')) ? get_theme_mod('tesseract_header_logo_text') : 'Demo');

			$data[] = array('Google Font Style(Logo Text)', 'tesseract_header_logo_text_fonts', (get_theme_mod('tesseract_header_logo_text_fonts')) ? get_theme_mod('tesseract_header_logo_text_fonts') : 'Open Sans');

			$data[] = array('Font Style(Logo Text)', 'tesseract_header_logo_text_fonts_styles', (get_theme_mod('tesseract_header_logo_text_fonts_styles')) ? get_theme_mod('tesseract_header_logo_text_fonts_styles') : 'normal');

			$data[] = array('Font Weights(Logo Text)', 'tesseract_header_logo_text_fonts_weights', (get_theme_mod('tesseract_header_logo_text_fonts_weights')) ? get_theme_mod('tesseract_header_logo_text_fonts_weights') : '900');

			$data[] = array('Header Logo(Image)', 'tesseract_header_logo_image', (get_theme_mod('tesseract_header_logo_image')) ? get_theme_mod('tesseract_header_logo_image') : '');

			$data[] = array('Header Logo Text Color', 'tesseract_header_upper_logo_text_color', (get_theme_mod('tesseract_header_upper_logo_text_color')) ? get_theme_mod('tesseract_header_upper_logo_text_color') : '#000000');

			/* Header Logo END */


			
			/* Header Size START */
			$data[] = array('Header Height', 'tesseract_header_height', (get_theme_mod('tesseract_header_height')) ? get_theme_mod('tesseract_header_height') : '10');

			$data[] = array('Select header width', 'tesseract_header_width', (get_theme_mod('tesseract_header_width')) ? get_theme_mod('tesseract_header_width') : 'default');

			/* Header Size END */

			$data[] = array('Header right block content', 'tesseract_header_right_content', (get_theme_mod('tesseract_header_right_content')) ? get_theme_mod('tesseract_header_right_content') : 'nothing');
		

			$data[] = array('Button code(Header Right Content)', 'tesseract_header_content_if_button', (get_theme_mod('tesseract_header_content_if_button')) ? get_theme_mod('tesseract_header_content_if_button') : '<a href="/" class="button primary-button">Primary Button</a><a href="/" class="button secondary-button">Secondary Button</a>');

			/* Mobile Menu START */
			$data[] = array('Mobile Menu', 'tesseract_mobmenu_opener_mob', (get_theme_mod('tesseract_mobmenu_opener_mob')) ? get_theme_mod('tesseract_mobmenu_opener_mob') : 'mob-showit');
			$data[] = array('Menu Background Color', 'tesseract_mobmenu_background_color', (get_theme_mod('tesseract_mobmenu_background_color')) ? get_theme_mod('tesseract_mobmenu_background_color') : '#336ca6');
			$data[] = array('Menu Link Color', 'tesseract_mobmenu_link_color', (get_theme_mod('tesseract_mobmenu_link_color')) ? get_theme_mod('tesseract_mobmenu_link_color') : '#ffffff');
			$data[] = array('Header Logo Height On Mobile', 'tesseract_header_logo_height_mob', (get_theme_mod('tesseract_header_logo_height_mob')) ? get_theme_mod('tesseract_header_logo_height_mob') : '100');
			$data[] = array('Menu Link Hover Background Color', 'tesseract_mobmenu_link_hover_background_color', (get_theme_mod('tesseract_mobmenu_link_hover_background_color')) ? get_theme_mod('tesseract_mobmenu_link_hover_background_color') : 'dark');
			$data[] = array('Menu Link Hover Background custom color', 'tesseract_mobmenu_link_hover_background_color_custom', (get_theme_mod('tesseract_mobmenu_link_hover_background_color_custom')) ? get_theme_mod('tesseract_mobmenu_link_hover_background_color_custom') : '#285684');
			$data[] = array('Menu Item Shadows and Separators Color', 'tesseract_mobmenu_shadow_color', (get_theme_mod('tesseract_mobmenu_shadow_color')) ? get_theme_mod('tesseract_mobmenu_shadow_color') : '#285684');
			$data[] = array('Menu Item Shadows and Separators Custom Color', 'tesseract_mobmenu_shadow_color_custom', (get_theme_mod('tesseract_mobmenu_shadow_color_custom')) ? get_theme_mod('tesseract_mobmenu_shadow_color_custom') : '#285684');

			/* Mobile Menu END */

			/* Header Menu Font Style START */
			$data[] = array('Google Font Style(Header Menu)', 'header_menu_text_fonts', (get_theme_mod('header_menu_text_fonts')) ? get_theme_mod('header_menu_text_fonts') : 'Open Sans');

			$data[] = array('Font Style(Header Menu)', 'header_menu_text_fonts_styles', (get_theme_mod('header_menu_text_fonts_styles')) ? get_theme_mod('header_menu_text_fonts_styles') : 'normal');

			$data[] = array('Font Weights(Header Menu)', 'header_menu_text_fonts_weights', (get_theme_mod('header_menu_text_fonts_weights')) ? get_theme_mod('header_menu_text_fonts_weights') : '100');

			$data[] = array('Header Menu Separator Symbol(Header Menu)', 'header_separator_symbol', (get_theme_mod('header_separator_symbol')) ? get_theme_mod('header_separator_symbol') : 'sp-none');

			$data[] = array('Font Size(In px.)(Header Menu)', 'header_menu_text_size_custom', (get_theme_mod('header_menu_text_size_custom')) ? get_theme_mod('header_menu_text_size_custom') : '16');

			$data[] = array('Font Spacing(In px.)(Header Menu)', 'header_menu_text_spacing', (get_theme_mod('header_menu_text_spacing')) ? get_theme_mod('header_menu_text_spacing') : '0');

			$data[] = array('Menu Spacing(In px.)(Header Menu)', 'header_menu_spacing', (get_theme_mod('header_menu_spacing')) ? get_theme_mod('header_menu_spacing') : '10');
			/* Header Menu Font Style END */

			

			$data[] = array('Select Header Menu', 'tesseract_header_menu_select', (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none');

			/* Footer Colors START */

			$data[] = array('Footer Background Color', 'tesseract_footer_colors_bck_color', (get_theme_mod('tesseract_footer_colors_bck_color')) ? get_theme_mod('tesseract_footer_colors_bck_color') : '#1e73be');

			$data[] = array('Homepage Footer Opacity', 'tesseract_footer_colors_bck_color_opacity', (get_theme_mod('tesseract_footer_colors_bck_color_opacity')) ? get_theme_mod('tesseract_footer_colors_bck_color_opacity') : '100');

			$data[] = array('Footer Text Color', 'tesseract_footer_colors_text_color', (get_theme_mod('tesseract_footer_colors_text_color')) ? get_theme_mod('tesseract_footer_colors_text_color') : '#ffffff');

			$data[] = array('Footer Heading Color', 'tesseract_footer_colors_heading_color', (get_theme_mod('tesseract_footer_colors_heading_color')) ? get_theme_mod('tesseract_footer_colors_heading_color') : '#ffffff');


			$data[] = array('Footer Link/Logo(Text) Color', 'tesseract_footer_colors_link_color', (get_theme_mod('tesseract_footer_colors_link_color')) ? get_theme_mod('tesseract_footer_colors_link_color') : '#ffffff');

			$data[] = array('Footer Hovered Link Color', 'tesseract_footer_colors_link_hover_color', (get_theme_mod('tesseract_footer_colors_link_hover_color')) ? get_theme_mod('tesseract_footer_colors_link_hover_color') : '#d1ecff');
			/* Footer Colors END */

			/* Footer Height START */

			$data[] = array('Footer Height', 'tesseract_footer_height', (get_theme_mod('tesseract_footer_height')) ? get_theme_mod('tesseract_footer_height') : '10');

			/* Footer Height END */

			$data[] = array('Select footer width', 'tesseract_footer_width', (get_theme_mod('tesseract_footer_width')) ? get_theme_mod('tesseract_footer_width') : 'default');

			$data[] = array('Footer Blocks Width Proportion', 'tesseract_footer_blocks_width_prop', (get_theme_mod('tesseract_footer_blocks_width_prop')) ? get_theme_mod('tesseract_footer_blocks_width_prop') : '60');

			/* Footer Upper Section START */

			// $data[] = array('Footer Upper Status', 'footer_upper_section_choice', (get_theme_mod('footer_upper_section_choice')) ? get_theme_mod('footer_upper_section_choice') : 'disable');

			// $data[] = array('Footer Upper Background Color', 'tesseract_footer_upper_color', (get_theme_mod('tesseract_footer_upper_color')) ? get_theme_mod('tesseract_footer_upper_color') : '#000000');

			// $data[] = array('Footer Upper Text Color', 'tesseract_footer_upper_text_color', (get_theme_mod('tesseract_footer_upper_text_color')) ? get_theme_mod('tesseract_footer_upper_text_color') : '#ffffff');

			// $data[] = array('Section 1(Footer Upper)', 'footer_upper_section_1', (get_theme_mod('footer_upper_section_1')) ? get_theme_mod('footer_upper_section_1') : 'html');

			// $default_1 = '<section class="widget widget-page-content 01">
			// 			<div class="widget-inner">
			// 			  <header class="widget-header">
			// 			    <h2>Providence</h2>
			// 			  </header>
			// 			    <div class="page-content">
			// 					  <p><span>Providence is a feature-rich, completely responsive Shopify theme that looks beautiful on all screens, from phones to desktops.</span></p>
			// 					<p><span>Let your customers enjoy its clean, user-friendly design as-is or tailor it to your liking through the extensive array of theme options.</span></p>
			// 					<p>Built by <a href="http://tesseractplus.com/" target="_blank" title="Tesseract">, Tesseract.</a></p>
			// 				</div>
			// 			</div>
			// 		</section>';
			// $data[] = array('HTML(Section: 1)(Footer Upper)', 'footer_upper_section_1_html', (get_theme_mod('footer_upper_section_1_html')) ? get_theme_mod('footer_upper_section_1_html') : $default_1);

			// $data[] = array('Section 2(Footer Upper)', 'footer_upper_section_2', (get_theme_mod('footer_upper_section_2')) ? get_theme_mod('footer_upper_section_2') : 'recent_post');

			// $data[] = array('HTML(Section: 2)(Footer Upper)', 'footer_upper_section_2_html', (get_theme_mod('footer_upper_section_2_html')) ? get_theme_mod('footer_upper_section_2_html') : $default_1);

			// $data[] = array('Section 3(Footer Upper)', 'footer_upper_section_3', (get_theme_mod('footer_upper_section_3')) ? get_theme_mod('footer_upper_section_3') : 'socialmenu');

			// $data[] = array('HTML(Section: 3)(Footer Upper)', 'footer_upper_section_3_html', (get_theme_mod('footer_upper_section_3_html')) ? get_theme_mod('footer_upper_section_3_html') : $default_1);

			// $data[] = array('Section 4(Footer Upper)', 'footer_upper_section_4', (get_theme_mod('footer_upper_section_4')) ? get_theme_mod('footer_upper_section_4') : 'menu');

			// $data[] = array('HTML(Section: 4)(Footer Upper)', 'footer_upper_section_4_html', (get_theme_mod('footer_upper_section_4_html')) ? get_theme_mod('footer_upper_section_4_html') : $default_1);

			/* Footer Upper Section END */

			/* Footer Left Block Content START */
			$data[] = array('Left Footer Area', 'tesseract_footer_additional_content', (get_theme_mod('tesseract_footer_additional_content')) ? get_theme_mod('tesseract_footer_additional_content') : 'nothing');

			$data[] = array('Left Footer Area HTML', 'tesseract_footer_additional_content_html', (get_theme_mod('tesseract_footer_additional_content_html')) ? get_theme_mod('tesseract_footer_additional_content_html') : 'nothing');
			/* Footer Left Block Content END */

			/* Footer Centre Block Content START */
			$data[] = array('Center Footer Area', 'tesseract_footer_centre_content', (get_theme_mod('tesseract_footer_centre_content')) ? get_theme_mod('tesseract_footer_centre_content') : 'menuhtml');

			$data[] = array('Center Footer Area HTML', 'tesseract_footer_centre_content_html', (get_theme_mod('tesseract_footer_centre_content_html')) ? get_theme_mod('tesseract_footer_centre_content_html') : $default_1);
			/* Footer Centre Block Content END */

			/* Footer Right Block Content START */
			$data[] = array('Right Footer Area', 'tesseract_footer_right_content', (get_theme_mod('tesseract_footer_right_content')) ? get_theme_mod('tesseract_footer_right_content') : 'html');

			$data[] = array('Right Footer Area HTML', 'tesseract_footer_right_content_html', (get_theme_mod('tesseract_footer_right_content_html')) ? get_theme_mod('tesseract_footer_right_content_html') : $default_1);
			/* Footer Right Block Content END */	



			
			/* Footer Font Style START */
			$data[] = array('Google Font Style(Footer Menu)', 'footer_menu_text_fonts', (get_theme_mod('footer_menu_text_fonts')) ? get_theme_mod('footer_menu_text_fonts') : 'Oswald');

			$data[] = array('Font Style(Footer Menu)', 'footer_menu_text_fonts_styles', (get_theme_mod('footer_menu_text_fonts_styles')) ? get_theme_mod('footer_menu_text_fonts_styles') : 'normal');

			$data[] = array('Font Weights(Footer Menu)', 'footer_menu_text_fonts_weights', (get_theme_mod('footer_menu_text_fonts_weights')) ? get_theme_mod('footer_menu_text_fonts_weights') : '100');

			$data[] = array('Font Size(In px.)(Footer Menu)', 'footer_menu_text_size_custom', (get_theme_mod('footer_menu_text_size_custom')) ? get_theme_mod('footer_menu_text_size_custom') : '16');

			$data[] = array('Font Spacing(In px.)(Footer Menu)', 'footer_menu_text_spacing', (get_theme_mod('footer_menu_text_spacing')) ? get_theme_mod('footer_menu_text_spacing') : '0');

			/* Footer Font Style END */

			$data[] = array('Menu Spacing(In px.)(Footer Menu)', 'footer_menu_spacing', (get_theme_mod('footer_menu_spacing')) ? get_theme_mod('footer_menu_spacing') : '12');

			// $data[] = array('Footer Content Alignment', 'tesseract_footer_content_align_option', (get_theme_mod('tesseract_footer_content_align_option')) ? get_theme_mod('tesseract_footer_content_align_option') : 'horizantal');

			/* L A Y O U T   O P T I O N S */

			/* Blog Post Options START */
			$data[] = array('The article content type', 'tesseract_blog_content', (get_theme_mod('tesseract_blog_content')) ? get_theme_mod('tesseract_blog_content') : 'excerpt');

			$data[] = array('Layout type for the Blog Post page', 'tesseract_blog_post_layout', (get_theme_mod('tesseract_blog_post_layout')) ? get_theme_mod('tesseract_blog_post_layout') : 'sidebar-left');

			$data[] = array('Feature Image Display', 'tesseract_blog_display_featimg2', (get_theme_mod('tesseract_blog_display_featimg2')) ? get_theme_mod('tesseract_blog_display_featimg2') : 'yes');

			$data[] = array('featured image position', 'tesseract_blog_featimg_pos', (get_theme_mod('tesseract_blog_featimg_pos')) ? get_theme_mod('tesseract_blog_featimg_pos') : 'below');

			$data[] = array('To Show or Hide Date', 'tesseract_blog_date', (get_theme_mod('tesseract_blog_date')) ? get_theme_mod('tesseract_blog_date') : 'showdate');

			$data[] = array('To Show or Hide Author', 'tesseract_blog_author', (get_theme_mod('tesseract_blog_author')) ? get_theme_mod('tesseract_blog_author') : 'showauthor');

			$data[] = array('To Show or Hide Comments', 'tesseract_blog_comments', (get_theme_mod('tesseract_blog_comments')) ? get_theme_mod('tesseract_blog_comments') : 'showcomment');

			$data[] = array('Post Title Color', 'tesseract_blog_titlecolor', (get_theme_mod('tesseract_blog_titlecolor')) ? get_theme_mod('tesseract_blog_titlecolor') : '#000000');

			$data[] = array('Read More Button text', 'tesseract_blog_button_txt', (get_theme_mod('tesseract_blog_button_txt')) ? get_theme_mod('tesseract_blog_button_txt') : '');

			$data[] = array('Read More Button Text Color', 'tesseract_blog_buttoncolor', (get_theme_mod('tesseract_blog_buttoncolor')) ? get_theme_mod('tesseract_blog_buttoncolor') : '#ffffff');

			$data[] = array('Read More Button Color', 'tesseract_blog_buttonbgcolor', (get_theme_mod('tesseract_blog_buttonbgcolor')) ? get_theme_mod('tesseract_blog_buttonbgcolor') : '#ffffff');

			$data[] = array('Choose the Read More Button size', 'tesseract_blog_button_size', (get_theme_mod('tesseract_blog_button_size')) ? get_theme_mod('tesseract_blog_button_size') : 'medium');

			$data[] = array('Read More Button radius for Rounded Corner', 'tesseract_blog_button_radius', (get_theme_mod('tesseract_blog_button_radius')) ? get_theme_mod('tesseract_blog_button_radius') : '');

			$data[] = array('Choose the Read More Button position', 'tesseract_blog_button_pos', (get_theme_mod('tesseract_blog_button_pos')) ? get_theme_mod('tesseract_blog_button_pos') : 'left');

			$data[] = array('To Show or Hide Title', 'tesseract_blog_post_title', (get_theme_mod('tesseract_blog_post_title')) ? get_theme_mod('tesseract_blog_post_title') : 'show');

			/* Blog Post Options END */

			/* WooCommerce Layout Options START */
			$data[] = array('Product Per Page', 'tesseract_product_per_page', (get_theme_mod('tesseract_product_per_page')) ? get_theme_mod('tesseract_product_per_page') : '12');

			$data[] = array('Product Listings', 'tesseract_woocommerce_loop_layout', (get_theme_mod('tesseract_woocommerce_loop_layout')) ? get_theme_mod('tesseract_woocommerce_loop_layout') : 'four-column');

			$data[] = array('Choose the Title size', 'tesseract_woocommerce_title_size', (get_theme_mod('tesseract_woocommerce_title_size')) ? get_theme_mod('tesseract_woocommerce_title_size') : 'medium');

			$data[] = array('Product Title Color', 'tesseract_woocommerce_titlecolor', (get_theme_mod('tesseract_woocommerce_titlecolor')) ? get_theme_mod('tesseract_woocommerce_titlecolor') : '#000000');

			$data[] = array('The Title with Underline', 'tesseract_woocommerce_title_underline', (get_theme_mod('tesseract_woocommerce_title_underline')) ? get_theme_mod('tesseract_woocommerce_title_underline') : 'notunderline');

			$data[] = array('Shop page Price size', 'tesseract_woocommerce_price_size', (get_theme_mod('tesseract_woocommerce_price_size')) ? get_theme_mod('tesseract_woocommerce_price_size') : '');

			$data[] = array('Product Price Color', 'tesseract_woocommerce_pricecolor', (get_theme_mod('tesseract_woocommerce_pricecolor')) ? get_theme_mod('tesseract_woocommerce_pricecolor') : '#000000');

			$data[] = array('The Price with Bold Option', 'tesseract_woocommerce_price_weight', (get_theme_mod('tesseract_woocommerce_price_weight')) ? get_theme_mod('tesseract_woocommerce_price_weight') : 'nonbold');

			$data[] = array('To Show or Hide Ratings on shop page', 'tesseract_woocommerce_shop_ratings', (get_theme_mod('tesseract_woocommerce_shop_ratings')) ? get_theme_mod('tesseract_woocommerce_shop_ratings') : 'hideratings');

			$data[] = array('To Show or Hide Cart Button', 'tesseract_woocommerce_product_morebutton', (get_theme_mod('tesseract_woocommerce_product_morebutton')) ? get_theme_mod('tesseract_woocommerce_product_morebutton') : 'showcartbutton');

			$data[] = array('Add to Cart/More Details Button Color', 'tesseract_woocommerce_buttonbgcolor', (get_theme_mod('tesseract_woocommerce_buttonbgcolor')) ? get_theme_mod('tesseract_woocommerce_buttonbgcolor') : '#0db6bc');

			$data[] = array('Add to Cart/More Details Button Text Color', 'tesseract_woocommerce_cart_button_text', (get_theme_mod('tesseract_woocommerce_cart_button_text')) ? get_theme_mod('tesseract_woocommerce_cart_button_text') : '#000000');

			$data[] = array('Add to Cart Button Hover Color', 'tesseract_woocommerce_cart_button_hover', (get_theme_mod('tesseract_woocommerce_cart_button_hover')) ? get_theme_mod('tesseract_woocommerce_cart_button_hover') : '#000000');

			$data[] = array('Add to Cart Button radius for Rounded Corner', 'tesseract_woocommerce_button_radius', (get_theme_mod('tesseract_woocommerce_button_radius')) ? get_theme_mod('tesseract_woocommerce_button_radius') : '');

			$data[] = array('The Cart Button size', 'tesseract_woocommerce_button_size', (get_theme_mod('tesseract_woocommerce_button_size')) ? get_theme_mod('tesseract_woocommerce_button_size') : 'woomedium');

			$data[] = array('To Show or Hide Breadcrumb', 'tesseract_woocommerce_product_breadcrumb', (get_theme_mod('tesseract_woocommerce_product_breadcrumb')) ? get_theme_mod('tesseract_woocommerce_product_breadcrumb') : 'showbreadcrumb');

			$data[] = array('To Show or Hide Ratings', 'tesseract_woocommerce_product_ratings', (get_theme_mod('tesseract_woocommerce_product_ratings')) ? get_theme_mod('tesseract_woocommerce_product_ratings') : 'showratings');

			$data[] = array('Layout type for single product pages', 'tesseract_woocommerce_product_layout', (get_theme_mod('tesseract_woocommerce_product_layout')) ? get_theme_mod('tesseract_woocommerce_product_layout') : 'fullwidth');

			$data[] = array('Shopping Cart Color', 'tesseract_woocommerce_cartcolor', (get_theme_mod('tesseract_woocommerce_cartcolor')) ? get_theme_mod('tesseract_woocommerce_cartcolor') : '#fffff');

			$data[] = array('Sale Tag Background Color', 'tesseract_woocommerce_salebgcolor', (get_theme_mod('tesseract_woocommerce_salebgcolor')) ? get_theme_mod('tesseract_woocommerce_salebgcolor') : '#77a464');

			$data[] = array('Sale Tag Text Color', 'tesseract_woocommerce_saletextcolor', (get_theme_mod('tesseract_woocommerce_saletextcolor')) ? get_theme_mod('tesseract_woocommerce_saletextcolor') : '#ffffff');

			$data[] = array('Woo Buttons Background Color', 'tesseract_woocommerce_button_backgroud', (get_theme_mod('tesseract_woocommerce_button_backgroud')) ? get_theme_mod('tesseract_woocommerce_button_backgroud') : '#49B9E6');

			$data[] = array('Woo Buttons Hover Color', 'tesseract_woocommerce_button_hover_color', (get_theme_mod('tesseract_woocommerce_button_hover_color')) ? get_theme_mod('tesseract_woocommerce_button_hover_color') : '#ffffff');

			$data[] = array('Woo Buttons Text Color', 'tesseract_woocommerce_button_text_color', (get_theme_mod('tesseract_woocommerce_button_text_color')) ? get_theme_mod('tesseract_woocommerce_button_text_color') : '#ffffff');

			$data[] = array('Regular Price Color(In case of sale price exist)', 'tesseract_woocommerce_regular_price_color', (get_theme_mod('tesseract_woocommerce_regular_price_color')) ? get_theme_mod('tesseract_woocommerce_regular_price_color') : '#FF0000');

			$data[] = array('Add to cart button postion', 'tesseract_cart_button_position', (get_theme_mod('tesseract_cart_button_position')) ? get_theme_mod('tesseract_cart_button_position') : 'left-woo-cart-btn');

			$data[] = array('Display Cart in header', 'tesseract_woocommerce_headercart', (get_theme_mod('tesseract_woocommerce_headercart')) ? get_theme_mod('tesseract_woocommerce_headercart') : 'disable');
			/* WooCommerce Layout Options END */

			
			for($i=0; $i<count($data); $i++) {
				fputcsv($fp, $data[$i]);
			}

		
		
		
		exit;
    }

    public function success_msg()
    {
    	?>
    		<div class="notice notice-success is-dismissible"> 
				<p><strong>Operation successfully done.</strong></p>
			</div>
    	<?php
    }

    public function error_msg()
    {
    	?>
    		<div class="notice notice-error is-dismissible"> 
				<p><strong>Error occured. Please try again.</strong></p>
			</div>
    	<?php
    }
 
 }new Tesseract_Import_Export;
    



?>