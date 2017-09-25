<?php

/**

 * The header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="content">

 *

 * @package Tesseract

 */

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> <?php if ( is_user_logged_in() ) {echo 'class="loginpage"';} ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="https://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>

<!--[if gte IE 9]>

  <style type="text/css">

    .gradient {

       filter: none;

    }

  </style>

<![endif]-->

</head>

<?php // Additional body classes

$bodyClass = ( version_compare($wp_version, '4.0.0', '>') && is_customize_preview() ) ? 'backend' : 'frontend';



$slayout = get_theme_mod('tesseract_search_results_layout');



$bplayout = get_theme_mod('tesseract_blog_post_layout');

 

if ( (is_page()) && (has_post_thumbnail()) ) $bodyClass .= ' tesseract-featured';



if ( is_plugin_active('beaver-builder-lite-version/fl-builder.php') || is_plugin_active('beaver-builder/fl-builder.php') ) $bodyClass .= ' beaver-on';



$opValue = get_theme_mod('tesseract_header_colors_bck_color_opacity');



$header_bckOpacity = is_numeric($opValue) ? TRUE : FALSE;



if ( is_front_page() && ( $header_bckOpacity && ( intval($opValue) < 100 ) ) ) $bodyClass .= ' transparent-header';





$opValue1 = get_theme_mod('tesseract_footer_colors_bck_color_opacity');



$footer_bckOpacity = is_numeric($opValue1) ? TRUE : FALSE;



if ( is_front_page() && ( $footer_bckOpacity && ( intval($opValue1) < 100 ) ) ) $bodyClass .= ' transparent-footer';









if ( is_search() ) {

	if ( $slayout == 'fullwidth' ) $bodyClass .= ' fullwidth';

	if ( $slayout == 'sidebar-right' ) $bodyClass .= ' sidebar-right';

}elseif( is_single() ) {

	if ( $bplayout == 'fullwidth' ) $bodyClass .= ' fullwidth';

	if ( $bplayout == 'sidebar-right' ) $bodyClass .= ' sidebar-right';

}elseif( is_home() ) {

	if ( $bplayout == 'fullwidth' ) $bodyClass .= ' fullwidth';

	if ( $bplayout == 'sidebar-right' ) $bodyClass .= ' sidebar-right';

}

 

?>



<body <?php body_class( $bodyClass ); ?>>

<?php $headright_content = (get_theme_mod('tesseract_header_right_content')) ? get_theme_mod('tesseract_header_right_content') : 'nothing';

$wooheader = ( get_theme_mod('tesseract_woocommerce_headercart') ) ? get_theme_mod('tesseract_woocommerce_headercart') : 'disable';

$rightclass = '';

if ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) {

	$rightclass = ($wooheader!='disable') ? $headright_content . ' is-right is-woo ' : $headright_content . ' is-right no-woo ';

} else if ( ( $headright_content == 'nothing' ) && ($wooheader!='disable') ) {

	$rightclass = ($wooheader!='disable') ? $headright_content . ' no-right is-woo ' : $headright_content . ' no-right no-woo ';

}





$headpos = ( is_front_page() && ( $header_bckOpacity && ( intval($opValue) < 100 ) ) ) ? 'pos-absolute' : 'pos-relative';



$footpos = ( is_front_page() && ( $footer_bckOpacity && ( intval($opValue1) < 100 ) ) ) ? 'pos-absolute' : 'pos-relative';

?>

<div id="page" class="hfeed site">

<a class="skip-link screen-reader-text" href="#content_TesseractTheme">

<?php _e( 'Skip to content', 'tesseract' ); ?>

</a>

<?php $logoImg = get_theme_mod('tesseract_header_logo_image');

    $blogname = get_bloginfo('blogname');

    $hmenusize = (get_theme_mod('tesseract_header_width')) ? get_theme_mod('tesseract_header_width') : 'fullwidth' ;



	/*$mmdisplay = get_theme_mod( 'tesseract_mobmenu_opener' );

	$mmdClass = ( $mmdisplay == 1 ) ? 'showit' : 'hideit';*/
  $mmdClass = (get_theme_mod( 'tesseract_mobmenu_opener_mob' )) ? get_theme_mod( 'tesseract_mobmenu_opener_mob' ) : 'mob-showit';
  

    $hmenusize_class = ( $hmenusize == 'fullwidth' ) ? 'fullwidth' : 'autowidth';



    if ( !$logoImg && $blogname ) $brand_content = 'blogname';

    if ( $logoImg ) $brand_content = 'logo';

    if ( !$logoImg && !$blogname ) $brand_content = 'no-brand';



    ?>

<?php $tesheadr_layout = (get_theme_mod('tesseract_header_layout_setting')) ? get_theme_mod('tesseract_header_layout_setting') : 'defaultlayout'; ?>

<?php $tesheadr_inlinelogopos = get_theme_mod('inline_logo_side'); ?>

