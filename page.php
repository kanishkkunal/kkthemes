<?php


// Set the default layout
add_filter( 'beans_layout', 'kkthemes_page_default_layout' );
function kkthemes_page_default_layout() {
	return 'c';
}

// Setup document
beans_add_smart_action( 'beans_before_load_document', 'kkthemes_page_setup_document' );

function kkthemes_page_setup_document() {
	//Remove breadcrumb
	beans_remove_action('beans_breadcrumb');

  //Remove padding from main wrapper
  beans_remove_attribute('beans_main', 'class', 'uk-block');
	beans_remove_attribute('beans_post', 'class', 'uk-panel-box');

	//Remove container so we can have full width Page title
  beans_remove_attribute('beans_fixed_wrap[_main]', 'class', 'uk-container');
  beans_remove_attribute('beans_fixed_wrap[_main]', 'class', '-center');

	//Add styling to Page header
	beans_wrap_inner_markup( 'beans_post_header', 'kk_themes_page_header', 'div', array(
	  'class' => 'uk-panel uk-panel-box uk-panel-space uk-text-large uk-text-center uk-margin-large-bottom tm-branded-panel'
	) );

	// Display any Post excerpts below Page title.
	beans_add_smart_action('beans_post_header_append_markup', the_excerpt);

  //Center page content and add a large bottom margin since we removed uk-block earlier from beans_main
	beans_add_attribute('beans_post_content', 'class', 'uk-container uk-container-center tm-maxwidth-content uk-margin-large-bottom');
}

// Load beans document
beans_load_document();
