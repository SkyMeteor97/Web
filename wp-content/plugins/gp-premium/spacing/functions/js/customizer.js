function generate_spacing_live_update( name, id, selector, property, negative, divide, media ) {
	settings = typeof settings !== 'undefined' ? settings : 'generate_spacing_settings';
	wp.customize( settings + '[' + id + ']', function( value ) {
		value.bind( function( newval ) {
			negative = typeof negative !== 'undefined' ? negative : false;
			media = typeof media !== 'undefined' ? media : '';
			divide = typeof divide !== 'undefined' ? divide : false;
			
			// Get new value
			newval = ( divide ) ? newval / 2 : newval;
			
			// Check if negative integer
			negative = ( negative ) ? '-' : '';
			
			// Check if media query
			media_query = ( '' !== media ) ? 'media="( ' + media + ' )"' : '';
			
			if ( jQuery( 'style#' + name ).length ) {
				jQuery( 'style#' + name ).html( selector + '{' + property + ':' + negative + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="' + name + '" ' + media_query + '>' + selector + '{' + property + ':' + negative + newval + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#' + name ).not( ':last' ).remove();
				}, 50 );
			}
			
			jQuery('body').trigger('generate_spacing_updated');
		} );
	} );
}

/** 
 * Header padding
 */
generate_spacing_live_update( 'header_top', 'header_top', '.inside-header', 'padding-top' );
generate_spacing_live_update( 'header_right', 'header_right', '.inside-header', 'padding-right' );
generate_spacing_live_update( 'header_bottom', 'header_bottom', '.inside-header', 'padding-bottom' );
generate_spacing_live_update( 'header_left', 'header_left', '.inside-header', 'padding-left' );

/** 
 * Content padding
 */
var content_areas = '.separate-containers .inside-article, \
					.separate-containers .comments-area, \
					.separate-containers .page-header, \
					.separate-containers .paging-navigation, \
					.one-container .site-content';
					
generate_spacing_live_update( 'content_top', 'content_top', content_areas, 'padding-top', false, false, 'min-width:769px' );
generate_spacing_live_update( 'content_right', 'content_right', content_areas, 'padding-right', false, false, 'min-width:769px' );
generate_spacing_live_update( 'content_bottom', 'content_bottom', content_areas, 'padding-bottom', false, false, 'min-width:769px' );
generate_spacing_live_update( 'content_left', 'content_left', content_areas, 'padding-left', false, false, 'min-width:769px' );

/* Mobile content padding */
generate_spacing_live_update( 'mobile_content', 'mobile_content_padding', content_areas, 'padding', false, false, 'max-width:' + gp_spacing.breakpoint );

if ( jQuery( 'body' ).hasClass( 'one-container' ) ) {
	generate_spacing_live_update( 'content-margin-right', 'content_right', '.one-container.right-sidebar .site-main,.one-container.both-right .site-main', 'margin-right' );
	generate_spacing_live_update( 'content-margin-left', 'content_left', '.one-container.left-sidebar .site-main,.one-container.both-left .site-main', 'margin-left' );
	generate_spacing_live_update( 'content-margin-right-both', 'content_right', '.one-container.both-sidebars .site-main', 'margin-right' );
	generate_spacing_live_update( 'content-margin-left-both', 'content_left', '.one-container.both-sidebars .site-main', 'margin-left' );
}

/** 
 * Main navigation spacing
 */
var menu_items = '.main-navigation .main-nav ul li a,\
				.menu-toggle,\
				.main-navigation .mobile-bar-items a';

generate_spacing_live_update( 'menu_item_padding_left', 'menu_item', menu_items, 'padding-left' );
generate_spacing_live_update( 'menu_item_padding_right', 'menu_item', menu_items, 'padding-right' );
generate_spacing_live_update( 'menu_item_height', 'menu_item_height', menu_items, 'line-height' );
generate_spacing_live_update( 'navigation_logo_height', 'menu_item_height', '.main-navigation .sticky-logo img', 'height' );

