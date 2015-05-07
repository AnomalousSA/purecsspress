<?php
/**
 *
 * @package WordPress
 * @subpackage PurecssPress
 * @since Purecsspress 1.0
 *
 * Last Revised: May 01, 2015
 */

if ( ! isset( $content_width ) ) $content_width = 900; 

if ( is_admin() ) {
	require_once( get_template_directory() . '/admin/inc/theme-options.php' );
}
require_once('walker/pure_menu_walker.php');
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
        
        // Add theme support for Custom Background
	$background_args = array(
		'default-color'          => 'ffffff',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $background_args );

	// Add theme support for Custom Header
	$header_args = array(
		'default-image'          => '',
		'width'                  => 0,
		'height'                 => 0,
		'flex-width'             => false,
		'flex-height'            => false,
		'uploads'                => true,
		'random-default'         => false,
		'header-text'            => false,
		'default-text-color'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $header_args );
        
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

	wp_register_style( 'purecss', get_template_directory_uri().'/assets/css/pure-min.css', false, '0.6', 'all' );
	wp_enqueue_style( 'purecss' );

	wp_register_style( 'purecss-responsive', get_template_directory_uri().'/assets/css/grids-responsive-min.css', array( 'purecss' ), '0.6', 'all' );
	wp_enqueue_style( 'purecss-responsive' );

	wp_register_style( 'fontawesome', get_template_directory_uri().'/assets/css/font-awesome.min.css', array( 'purecss', 'purecss-responsive' ), '4.4.3', 'all' );
	wp_enqueue_style( 'fontawesome' );

	wp_register_style( 'puremainstyle', get_template_directory_uri().'/assets/css/style.css', array( 'fontawesome' ), '1.0', 'all' );
	wp_enqueue_style( 'puremainstyle' );

}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'purecsspress_styles' );

// Register Script
function purecsspress_scripts() {

	wp_register_script( 'mainscript', get_template_directory_uri().'/assets/scripts/script.js', array( 'jquery' ), '1', true );
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

if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 160, 120 ); // 160 pixels wide by 120 pixels high
}
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'bootstrap-small', 260, 180 ); // 260 pixels wide by 180 pixels high
  add_image_size( 'bootstrap-medium', 360, 268 ); // 360 pixels wide by 268 pixels high
}

if ( ! function_exists( 'purecsspress_widgets_init' ) ) {

// Register Sidebar
function purecsspress_widgets_init() {

	$page = array(
		'id'            => 'sidebar-page',
		'name'          => __( 'Page Sidebar', 'purecsspress' ),
		'description'   => __( 'Sidebar that appears on pages with sidebars.', 'purecsspress' ),
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $page );
        
        $posts = array(
		'id'            => 'sidebar-posts',
		'name'          => __( 'Post Sidebar', 'purecsspress' ),
		'description'   => __( 'Sidebar that appears on posts.', 'purecsspress' ),
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $posts );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'purecsspress_widgets_init' );

}

if ( ! function_exists( 'purecsspress_comment' ) ) :

function purecsspress_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'purecsspress' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'purecsspress' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'purecsspress' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'purecsspress' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'purecsspress' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'purecsspress' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for bootstrapwp_comment()

if ( ! function_exists( 'purecsspress_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 */
function purecsspress_content_nav( $nav_id ) {
	global $wp_query;
	?>

	<?php if ( is_single() ) : // navigation links for single posts ?>
<ul class="pager">
		<?php previous_post_link( '<li class="previous">%link</li>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'purecsspress' ) . '</span> %title' ); ?>
		<?php next_post_link( '<li class="next">%link</li>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'purecsspress' ) . '</span>' ); ?>
</ul>
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
<ul class="pager">
		<?php if ( get_next_posts_link() ) : ?>
		<li class="next"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'purecsspress' ) ); ?></li>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<li class="previous"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'purecsspress' ) ); ?></li>
		<?php endif; ?>
</ul>
	<?php endif; ?>

	<?php
}
endif; // bootstrapwp_content_nav

if ( ! function_exists( 'purecsspress_posted_on' ) ) :
  
  function purecsspress_posted_on() {
    printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'bootstrap' ),
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', 'purecsspress' ), get_the_author() ) ),
      esc_html( get_the_author() )
    );
  }
endif;



function purecsspress_enqueue_comment_reply() {
    // on single blog post pages with comments open and threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script( 'comment-reply' ); 
    }
}
// Hook into wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'purecsspress_enqueue_comment_reply' );

 ?>