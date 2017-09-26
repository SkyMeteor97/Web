<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function forest_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	
	//If Menu Description is Disabled.
	if ( !has_nav_menu('primary') || get_theme_mod('forest_disable_nav_desc') ) :
		echo "#site-navigation ul li a { padding: 16px 12px; }";
	endif;
	
	
	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('forest_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: left; }";
	endif;	
	
	if ( get_theme_mod('forest_title_font') ) :
		echo ".title-font, h1, h2, .sections-title, .woocommerce ul.products li.product h3 { font-family: ".esc_html( get_theme_mod('forest_title_font','Lato') )."; }";
	endif;
	
	if ( get_theme_mod('forest_body_font') ) :
		echo "body { font-family: ".esc_html( get_theme_mod('forest_body_font','Open Sans') )."; }";
	endif;
	
	if ( get_theme_mod('forest_site_titlecolor') ) :
		echo "#masthead h1.site-title a { color: ".esc_html( get_theme_mod('forest_site_titlecolor', '#333') )."; }";
	endif;
	
	
	if ( get_theme_mod('forest_header_desccolor','#777777') ) :
		echo ".site-description { color: ".esc_html( get_theme_mod('forest_header_desccolor','#777777') )."; }";
	endif;
	//Check Jetpack is active
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) )
		echo '.pagination { display: none; }';


	if ( get_theme_mod('forest_custom_css') ) :
		echo  esc_html( get_theme_mod('forest_custom_css') );
	endif;
	
	
	if ( get_theme_mod('forest_hide_title_tagline') ) :
		echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	if ( get_theme_mod('forest_logo_resize') ) :
		$val = esc_html( get_theme_mod('forest_logo_resize') )/100;
		echo "#masthead .custom-logo { transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
		endif;



    // page & post fontsize
    if(get_theme_mod('forest_content_page_post_fontsize_set')):
        $pp_size_val = get_theme_mod('forest_content_page_post_fontsize_set');
        if($pp_size_val=='small'):
            echo "#primary-mono .entry-content{ font-size:12px;}";
        elseif ($pp_size_val=='medium'):
            echo "#primary-mono .entry-content{ font-size:16px;}";
        elseif ($pp_size_val=='large'):
            echo "#primary-mono .entry-content{ font-size:18px;}";
        elseif ($pp_size_val=='extra-large'):
            echo "#primary-mono .entry-content{ font-size:20px;}";
        endif;
    else:
        echo "#primary-mono .entry-content{ font-size:14px;}";
    endif;

    //site title font size
    //var_dump(get_theme_mod('forest_content_site_fontsize_set'));
    if(get_theme_mod('forest_content_site_title_fontsize_set')):
        $site_title_size_val=get_theme_mod('forest_content_site_title_fontsize_set');
        if($site_title_size_val != 'default'):
            echo "#masthead h1.site-title {font-size:".$site_title_size_val."px !important;}";
        else:
            echo "#masthead h1.site-title {font-size:37"."px;}";
        endif;
    endif;

    //site desc font size
    //var_dump(get_theme_mod('forest_content_site_desc_fontsize_set'));
    if(get_theme_mod('forest_content_site_desc_fontsize_set')):
        $site_desc_size_val=get_theme_mod('forest_content_site_desc_fontsize_set');
        if($site_desc_size_val != 'default'):
            echo "#masthead h2.site-description {font-size:".$site_desc_size_val."px !important;}";
        else:
            echo "#masthead h2.site-description {font-size:15"."px;}";
        endif;
    endif;






    echo "</style>";
}

add_action('wp_head', 'forest_custom_css_mods');