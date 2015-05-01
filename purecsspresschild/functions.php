<?php
/**
 *
 * @package WordPress
 * @subpackage PurecssPress Child Theme
 * @since Purecsspress 1.0
 *
 * Last Revised: May 01, 2015
 */

function remove_scripts()
{
wp_deregister_script('monstrosity-script' );
wp_deregister_style('monstrosity-style' );
}
add_action( 'wp_enqueue_scripts', 'remove_scripts',100 );

function child_monstrosity_loader() {
wp_enqueue_style( 'child-monstrosity-style', get_stylesheet_directory_uri().'/assets/css/style.css', false , '1.0', 'all' );
wp_enqueue_script( 'child-monstrosity-script', get_stylesheet_directory_uri() .'/assets/js/script.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'child_monstrosity_loader', 200 );


 ?>