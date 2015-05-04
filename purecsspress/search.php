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
    <?php if (have_posts() ) : ; ?>
            <div class="pure-g">
                <div class="pure-u-3-4">
                    <h1><?php printf( __( 'Search Results for: %s', 'purecsspress' ), '<small>' . get_search_query() . '</small>' ); ?></h1>
                    <?php while ( have_posts() ) : the_post(); ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><h3><?php the_title();?></h3></a>
                            <?php the_excerpt();?>
                    <?php endwhile; ?>
                </div>
                <div class="pure-u-1-4"><?php get_sidebar(); ?></div>
            </div>         
<?php else: ?>
            <div class="pure-g">
                <div class="pure-u-3-4">
                      <h1><?php _e( 'No Results Found', 'purecsspress' ); ?></h1>
                      <p><?php _e( 'Perhaps you should try again with a different search term.', 'purecsspress' ); ?></p>
                      <p><a class="btn btn-primary btn-lg" role="button" href="<?php echo home_url( '/' ); ?>">Return to Home</a></p>
                    
                    <div class="pure-g">
                    <div class="pure-u-1-3">
                        <h2><?php _e('Search', 'purecsspress'); ?></h2>
                        <?php get_search_form(); ?>
                    </div>
                    <div class="pure-u-1-3"><?php the_widget('WP_Widget_Recent_Posts'); ?></div>
                    <div class="pure-u-1-3">
                        <h2><?php _e('Categories', 'purecss'); ?></h2>
                        <ul>
                            <?php wp_list_categories(array('orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10)); ?>
                        </ul> 
                    </div>
                </div>
                </div>
                <div class="pure-u-1-4"><?php get_sidebar(); ?></div>
            </div>         
<?php endif ;?>
<?php get_footer(); ?>