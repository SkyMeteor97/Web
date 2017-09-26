<?php
//featured area 1 start
function forest_customize_register_fp_area( $wp_customize )
{
// CREATE THE fcp PANEL
    $wp_customize->add_panel('forest_farea_panel', array(
        'priority' => 40,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Featured Posts Area', 'forest'),
        'description' => '',
    ));
//farea 1 start
$wp_customize->add_section(
    'forest_farea1',
    array(
        'title' => __('Featured Posts Area 1', 'forest'),
        'priority' => 10,
        'panel' => 'forest_farea_panel'
    )
);

$wp_customize->add_setting(
    'forest_farea1_enable',
    array('sanitize_callback' => 'forest_sanitize_checkbox')
);

$wp_customize->add_control(
    'forest_farea1_enable', array(
        'setting' => 'forest_farea1_enable',
        'label' => __('Enable featured area 1', 'forest'),
        'section' => 'forest_farea1',
        'type' => 'checkbox',
    )
);


    $wp_customize->add_setting(
        'forest_farea1_title',
        array('sanitize_callback' => 'sanitize_text_field')
    );

    $wp_customize->add_control(
        'forest_farea1_title', array(
            'setting' => 'forest_farea1_title',
            'label' => __('Title for the featured area 1', 'forest'),
            'section' => 'forest_farea1',
            'type' => 'text',
        )
    );

$wp_customize->add_setting(
    'forest_farea1_cat',
    array('sanitize_callback' => 'forest_sanitize_category')
);

$wp_customize->add_control(
    new Forest_WP_Customize_Category_Control(
        $wp_customize,
        'forest_farea1_cat',
        array(
            'label' => __('Posts Category.', 'forest'),
            'setting' => 'forest_farea1_cat',
            'section' => 'forest_farea1'
        )
    )
);
//farea 1 end.
//farea 2 start
    $wp_customize->add_section(
        'forest_farea2',
        array(
            'title' => __('Featured Posts Area 2 ', 'forest'),
            'priority' => 10,
            'panel' => 'forest_farea_panel'
        )
    );

    $wp_customize->add_setting(
        'forest_farea2_enable',
        array('sanitize_callback' => 'forest_sanitize_checkbox')
    );

    $wp_customize->add_control(
        'forest_farea2_enable', array(
            'setting' => 'forest_farea2_enable',
            'label' => __('Enable featured area 2.', 'forest'),
            'section' => 'forest_farea2',
            'type' => 'checkbox',
        )
    );


    $wp_customize->add_setting(
        'forest_farea2_title',
        array('sanitize_callback' => 'sanitize_text_field')
    );

    $wp_customize->add_control(
        'forest_farea2_title', array(
            'setting' => 'forest_farea2_title',
            'label' => __('Title for the featured area 2', 'forest'),
            'section' => 'forest_farea2',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'forest_farea2_cat',
        array('sanitize_callback' => 'forest_sanitize_category')
    );

    $wp_customize->add_control(
        new Forest_WP_Customize_Category_Control(
            $wp_customize,
            'forest_farea2_cat',
            array(
                'label' => __('Posts Category.', 'forest'),
                'setting' => 'forest_farea2_cat',
                'section' => 'forest_farea2'
            )
        )
    );
//farea 2 end
}
add_action( 'customize_register', 'forest_customize_register_fp_area' );

//featured area 1 end