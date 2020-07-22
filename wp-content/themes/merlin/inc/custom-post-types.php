<?php

// Register Custom Post Type: Resources
// Post Type Key: resource
function create_resources_cpt() {

  $labels = array(
    'name' => __( 'Resources', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Resource', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Resources', 'textdomain' ),
    'name_admin_bar' => __( 'Resources', 'textdomain' ),
    'archives' => __( 'Resources Archives', 'textdomain' ),
    'attributes' => __( 'Resources Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Resource:', 'textdomain' ),
    'all_items' => __( 'All Resources', 'textdomain' ),
    'add_new_item' => __( 'Add New Resource', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Resource', 'textdomain' ),
    'edit_item' => __( 'Edit Resource', 'textdomain' ),
    'update_item' => __( 'Update Resource', 'textdomain' ),
    'view_item' => __( 'View Resource', 'textdomain' ),
    'view_items' => __( 'View Resources', 'textdomain' ),
    'search_items' => __( 'Search Resources', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into Resource', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Resource', 'textdomain' ),
    'items_list' => __( 'Resource list', 'textdomain' ),
    'items_list_navigation' => __( 'Resources list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Resource list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'Resource', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => 'dashicons-welcome-view-site',
    'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
    'taxonomies' => array('category'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
  );
  register_post_type( 'resource', $args );

}
add_action( 'init', 'create_resources_cpt', 0 );



// Register Custom Post Type: Testimonials
// Post Type Key: testimonial
function create_testimonials_cpt() {

  $labels = array(
    'name' => __( 'Testimonials', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Testimonial', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Testimonials', 'textdomain' ),
    'name_admin_bar' => __( 'Testimonials', 'textdomain' ),
    'archives' => __( 'Testimonials Archives', 'textdomain' ),
    'attributes' => __( 'Testimonials Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Testimonial:', 'textdomain' ),
    'all_items' => __( 'All Testimonials', 'textdomain' ),
    'add_new_item' => __( 'Add New Testimonial', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Testimonial', 'textdomain' ),
    'edit_item' => __( 'Edit Testimonial', 'textdomain' ),
    'update_item' => __( 'Update Testimonial', 'textdomain' ),
    'view_item' => __( 'View Testimonial', 'textdomain' ),
    'view_items' => __( 'View Testimonials', 'textdomain' ),
    'search_items' => __( 'Search Testimonials', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into Testimonial', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'textdomain' ),
    'items_list' => __( 'Resource list', 'textdomain' ),
    'items_list_navigation' => __( 'Testimonials list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Testimonial list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'Testimonial', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => 'dashicons-format-quote',
    'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
    'taxonomies' => array(''),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'exclude_from_search' => true, // exclude from search results
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
  );
  register_post_type( 'testimonial', $args );

}
add_action( 'init', 'create_testimonials_cpt', 0 );

// Register Custom Taxonomy: "Testimonial Type" - used within the "Testimonial" post type
function create_testimonial_tax() {
	$labels = array(
		'name'                       => _x( 'Testimonial Type', 'Taxonomy General Name', 'textdomain' ),
		'singular_name'              => _x( 'Testimonial Type', 'Taxonomy Singular Name', 'textdomain' ),
		'menu_name'                  => __( 'Testimonial Type', 'textdomain' ),
		'all_items'                  => __( 'All Testimonial Types', 'textdomain' ),
		'parent_item'                => __( 'Parent Type', 'textdomain' ),
		'parent_item_colon'          => __( 'Parent Type:', 'textdomain' ),
		'new_item_name'              => __( 'New Testimonial Type', 'textdomain' ),
		'add_new_item'               => __( 'Add Tetsimonial Type', 'textdomain' ),
		'edit_item'                  => __( 'Edit Types', 'textdomain' ),
		'update_item'                => __( 'Update Types', 'textdomain' ),
		'view_item'                  => __( 'View Types', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate programs with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove programs', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'textdomain' ),
		'popular_items'              => __( 'Popular Testimonial Types', 'textdomain' ),
		'search_items'               => __( 'Search Testimonial Types', 'textdomain' ),
		'not_found'                  => __( 'Testimonial Type Not Found', 'textdomain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'testimonial-type', array( 'testimonial' ), $args );
}
add_action( 'init', 'create_testimonial_tax', 0 );





// Register Custom Post Type: Awards
// Post Type Key: award
function create_awards_cpt() {

  $labels = array(
    'name' => __( 'Awards', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Award', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Awards', 'textdomain' ),
    'name_admin_bar' => __( 'Awards', 'textdomain' ),
    'archives' => __( 'Awards Archives', 'textdomain' ),
    'attributes' => __( 'Awards Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Award:', 'textdomain' ),
    'all_items' => __( 'All Awards', 'textdomain' ),
    'add_new_item' => __( 'Add New Award', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Award', 'textdomain' ),
    'edit_item' => __( 'Edit Award', 'textdomain' ),
    'update_item' => __( 'Update Award', 'textdomain' ),
    'view_item' => __( 'View Award', 'textdomain' ),
    'view_items' => __( 'View Award', 'textdomain' ),
    'search_items' => __( 'Search Awards', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into Award', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Award', 'textdomain' ),
    'items_list' => __( 'Award list', 'textdomain' ),
    'items_list_navigation' => __( 'Awards list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Award list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'Awards', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => 'dashicons-awards',
    'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
    'taxonomies' => array(''),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'exclude_from_search' => true, //exclude from search results
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
  );
  register_post_type( 'award', $args );

}
add_action( 'init', 'create_awards_cpt', 0 );



// Register Custom Post Type: Attorneys
// Post Type Key: attorney
function create_attorneys_cpt() {

  $labels = array(
    'name' => __( 'Attorneys', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Attorney', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Attorneys', 'textdomain' ),
    'name_admin_bar' => __( 'Attorneys', 'textdomain' ),
    'archives' => __( 'Attorneys Archives', 'textdomain' ),
    'attributes' => __( 'Attorneys Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Attorney:', 'textdomain' ),
    'all_items' => __( 'All Attorneys', 'textdomain' ),
    'add_new_item' => __( 'Add New Attorney', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Attorney', 'textdomain' ),
    'edit_item' => __( 'Edit Attorney', 'textdomain' ),
    'update_item' => __( 'Update Attorney', 'textdomain' ),
    'view_item' => __( 'View Attorney', 'textdomain' ),
    'view_items' => __( 'View Attorney', 'textdomain' ),
    'search_items' => __( 'Search Attorneys', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into Attorney', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Attorney', 'textdomain' ),
    'items_list' => __( 'Attorney list', 'textdomain' ),
    'items_list_navigation' => __( 'Attorneys list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Attorney list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'Attorneys', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => 'dashicons-admin-users',
    'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
    'taxonomies' => array(''),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
  );
  register_post_type( 'attorneys', $args );

}
add_action( 'init', 'create_attorneys_cpt', 0 );



// Register Custom Taxonomy: "Attorney State" - used within the "Attorney" post type
function create_attorney_state_tax() {
	$labels = array(
		'name'                       => _x( 'Attorney State', 'Taxonomy General Name', 'textdomain' ),
		'singular_name'              => _x( 'Attorney State', 'Taxonomy Singular Name', 'textdomain' ),
		'menu_name'                  => __( 'Attorney State', 'textdomain' ),
		'all_items'                  => __( 'All Attorney States', 'textdomain' ),
		'parent_item'                => __( 'Parent Type', 'textdomain' ),
		'parent_item_colon'          => __( 'Parent Type:', 'textdomain' ),
		'new_item_name'              => __( 'New Attorney State', 'textdomain' ),
		'add_new_item'               => __( 'Add Attorney State', 'textdomain' ),
		'edit_item'                  => __( 'Edit Attorney States', 'textdomain' ),
		'update_item'                => __( 'Update Attorney States', 'textdomain' ),
		'view_item'                  => __( 'View Attorney States', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate states with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove states', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'textdomain' ),
		'popular_items'              => __( 'Popular Attorney States', 'textdomain' ),
		'search_items'               => __( 'Search Attorney States', 'textdomain' ),
		'not_found'                  => __( 'Attorney State Not Found', 'textdomain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'attorney-state', array( 'attorneys' ), $args );
}
add_action( 'init', 'create_attorney_state_tax', 0 );

// Register Custom Taxonomy: "Attorney Specialty" - used within the "Attorney" post type
function create_attorney_specialty_tax() {
	$labels = array(
		'name'                       => _x( 'Attorney Specialty', 'Taxonomy General Name', 'textdomain' ),
		'singular_name'              => _x( 'Attorney Specialty', 'Taxonomy Singular Name', 'textdomain' ),
		'menu_name'                  => __( 'Attorney Specialty', 'textdomain' ),
		'all_items'                  => __( 'All Attorney Specialties', 'textdomain' ),
		'parent_item'                => __( 'Parent Type', 'textdomain' ),
		'parent_item_colon'          => __( 'Parent Type:', 'textdomain' ),
		'new_item_name'              => __( 'New Attorney Specialty', 'textdomain' ),
		'add_new_item'               => __( 'Add Attorney Specialty', 'textdomain' ),
		'edit_item'                  => __( 'Edit Attorney Specialty', 'textdomain' ),
		'update_item'                => __( 'Update Attorney Specialty', 'textdomain' ),
		'view_item'                  => __( 'View Attorney Specialty', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate specialties with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove specialties', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'textdomain' ),
		'popular_items'              => __( 'Popular Attorney Specialties', 'textdomain' ),
		'search_items'               => __( 'Search Attorney Specialties', 'textdomain' ),
		'not_found'                  => __( 'Attorney Specialty Not Found', 'textdomain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'attorney-specialty', array( 'attorneys' ), $args );
}
add_action( 'init', 'create_attorney_specialty_tax', 0 );



// Register Custom Post Type: Type of Loss
// Post Type Key: loss
function create_type_of_loss_cpt() {

  $labels = array(
    'name' => __( 'Types of Loss', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Type of Loss', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Types of Loss', 'textdomain' ),
    'name_admin_bar' => __( 'Types of Loss', 'textdomain' ),
    'archives' => __( 'Types of Loss Archives', 'textdomain' ),
    'attributes' => __( 'Types of Loss Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Type of Loss:', 'textdomain' ),
    'all_items' => __( 'All Types of Loss', 'textdomain' ),
    'add_new_item' => __( 'Add New Type of Loss', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Type of Loss', 'textdomain' ),
    'edit_item' => __( 'Edit Type of Loss', 'textdomain' ),
    'update_item' => __( 'Update Type of Loss', 'textdomain' ),
    'view_item' => __( 'View Type of Loss', 'textdomain' ),
    'view_items' => __( 'View Types of Loss', 'textdomain' ),
    'search_items' => __( 'Search Types of Loss', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into Type of Loss', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Type of Loss', 'textdomain' ),
    'items_list' => __( 'Types of Loss list', 'textdomain' ),
    'items_list_navigation' => __( 'Types of Loss list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Types of Loss list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'Types of Loss', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => 'dashicons-admin-home',
    'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
    'taxonomies' => array(''),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
  );
  register_post_type( 'loss', $args );

}
add_action( 'init', 'create_type_of_loss_cpt', 0 );



// Register Custom Post Type: Insurance Claims
// Post Type Key: insurance
function create_insurance_cpt() {

  $labels = array(
    'name' => __( 'Insurance Claims', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Insurance Claim', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Insurance Claims', 'textdomain' ),
    'name_admin_bar' => __( 'Insurance Claims', 'textdomain' ),
    'archives' => __( 'Insurance Claims Archives', 'textdomain' ),
    'attributes' => __( 'Insurance Claims Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Insurance Claim:', 'textdomain' ),
    'all_items' => __( 'All Insurance Claims', 'textdomain' ),
    'add_new_item' => __( 'Add New Insurance Claim', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Insurance Claim', 'textdomain' ),
    'edit_item' => __( 'Edit Insurance Claim', 'textdomain' ),
    'update_item' => __( 'Update Insurance Claim', 'textdomain' ),
    'view_item' => __( 'View Insurance Claim', 'textdomain' ),
    'view_items' => __( 'View Insurance Claims', 'textdomain' ),
    'search_items' => __( 'Search Insurance Claims', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into Insurance Claim', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Insurance Claim', 'textdomain' ),
    'items_list' => __( 'Insurance Claims list', 'textdomain' ),
    'items_list_navigation' => __( 'Insurance Claims list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Insurance Claims list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'Insurance Claims', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => 'dashicons-media-spreadsheet',
    'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
    'taxonomies' => array(''),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
  );
  register_post_type( 'insurance', $args );

}
add_action( 'init', 'create_insurance_cpt', 0 );

?>
