<?php
// Layout and Design
function forest_customize_register_layouts( $wp_customize ) {
$wp_customize->add_panel( 'forest_design_panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Design & Layout','forest'),
) );

$wp_customize->add_section(
    'forest_design_options',
    array(
        'title'     => __('Blog Layout','forest'),
        'priority'  => 0,
        'panel'     => 'forest_design_panel'
    )
);


$wp_customize->add_setting(
    'forest_blog_layout',
    array( 'sanitize_callback' => 'forest_sanitize_blog_layout' )
);

function forest_sanitize_blog_layout( $input ) {
    if ( in_array($input, array('grid','forest','forest_3_column','smiley','calender') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'forest_blog_layout',array(
        'label' => __('Select Layout','forest'),
        'settings' => 'forest_blog_layout',
        'section'  => 'forest_design_options',
        'type' => 'select',
        'choices' => array(
            'grid' => __('Standard Blog Layout','forest'),
            'forest' => __('Forest Theme Layout','forest'),
            'forest_3_column' => __('Forest Theme Layout (3 Columns)','forest'),
            'smiley'    => __('Smiley Layout ','forest'),
            'calender'    => __('Calender Layout ','forest'),
        )
    )
);

$wp_customize->add_section(
    'forest_sidebar_options',
    array(
        'title'     => __('Sidebar Layout','forest'),
        'priority'  => 0,
        'panel'     => 'forest_design_panel'
    )
);

$wp_customize->add_setting(
    'forest_disable_sidebar',
    array( 'sanitize_callback' => 'forest_sanitize_checkbox' )
);

$wp_customize->add_control(
    'forest_disable_sidebar', array(
        'settings' => 'forest_disable_sidebar',
        'label'    => __( 'Disable Sidebar Everywhere.','forest' ),
        'section'  => 'forest_sidebar_options',
        'type'     => 'checkbox',
        'default'  => false
    )
);

$wp_customize->add_setting(
    'forest_disable_sidebar_home',
    array( 'sanitize_callback' => 'forest_sanitize_checkbox' )
);

$wp_customize->add_control(
    'forest_disable_sidebar_home', array(
        'settings' => 'forest_disable_sidebar_home',
        'label'    => __( 'Disable Sidebar on Home/Blog.','forest' ),
        'section'  => 'forest_sidebar_options',
        'type'     => 'checkbox',
        'active_callback' => 'forest_show_sidebar_options',
        'default'  => false
    )
);

$wp_customize->add_setting(
    'forest_disable_sidebar_front',
    array( 'sanitize_callback' => 'forest_sanitize_checkbox' )
);

$wp_customize->add_control(
    'forest_disable_sidebar_front', array(
        'settings' => 'forest_disable_sidebar_front',
        'label'    => __( 'Disable Sidebar on Front Page.','forest' ),
        'section'  => 'forest_sidebar_options',
        'type'     => 'checkbox',
        'active_callback' => 'forest_show_sidebar_options',
        'default'  => false
    )
);


$wp_customize->add_setting(
    'forest_sidebar_width',
    array(
        'default' => 4,
        'sanitize_callback' => 'forest_sanitize_positive_number' )
);

$wp_customize->add_control(
    'forest_sidebar_width', array(
        'settings' => 'forest_sidebar_width',
        'label'    => __( 'Sidebar Width','forest' ),
        'description' => __('Min: 25%, Default: 33%, Max: 40%','forest'),
        'section'  => 'forest_sidebar_options',
        'type'     => 'range',
        'active_callback' => 'forest_show_sidebar_options',
        'input_attrs' => array(
            'min'   => 3,
            'max'   => 5,
            'step'  => 1,
            'class' => 'sidebar-width-range',
            'style' => 'color: #0a0',
        ),
    )
);

/* Active Callback Function */
function forest_show_sidebar_options($control) {

    $option = $control->manager->get_setting('forest_disable_sidebar');
    return $option->value() == false ;

}

class Forest_Custom_CSS_Control extends WP_Customize_Control {
    public $type = 'textarea';

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}

$wp_customize-> add_section(
    'forest_custom_codes',
    array(
        'title'			=> __('Custom CSS','forest'),
        'description'	=> __('Enter your Custom CSS to Modify design.','forest'),
        'priority'		=> 11,
        'panel'			=> 'forest_design_panel'
    )
);

$wp_customize->add_setting(
    'forest_custom_css',
    array(
        'default'		=> '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'wp_filter_nohtml_kses',
        'sanitize_js_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control(
    new Forest_Custom_CSS_Control(
        $wp_customize,
        'forest_custom_css',
        array(
            'section' => 'forest_custom_codes',
            'settings' => 'forest_custom_css'
        )
    )
);

function forest_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

$wp_customize-> add_section(
    'forest_custom_footer',
    array(
        'title'			=> __('Custom Footer Text','forest'),
        'description'	=> __('Enter your Own Copyright Text.','forest'),
        'priority'		=> 11,
        'panel'			=> 'forest_design_panel'
    )
);

$wp_customize->add_setting(
    'forest_footer_text',
    array(
        'default'		=> '',
        'sanitize_callback'	=> 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'forest_footer_text',
    array(
        'section' => 'forest_custom_footer',
        'settings' => 'forest_footer_text',
        'type' => 'text'
    )
);
}
add_action( 'customize_register', 'forest_customize_register_layouts' );