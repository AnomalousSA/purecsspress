<?php
/**
 * Default Page Header
 *
 * @package WordPress
 * @subpackage PurecssPress
 * @since Purecsspress 1.0
 *
 * Last Revised: May 01, 2015
 */
global $childDir;
$childDir = dirname(get_bloginfo('stylesheet_url'));
?><!DOCTYPE html>
<!-- Purecsspress -->
<!-- http://www.anomalous.co.za -->
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta itemprop="name" content="<?php bloginfo('name');?>"/>
        <meta itemprop="url" content="<?php echo home_url('/'); ?>"/>
        <link href="http://gmpg.org/xfn/11" rel="profile"/>
        <link href="<?php bloginfo('pingback_url');?>" rel="pingback"/>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(''); ?> >
        <div class="container">
            <div class="pure-g">
                <div class="pure-u-1">
                    <div class="pure-menu pure-menu-horizontal">
                         <a href="<?php echo home_url('/'); ?>" class="pure-menu-heading pure-menu-link"><?php wp_title(); ?></a>
                        <?php
                        wp_nav_menu(array(
                            'menu' => 'main-menu',
                            'theme_location' => 'main-menu',
                            'depth' => 2,
                            'container' => false,
                            //'container_class'   => 'pure-menu pure-menu-horizontal',
                            //'container_id'      => 'bs-example-navbar-collapse-1',
                            'menu_class' => 'pure-menu-list',
                            'fallback_cb' => 'pure_menu_walker::fallback',
                            'walker' => new pure_menu_walker())
                        );
                        ?>
                    </div>    
                </div>
            </div>