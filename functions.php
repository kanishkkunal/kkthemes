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

// Set the default layout
add_filter( 'beans_layout', 'kkthemes_default_layout' );
function kkthemes_default_layout() {
	return 'c';
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
	register_nav_menu('footer-menu', __( 'Footer Menu', 'kkthemes'));
}


// Modify beans layout (filter)
beans_add_smart_action( 'beans_layout_grid_settings', 'kkthemes_layout_grid_settings' );

function kkthemes_layout_grid_settings( $layouts ) {

	return array_merge( $layouts, array(
		'grid' => 10,
		'sidebar_primary' => 3,
		'sidebar_secondary' => 3,
		'breakpoint' => 'large'
	) );
}

// Setup document fragements, markups and attributes
add_action( 'wp', 'kkthemes_setup_document' );

function kkthemes_setup_document() {
	beans_remove_action('beans_header_image');
	//remove default header image

	// Move breadcrumb just below header
	beans_modify_action_hook('beans_breadcrumb', 'beans_header_after_markup');
	beans_add_attribute('beans_breadcrumb', 'class', 'uk-container uk-container-center uk-hidden-small');

	// Site Logo
	beans_remove_action( 'beans_site_title_tag' );
	//Add back site title after logo image
	//beans_add_smart_action('beans_logo_image_after_markup', 'kkthemes_site_title');

	if ( is_user_logged_in() ) {
		//Add edit post link when user is logged in
		if( is_singular() )
			beans_add_smart_action('beans_post_header_prepend_markup', 'kkthemes_edit_link');
	}

	//content
	beans_remove_attribute('beans_post', 'class', 'uk-panel-box');

	//comments
	beans_remove_attribute('beans_comments', 'class', 'uk-panel-box');
}


function kkthemes_site_title() {
	echo beans_output( 'beans_site_title_text', get_bloginfo( 'name' ) );
}

function kkthemes_edit_link() {
		edit_post_link( __( 'Edit', 'kkthemes' ), '<div class="uk-align-right"><i class="uk-icon-pencil-square-o"></i> ', '</div>' );
}

// Resize post image (filter)
beans_add_smart_action( 'beans_edit_post_image_args', 'kkthemes_index_post_image_args' );
function kkthemes_index_post_image_args( $args ) {
	$args['resize'] = array( 525, 305, true); //430, 250
	return $args;
}

// Modify the read more text.
add_filter( 'beans_post_more_link_text_output', 'kkthemes_modify_read_more' );
function kkthemes_modify_read_more() {
	if(is_featured_item()) {
   	return __('Learn more', 'kkthemes');
 	}
	else {
		return __('Read more', 'kkthemes');
	}
}

// Modify beans post meta items (filter)
beans_add_smart_action( 'beans_post_meta_items', 'kkthemes_post_meta_items' );

function kkthemes_post_meta_items( $items ) {

	// Remove comments meta
	unset( $items['comments']);
	unset( $items['author']);

	return $items;
}


// Add the footer menu
beans_add_smart_action( 'beans_footer_prepend_markup', 'kkthemes_footer_menu' );
function kkthemes_footer_menu() {
	wp_nav_menu( array( 'theme_location' => 'footer-menu',
											'container' => 'nav',
	 										'container_class' => 'tm-footer-menu uk-navbar uk-margin-bottom',
											'menu_class' => 'uk-navbar-nav uk-text-small'
										));
}

// Overwrite the footer content.
beans_modify_action_callback( 'beans_footer_content', 'beans_child_footer_content' );

function beans_child_footer_content() {
	?>
	<div class="tm-sub-footer uk-text-center uk-text-muted">
		Copyright © <a href="http://kunruchcreations.com/" title="KunRuch Creations" target="_blank">KunRuch Creations</a> - All Rights Reserved
		<br/>
		Built with <a href="http://www.getbeans.io/" title="Beans Framework for WordPress" target="_blank">Beans</a> for <a href="https://wordpress.org" rel="external nofollow" target="_blank">WordPress</a> - Theme by <a href="https://kkthemes.com" title="WordPress Themes by Kanishk">KKThemes</a>
	</div>

	<?php
}


//Customizer fields
//Additional Header & Footer Codes (for Google Analytics)
add_action( 'init', 'kkthemes_customization_fields' );
function kkthemes_customization_fields() {
	$fields = array(
		array(
			'id' => 'kkthemes_head_code',
			'label' => __( 'Additional Head Code', 'kkthemes' ),
			'type' => 'textarea',
			'default' => ''
		)
	);
	beans_register_wp_customize_options( $fields, 'kkthemes_custom_code', array( 'title' => __( 'Custom Code', 'kkthemes' ), 'priority' => 1100 ) );
}
add_action('beans_head_append_markup', 'kkthemes_custom_footer_code');
function kkthemes_custom_footer_code() {
	echo get_theme_mod( 'kkthemes_head_code', '' );
}

/* Customize Jetpack */
require 'include/jetpack-custom.php';
