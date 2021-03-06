jQuery(window).load(function(){
	jQuery( '.slider-input' ).change(function () {
		var value = this.value;
		jQuery( this ).closest( 'label' ).next( 'div.slider' ).slider( 'value', parseFloat(value));
	});
	
	jQuery( '.gp-slider-default-value' ).on( 'click', function(e) {
		e.preventDefault();
		var default_value = jQuery( this ).data( 'default-value' );
		jQuery( this ).prevAll( 'label' ).find( 'input' ).attr( 'value', default_value ).trigger( 'change' );
		return false;
	});
	
	function generate_range_slider( name, min, max, step ) {
		setTimeout(function() {
			jQuery('input[name="' + name + '"]').closest( 'label' ).next('div.slider').slider({
				value: jQuery('input[name="' + name + '"]').val(),
				min: min,
				max: max,
				step: step,
				slide: function( event, ui ) {
					jQuery('input[name="' + name + '"]').val( ui.value ).change();
					jQuery('#customize-control-' + name + ' .value input').val( ui.value );
				}
			});
		});
	}
	
	generate_range_slider( 'generate_settings[body_font_size]', 6, 25, 1 );
	generate_range_slider( 'generate_settings[body_line_height]', 1, 5, .1 );
	generate_range_slider( 'generate_settings[paragraph_margin]', 0, 5, .1 );
	generate_range_slider( 'generate_settings[site_title_font_size]', 10, 200, 1 );
	generate_range_slider( 'generate_settings[site_tagline_font_size]', 6, 50, 1 );
	generate_range_slider( 'generate_settings[navigation_font_size]', 6, 30, 1 );
	generate_range_slider( 'generate_secondary_nav_settings[secondary_navigation_font_size]', 6, 30, 1 );
	generate_range_slider( 'generate_settings[widget_title_font_size]', 6, 30, 1 );
	generate_range_slider( 'generate_settings[widget_content_font_size]', 6, 30, 1 );
	generate_range_slider( 'generate_settings[heading_1_font_size]', 15, 100, 1 );
	generate_range_slider( 'generate_settings[heading_2_font_size]', 10, 80, 1 );
	generate_range_slider( 'generate_settings[heading_3_font_size]', 10, 80, 1 );
	generate_range_slider( 'generate_settings[heading_4_font_size]', 10, 80, 1 );
	generate_range_slider( 'generate_settings[footer_font_size]', 6, 30, 1 );
	generate_range_slider( 'generate_settings[mobile_site_title_font_size]', 10, 200, 1 );
	generate_range_slider( 'generate_settings[mobile_heading_1_font_size]', 15, 100, 1 );
	generate_range_slider( 'generate_settings[mobile_heading_2_font_size]', 10, 80, 1 );
});