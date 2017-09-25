<?php
/**
 * Enqueue scripts and styles.
 */
function forest_scripts() {
    wp_enqueue_style( 'forest-style', get_stylesheet_uri() );

    wp_enqueue_style('forest-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('forest_title_font', 'Lato') )).':100,300,400,700' );

    if (get_theme_mod('forest_title_font') != get_theme_mod('forest_body_font') ) {
        wp_enqueue_style('forest-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('forest_body_font', 'Open Sans') )).':100,300,400,700' );
    }

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );

    wp_enqueue_style( 'hover-css', get_template_directory_uri() . '/assets/css/hover.min.css' );

    wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/assets/css/slicknav.css' );

    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css' );

    wp_enqueue_style( 'forest-main-theme-style', get_template_directory_uri() . '/assets/theme-styles/css/'.get_theme_mod('forest_skin', 'default').'.css' );

    wp_enqueue_script( 'forest-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'forest-externaljs', get_template_directory_uri() . '/js/external.js', array('jquery'), '20120206', true );

    wp_enqueue_script( 'forest-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'forest-custom-js', get_template_directory_uri() . '/js/custom.js', array('forest-externaljs') );
}
add_action( 'wp_enqueue_scripts', 'forest_scripts' );