wp.customize( 'generate_spacing_settings[menu_item_height]', function( value ) {
	value.bind( function( newval ) {
		if ( jQuery( 'style#navigation_logo_height' ).length ) {
			jQuery( 'style#navigation_logo_height' ).html( '.main-navigation .sticky-logo img, .mobile-header-navigation .mobile-header-logo img{height:' + ( newval - 20 ) + 'px;}' );
		} else {
			jQuery( 'head' ).append( '<style id="navigation_logo_height">.main-navigation .sticky-logo img, .mobile-header-navigation .mobile-header-logo img{height:' + ( newval - 20 ) + 'px;}</style>' );
			setTimeout(function() {
				jQuery( 'style#navigation_logo_height' ).not( ':last' ).remove();
			}, 50 );
		}
	} );
} );

/** 
 * Main sub-navigation spacing
 */
generate_spacing_live_update( 'sub_menu_item_height_top', 'sub_menu_item_height', '.main-navigation .main-nav ul ul li a', 'padding-top' );
generate_spacing_live_update( 'sub_menu_item_height_right', 'menu_item', '.main-navigation .main-nav ul ul li a', 'padding-right' );
generate_spacing_live_update( 'sub_menu_item_height_bottom', 'sub_menu_item_height', '.main-navigation .main-nav ul ul li a', 'padding-bottom' );
generate_spacing_live_update( 'sub_menu_item_height_left', 'menu_item', '.main-navigation .main-nav ul ul li a', 'padding-left' );
generate_spacing_live_update( 'sub_menu_item_offset', 'menu_item_height', '.main-navigation ul ul', 'top' );

/** 
 * Main navigation RTL arrow spacing
 */
generate_spacing_live_update( 'dropdown_menu_arrow', 'menu_item', '.menu-item-has-children .dropdown-menu-toggle', 'padding-right' );

/** 
 * Main sub-navigation RTL arrow spacing
 */
generate_spacing_live_update( 'rtl_dropdown_submenu_arrow', 'menu_item', '.rtl .main-navigation .main-nav ul li.menu-item-has-children > a', 'padding-right' );

/** 
 * Main sub-navigation arrow spacing
 */
generate_spacing_live_update( 'dropdown_submenu_arrow_top', 'sub_menu_item_height', '.menu-item-has-children ul .dropdown-menu-toggle', 'padding-top' );
generate_spacing_live_update( 'dropdown_submenu_arrow_bottom', 'sub_menu_item_height', '.menu-item-has-children ul .dropdown-menu-toggle', 'padding-bottom' );
generate_spacing_live_update( 'dropdown_submenu_arrow_margin', 'sub_menu_item_height', '.menu-item-has-children ul .dropdown-menu-toggle', 'margin-top', true );

/** 
 * Navigation search
 */
generate_spacing_live_update( 'navigation_search', 'menu_item_height', '.navigation-search, .navigation-search input', 'height' );

/** 
 * Widget padding
 */
generate_spacing_live_update( 'widget_top', 'widget_top', '.widget-area .widget', 'padding-top' );
generate_spacing_live_update( 'widget_right', 'widget_right', '.widget-area .widget', 'padding-right' );
generate_spacing_live_update( 'widget_bottom', 'widget_bottom', '.widget-area .widget', 'padding-bottom' );
generate_spacing_live_update( 'widget_left', 'widget_left', '.widget-area .widget', 'padding-left' );

/** 
 * Footer widget area
 */
generate_spacing_live_update( 'footer_widget_container_top', 'footer_widget_container_top', '.footer-widgets', 'padding-top' );
generate_spacing_live_update( 'footer_widget_container_right', 'footer_widget_container_right', '.footer-widgets', 'padding-right' );
generate_spacing_live_update( 'footer_widget_container_bottom', 'footer_widget_container_bottom', '.footer-widgets', 'padding-bottom' );
generate_spacing_live_update( 'footer_widget_container_left', 'footer_widget_container_left', '.footer-widgets', 'padding-left' );

/** 
 * Footer
 */
generate_spacing_live_update( 'footer_top', 'footer_top', '.site-info', 'padding-top' );
generate_spacing_live_update( 'footer_right', 'footer_right', '.site-info', 'padding-right' );
generate_spacing_live_update( 'footer_bottom', 'footer_bottom', '.site-info', 'padding-bottom' );
generate_spacing_live_update( 'footer_left', 'footer_left', '.site-info', 'padding-left' );

/** 
 * Separator
 */
 
