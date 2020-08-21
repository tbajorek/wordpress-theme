<?php

/**
 * Add a home link to your menu
 *
 * @since 4.0
 */
function prawemysli_add_menu_home_link($items, $args) {

    // Only used for the main menu
    if ( 'primary' != $args->theme_location ) {
        return $items;
    }
    // Create home link
    $current_home_page_class = is_home() ? 'current_page_item ' : '';
    //$home_link = '<li class="' . $current_home_page_class . 'clickable-list-item menu-item"><a class="clickable menu-link with-icon icon-home" href="' . esc_url( home_url( '/' ) ) . '"><span class="menu-link-text">Home</span></a></li>';
    // Add home link to the menu items
    //$items = $home_link . $items;
    // Return menu items
    return $items;

}
add_filter( 'wp_nav_menu_items', 'prawemysli_add_menu_home_link', 10, 2 );

/**
 * Determine how to display social menu (only icons)
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $item        Menu item data object.
 * @param int      $depth       Depth of the menu. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 * @return string The menu item output with social icon.
 */
function prawemysli_transform_social_menu( $item_output, $item, $depth, $args ) {
    if ( 'social' === $args->theme_location ) {
        $socialType = PraweMysli_Social_Menu_Helper::getSocialType($item->url);
        $icon = PraweMysli_Social_Menu_Helper::getIcon($socialType);
        return '<a class="clickable as-icon icon-' . $icon . '" href="' . $item->url . '" target="_blank" aria-label="' . ucfirst($socialType) . '"></a>';
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prawemysli_transform_social_menu', 10, 4);

/**
 * Adds conditional body classes.
 *
 * @param array $classes Classes added to the body tag.
 * @return array Classes added to the body tag.
 */
function prawemysli_body_classes( $classes ) {
    //$classes[] = 'no-sidebar';//TODO
    return $classes;
}

add_filter( 'body_class', 'prawemysli_body_classes' );

/**
 * WCAG 2.0 Attributes for Dropdown Menus
 *
 * Adjustments to menu attributes tot support WCAG 2.0 recommendations
 * for flyout and dropdown menus.
 *
 * @ref https://www.w3.org/WAI/tutorials/menus/flyout/
 */
function prawemysli_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
    $atts['class'] = 'clickable menu-link';
    foreach ($item->classes as $class) {
        if (strpos($class, '-item') === false) {
            $atts['class'] .= (' ' . $class);
        }
    }

    // Add [aria-haspopup] and [aria-expanded] to menu items that have children.
    $item_has_children = in_array( 'menu-item-has-children', $item->classes, true );
    if ( $item_has_children ) {
        $atts['aria-haspopup'] = 'true';
        $atts['aria-expanded'] = 'false';
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'prawemysli_nav_menu_link_attributes', 10, 4 );

function special_nav_class($classes, $item){
    foreach ($classes as $key => $class) {
        if (strpos($class, '-item') === false) {
            unset($classes[$key]);
        }
    }
    if(in_array('current-menu-item', $classes, true)){
        $classes[] = 'selected ';
    }
    return $classes;
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function wpdocs_custom_dropdown_class( $classes ) {
    $classes[] = 'menu';
    $classes[] = 'clickable-list';

    return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'wpdocs_custom_dropdown_class' );