<?php $tesheadr_vertpadding = (get_theme_mod('tesseract_vertical_header_width')) ? get_theme_mod('tesseract_vertical_header_width') : 230; 

  $header_upper_color = (get_theme_mod('tesseract_header_upper_color_top_part')) ? get_theme_mod('tesseract_header_upper_color_top_part') : '#000000';

$top_enable = (get_theme_mod( 'tesseract_header_upper_status' )) ? get_theme_mod( 'tesseract_header_upper_status' ) : 'disable';

 $header_logo_choice = (get_theme_mod('tesseract_header_logo_type')) ? get_theme_mod('tesseract_header_logo_type') : 'image';

    $header_text        = (get_theme_mod('tesseract_header_logo_text')) ? get_theme_mod('tesseract_header_logo_text') : get_bloginfo();
    $header_fonts       = (get_theme_mod('tesseract_header_logo_text_fonts')) ? get_theme_mod('tesseract_header_logo_text_fonts') : 'none';
    $header_font_styles = (get_theme_mod('tesseract_header_logo_text_fonts_styles')) ? get_theme_mod('tesseract_header_logo_text_fonts_styles') : 'normal';
    $header_font_weight = (get_theme_mod('tesseract_header_logo_text_fonts_weights')) ? get_theme_mod('tesseract_header_logo_text_fonts_weights') : '900';

if($header_fonts !='none' ){?>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo $header_fonts; ?>" media="screen">

<?php } ?>
<?php //echo $tesheadr_vertpadding; ?>

<?php //echo $tesheadr_layout; ?>

<?php