/* Masonry */
if ( jQuery( 'body' ).hasClass( 'masonry-enabled' ) ) {
	generate_spacing_live_update( 'masonry_separator', 'separator', '.masonry-post .inside-article', 'margin-left' );
	generate_spacing_live_update( 'masonry_separator_bottom', 'separator', '.masonry-container > article', 'margin-bottom' );
	generate_spacing_live_update( 'masonry_separator_container', 'separator', '.masonry-container', 'margin-left', 'negative' );
	generate_spacing_live_update( 'masonry_separator_page_header_left', 'separator', '.masonry-enabled .page-header', 'margin-left' );
	generate_spacing_live_update( 'masonry_separator_page_header_bottom', 'separator', '.masonry-enabled .page-header', 'margin-bottom' );
	generate_spacing_live_update( 'masonry_separator_load_more', 'separator', '.separate-containers .site-main > .masonry-load-more', 'margin-bottom' );
}

/* Columns */
if ( jQuery( 'body' ).hasClass( 'generate-columns-activated' ) ) {
	generate_spacing_live_update( 'columns_bottom', 'separator', '.generate-columns', 'margin-bottom' );
	generate_spacing_live_update( 'columns_left', 'separator', '.generate-columns', 'padding-left' );
	generate_spacing_live_update( 'columns_container', 'separator', '.generate-columns-container', 'padding-left', 'negative' );
	generate_spacing_live_update( 'columns_page_header_bottom', 'separator', '.generate-columns-container .page-header', 'margin-bottom' );
	generate_spacing_live_update( 'columns_page_header_left', 'separator', '.generate-columns-container .page-header', 'margin-left' );
	generate_spacing_live_update( 'columns_pagination', 'separator', '.separate-containers .generate-columns-container > .paging-navigation', 'margin-left' );
}
 
/* Right sidebar */
if ( jQuery( 'body' ).hasClass( 'right-sidebar' ) ) {
	generate_spacing_live_update( 'right_sidebar_sepatator_top', 'separator', '.right-sidebar.separate-containers .site-main', 'margin-top' );
	generate_spacing_live_update( 'right_sidebar_sepatator_right', 'separator', '.right-sidebar.separate-containers .site-main', 'margin-right' );
	generate_spacing_live_update( 'right_sidebar_sepatator_bottom', 'separator', '.right-sidebar.separate-containers .site-main', 'margin-bottom' );
}

/* Left sidebar */
if ( jQuery( 'body' ).hasClass( 'left-sidebar' ) ) {
	generate_spacing_live_update( 'left_sidebar_sepatator_top', 'separator', '.left-sidebar.separate-containers .site-main', 'margin-top' );
	generate_spacing_live_update( 'left_sidebar_sepatator_left', 'separator', '.left-sidebar.separate-containers .site-main', 'margin-left' );
	generate_spacing_live_update( 'left_sidebar_sepatator_bottom', 'separator', '.left-sidebar.separate-containers .site-main', 'margin-bottom' );
}

/* Both sidebars */
if ( jQuery( 'body' ).hasClass( 'both-sidebars' ) ) {
	generate_spacing_live_update( 'both_sidebars_sepatator', 'separator', '.both-sidebars.separate-containers .site-main', 'margin' );
}

/* Both sidebars right */
if ( jQuery( 'body' ).hasClass( 'both-right' ) ) {
	generate_spacing_live_update( 'both_right_sidebar_sepatator_top', 'separator', '.both-right.separate-containers .site-main', 'margin-top' );
	generate_spacing_live_update( 'both_right_sidebar_sepatator_right', 'separator', '.both-right.separate-containers .site-main', 'margin-right' );
	generate_spacing_live_update( 'both_right_sidebar_sepatator_bottom', 'separator', '.both-right.separate-containers .site-main', 'margin-bottom' );
	generate_spacing_live_update( 'both_right_left_sidebar', 'separator', '.both-right.separate-containers .inside-left-sidebar', 'margin-right', false, true );
	generate_spacing_live_update( 'both_right_right_sidebar', 'separator', '.both-right.separate-containers .inside-right-sidebar', 'margin-left', false, true );
}

