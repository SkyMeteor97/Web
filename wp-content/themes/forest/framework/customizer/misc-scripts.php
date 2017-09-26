<?php
//upgrade
function forest_customize_register_misc( $wp_customize ) {
$wp_customize->add_section(
    'forest_sec_upgrade',
    array(
        'title'     => __('Forest Theme - Help & Support','forest'),
        'priority'  => 45,
    )
);

$wp_customize->add_setting(
    'forest_upgrade',
    array( 'sanitize_callback' => 'esc_textarea' )
);

$wp_customize->add_control(
    new Forest_WP_Customize_Upgrade_Control(
        $wp_customize,
        'forest_upgrade',
        array(
            'label' => __('Thank You','forest'),
            'description' => __('Thank You for Choosing Forest Theme by Rohitink.com. Forest is a Powerful Wordpress theme which also supports WooCommerce in the best possible way. It is "as we say" the last theme you would ever need. It has all the basic and advanced features needed to run a gorgeous looking site. For any Help related to this theme, please visit  <a href="https://inkhive.com/contact-us/" target="_blank">Forest Help & Support</a>.','forest'),
            'section' => 'forest_sec_upgrade',
            'settings' => 'forest_upgrade',
        )
    )
);

$wp_customize->add_section(
    'forest_sec_upgrade_pro',
    array(
        'title'     => __('Discover FOREST PRO','forest'),
        'priority'  => 44,
    )
);

$wp_customize->add_setting(
    'forest_upgrade_pro',
    array( 'sanitize_callback' => 'esc_textarea' )
);

$wp_customize->add_control(
    new Forest_WP_Customize_Upgrade_Control(
        $wp_customize,
        'forest_upgrade_pro',
        array(
            'label' => __('Upgrade to Awesomness','forest'),
            'description' => __('I am Proud to Announce the release of Pro Version of Forest after a lot of requests. I have added all the features requested by all our current users.  It has all the features like Unlimited Fonts, Unlimited Colors, Custom skins and Designer, Better Menus, More Header Layouts, Boxed Layout and so much more.  <a href="https://inkhive.com/product/forest-pro/" target="_blank">Buy Forest Pro</a>.','forest'),
            'section' => 'forest_sec_upgrade_pro',
            'settings' => 'forest_upgrade_pro',
        )
    )
);
}
add_action( 'customize_register', 'forest_customize_register_misc' );