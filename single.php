<?php
/* Helpers and utility functions */
require_once 'include/helpers.php';

beans_add_smart_action( 'beans_before_load_document', 'kkthemes_single_setup_document' );
function kkthemes_single_setup_document() {

		beans_remove_action( 'beans_breadcrumb' );
 		//remove featured image
 		beans_remove_action( 'beans_post_image' );
}

// Load beans document
beans_load_document();
