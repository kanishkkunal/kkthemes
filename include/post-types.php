<?php

//Register custom post types
function kkthemes_create_post_types() {
  kkthemes_create_themes_type();
  kkthemes_create_plugins_type();

  //flush_rewrite_rules();
}

// Register Custom Theme Post Type
function kkthemes_create_themes_type() {

	$labels = array(
		'name'                  => _x( 'WordPress Themes', 'Post Type General Name', 'kkthemes' ),
		'singular_name'         => _x( 'WordPress Theme', 'Post Type Singular Name', 'kkthemes' ),
		'menu_name'             => __( 'WordPress Themes', 'kkthemes' ),
		'name_admin_bar'        => __( 'WordPress Themes', 'kkthemes' ),
		'archives'              => __( 'WordPress Themes', 'kkthemes' ),
		'parent_item_colon'     => __( 'Parent WordPress Theme:', 'kkthemes' ),
		'all_items'             => __( 'All WordPress Themes', 'kkthemes' ),
		'add_new_item'          => __( 'Add New WordPress Theme', 'kkthemes' ),
		'add_new'               => __( 'Add New', 'kkthemes' ),
		'new_item'              => __( 'New WordPress Theme', 'kkthemes' ),
		'edit_item'             => __( 'Edit WordPress Theme', 'kkthemes' ),
		'update_item'           => __( 'Update WordPress Theme', 'kkthemes' ),
		'view_item'             => __( 'View WordPress Theme', 'kkthemes' ),
		'search_items'          => __( 'Search WordPress Themes', 'kkthemes' ),
		'not_found'             => __( 'Not found', 'kkthemes' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'kkthemes' ),
		'featured_image'        => __( 'Featured Image', 'kkthemes' ),
		'set_featured_image'    => __( 'Set featured image', 'kkthemes' ),
		'remove_featured_image' => __( 'Remove featured image', 'kkthemes' ),
		'use_featured_image'    => __( 'Use as featured image', 'kkthemes' ),
		'insert_into_item'      => __( 'Insert into item', 'kkthemes' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'kkthemes' ),
		'items_list'            => __( 'Items list', 'kkthemes' ),
		'items_list_navigation' => __( 'Items list navigation', 'kkthemes' ),
		'filter_items_list'     => __( 'Filter items list', 'kkthemes' ),
	);
	$args = array(
		'label'                 => __( 'WordPress Themes', 'kkthemes' ),
		'description'           => __( 'Download Free, Fast and easily customizable WordPress Themes', 'kkthemes' ),
    'rewrite'               => array( 'slug' => 'wordpress' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'page-attributes' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-welcome-widgets-menus',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);

  register_post_type( 'wordpress-themes', $args );

}


// Register Custom Plugin Post Type
function kkthemes_create_plugins_type() {

	$labels = array(
		'name'                  => _x( 'WordPress Plugins', 'Post Type General Name', 'kkthemes' ),
		'singular_name'         => _x( 'WordPress Plugins', 'Post Type Singular Name', 'kkthemes' ),
		'menu_name'             => __( 'WordPress Plugins', 'kkthemes' ),
		'name_admin_bar'        => __( 'WordPress Plugins', 'kkthemes' ),
		'archives'              => __( 'WordPress Plugins', 'kkthemes' ),
		'parent_item_colon'     => __( 'Parent WordPress Plugins:', 'kkthemes' ),
		'all_items'             => __( 'All WordPress Plugins', 'kkthemes' ),
		'add_new_item'          => __( 'Add New WordPress Plugins', 'kkthemes' ),
		'add_new'               => __( 'Add New', 'kkthemes' ),
		'new_item'              => __( 'New WordPress Plugin', 'kkthemes' ),
		'edit_item'             => __( 'Edit WordPress Plugin', 'kkthemes' ),
		'update_item'           => __( 'Update WordPress Plugin', 'kkthemes' ),
		'view_item'             => __( 'View WordPress Plugin', 'kkthemes' ),
		'search_items'          => __( 'Search WordPress Plugins', 'kkthemes' ),
		'not_found'             => __( 'Not found', 'kkthemes' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'kkthemes' ),
		'featured_image'        => __( 'Featured Image', 'kkthemes' ),
		'set_featured_image'    => __( 'Set featured image', 'kkthemes' ),
		'remove_featured_image' => __( 'Remove featured image', 'kkthemes' ),
		'use_featured_image'    => __( 'Use as featured image', 'kkthemes' ),
		'insert_into_item'      => __( 'Insert into item', 'kkthemes' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'kkthemes' ),
		'items_list'            => __( 'Items list', 'kkthemes' ),
		'items_list_navigation' => __( 'Items list navigation', 'kkthemes' ),
		'filter_items_list'     => __( 'Filter items list', 'kkthemes' ),
	);
	$args = array(
		'label'                 => __( 'WordPress Plugins', 'kkthemes' ),
		'description'           => __( 'Powerful and easy to set-up WordPress Plugins', 'kkthemes' ),
    'rewrite'               => array( 'slug' => 'wordpress-plugins' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'page-attributes' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-layout',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);

  register_post_type( 'wordpress-plugins', $args );

}
