<?php

/* Helpers and utility functions */
require_once 'include/helpers.php';

function is_featured_items_archive() {
	return is_featured_item();
}

function is_main_archive() {
	return is_featured_items_archive() || is_category('blog');
}

// Set the default layout
add_filter( 'beans_default_layout', 'kkthemes_index_default_layout' );

function kkthemes_index_default_layout() {
	if( is_featured_items_archive() ) {
		return 'c';
	}
	else {
		return 'c_sp';
	}
}

beans_add_smart_action( 'beans_before_load_document', 'kkthemes_archive_setup_document' );
function kkthemes_archive_setup_document() {
	if(is_main_archive()) {
		// Remove breadcrumb if this is main archive (accessible from main menu)
		// Other archives like Tags archive, author archive, month archive etc will continue to have breadcumb
		beans_remove_action('beans_breadcrumb');

		//Add a large Title panel in these archive pages
		beans_add_smart_action('beans_header_after_markup', 'kkthemes_archive_title');
	}

	// Posts grid
	beans_add_attribute( 'beans_content', 'class', 'tm-posts-grid uk-grid uk-grid-width-small-1-2 uk-grid-width-medium-1-2' );
	beans_add_attribute( 'beans_content', 'data-uk-grid-margin', '' );
	beans_add_attribute( 'beans_content', 'data-uk-grid-match', "{target:'.uk-panel'}" );
	beans_wrap_inner_markup( 'beans_post', 'kkthemes_post_panel', 'div', array(
	  'class' => 'uk-panel uk-panel-box'
	) );

	// Post article
	beans_remove_attribute( 'beans_post', 'class', 'uk-article' );
	// Post meta
	beans_remove_action( 'beans_post_meta_tags' );
	beans_remove_action( 'beans_post_meta_categories' );
	// Post image
	beans_modify_action( 'beans_post_image', 'beans_post_header_before_markup', 'beans_post_image' );
	// Post title
	beans_add_attribute( 'beans_post_title', 'class', 'uk-margin-small-top uk-h3' );
	// Remove the post content.
	beans_remove_action( 'beans_post_content' );
	// Post more link
	beans_add_attribute( 'beans_post_more_link', 'class', 'uk-button uk-button-primary uk-button-small' );
	// Posts pagination
	beans_modify_action_hook( 'beans_posts_pagination', 'beans_content_after_markup' );
}

function kkthemes_archive_title() {
?>
	<div class="uk-panel uk-panel-box uk-panel-space uk-text-large uk-text-center tm-branded-panel" data-markup-id="kk_themes_page_header">
		<h1 class="uk-article-title" itemprop="headline" data-markup-id="beans_post_title">
			<?php single_cat_title( '' ); ?>
		</h1>
		<p><?php echo category_description(); ?></p>
	</div>
<?php
}

// Resize post image (filter)
beans_add_smart_action( 'beans_edit_post_image_args', 'kkthemes_index_post_image_args' );
function kkthemes_index_post_image_args( $args ) {
	if(is_featured_items_archive()) {
			$args['resize'] = array( 525, 305, true );
	}
	else {
		$args['resize'] = array( 430, 250, true );
	}
	return $args;
}


// Load beans document
beans_load_document();
