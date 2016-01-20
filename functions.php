<?php

// Include Beans. Do not remove the line below.
require_once( get_template_directory() . '/lib/init.php' );

/* Custom Post types */
require 'include/post-types.php';

/*
 * Add our theme style
 */
add_action( 'beans_uikit_enqueue_scripts', 'beans_child_enqueue_uikit_assets' );

function beans_child_enqueue_uikit_assets() {
	// Enqueue uikit overwrite theme folder
	beans_uikit_enqueue_theme( 'kkthemes', get_stylesheet_directory_uri() . '/assets/less/uikit' );

	beans_compiler_add_fragment( 'uikit', get_stylesheet_directory_uri() . '/assets/less/style.less', 'less' );

}

/*
 * Initialize Theme
 */
beans_add_smart_action( 'init', 'kktheme_init' );

function kktheme_init() {
	//create custom post types
	kkthemes_create_post_types();

	//remove support of comments from page post type.
	remove_post_type_support( 'page', 'comments' );
	add_post_type_support('page', 'excerpt' );
	// Register additional menus, we already have a Primary menu registered
	register_nav_menu('social-menu', __( 'Social Menu', 'kkthemes'));
}


// Setup document fragements, markups and attributes
add_action( 'wp', 'kkthemes_setup_document' );

function kkthemes_setup_document() {

	// Remove Beans breadcrumb
	beans_remove_action('beans_breadcrumb');
	// Remove custom Breadcrumb
	beans_add_smart_action('beans_header_after_markup', 'kktheme_breadcrumb');

	// Frontpage
	if ( is_home() ) {
		beans_add_smart_action('beans_header_after_markup', 'kkthemes_site_title_tag');
	}

	// Site Logo
	beans_remove_action( 'beans_site_title_tag' );
	//Add back site title after logo image
	beans_add_smart_action('beans_logo_image_after_markup', 'kkthemes_site_title');

	if ( is_user_logged_in() ) {
		//Add edit post link when user is logged in
		//if( is_singular() )
			//beans_add_smart_action('beans_post_header_before_markup', 'kkthemes_edit_link');
	}

	//Content
	beans_remove_attribute('beans_post', 'class', 'uk-panel-box');
}


function kkthemes_site_title() {
	echo beans_output( 'beans_site_title_text', get_bloginfo( 'name' ) );
}

function kkthemes_site_title_tag() {
	// Stop here if there isn't a description.
	if ( !$description = get_bloginfo( 'description' ) )
		return;

	echo beans_open_markup( 'kkthemes_site_title_tag', 'div', array(
		'class' => 'tm-site-title-tag uk-block',
		'itemprop' => 'description'
	) );

		echo beans_output( 'kkthemes_site_title_tag_text', $description );

	echo beans_close_markup( 'kkthemes_site_title_tag', 'div' );
}

function kktheme_breadcrumb() {
	if ( function_exists('yoast_breadcrumb') && !is_home() ) {
		yoast_breadcrumb('<div class="uk-container uk-container-center"><p class="uk-margin-top tm-breadcrumbs">','</p></div>');
	}
}

function kkthemes_edit_link() {
		edit_post_link( __( 'Edit', 'kkthemes' ), '<div class="uk-margin-bottom-small uk-text-small uk-align-right"><i class="uk-icon-pencil-square-o"></i> ', '</div>' );
}


/* Customize Jetpack */
require 'include/jetpack-custom.php';
