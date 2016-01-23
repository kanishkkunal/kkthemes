<?php
/* Helpers and utility functions */
require_once 'include/helpers.php';

beans_add_smart_action( 'beans_before_load_document', 'kkthemes_single_setup_document' );
function kkthemes_single_setup_document() {

		beans_remove_action( 'beans_breadcrumb' );
 		//remove featured image
 		beans_remove_action( 'beans_post_image' );
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

// Load beans document
beans_load_document();
