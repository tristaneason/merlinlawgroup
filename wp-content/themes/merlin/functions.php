<?php

if ( ! function_exists( 'sparxoo_dev_setup' ) ) :

function sparxoo_dev_setup() {

	load_theme_textdomain( 'sparxoo-dev', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// Nav Theme Locations
	register_nav_menus( array(
	    'top-header-menu' => __( 'Top Header Menu', 'sparxoo-dev' ),
	    'header-menu' => __( 'Header Menu', 'sparxoo-dev' ),
	    'mobile-menu' => __( 'Mobile Menu', 'sparxoo-dev' ),
	    'footer-menu' => __( 'Footer Menu', 'sparxoo-dev' )
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sparxoo_dev_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'sparxoo_dev_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sparxoo_dev_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sparxoo_dev_content_width', 640 );
}
add_action( 'after_setup_theme', 'sparxoo_dev_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sparxoo_dev_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sparxoo-dev' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sparxoo-dev' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sparxoo_dev_widgets_init' );


// Enqueue scripts and styles.
function sparxoo_dev_scripts() {
	wp_enqueue_style( 'bundle-css', get_stylesheet_uri(), array(), '1' );
  //wp_enqueue_style( 'bundle-css', get_template_directory_uri() . '/public/css/style.css' );

  // Load jQuery via CDN
	wp_enqueue_script( 'jq','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '1', true );
  // Load build file rendered by Webpack.config.js
	wp_enqueue_script( 'bundle-js', get_template_directory_uri() . '/public/js/bundle.js', array(), '1', true );
  // Load comments script when single & enabled
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
  // Declare JS global variables for ajax; returns admin-ajax URL file
  // Usage:  ajaxreq.ajaxurl
  wp_localize_script( 'bundle-js', 'ajaxreq', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
  ));

}
add_action( 'wp_enqueue_scripts', 'sparxoo_dev_scripts' );


// ACF - Add Options page-header
// Usage within template file: the_field('header_title', 'option');
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}


// Custom excerpt length
function themify_custom_excerpt_length( $length ) {
   return 30;
}
add_filter( 'excerpt_length', 'themify_custom_excerpt_length', 999 );

// Custom Excerpt More Link (...)
add_action( 'after_setup_theme', 'custom_excerpt_more' );
function custom_excerpt_more() {
   // add more link to excerpt
   function theme_custom_excerpt_more($more) {
      global $post;
      return '<a class="more-link" href="'. get_permalink($post->ID) . '">'. __('...', 'sparxoo_dev') .'</a>';
   }
   add_filter('excerpt_more', 'theme_custom_excerpt_more');
}



// Load Attorneys Hook
add_action( 'wp_ajax_query_attorneys', 'load_attorneys' );
add_action( 'wp_ajax_nopriv_query_attorneys', 'load_attorneys' );

// Load Attorneys Function
function load_attorneys() {
  $args = array(
    'post_type' => 'attorney',
    'posts_per_page' => -1,
  );
  query_attorneys();
  wp_die();
};

// Query Attorneys - retrieve POST data via ajax call & query attorney posts
function query_attorneys() {
  $filter_data = $_POST['filter_data'];
  $state = $filter_data['state'];
  $specialty = $filter_data['specialty'];

  if(count($state) == 0 || count($specialty) == 0) {
    $relation = 'OR';
  } else {
    $relation = 'AND';
  }

    $args = array(
     'post_type'=>'attorneys',
     'posts_per_page' => -1,
     'tax_query' => array(
     'relation' => $relation,
        array(
          'taxonomy' => 'attorney-state',
          'field' => 'slug',
          'terms' => $state,
          'operator' => 'IN'
        ),
        array(
          'taxonomy' => 'attorney-specialty',
          'field' => 'slug',
          'terms' => $specialty,
          'operator' => 'IN'
        ),
    )
  );

  $query = new WP_Query($args); ?>
  <?php if ( $query->have_posts() ) : ?>
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="col-xs-12 col-sm-6 attorney-item-wrap">
      <div class="attorney-item">
        <a href="<?php the_permalink(); ?>">

            <div class="col-xs-12 col-md-4 img bg-img-cover has-overlay" style="background-image:url('<?php echo get_the_post_thumbnail_url( $post_id ); ?>')">
            </div><!--/.col-->
            <div class="col-xs-12 col-md-8">
              <div class="padded">
                <h6 class="title"><strong><?php the_title(); ?></strong></h6>
                <p>States Licensed In:</p>
                <?php $terms = get_the_terms( $post->ID , 'attorney-state' ); ?>
                <?php foreach($terms as $term) { ?>
                  <li><?php echo $term->name; ?></li>
                <?php } ?>
              </div>
            </div><!--/.col-->
            <div class="read-more-wrap">
              <a class="underline-from-left primary read-more" href="<?php the_permalink(); ?>">Read More</a>
            </div><!--/.read-more-wrap-->

        </a>
      </div><!--/.attorney-item-->
    </div><!--/.attorney-item-wrap-->
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
  <?php else : ?>
    <div class="col-xs-12">
    <h5 class="text-center">No attorneys match your criteria. Please adjust the filters and try again.</h5>
    </div>
  <?php
  endif;
  }

function load_all_attorneys() {
  $terms = $_POST['terms'];
  $args = array(
    'post_type' => 'attorneys',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
  );

  $query = new WP_Query( $args );
  ?>
  <?php if ( $query->have_posts() ) : ?>
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="col-xs-12 col-sm-6 attorney-item-wrap">
      <div class="attorney-item">
        <a href="<?php the_permalink(); ?>">

            <div class="col-xs-12 col-md-4 img bg-img-cover has-overlay" style="background-image:url('<?php echo get_the_post_thumbnail_url( $post_id ); ?>')">
            </div><!--/.col-->
            <div class="col-xs-12 col-md-8">
              <div class="padded">
                <h6 class="title"><strong><?php the_title(); ?></strong></h6>
                <p>States Licensed In:</p>
                <?php $terms = get_the_terms( $post->ID , 'attorney-state' ); ?>
                <?php foreach($terms as $term) { ?>
                  <li><?php echo $term->name; ?></li>
                <?php } ?>
              </div>
            </div><!--/.col-->
            <div class="read-more-wrap">
              <a class="underline-from-left primary read-more" href="<?php the_permalink(); ?>">Read More</a>
            </div><!--/.read-more-wrap-->

        </a>
      </div><!--/.attorney-item-->
    </div><!--/.attorney-item-wrap-->
  <?php endwhile; endif;
}


// Various template required files
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/breadcrumbs.php';

// Removes default WP junk from header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3 );
// Removes prev and next article links
add_filter( 'index_rel_link', '__return_false' );
add_filter( 'parent_post_rel_link', '__return_false' );
add_filter( 'start_post_rel_link', '__return_false' );
add_filter( 'previous_post_rel_link', '__return_false' );
add_filter( 'next_post_rel_link', '__return_false' );
