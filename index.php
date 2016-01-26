<?php

// Setup Bench
beans_add_smart_action( 'beans_before_load_document', 'kkthemes_index_setup_document' );

function kkthemes_index_setup_document() {
	// Posts grid
  beans_remove_attribute('beans_post', 'class', 'uk-panel-box');
	beans_add_attribute( 'beans_content', 'class', 'tm-posts-grid uk-grid uk-grid-width-small-1-2 uk-grid-width-medium-1-2' );
	beans_add_attribute( 'beans_content', 'data-uk-grid-margin', '' );
	beans_add_attribute( 'beans_content', 'data-uk-grid-match', "{target:'.uk-panel'}" );
	beans_wrap_inner_markup( 'beans_post_body', 'kkthemes_post_panel', 'div', array(
	  'class' => 'uk-panel uk-panel-box'
	) );

	// Post article
	beans_remove_attribute( 'beans_post', 'class', 'uk-article' );

	// Post meta
	beans_remove_action( 'beans_post_meta' );
	beans_remove_action( 'beans_post_meta_tags' );
	beans_remove_action( 'beans_post_meta_categories');

  // Post more link
	beans_add_attribute( 'beans_post_more_link', 'class', 'uk-button uk-button-primary' );

	// Post title
	beans_add_attribute( 'beans_post_title', 'class', 'uk-h2' );

}

/* Helpers and utility functions */
require_once 'include/helpers.php';

// Auto generate summary of Post content and read more button
beans_add_smart_action( 'the_content', 'kkthemes_post_content' );

function kkthemes_post_content( $content ) {

    $output = beans_open_markup( 'kkthemes_post_content', 'p' );

    	$output .= beans_output( 'kkthemes_post_content_summary', kkthemes_get_excerpt( $content ) );

   	$output .= beans_close_markup( 'kkthemes_post_content', 'p' );

		$output .= '<p>'.beans_post_more_link().'</p>';

   	return $output;

}

// Load beans document
beans_load_document();
