<?php

beans_add_smart_action( 'beans_before_load_document', 'kkthemes_news_setup_document' );
function kkthemes_news_setup_document() {

	// Post meta
	beans_remove_action( 'beans_post_meta_tags' );
	beans_remove_action( 'beans_post_meta_categories' );
	// Post image
	beans_remove_action( 'beans_post_image');
	// Post title
	beans_add_attribute( 'beans_post_title', 'class', 'uk-h2' );
	// Remove the post content.
	beans_remove_action( 'beans_post_content' );
	// Post more link
	beans_add_attribute( 'beans_post_more_link', 'class', 'uk-button uk-button-primary uk-button-small' );
	// Posts pagination
	beans_modify_action_hook( 'beans_posts_pagination', 'beans_content_after_markup' );
}

// Load beans document
beans_load_document();
