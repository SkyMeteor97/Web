<?php
// CREATE THE fcp PANEL
function forest_customize_register_fposts_square_boxes( $wp_customize ) {
$wp_customize->add_panel('forest_a_fcp_panel', array(
    'priority' => 40,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Featured Posts Showcase', 'forest'),
    'description' => '',
));


//SQUARE BOXES
$wp_customize->add_section(
    'forest_a_fc_boxes',
    array(
        'title' => __('Square Boxes', 'forest'),
        'priority' => 10,
        'panel' => 'forest_a_fcp_panel'
    )
);

$wp_customize->add_setting(
    'forest_a_box_enable',
    array('sanitize_callback' => 'forest_sanitize_checkbox')
);

$wp_customize->add_control(
    'forest_a_box_enable', array(
        'settings' => 'forest_a_box_enable',
        'label' => __('Enable Square Boxes & Posts Slider.', 'forest'),
        'section' => 'forest_a_fc_boxes',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'forest_a_box_title',
    array('sanitize_callback' => 'sanitize_text_field')
);

$wp_customize->add_control(
    'forest_a_box_title', array(
        'settings' => 'forest_a_box_title',
        'label' => __('Title for the Boxes', 'forest'),
        'section' => 'forest_a_fc_boxes',
        'type' => 'text',
    )
);

$wp_customize->add_setting(
    'forest_a_box_cat',
    array('sanitize_callback' => 'forest_sanitize_category')
);

$wp_customize->add_control(
    new Forest_WP_Customize_Category_Control(
        $wp_customize,
        'forest_a_box_cat',
        array(
            'label' => __('Posts Category.', 'forest'),
            'settings' => 'forest_a_box_cat',
            'section' => 'forest_a_fc_boxes'
        )
    )
);
}
add_action( 'customize_register', 'forest_customize_register_fposts_square_boxes' );