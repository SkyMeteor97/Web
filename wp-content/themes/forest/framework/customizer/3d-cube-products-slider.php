<?php
//SLIDER
function forest_customize_register_3d_cube_prd_slider( $wp_customize ) {
    if ( class_exists('woocommerce') ) :
$wp_customize->add_section(
    'forest_fc_slider',
    array(
        'title'     => __('3D Cube Products Slider','forest'),
        'priority'  => 10,
        'panel'     => 'forest_fcp_panel',
        'description' => 'This is the Posts Slider, displayed left to the square boxes.',
    )
);


$wp_customize->add_setting(
    'forest_slider_title',
    array( 'sanitize_callback' => 'sanitize_text_field' )
);

$wp_customize->add_control(
    'forest_slider_title', array(
        'settings' => 'forest_slider_title',
        'label'    => __( 'Title for the Slider', 'forest' ),
        'section'  => 'forest_fc_slider',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'forest_slider_count',
    array( 'sanitize_callback' => 'forest_sanitize_positive_number' )
);

$wp_customize->add_control(
    'forest_slider_count', array(
        'settings' => 'forest_slider_count',
        'label'    => __( 'No. of Posts(Min:3, Max: 10)', 'forest' ),
        'section'  => 'forest_fc_slider',
        'type'     => 'range',
        'input_attrs' => array(
            'min'   => 3,
            'max'   => 10,
            'step'  => 1,
            'class' => 'test-class test',
            'style' => 'color: #0a0',
        ),
    )
);

$wp_customize->add_setting(
    'forest_slider_cat',
    array( 'sanitize_callback' => 'forest_sanitize_product_category' )
);

$wp_customize->add_control(
    new Forest_WP_Customize_Product_Category_Control(
        $wp_customize,
        'forest_slider_cat',
        array(
            'label'    => __('Category For Slider.','forest'),
            'settings' => 'forest_slider_cat',
            'section'  => 'forest_fc_slider'
        )
    )
);
endif;
}
add_action( 'customize_register', 'forest_customize_register_3d_cube_prd_slider' );