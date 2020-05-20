<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function my_theme_enqueue_styles() {

	$parent_style = 'twentytwenty-style';



	wp_register_style( 'uikit', get_stylesheet_directory_uri() . '/assets/lib/uikit/css/uikit.min.css', array(), false, 'all' );
	wp_enqueue_style('uikit');
	
	wp_register_style( 'style', get_template_directory_uri() . '/style.css', array(), false, 'all' );
	wp_enqueue_style('style');



	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
	wp_enqueue_style('child-style', 
		get_stylesheet_directory_uri() . '/style.css',
		array($parent_style),
		wp_get_theme()->get('version')
	);


	wp_register_script( 'uikit', get_stylesheet_directory_uri() . '/assets/lib/uikit/js/uikit.min.js', '', 2, true );
	wp_enqueue_script('uikit');



}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');



function wpdocs_get_paginated_links( $query ) {
    // When we're on page 1, 'paged' is 0, but we're counting from 1,
    // so we're using max() to get 1 instead of 0
    $currentPage = max( 1, get_query_var( 'paged', 1 ) );
 
    // This creates an array with all available page numbers, if there
    // is only *one* page, max_num_pages will return 0, so here we also
    // use the max() function to make sure we'll always get 1
    $pages = range( 1, max( 1, $query->max_num_pages ) );
 
    // Now, map over $pages and return the page number, the url to that
    // page and a boolean indicating whether that number is the current page
    return array_map( function( $page ) use ( $currentPage ) {
        return ( object ) array(
            "isCurrent" => $page == $currentPage,
            "page" => $page,
            "url" => get_pagenum_link( $page )
        );
    }, $pages );
}