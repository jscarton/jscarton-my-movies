<?php
/**
 * Plugin Name:       JScarton My Movies
 * Description:       A React Based Wordpress Plugin to show movies recommendations.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Juan Scarton <jscarton@gmail.com>
 * License:           MIT
 * Text Domain:       jscarton_my_movies
 */
require 'vendor/autoload.php';

use Jscarton\MyMovies\AjaxHandler;

// register activation hook to created DB tables
register_activation_hook( __FILE__, ['Jscarton\MyMovies\Installer','install']);

// register deactivation hook to clean up db tables
register_deactivation_hook( __FILE__, ['Jscarton\MyMovies\Installer','uninstall'] );


// create option on admin menu
add_action( 'admin_menu', 'jscarton_my_movies_init_menu' );

/**
 * Init Admin Menu.
 *
 * @return void
 */
function jscarton_my_movies_init_menu() {
    add_menu_page( __( 'My Movies', 'jscarton_my_movies'), __( 'My Movies', 'jscarton_my_movies'), 'manage_options', 'jscarton_my_movies', 'jscarton_my_movies_admin_page', 'dashicons-admin-post', '2.1' );
}

/**
 * Init Admin Page.
 *
 * @return void
 */
function jscarton_my_movies_admin_page() {
    require_once plugin_dir_path( __FILE__ ) . 'templates/app.php';
}

add_action( 'admin_enqueue_scripts', 'jscarton_my_movies_admin_enqueue_scripts' );

/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function jscarton_my_movies_admin_enqueue_scripts() {
    wp_enqueue_style( 'jscarton-my-movies-style', plugin_dir_url( __FILE__ ) . 'build/index.css' );
    wp_enqueue_script( 'jscarton-my-movies-script', plugin_dir_url( __FILE__ ) . 'build/index.js', array( 'wp-element' ), '1.0.0', true ); 
}

Jscarton\MyMovies\AjaxHandler::register();