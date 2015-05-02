<?php

/**
 *
 * Description: Default Index template to display loop of blog posts
 *
 * @package WordPress
 * @subpackage PurecssPress
 * @since Purecsspress 1.0
 *
 * Last Revised: May 01, 2015
 */

get_header(); ?>
		<?php while ( have_posts() ) : the_post(); ?>
        <div class="container">
            <div class="pure-g">
                <div class="pure-u-3-4">
                    <?php if(function_exists('purecsspress_breadcrumbs')) purecsspress_breadcrumbs(); ?>
                    <h1><?php the_title();?></h1>
                   
                    <?php the_content();?>
                    <?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
                    <?php endwhile; // end of the loop. ?>
                    <?php comments_template(); ?>
                </div>              
                <div class="pure-u-1-4"><?php get_sidebar(); ?></div>
            </div>         
        </div> <!-- /container -->
<?php get_footer(); ?>