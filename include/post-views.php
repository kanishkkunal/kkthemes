<?php

require_once 'helpers.php';

function kkthemes_post_view($featured_items = false) {
  	// Posts grid
  	if(is_featured_item() || $featured_items) {
  		beans_remove_attribute('beans_post', 'class', 'uk-panel-box');
  		beans_add_attribute( 'beans_content', 'class', 'tm-posts-grid uk-grid uk-grid-width-small-1-2' );
  		beans_add_attribute( 'beans_content', 'data-uk-grid-margin', '' );
  		beans_add_attribute( 'beans_content', 'data-uk-grid-match', "{target:'.uk-panel'}" );
  		beans_wrap_inner_markup( 'beans_post_body', 'kkthemes_post_panel', 'div', array(
  			'class' => 'uk-panel uk-panel-box'
  		) );

  		beans_remove_attribute('beans_post', 'class', 'uk-article');
  	}
  	else {
  		beans_add_attribute( 'beans_post', 'class', 'tm-post-grid uk-grid uk-grid-medium' );
  		beans_add_attribute( 'beans_post_image', 'class', 'uk-width-medium-1-2');
  		beans_wrap_markup( 'beans_post_header', 'kkthemes_post_preview', 'div', array(
  		  'class' => 'tm-post-preview uk-width-medium-1-2'
  	  ));

      // Post title
    	beans_add_attribute( 'beans_post_title', 'class', 'uk-h2' );
  	}

  	// Post content
  	beans_remove_action( 'beans_post_content' );
  	beans_remove_markup('beans_post_body');
  	add_action('kkthemes_post_preview_append_markup', 'the_content');

  	// Post meta
  	beans_remove_action( 'beans_post_meta_tags' );
  	beans_remove_action( 'beans_post_meta_categories' );
  	// Post image
  	beans_modify_action( 'beans_post_image', 'beans_post_header_before_markup', 'beans_post_image' );
}
 ?>
