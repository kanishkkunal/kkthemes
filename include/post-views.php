<?php

require_once 'helpers.php';

function kkthemes_post_view($featured_items = false) {

  	// Posts grid
		beans_add_attribute( 'beans_post', 'class', 'tm-post-grid uk-grid uk-grid-medium' );
		beans_add_attribute( 'beans_post_image', 'class', 'uk-width-medium-1-2');
		beans_wrap_markup( 'beans_post_header', 'kkthemes_post_preview', 'div', array(
		  'class' => 'tm-post-preview uk-width-medium-1-2'
	  ));

  	if(is_featured_item() || $featured_items) {
      //More button
      beans_add_attribute('beans_post_more_link', 'class', 'uk-button uk-button-large uk-margin-top');
  	}
  	else {
      // Post title
    	beans_add_attribute( 'beans_post_title', 'class', 'uk-h2' );
  	}

  	// Post content
  	beans_remove_action( 'beans_post_content' );
  	beans_remove_markup('beans_post_body');
  	add_action('kkthemes_post_preview_append_markup', 'the_content');

    // Auto generate summary of Post content and read more button
    beans_add_smart_action( 'the_content', 'kkthemes_post_content' );

  	// Post meta
  	beans_remove_action( 'beans_post_meta_tags' );
  	beans_remove_action( 'beans_post_meta_categories' );
  	// Post image
  	beans_modify_action( 'beans_post_image', 'beans_post_header_before_markup', 'beans_post_image' );
};

function kkthemes_post_content( $content ) {
    $output = beans_open_markup( 'kkthemes_post_content', 'p' );
    	$output .= beans_output( 'kkthemes_post_content_summary', kkthemes_get_excerpt( $content ) );
   	$output .= beans_close_markup( 'kkthemes_post_content', 'p' );
		$output .= '<p>'.beans_post_more_link().'</p>';
   	return $output;
}
 ?>
