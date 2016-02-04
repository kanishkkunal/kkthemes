<?php

require_once 'include/post-views.php';


beans_add_smart_action( 'beans_before_load_document', 'kkthemes_index_setup_document' );
function kkthemes_index_setup_document() {
	if(is_main_archive()) {
		// Remove breadcrumb if this is main archive (accessible from main menu)
		// Other archives like Tags archive, author archive, month archive etc will continue to have breadcumb
		beans_remove_action('beans_breadcrumb');

		//Add a large Title panel in these archive pages
		beans_add_smart_action('beans_header_after_markup', 'kkthemes_archive_title');
	}
	kkthemes_post_view();

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

// Load beans document
beans_load_document();