/* Both sidebars left */
if ( jQuery( 'body' ).hasClass( 'both-left' ) ) {
	generate_spacing_live_update( 'both_left_sidebar_sepatator_top', 'separator', '.both-left.separate-containers .site-main', 'margin-top' );
	generate_spacing_live_update( 'both_left_sidebar_sepatator_right', 'separator', '.both-left.separate-containers .site-main', 'margin-bottom' );
	generate_spacing_live_update( 'both_left_sidebar_sepatator_bottom', 'separator', '.both-left.separate-containers .site-main', 'margin-left' );
	generate_spacing_live_update( 'both_left_left_sidebar', 'separator', '.both-left.separate-containers .inside-left-sidebar', 'margin-right', false, true );
	generate_spacing_live_update( 'both_left_right_sidebar', 'separator', '.both-left.separate-containers .inside-right-sidebar', 'margin-left', false, true );
}

/* Main element margin */
generate_spacing_live_update( 'site_main_separator_top', 'separator', '.separate-containers .site-main', 'margin-top' );
generate_spacing_live_update( 'site_main_separator_bottom', 'separator', '.separate-containers .site-main', 'margin-bottom' );

/* Page header element */
generate_spacing_live_update( 'page_header_separator_top', 'separator', 
	'.separate-containers .page-header-image, \
	.separate-containers .page-header-contained, \
	.separate-containers .page-header-image-single, \
	.separate-containers .page-header-content-single', 'margin-top' );

/* Top and bottom sidebar margin */
generate_spacing_live_update( 'right_sidebar_separator_top', 'separator', '.separate-containers .inside-right-sidebar, .separate-containers .inside-left-sidebar', 'margin-top' );
generate_spacing_live_update( 'right_sidebar_separator_bottom', 'separator', '.separate-containers .inside-right-sidebar, .separate-containers .inside-left-sidebar', 'margin-bottom' );

/* Element separators */
generate_spacing_live_update( 'content_separator', 'separator', 
	'.separate-containers .widget, \
	.separate-containers .site-main > *, \
	.separate-containers .page-header, \
	.widget-area .main-navigation', 'margin-bottom' );

/**
 * Right sidebar width
 */
wp.customize( 'generate_spacing_settings[right_sidebar_width]', function( value ) {
	value.bind( function( newval ) {
		var body = jQuery( 'body' );

		if ( jQuery( '#right-sidebar' ).length ) {
			
			// Left sidebar width
			var left_sidebar = ( jQuery( '#left-sidebar' ).length ) ? wp.customize.value('generate_spacing_settings[left_sidebar_width]')() : 0;
			
			// Right sidebar class
			jQuery( "#right-sidebar" ).removeClass(function (index, css) {
				return (css.match (/(^|\s)grid-\S+/g) || []).join(' ');
			}).removeClass(function (index, css) {
				return (css.match (/(^|\s)tablet-grid-\S+/g) || []).join(' ');
			}).addClass( 'grid-' + newval ).addClass( 'tablet-grid-' + newval ).addClass( 'grid-parent' );
			
			// Content area class
			jQuery( ".content-area" ).removeClass(function (index, css) {
				return (css.match (/(^|\s)grid-\S+/g) || []).join(' ');
			}).removeClass(function (index, css) {
				return (css.match (/(^|\s)tablet-grid-\S+/g) || []).join(' ');
			}).addClass( 'grid-' + ( 100 - newval - left_sidebar ) ).addClass( 'tablet-grid-' + ( 100 - newval - left_sidebar ) ).addClass( 'grid-parent' );
			
			if ( body.hasClass( 'both-sidebars' ) ) {
				var content_width = ( 100 - newval - left_sidebar );
				jQuery( '#left-sidebar' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)push-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-push-\S+/g) || []).join(' ');
				}).addClass( 'pull-' + ( content_width ) ).addClass( 'tablet-pull-' + ( content_width ) );
			}
			
			if ( body.hasClass( 'both-left' ) ) {
				var total_sidebar_width = ( parseInt( left_sidebar ) + parseInt( newval ) );
				
				jQuery( '#right-sidebar' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).addClass( 'pull-' + ( 100 - total_sidebar_width ) ).addClass( 'tablet-pull-' + ( 100 - total_sidebar_width ) );
				
				jQuery( '#left-sidebar' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).addClass( 'pull-' + ( 100 - total_sidebar_width ) ).addClass( 'tablet-pull-' + ( 100 - total_sidebar_width ) );
				
				jQuery( '.content-area' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)push-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-push-\S+/g) || []).join(' ');
				}).addClass( 'push-' + ( total_sidebar_width ) ).addClass( 'tablet-push-' + ( total_sidebar_width ) );
			}
			jQuery('body').trigger('generate_spacing_updated');
		}
	} );
} );

