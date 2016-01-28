<?php

/* Helpers and utility functions */
require_once 'include/helpers.php';

function is_featured_items_archive() {
	return is_featured_item();
}

function is_main_archive() {
	return is_featured_items_archive() || is_category('blog');
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
	if(is_featured_items_archive()) {
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
	// Post title
	if(!is_featured_items_archive()) {
		beans_add_attribute( 'beans_post_title', 'class', 'uk-h2' );
	}
	// Posts pagination
	beans_modify_action_hook( 'beans_posts_pagination', 'beans_content_after_markup' );
}

function kkthemes_archive_title() {
?>
	<div class="uk-panel uk-panel-box uk-panel-space uk-text-large uk-text-center tm-branded-panel" data-markup-id="kk_themes_page_header">
		<h1 class="uk-article-title" itemprop="headline" data-markup-id="beans_post_title">
			<?php single_cat_title( '' ) || post_type_archive_title( '' ); ?>
		</h1>
		<p>
		<?php
			if (is_featured_item()) {
					$post_type = get_post_type();
					echo get_post_type_object($post_type)->description;
			}
			else {
				echo category_description();
			}
		?>
		</p>
	</div>
<?php
}


// Auto generate summary of Post content and read more button
beans_add_smart_action( 'the_content', 'kkthemes_post_content' );
function kkthemes_post_content( $content ) {
    $output = beans_open_markup( 'kkthemes_post_content', 'p' );
    	$output .= beans_output( 'kkthemes_post_content_summary', kkthemes_get_excerpt( $content ) );
   	$output .= beans_close_markup( 'kkthemes_post_content', 'p' );
		$output .= '<p>'.beans_post_more_link().'</p>';
   	return $output;
}

// Resize post image (filter)
beans_add_smart_action( 'beans_edit_post_image_args', 'kkthemes_index_post_image_args' );
function kkthemes_index_post_image_args( $args ) {
	$args['resize'] = array( 525, 305, true); //430, 250
	return $args;
}


// Load beans document
beans_load_document();
