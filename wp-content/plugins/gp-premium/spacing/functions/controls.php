<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Generate_Spacing_Customize_Control' ) ) :
class Generate_Spacing_Customize_Control extends WP_Customize_Control {
	public $type = 'spacing';
	public $description = '';
	public $secondary_description = '';
	
	public function enqueue() {
		wp_enqueue_script( 'gp-spacing-customizer', plugin_dir_url( __FILE__ )  . '/js/spacing-customizer.js', array( 'customize-controls' ), GENERATE_SPACING_VERSION, true );
	}
	
	public function to_json() {
		parent::to_json();
		$this->json[ 'link' ] = $this->get_link();
		$this->json[ 'value' ] = absint( $this->value() );
		$this->json[ 'description' ] = esc_html( $this->description );
		$this->json[ 'secondary_description' ] = esc_html( $this->secondary_description );
	}
	
	public function content_template() {
		?>
		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			
			<# if ( data.description ) { #>
				<span class="description">{{ data.description }}</span>
			<# } #>
			
			<input class="generate-number-control" type="number" style="text-align: center;" {{{ data.link }}} value="{{{ data.value }}}" />
		
			<# if ( data.secondary_description ) { #>
				<span class="description" style="text-align:left;display:block;">{{{ data.secondary_description }}}</span>
			<# } #>
		</label>
		<?php
	}
}
endif;

if ( !class_exists('Generate_Customize_Spacing_Slider_Control') ) :
/**
 *	Create our container width slider control
 */
class Generate_Customize_Spacing_Slider_Control extends WP_Customize_Control
{
	// Setup control type
	public $type = 'gp-spacing-slider';
	public $id = '';
	public $default_value = '';
	public $unit = '';
	
	public function to_json() {
		parent::to_json();
		$this->json[ 'link' ] = $this->get_link();
		$this->json[ 'value' ] = $this->value();
		$this->json[ 'id' ] = $this->id;
		$this->json[ 'default_value' ] = $this->default_value;
		$this->json[ 'reset_title' ] = esc_attr__( 'Reset','generate-spacing' );
		$this->json[ 'unit' ] = $this->unit;
	}
	
	public function content_template() {
		?>
		<label>
			<p class="description">
				<span class="spacing-size-label">
					{{ data.label }}
				</span> 
				<span class="value">
					<input <# if ( '' == data.unit ) { #>style="display:none;"<# } #> name="{{ data.id }}" type="number" {{{ data.link }}} value="{{{ data.value }}}" class="slider-input" /><span <# if ( '' == data.unit ) { #>style="display:none;"<# } #> class="px">{{ data.unit }}</span>
				</span>
			</p>
		</label>
		<div class="slider gp-flat-slider <# if ( '' !== data.default_value ) { #>show-reset<# } #>"></div>
		<# if ( '' !== data.default_value ) { #><span style="cursor:pointer;" title="{{ data.reset_title }}" class="gp-slider-default-value" data-default-value="{{ data.default_value }}"><span class="gp-customizer-icon-undo" aria-hidden="true"></span><span class="screen-reader-text">{{ data.reset_title }}</span></span><# } #>
		<?php
	}
	
	// Function to enqueue the right jquery scripts and styles
	public function enqueue() {
		
		wp_enqueue_script( 'gp-spacing-customizer', trailingslashit( plugin_dir_url( __FILE__ ) )  . 'js/spacing-customizer.js', array( 'customize-controls' ), GENERATE_SPACING_VERSION, true );
		wp_enqueue_style( 'gp-spacing-customizer-controls-css', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/customizer.css', array(), GENERATE_SPACING_VERSION );
		
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-slider' );
		
		wp_enqueue_script( 'generate-spacing-slider-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/spacing-slider.js', array( 'jquery-ui-slider' ), GENERATE_SPACING_VERSION );
		
		wp_enqueue_style('generate-ui-slider', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/jquery-ui.structure.css');
		wp_enqueue_style('generate-flat-slider', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/range-slider.css');
		
	}
}
endif;
	
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Generate_Spacing_Customize_Misc_Control' ) ) :
class Generate_Spacing_Customize_Misc_Control extends WP_Customize_Control {
    public $settings = 'generate_spacing_headings';
    public $description = '';
	public $areas = '';
 
 
    public function render_content() {
        switch ( $this->type ) {
            default:
            case 'text' :
                echo '<label><span class="customize-control-title">' . $this->description . '</span></label>';
                break;
 
            case 'spacing-heading':
                if ( ! empty( $this->label ) ) echo '<span class="customize-control-title spacing-title">' . esc_html( $this->label ) . '</span>';
				if ( ! empty( $this->description ) ) echo '<span class="spacing-title-description">' . esc_html( $this->description ) . '</span>';
				if ( ! empty( $this->areas ) ) :
					echo '<div style="clear:both;display:block;"></div>';
					foreach ( $this->areas as $value => $label ) :
						echo '<span class="spacing-area">' . esc_html( $label ) . '</span>';
					endforeach;
				endif;
                break;
 
            case 'line' :
                echo '<hr />';
                break;
        }
    }
}
endif;