/**
 * Left sidebar width
 */
wp.customize( 'generate_spacing_settings[left_sidebar_width]', function( value ) {
	value.bind( function( newval ) {
		var body = jQuery( 'body' );
		if ( jQuery( '#left-sidebar' ).length ) {
			// Right sidebar width
			var right_sidebar = ( jQuery( '#right-sidebar' ).length ) ? wp.customize.value('generate_spacing_settings[right_sidebar_width]')() : 0;
			
			// Right sidebar class
			jQuery( "#left-sidebar" ).removeClass(function (index, css) {
				return (css.match (/(^|\s)grid-\S+/g) || []).join(' ');
			}).removeClass(function (index, css) {
				return (css.match (/(^|\s)tablet-grid-\S+/g) || []).join(' ');
			}).addClass( 'grid-' + newval ).addClass( 'tablet-grid-' + newval ).addClass( 'grid-parent' );
			
			// Content area class
			jQuery( ".content-area" ).removeClass(function (index, css) {
				return (css.match (/(^|\s)grid-\S+/g) || []).join(' ');
			}).removeClass(function (index, css) {
				return (css.match (/(^|\s)tablet-grid-\S+/g) || []).join(' ');
			}).addClass( 'grid-' + ( 100 - newval - right_sidebar ) ).addClass( 'tablet-grid-' + ( 100 - newval - right_sidebar ) ).addClass( 'grid-parent' );
			
			if ( body.hasClass( 'left-sidebar' ) ) {
				jQuery( '#left-sidebar' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)push-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-push-\S+/g) || []).join(' ');
				}).addClass( 'pull-' + ( 100 - newval ) ).addClass( 'tablet-pull-' + ( 100 - newval ) );
				
				jQuery( '.content-area' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)push-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-push-\S+/g) || []).join(' ');
				}).addClass( 'push-' + newval ).addClass( 'tablet-push-' + newval ).addClass( 'grid-' + ( 100 - newval ) ).addClass( 'tablet-grid-' + ( 100 - newval ) );
			}
			
			if ( body.hasClass( 'both-sidebars' ) ) {
				var content_width = ( 100 - newval - right_sidebar );
				jQuery( '#left-sidebar' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)push-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-push-\S+/g) || []).join(' ');
				}).addClass( 'pull-' + ( content_width ) ).addClass( 'tablet-pull-' + ( content_width ) );
				
				jQuery( '.content-area' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)push-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-push-\S+/g) || []).join(' ');
				}).addClass( 'push-' + ( newval ) ).addClass( 'tablet-push-' + ( newval ) );
			}
			
			if ( body.hasClass( 'both-left' ) ) {
				var content_width = ( 100 - newval - right_sidebar );
				var total_sidebar_width = ( parseInt( right_sidebar ) + parseInt( newval ) );
				
				jQuery( '#right-sidebar' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).addClass( 'pull-' + ( 100 - total_sidebar_width ) ).addClass( 'tablet-pull-' + ( 100 - total_sidebar_width ) );
				
				jQuery( '#left-sidebar' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).addClass( 'pull-' + ( 100 - total_sidebar_width ) ).addClass( 'tablet-pull-' + ( 100 - total_sidebar_width ) );
				
				jQuery( '.content-area' ).removeClass(function (index, css) {
					return (css.match (/(^|\s)pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-pull-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)push-\S+/g) || []).join(' ');
				}).removeClass(function (index, css) {
					return (css.match (/(^|\s)tablet-push-\S+/g) || []).join(' ');
				}).addClass( 'push-' + ( total_sidebar_width ) ).addClass( 'tablet-push-' + ( total_sidebar_width ) );
			}
			jQuery('body').trigger('generate_spacing_updated');
		}
	} );
} );