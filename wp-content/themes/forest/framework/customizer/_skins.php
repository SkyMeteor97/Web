<?php
//Select the Default Theme Skin
function forest_customize_register_skin( $wp_customize ) {
$wp_customize->add_section(
    'forest_skin_options',
    array(
        'title'     => __('Choose Skin','forest'),
        'priority'  => 39,
    )
);

$wp_customize->add_setting(
    'forest_skin',
    array(
        'default'=> 'default',
        'sanitize_callback' => 'forest_sanitize_skin'
    )
);

$skins = array( 'default' => __('Default(blue)','forest'),
    'orange' =>  __('Orange','forest'),
    'green' => __('Green','forest'),
);

$wp_customize->add_control(
    'forest_skin',array(
        'settings' => 'forest_skin',
        'section'  => 'forest_skin_options',
        'type' => 'select',
        'choices' => $skins,
    )
);

function forest_sanitize_skin( $input ) {
    if ( in_array($input, array('default','orange','brown','green','grayscale') ) )
        return $input;
    else
        return '';
}
//Logo Settings
    $wp_customize->add_section( 'title_tagline' , array(
        'title'      => __( 'Title, Tagline & Logo', 'forest' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'forest_logo_resize' , array(
        'default'     => 100,
        'sanitize_callback' => 'forest_sanitize_positive_number',
    ) );
    $wp_customize->add_control(
        'forest_logo_resize',
        array(
            'label' => __('Resize & Adjust Logo','forest'),
            'section' => 'title_tagline',
            'settings' => 'forest_logo_resize',
            'priority' => 6,
            'type' => 'range',
            'active_callback' => 'forest_logo_enabled',
            'input_attrs' => array(
                'min'   => 30,
                'max'   => 200,
                'step'  => 5,
            ),
        )
    );

    function forest_logo_enabled($control) {
        $option = $control->manager->get_setting('custom_logo');
        return $option->value() == true;
    }



    //Replace Header Text Color with, separate colors for Title and Description
    //Override forest_site_titlecolor
    $wp_customize->remove_control('header_text');
    $wp_customize->remove_setting('header_textcolor');
    $wp_customize->add_setting('forest_site_titlecolor', array(
        'default'     => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'forest_site_titlecolor', array(
            'label' => __('Site Title Color','forest'),
            'section' => 'colors',
            'settings' => 'forest_site_titlecolor',
            'type' => 'color'
        ) )
    );

    $wp_customize->add_setting('forest_header_desccolor', array(
        'default'     => '#777777',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'forest_header_desccolor', array(
            'label' => __('Site Tagline Color','forest'),
            'section' => 'colors',
            'settings' => 'forest_header_desccolor',
            'type' => 'color'
        ) )
    );
    //Settings For Logo Area

    $wp_customize->add_setting(
        'forest_hide_title_tagline',
        array( 'sanitize_callback' => 'forest_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'forest_hide_title_tagline', array(
            'settings' => 'forest_hide_title_tagline',
            'label'    => __( 'Hide Title and Tagline.', 'forest' ),
            'section'  => 'title_tagline',
            'type'     => 'checkbox',
        )
    );

    function forest_title_visible( $control ) {
        $option = $control->manager->get_setting('forest_hide_title_tagline');
        return $option->value() == false ;
    }

}
add_action( 'customize_register', 'forest_customize_register_skin' );