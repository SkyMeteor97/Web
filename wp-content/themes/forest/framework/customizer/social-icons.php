<?php
// Social Icons
function forest_customize_register_social( $wp_customize ) {
$wp_customize->add_section('forest_social_section', array(
    'title' => __('Social Icons','forest'),
    'priority' => 44 ,
));

$social_networks = array( //Redefinied in Sanitization Function.
    'none' => __('-','forest'),
    'facebook' => __('Facebook','forest'),
    'twitter' => __('Twitter','forest'),
    'google-plus' => __('Google Plus','forest'),
    'instagram' => __('Instagram','forest'),
    'rss' => __('RSS Feeds','forest'),
    'vine' => __('Vine','forest'),
    'vimeo-square' => __('Vimeo','forest'),
    'youtube' => __('Youtube','forest'),
    'flickr' => __('Flickr','forest'),
);
    //social icons style
    $social_style = array(
        'hvr-ripple-out'  => __('Default', 'forest'),
        'hvr-wobble-bottom'   => __('Style 1', 'forest'),
        'hvr-bounce-to-bottom'   => __('Style 2', 'forest'),
        'hvr-rectangle-out'   => __('Style 3', 'forest'),
        'hvr-glow'   => __('Style 4', 'forest'),

    );
    $wp_customize->add_setting(
        'forest_social_icon_style_set', array(
        'sanitize_callback' => 'forest_sanitize_social_style',
        'default' => 'hvr-bounce-to-bottom'
    ));

    function forest_sanitize_social_style( $input ) {
        if ( in_array($input, array('hvr-bounce-to-bottom','hvr-wobble-bottom','hvr-ripple-out','hvr-rectangle-out','hvr-glow') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control( 'forest_social_icon_style_set', array(
        'settings' => 'forest_social_icon_style_set',
        'label' => __('Social Icon Style ','forest'),
        'description' => __('You can choose your icon style','forest'),
        'section' => 'forest_social_section',
        'type' => 'select',
        'choices' => $social_style,
    ));


    $social_count = count($social_networks);

for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :

    $wp_customize->add_setting(
        'forest_social_'.$x, array(
        'sanitize_callback' => 'forest_sanitize_social',
        'default' => 'none'
    ));

    $wp_customize->add_control( 'forest_social_'.$x, array(
        'settings' => 'forest_social_'.$x,
        'label' => __('Icon ','forest').$x,
        'section' => 'forest_social_section',
        'type' => 'select',
        'choices' => $social_networks,
    ));

    $wp_customize->add_setting(
        'forest_social_url'.$x, array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control( 'forest_social_url'.$x, array(
        'settings' => 'forest_social_url'.$x,
        'description' => __('Icon ','forest').$x.__(' Url','forest'),
        'section' => 'forest_social_section',
        'type' => 'url',
        'choices' => $social_networks,
    ));

endfor;

function forest_sanitize_social( $input ) {
    $social_networks = array(
        'none' ,
        'facebook',
        'twitter',
        'google-plus',
        'instagram',
        'rss',
        'vine',
        'vimeo-square',
        'youtube',
        'flickr'
    );
    if ( in_array($input, $social_networks) )
        return $input;
    else
        return '';
}

}
add_action( 'customize_register', 'forest_customize_register_social' );