if ( is_plugin_active( 'tesseract-pro-plugin/fl-builder.php' ) ) { ?>

<?php if ( $tesheadr_layout == 'none' ) { ?>

<?php } elseif ( $tesheadr_layout == 'defaultlayout' ) {  ?>
  
<header id="masthead_TesseractTheme" class="site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?>">

    <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
    <?php if($mmdClass_mob=='mob-showit'){ ?>
      <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>
    <?php } ?>

      <div id="site-banner-left">

        <div id="site-banner-left-inner">

           <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></h1>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php ///} ?>

          <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select'):'none';


						if ( $menuSelected !== 'none' ) : ?>

          <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

            <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

          </nav>

          <!-- #site-navigation -->

          

          <?php endif; ?>

        </div>

      </div>

      <?php get_template_part( 'content', 'header-rightcontent' ); ?>

    </div>

  </div>

</header>

<?php } elseif ( $tesheadr_layout == 'navbottom' ) { ?>

<header id="masthead_TesseractTheme" class="site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> bottomNav">

    <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
      <?php if($mmdClass=='mob-showit'){ ?>
      <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>
      <?php } ?>

      <div id="site-banner-left">

        <div id="site-banner-left-inner">

          <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></h1>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>
        </div>

      </div>

      <?php get_template_part( 'content', 'header-rightcontent' ); ?>

    </div>

    <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select'):'none';

			if ( $menuSelected !== 'none' ) : ?>

    <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

      <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

    </nav>

    <!-- #site-navigation -->

    <?php endif; ?>

  </div>

</header>

<?php } elseif( $tesheadr_layout == 'navright' ) { ?>

<header id="masthead_TesseractTheme" class="site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?>">

    <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

      <?php if($mmdClass=='mob-showit'){ ?>
      <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>
      <?php } ?>
      <div id="site-banner-left">

        <div id="site-banner-left-inner">

          <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></h1>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>

          <?php //$menuSelected = get_theme_mod('tesseract_header_menu_select');



							//if ( $menuSelected !== 'none' ) : ?>

          <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation rightNav <?php echo $hmenusize_class; ?>" role="navigation">

            <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

          </nav>

          <!-- #site-navigation -->

          

          <?php //endif; ?>

        </div>

      </div>

    </div>

  </div>

</header>

<?php } elseif( $tesheadr_layout == 'navleft' ) { ?>

<header id="masthead_TesseractTheme" class="site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?>">

    <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
      <?php if($mmdClass=='mob-showit'){ ?>
      <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>
      <?php } ?>
      <div id="site-banner-left">

        <div id="site-banner-left-inner">

          <?php //$menuSelected = get_theme_mod('tesseract_header_menu_select');

			//if ( $menuSelected !== 'none' ) : ?>

          <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

            <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

          </nav>

          <!-- #site-navigation -->

          <?php //endif; ?>

         <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></h1>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>
        </div>

      </div>

    </div>

  </div>

</header>

<?php } elseif( $tesheadr_layout == 'navcentered' ) { ?>

<header id="masthead_TesseractTheme" class="site-header <?php echo $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> centeredNav">

    <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

      <div class="row">

        <div class="col-md-12">

          <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></h1>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>

        </div>

        <div class="col-md-12">

          <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

          <?php //$menuSelected = get_theme_mod('tesseract_header_menu_select');

			//if ( $menuSelected !== 'none' ) : ?>

          <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

            <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

          </nav>

          <!-- #site-navigation -->

          <?php //endif; ?>

        </div>

      </div>

    </div>

  </div>

</header>

<?php } elseif( $tesheadr_layout == 'centered-inline-logo' ) { ?>

<header id="masthead_TesseractTheme" class="site-header <?php echo $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">

	<?php if ( $tesheadr_inlinelogopos == 'inlineleft' ) { ?>

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> logoInlineCenter left">

    <?php } elseif ( $tesheadr_inlinelogopos == 'inlineright' ){ ?>

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> logoInlineCenter right">	

	<?php } ?>

    <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

      <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></h1>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>

      <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

      <?php //$menuSelected = get_theme_mod('tesseract_header_menu_select');

			//if ( $menuSelected !== 'none' ) : ?>

      <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

        <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

      </nav>

      <!-- #site-navigation -->

      <?php //endif; ?>

    </div>

  </div>

</header>

<?php } elseif( $tesheadr_layout == 'vertical-left' ) { ?>

<div class="fl-page verticalNavLeftContainer">

  <header id="masthead_TesseractTheme" class="site-header verticalLeftHeader <?php echo $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" style="width:<?php echo $tesheadr_vertpadding; ?>px;" role="banner">

    <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> vertical">

      <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

        <?php //if ( $logoImg || $blogname ) { ?>

                <div class="site-branding">

                  <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                  <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                  <?php else : ?>

                  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                    <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                      <?php echo $header_text; ?>
                    </span>

                    </a></h1>

                  <?php endif; ?>

                </div>

                <!-- .site-branding -->

                <?php //} ?>

        <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

        <?php //$menuSelected = get_theme_mod('tesseract_header_menu_select');

  			//if ( $menuSelected !== 'none' ) : ?>

        <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

          <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

        </nav>

        <!-- #site-navigation -->

        <?php //endif; ?>

      </div>

    </div>

  </header>

<?php } elseif( $tesheadr_layout == 'vertical-right' ) { ?>

<div class="fl-page verticalNavRightContainer">

<header id="masthead_TesseractTheme" class="site-header verticalRightHeader <?php echo $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" style="width:<?php echo $tesheadr_vertpadding; ?>px;" role="banner">

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?> vertical">

    <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">

      <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></h1>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>

      <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>

      <?php //$menuSelected = get_theme_mod('tesseract_header_menu_select');

			//if ( $menuSelected !== 'none' ) : ?>

      <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

        <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>

      </nav>

      <!-- #site-navigation -->

      <?php //endif; ?>

    </div>

  </div>

</header>

<?php } ?>

<?php } else {  ?>

<header id="masthead_TesseractTheme" class="site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">

  <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?>">

    <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
      <?php if($mmdClass=='mob-showit'){ ?>
      <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="#" id="mobile-menu-trigger"></a></div>
      <?php } ?>

      <div id="site-banner-left">

        <div id="site-banner-left-inner">

          <?php //if ( $logoImg || $blogname ) { ?>

              <div class="site-branding">

                <?php if ( $header_logo_choice == 'image' && $logoImg ) : ?>

                <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>

                <?php else : ?>

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                  <span style="font-family:<?php echo $header_fonts; ?>; font-style:<?php echo $header_font_styles;?>; font-weight:<?php echo $header_font_weight; ?>;">
                    <?php echo $header_text; ?>
                  </span>

                  </a></h1>

                <?php endif; ?>

              </div>

              <!-- .site-branding -->

              <?php //} ?>

          <?php $menuSelected = (get_theme_mod('tesseract_header_menu_select')) ? get_theme_mod('tesseract_header_menu_select') : 'none';

							if ( $menuSelected !== 'none' ) : ?>

          <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">

            <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 );  ?>

          </nav>

          <!-- #site-navigation -->

          

          <?php endif; ?>

        </div>

      </div>

      <?php get_template_part( 'content', 'header-rightcontent' ); ?>

    </div>

  </div>

</header>

<?php } ?>

<!-- #masthead -->

<?php if ( $tesheadr_layout == 'vertical-left' ) { ?>

<div id="content_TesseractTheme" class="cf site-content" style="margin-left:<?php echo $tesheadr_vertpadding; ?>px;">

<?php } elseif ( $tesheadr_layout == 'vertical-right' ) { ?>

<div id="content_TesseractTheme" class="cf site-content" style="margin-right:<?php echo $tesheadr_vertpadding; ?>px;">

<?php } else { ?>

<div id="content_TesseractTheme" class="cf site-content">

<?php } ?>
<?php
$tesseract_header_logo_height_mob = (get_theme_mod('tesseract_header_logo_height_mob')) ? get_theme_mod('tesseract_header_logo_height_mob') : 100;
//echo "Current Pixel: ".$tesseract_header_logo_height_mob;
?>
<style type="text/css">

  @media screen and (max-width:768px) {
    #site-banner .site-logo img {
            max-width: <?php echo $tesseract_header_logo_height_mob; ?>px !important;
            height: auto !important;
        }
  }
</style>