<?php
/**
 *
 * @package WordPress
 * @subpackage PurecssPress Child Theme
 * @since Purecsspress 1.0
 *
 * Last Revised: May 01, 2015
 */

function child_purecsspress_loader() {
    wp_register_style( 'puremainstyle', get_stylesheet_directory_uri().'/assets/css/style.css', array( 'fontawesome' ), '1.0', 'all' );
    wp_enqueue_style( 'puremainstyle' );
    wp_register_script( 'mainscript', get_stylesheet_directory_uri().'/assets/scripts/script.js', array( 'jquery' ), '1', true );
    wp_enqueue_script( 'mainscript' );
}
add_action( 'wp_enqueue_scripts', 'child_purecsspress_loader', 200 );


 ?>