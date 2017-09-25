<?php
//SLIDER
// SLIDER PANEL
function forest_customize_register_slider( $wp_customize ) {
$wp_customize->add_panel( 'forest_slider_panel', array(
    'priority'       => 35,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Main Slider','forest'),
) );

$wp_customize->add_section(
    'forest_sec_slider_options',
    array(
        'title'     => __('Enable/Disable','forest'),
        'priority'  => 0,
        'panel'     => 'forest_slider_panel'
    )
);


$wp_customize->add_setting(
    'forest_main_slider_enable',
    array( 'sanitize_callback' => 'forest_sanitize_checkbox' )
);

$wp_customize->add_control(
    'forest_main_slider_enable', array(
        'settings' => 'forest_main_slider_enable',
        'label'    => __( 'Enable Slider on HomePage.', 'forest' ),
        'section'  => 'forest_sec_slider_options',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'forest_main_slider_count',
    array(
        'default' => '0',
        'sanitize_callback' => 'forest_sanitize_positive_number'
    )
);

// Select How Many Slides the User wants, and Reload the Page.
$wp_customize->add_control(
    'forest_main_slider_count', array(
        'settings' => 'forest_main_slider_count',
        'label'    => __( 'No. of Slides(Min:0, Max: 10)' ,'forest'),
        'section'  => 'forest_sec_slider_options',
        'type'     => 'number',
        'description' => __('Save the Settings, and Reload this page to Configure the Slides.','forest'),

    )
);

for ( $i = 1 ; $i <= 10 ; $i++ ) :

    //Create the settings Once, and Loop through it.
    static $x = 0;
    $wp_customize->add_section(
        'forest_slide_sec'.$i,
        array(
            'title'     => __('Slide ','forest').$i,
            'priority'  => $i,
            'panel'     => 'forest_slider_panel',
            'active_callback' => 'forest_show_slide_sec'

        )
    );

    $wp_customize->add_setting(
        'forest_slide_img'.$i,
        array( 'sanitize_callback' => 'esc_url_raw' )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'forest_slide_img'.$i,
            array(
                'label' => '',
                'section' => 'forest_slide_sec'.$i,
                'settings' => 'forest_slide_img'.$i,
            )
        )
    );

    $wp_customize->add_setting(
        'forest_slide_title'.$i,
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'forest_slide_title'.$i, array(
            'settings' => 'forest_slide_title'.$i,
            'label'    => __( 'Slide Title','forest' ),
            'section'  => 'forest_slide_sec'.$i,
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'forest_slide_desc'.$i,
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'forest_slide_desc'.$i, array(
            'settings' => 'forest_slide_desc'.$i,
            'label'    => __( 'Slide Description','forest' ),
            'section'  => 'forest_slide_sec'.$i,
            'type'     => 'text',
        )
    );



    $wp_customize->add_setting(
        'forest_slide_CTA_button'.$i,
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'forest_slide_CTA_button'.$i, array(
            'settings' => 'forest_slide_CTA_button'.$i,
            'label'    => __( 'Custom Call to Action Button Text(Optional)','forest' ),
            'section'  => 'forest_slide_sec'.$i,
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'forest_slide_url'.$i,
        array( 'sanitize_callback' => 'esc_url_raw' )
    );

    $wp_customize->add_control(
        'forest_slide_url'.$i, array(
            'settings' => 'forest_slide_url'.$i,
            'label'    => __( 'Target URL','forest' ),
            'section'  => 'forest_slide_sec'.$i,
            'type'     => 'url',
        )
    );

endfor;

//active callback to see if the slide section is to be displayed or not
function forest_show_slide_sec( $control ) {
    $option = $control->manager->get_setting('forest_main_slider_count');
    global $x;
    if ( $x < $option->value() ){
        $x++;
        return true;
    }
}
}
add_action( 'customize_register', 'forest_customize_register_slider' );