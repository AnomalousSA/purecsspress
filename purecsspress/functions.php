<?php
/**
 *
 * @package WordPress
 * @subpackage Monstrosity
 * @since Monstrosity 0.1
 *
 * Last Updated: March 11, 2014
 */
//require_once('includes/monstrosity_options.php');

if ( ! function_exists('purecsspress_theme_features') ) {

// Register Theme Features
function purecsspress_theme_features()  {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat' ) );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );
}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'purecsspress_theme_features' );

}

if ( ! function_exists( 'purecsspress_navigation_menus' ) ) {

// Register Navigation Menus
function purecsspress_navigation_menus() {

	$locations = array(
		'mainmenu' => __( 'Main Menu For the Theme', 'text_domain' ),
		'footermenu' => __( 'Menu in the footer of the website.', 'text_domain' ),
	);
	register_nav_menus( $locations );

}

// Hook into the 'init' action
add_action( 'init', 'purecsspress_navigation_menus' );

}


// Register Style
function purecsspress_styles() {

	wp_register_style( 'purecss', get_template_directory_uri().'/assets/css/bootstrap.min.cs', false, '0.6', 'all' );
	wp_enqueue_style( 'purecss' );

	wp_register_style( 'purecss-responsive', get_template_directory_uri().'/assets/css/font-awesome.cs', array( 'purecss' ), '0.6', 'all' );
	wp_enqueue_style( 'purecss-responsive' );

	wp_register_style( 'fontawesome', get_template_directory_uri().'/assets/css/font-awesome.cs', array( 'purecss', 'purecss-responsive' ), '4.4.3', 'all' );
	wp_enqueue_style( 'fontawesome' );

	wp_register_style( 'mainstyle', get_template_directory_uri().'/assets/css/font-awesome.cs', array( 'purecss', ' purecss-responsive', ' fontawesome' ), false, 'all' );
	wp_enqueue_style( 'mainstyle' );

}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'purecsspress_styles' );

// Register Script
function purecsspress_scripts() {

	wp_register_script( 'mainscript', get_template_directory_uri().'/assets/css/bootstrap.min.css', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'mainscript' );

}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'purecsspress_scripts' );


// Bredcrumbs

function purecsspress_breadcrumbs() {

  $delimiter = '<span class="divider">/</span>';
  $home = 'Home'; // text for the 'Home' link
  $before = '<li class="active">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<ol class="breadcrumb">';

    global $post;
    $homeLink = home_url('/');
    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category( $thisCat );
      $parentCat = get_category( $thisCat->parent );
      if ( $thisCat->parent != 0 ) echo get_category_parents( $parentCat, TRUE, ' ' . $delimiter . ' ' );
      echo $before . 'Archive by category "' . single_cat_title( '', false ) . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time( 'd' ) . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time( 'F' ) . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time( 'Y' ) . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object( get_post_type() );
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
        echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object( get_post_type() );
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post( $post->post_parent );
      $cat = get_the_category( $parent->ID ); $cat = $cat[0];
      echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
      echo '<li><a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ( $parent_id ) {
        $page = get_page( $parent_id );
        $breadcrumbs[] = '<li><a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse( $breadcrumbs );
      foreach ( $breadcrumbs as $crumb ) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title( '', false ) . '"' . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata( $author );
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }

    if ( get_query_var( 'paged' ) ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __( 'Page', 'bootstrapwp' ) . ' ' . get_query_var( 'paged' );
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</ol>';

  }
} 


function purecsspress_widgets_init() {
  register_sidebar( array(
    'name' => __('Page Sidebar', 'purecsspress'),
    'id' => 'sidebar-page',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => __('Posts Sidebar', 'purecsspress'),
    'id' => 'sidebar-posts',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );
}

add_action( 'init', 'purecsspress_widgets_init' );


 ?>