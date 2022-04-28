<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() . '/js/main.js', array(), $the_theme->get( 'Version' ), true );
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

// add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'primary' )
        // return $items.'<li class="menu-item nav-item nav-search"><form action="http://example.com/" id="searchform" method="get"><input type="text" name="s" id="s" class="form-control" placeholder="Search"></form></li>';
        return $items.'<li class="menu-item nav-item nav-search"></li>';
 
    return $items;
}

// Add cta button shortcode
// [cta-btn title="" url=""]
function cta_function($atts = []) {
    $cta_atts = shortcode_atts(
        array(
            'title' => 'Call to Action',
            'url' => '#',
            'newtab' => 'yes',
        ), $atts);

    if($cta_atts['newtab'] == 'yes') $target = 'target="_blank"';

    $return_string = '<a class="btn btn-primary" href="'.$cta_atts['url'].'" role="button" '.$target.'>'.$cta_atts['title'].'</a>';

    return $return_string;
}

function register_shortcodes(){
    add_shortcode('cta-btn', 'cta_function');
}

add_action( 'init', 'register_shortcodes' );