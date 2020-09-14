<?php

function prawemysli_theme_support() {
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support( 'title-tag' );

    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ]);

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'twitter-thumbnail', 250, 250 );

    add_theme_support('automatic-feed-links');
    add_theme_support('menus');
}

/**
 * REQUIRED FILES
 * Include required files.
 */
require(get_template_directory() . '/inc/template-tags.php');
require(get_template_directory() . '/inc/breadcrumbs.php');
require(get_template_directory() . '/inc/pagination.php');
require(get_template_directory() . '/inc/thumbnail-colors.php');
require(get_template_directory() . '/classes/PraweMysli_Social_Menu_Helper.php');
require(get_template_directory() . '/classes/PraweMysli_Walker_Nav_Menu.php');
require(get_template_directory() . '/classes/PraweMysli_Customize.php');
require(get_template_directory() . '/widgets/Newsletter_Widget.php');
require(get_template_directory() . '/widgets/Facebook_Profile_Widget.php');

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function prawemysli_menus() {
    $locations = [
        'primary'  => __('Desktop Horizontal Menu', 'prawe-mysli'),
        'social'   => __('Social Menu', 'prawe-mysli')
    ];
    register_nav_menus($locations);
}
add_action('init', 'prawemysli_menus');


add_action('after_setup_theme', 'prawemysli_theme_support');

/**
 * Register and Enqueue Styles.
 */
function prawemysli_register_styles() {
    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_style('prawemysli-style', get_template_directory_uri() . '/frontend/dist/main.css', '', $theme_version);
}

/**
 * Register and Enqueue Scripts.
 */
function prawemysli_register_scripts() {

    $theme_version = wp_get_theme()->get( 'Version' );
    if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    wp_enqueue_script( 'prawemysli-js', get_template_directory_uri() . '/frontend/dist/main.js', array(), $theme_version, true);
    wp_script_add_data( 'prawemysli-js', 'async', true );
}

if( !is_admin() ) {
    add_action( 'wp_enqueue_scripts', 'prawemysli_register_styles' );
    add_action( 'wp_enqueue_scripts', 'prawemysli_register_scripts' );
}

function prawemysli_fix_wp_headers($headers) {
    $headers['Access-Control-Allow-Origin'] = '*';
    $headers['Vary'] = 'Origin';
    return $headers;
}
add_filter('wp_headers', 'prawemysli_fix_wp_headers');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function prawemysli_widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Right sidebar', 'prawe-mysli', 'prawe-mysli'),
            'id'            => 'right-sidebar',
            'description'   => __( 'Add widgets here to appear in right sidebar.', 'prawe-mysli'),
            'before_widget' => '<section id="%1$s" class="widget section block %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

}
add_action( 'widgets_init', 'prawemysli_widgets_init' );

function prawemysli_change_search_url() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }
}
add_action( 'template_redirect', 'prawemysli_change_search_url' );

function get_domain(): string
{
    $urlparts = parse_url(home_url());
    return $urlparts['host'];
}

function the_post_results_info(): string
{
    global $wp_query;
    $total_results = $wp_query->found_posts;
    if ($total_results > 0) {
        return sprintf(
            _n('Found %s result', 'Found %s results', $total_results, 'prawe-mysli'),
            $total_results
        );
    }
    return __('No post found', 'prawe-mysli');
}

function prawemysli_setup_language(){
    load_theme_textdomain( 'prawe-mysli', get_template_directory() . '/lang' );
}
add_action( 'after_setup_theme', 'prawemysli_setup_language' );