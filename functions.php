<?php
/**
 * Echo Theme functions and definitions
 *
 * @package EchoTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$echo_theme_inc_dir = 'inc';

// Array of files to include.
$echo_theme_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/cpt.php',                             // Register custom post types.
	'/wp-overrides.php',                    // Override default Wordpress functions & settings
	'/plugin-overrides.php',                // Override plugin functions & settings
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/shortcodes.php',                      // Library of shortcodes
	'/blocks.php',                          // ACF Blocks
    '/mega_menu.php',
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$echo_theme_includes[] = '/wc-overrides.php'; // Override default WooCommerce functions & settings
	$echo_theme_includes[] = '/woocommerce.php'; // WooCommerce functions
}

// Include files.
foreach ( $echo_theme_includes as $file ) {
	require_once get_theme_file_path( $echo_theme_inc_dir . $file );
}


function register_theme_menu_locations() {
    register_nav_menus( array(
        'top-menu'   => __( 'Top Menu', 'top-menu' ),
        'footer-menu' => __( 'Footer Menu', 'footer-menu' ),
		'quick-links' => __('Quick Links'),
        'support'     => __('Support'),
        'information' => __('Information'),
    ) );
}
add_action( 'init', 'register_theme_menu_locations' );


add_filter( 'wpseo_breadcrumb_separator', 'custom_yoast_breadcrumb_separator' );
function custom_yoast_breadcrumb_separator( $separator ) {
    return ' <span class="icon-arrow-right"></span> ';
}

function enqueue_usp_slick_slider() {
    wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/slick/slick.css' );
    wp_enqueue_style( 'slick-theme-css', get_template_directory_uri() . '/slick/slick-theme.css' );
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/slick/slick.min.js', array( 'jquery' ), null, true );

    wp_add_inline_script( 'slick-js', "
        jQuery(document).ready(function($){
            $('.usp-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: false,
                dots: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
        jQuery(document).ready(function($) {
            $('.testimonial-slider').slick({
                arrows: true,
                dots: true,
                autoplay: false,
                autoplaySpeed: 5000,
                slidesToShow: 1,
                adaptiveHeight: true
            });
        });
    " );
}
add_action( 'wp_enqueue_scripts', 'enqueue_usp_slick_slider' );


add_filter('acf/settings/save_json', function() {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});


function custom_archive_posts_per_page( $query ) {
    if ( !is_admin() && $query->is_main_query() && ( is_archive() || is_post_type_archive('post') ) ) {
        $query->set( 'posts_per_page', 6 );
    }
}
add_action( 'pre_get_posts', 'custom_archive_posts_per_page' );
