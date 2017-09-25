<?php
function forest_customize_register_fprd_square_boxes( $wp_customize ) {
if ( class_exists('woocommerce') ) :
    // CREATE THE fcp PANEL
    $wp_customize->add_panel( 'forest_fcp_panel', array(
        'priority'       => 40,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => 'Featured Product Showcase',
        'description'    => '',
    ) );


    //SQUARE BOXES
    $wp_customize->add_section(
        'forest_fc_boxes',
        array(
            'title'     => __('Square Boxes','forest'),
            'priority'  => 10,
            'panel'     => 'forest_fcp_panel'
        )
    );

    $wp_customize->add_setting(
        'forest_box_enable',
        array( 'sanitize_callback' => 'forest_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'forest_box_enable', array(
            'settings' => 'forest_box_enable',
            'label'    => __( 'Enable Square Boxes & Posts Slider.', 'forest' ),
            'section'  => 'forest_fc_boxes',
            'type'     => 'checkbox',
        )
    );


    $wp_customize->add_setting(
        'forest_box_title',
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'forest_box_title', array(
            'settings' => 'forest_box_title',
            'label'    => __( 'Title for the Boxes','forest' ),
            'section'  => 'forest_fc_boxes',
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'forest_box_cat',
        array( 'sanitize_callback' => 'forest_sanitize_product_category' )
    );

    $wp_customize->add_control(
        new Forest_WP_Customize_Product_Category_Control(
            $wp_customize,
            'forest_box_cat',
            array(
                'label'    => __('Product Category.','forest'),
                'settings' => 'forest_box_cat',
                'section'  => 'forest_fc_boxes'
            )
        )
    );
    endif;
}
add_action( 'customize_register', 'forest_customize_register_fprd_square_boxes' );