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
            <div class="row">
                <div class="col-md-8">
                    <?php if(function_exists('monstrosity_breadcrumbs')) monstrosity_breadcrumbs(); ?>
                    <h1><?php the_title();?></h1>
                    <p class="meta"><?php echo monstrosity_posted_on();?></p>
                    <?php the_content();?>
                    <?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
                    <?php endwhile; // end of the loop. ?>
                    <?php comments_template(); ?>
                </div>              
                <div class="col-md-4"><?php get_sidebar(); ?></div>
            </div>         
        </div> <!-- /container -->
<?php get_footer(); ?>