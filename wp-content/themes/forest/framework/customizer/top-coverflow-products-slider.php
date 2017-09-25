<?php
//COVERFLOW
function forest_customize_register_top_coverflow_prd_slider( $wp_customize ) {
    if ( class_exists('woocommerce') ) :
$wp_customize->add_section(
    'forest_fc_coverflow',
    array(
        'title'     => __('Top CoverFlow Slider','forest'),
        'priority'  => 5,
        'panel'     => 'forest_fcp_panel'
    )
);

$wp_customize->add_setting(
    'forest_coverflow_enable',
    array( 'sanitize_callback' => 'forest_sanitize_checkbox' )
);

$wp_customize->add_control(
    'forest_coverflow_enable', array(
        'settings' => 'forest_coverflow_enable',
        'label'    => __( 'Enable', 'forest' ),
        'section'  => 'forest_fc_coverflow',
        'type'     => 'checkbox',
    )
);
        $wp_customize->add_setting(
            'forest_b_coverflow_title',
            array('sanitize_callback' => 'sanitize_text_field')
        );

        $wp_customize->add_control(
            'forest_b_coverflow_title', array(
                'settings' => 'forest_b_coverflow_title',
                'label' => __('Title for the Coverflow', 'forest'),
                'section' => 'forest_fc_coverflow',
                'type' => 'text',
            )
        );

$wp_customize->add_setting(
    'forest_coverflow_cat',
    array( 'sanitize_callback' => 'forest_sanitize_product_category' )
);


$wp_customize->add_control(
    new Forest_WP_Customize_Product_Category_Control(
        $wp_customize,
        'forest_coverflow_cat',
        array(
            'label'    => __('Category For Image Grid','forest'),
            'settings' => 'forest_coverflow_cat',
            'section'  => 'forest_fc_coverflow'
        )
    )
);

$wp_customize->add_setting(
    'forest_coverflow_pc',
    array( 'sanitize_callback' => 'forest_sanitize_positive_number' )
);

$wp_customize->add_control(
    'forest_coverflow_pc', array(
        'settings' => 'forest_coverflow_pc',
        'label'    => __( 'Max No. of Posts in the Grid. Min: 5.', 'forest' ),
        'section'  => 'forest_fc_coverflow',
        'type'     => 'number',
        'default'  => '0'
    )
);



endif; //end class exists woocommerce
}
add_action( 'customize_register', 'forest_customize_register_top_coverflow_prd_slider' );