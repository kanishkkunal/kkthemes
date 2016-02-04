<?php /* Template Name: Home Page Template */

require_once 'include/post-views.php';

//TODO: This needs logic change when more featured items are introduced

// Setup document
beans_add_smart_action( 'beans_before_load_document', 'kkthemes_homepage_setup_document' );
function kkthemes_homepage_setup_document() {
  beans_add_smart_action('beans_header_after_markup', 'kkthemes_site_title_tag');

  beans_add_smart_action('beans_content_after_markup', 'kkthemes_homepage_contents');

  kkthemes_post_view(true);

  //change this to manually output post loop when more post types are there.
  beans_add_filter('beans_loop_query_args[_main]', 'kkthemes_theme_home_query_args');

  //remove pagination
  beans_remove_action('beans_posts_pagination');
}

function kkthemes_theme_home_query_args() {
  $args =  array(
		'post_type' => 'wordpress-themes',
		'posts_per_page' => 4
	);
  return $args;
}

function kkthemes_homepage_contents() {
  echo '<div class="uk-text-center"><a class="uk-button uk-button-primary uk-button-large" href="/wordpress">View All WordPress Themes</a></div>';
}

function kkthemes_site_title_tag() {
	// Stop here if there isn't a description.
	if ( !$description = get_bloginfo( 'description' ) )
		return;

	echo beans_open_markup( 'kkthemes_site_title_tag', 'div', array(
		'class' => 'tm-site-title-tag tm-branded-panel uk-block',
		'itemprop' => 'description'
	) );

		echo beans_output( 'kkthemes_site_title_tag_text', $description );

	echo beans_close_markup( 'kkthemes_site_title_tag', 'div' );
}

// Load beans document
beans_load_document();
?>
