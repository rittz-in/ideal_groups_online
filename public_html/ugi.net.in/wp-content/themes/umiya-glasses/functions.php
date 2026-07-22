<?php
	add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_enqueue_styles');
	function twenty_twenty_one_enqueue_styles() {
	  	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	}

// DISABLE GUTENBERG EDITOR
add_filter('use_block_editor_for_post', '__return_false', 10);

if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'Theme Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
  
  acf_add_options_sub_page(array(
    'page_title'  => 'Theme Header Settings',
    'menu_title'  => 'Header',
    'parent_slug' => 'theme-general-settings',
  ));
  
  acf_add_options_sub_page(array(
    'page_title'  => 'Theme Footer Settings',
    'menu_title'  => 'Footer',
    'parent_slug' => 'theme-general-settings',
  ));
  
}

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
  if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
      // File does not exist... return an error.
      return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
  } else {
      // File exists... require it.
      require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
  }
}
add_action( 'after_setup_theme', 'register_navwalker' );

// Theme Support
function wpb_theme_setup(){
    // Nav Menus
    register_nav_menus(array(
      'primary' => __('Primary Menu', 'ttwentytwenty-child')
    ));
}

 add_action('after_setup_theme','wpb_theme_setup'); 

 // Pagination Starts here

function pp_pagination_nav() {

  if( is_singular() )
  return;

  global $wp_query;

  /** Stops execution if there's only 1 page */
  if( $wp_query->max_num_pages <= 1 )
  return;

  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max = intval( $wp_query->max_num_pages );

  /** Adds current page to the array */
  if ( $paged >= 1 )
  $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
  $links[] = $paged - 1;
  $links[] = $paged - 2;
  }

  if ( ( $paged + 2 ) <= $max ) {
  $links[] = $paged + 2;
  $links[] = $paged + 1;
  }

  echo '<div class=""><ul class="pagination">' . "\n";

  /** Previous Post Link Function */
  if ( get_previous_posts_link() )
  printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

  /** Links to the first page, plus ellipses if necessary */
  if ( ! in_array( 1, $links ) ) {
  $class = 1 == $paged ? ' class="active"' : '';

  printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

  if ( ! in_array( 2, $links ) )
  echo '<li>…</li>';
  }

  /** Links to current page, plus 2 pages in either direction if necessary */
  sort( $links );
  foreach ( (array) $links as $link ) {
  $class = $paged == $link ? ' class="active"' : '';
  printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }

  /** Links to last page, plus ellipses if necessary */
  if ( ! in_array( $max, $links ) ) {
  if ( ! in_array( $max - 1, $links ) )
  echo '<li>…</li>' . "\n";

  $class = $paged == $max ? ' class="active"' : '';
  printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }

  /** Next Post Link function */
  if ( get_next_posts_link() )
  printf( '<li>%s</li>' . "\n", get_next_posts_link() );

  echo '</ul></div>' . "\n";
}

// older post class added
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
  return 'class="btn btn-default"';
}