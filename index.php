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

	  $tag_style = '';
	  $header_image = get_header_image();
	  if (!empty( $header_image ) )
	    $tag_style = 'background-image: url('.esc_url( $header_image ).');';
?>
	<div class="uk-panel uk-panel-box uk-panel-space uk-text-large uk-text-center tm-branded-panel uk-margin-large-bottom" style="<?php echo $tag_style; ?>">
		<h1 class="uk-article-title" itemprop="headline">
			<?php single_cat_title( '' ) || post_type_archive_title( '' ); ?>
		</h1>
		<?php
			if (is_featured_item()) {
					$post_type = get_post_type();
					echo '<p>'.get_post_type_object($post_type)->description.'</p>';
			}
			else {
				echo category_description();
			}
		?>
	</div>
<?php
}

// Load beans document
beans_load_document();
