<?php
//CUSTOM SHOWCASE
function forest_customize_register_showcase($wp_customize ) {
$wp_customize->add_panel( 'forest_showcase_panel', array(
    'priority'       => 35,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Custom Showcase','forest'),
) );

$wp_customize->add_section(
    'forest_sec_showcase_options',
    array(
        'title'     => __('Enable/Disable','forest'),
        'priority'  => 0,
        'panel'     => 'forest_showcase_panel'
    )
);


$wp_customize->add_setting(
    'forest_showcase_enable',
    array( 'sanitize_callback' => 'forest_sanitize_checkbox' )
);

$wp_customize->add_control(
    'forest_showcase_enable', array(
        'settings' => 'forest_showcase_enable',
        'label'    => __( 'Enable Showcase on Front Page.', 'forest' ),
        'section'  => 'forest_sec_showcase_options',
        'type'     => 'checkbox',
    )
);

for ( $i = 1 ; $i <= 3 ; $i++ ) :

    //Create the settings Once, and Loop through it.
    $wp_customize->add_section(
        'forest_showcase_sec'.$i,
        array(
            'title'     => __('ShowCase ','forest').$i,
            'priority'  => $i,
            'panel'     => 'forest_showcase_panel',

        )
    );

    $wp_customize->add_setting(
        'forest_showcase_img'.$i,
        array( 'sanitize_callback' => 'esc_url_raw' )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'forest_showcase_img'.$i,
            array(
                'label' => '',
                'section' => 'forest_showcase_sec'.$i,
                'settings' => 'forest_showcase_img'.$i,
            )
        )
    );

    $wp_customize->add_setting(
        'forest_showcase_title'.$i,
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'forest_showcase_title'.$i, array(
            'settings' => 'forest_showcase_title'.$i,
            'label'    => __( 'Showcase Title','forest' ),
            'section'  => 'forest_showcase_sec'.$i,
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'forest_showcase_desc'.$i,
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'forest_showcase_desc'.$i, array(
            'settings' => 'forest_showcase_desc'.$i,
            'label'    => __( 'Showcase Description','forest' ),
            'section'  => 'forest_showcase_sec'.$i,
            'type'     => 'text',
        )
    );


    $wp_customize->add_setting(
        'forest_showcase_url'.$i,
        array( 'sanitize_callback' => 'esc_url_raw' )
    );

    $wp_customize->add_control(
        'forest_showcase_url'.$i, array(
            'settings' => 'forest_showcase_url'.$i,
            'label'    => __( 'Target URL','forest' ),
            'section'  => 'forest_showcase_sec'.$i,
            'type'     => 'url',
        )
    );

endfor;
}
add_action( 'customize_register', 'forest_customize_register_showcase' );