<?php


/*
if ( ! class_exists( 'FLBuilderModel' ) ) {

	return;

}
*/


function tesseract_enqueue_elementor_scripts() {



		wp_enqueue_script( 'tesseract-bb-extensions-elementor', get_template_directory_uri() . '/importer/js/elementor.js', array( 'jquery' ) );

		;



}

add_action( 'wp_enqueue_scripts', 'tesseract_enqueue_elementor_scripts' );

