<?php

/**
 *
 * Description: Search Page
 * Description: Default search template to display loop of blog posts
 *
 * @package WordPress
 * @subpackage PurecssPress
 * @since Purecsspress 1.0
 *
 * Last Revised: May 01, 2015
 */
global $childDir;
get_header(); ?>
    <?php if (have_posts() ) ; ?>
            <div class="pure-g">
                <div class="pure-u-3-4">
                    <?php if(function_exists('purecsspress_breadcrumbs')) purecsspress_breadcrumbs(); ?>
                    <h1><?php
                    if ( is_day() ) {
                        printf( __( 'Daily Archives: %s', 'purecsspress' ), '<small>' . get_the_date() . '</small>' );
                    } elseif ( is_month() ) {
                        printf( __( 'Monthly Archives: %s', 'purecsspress' ), '<small>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'purecsspress' ) ) . '</small>' );
                    } elseif ( is_year() ) {
                        printf( __( 'Yearly Archives: %s', 'purecsspress' ), '<small>' . get_the_date( _x( 'Y', 'yearly archives date format', 'purecsspress' ) ) . '</span>' );
                    } elseif ( is_tag() ) {
                        printf( __( 'Tag Archives: %s', 'purecsspress' ), '<small>' . single_tag_title( '', false ) . '</small>' );
                                // Show an optional tag description
                        $tag_description = tag_description();
                        if ( $tag_description )
                            echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
                    } elseif ( is_category() ) {
                        printf( __( 'Category Archives: %s', 'purecsspress' ), '<small>' . single_cat_title( '', false ) . '</small>' );
                        $category_description = category_description();
                        if ( $category_description )
                            echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
                    } else {
                        _e( 'Blog Archives', 'purecsspress' );
                    }
                    ?></h1>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div <?php post_class(); ?>>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><h3><?php the_title();?></h3></a>
                            <?php the_excerpt();?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="pure-u-1-3"><?php get_sidebar('post'); ?></div>
            </div>         
<?php get_footer(); ?>