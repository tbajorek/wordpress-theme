<?php
/*=============================================
                BREADCRUMBS
=============================================*/
//  to include in functions.php

/**
 * @param string $before    tag before the current crumb
 * @param string $after     tag after the current crumb
 * @param string $delimiter delimiter between crumbs
 */
function show_breadcrumbs(
    string $before = '<span class="current">',
    string $after = '</span>',
    string $delimiter = '&raquo;'
) {
    $showOnHome = false; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $home = __('Home', 'prawe-mysli'); // text for the 'Home' link

    global $post;
    $homeLink = get_bloginfo('url');
    if (is_home() || is_front_page()) {
        if ($showOnHome === true) {
            echo $before . '<a href="' . $homeLink . '">' . $home . '</a>' . $after;
        }
        return;
    }

    echo $before . '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    if (is_category()) {
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent !== 0) {
            echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
        }
        echo single_cat_title('', false);
    } elseif (is_search()) {
        echo __('Search results for', 'prawe-mysli') . ' "' . get_search_query() . '"';
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
            echo $cats;
            echo get_the_title();
        }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
        $post_type = get_post_type_object(get_post_type());
        echo $post_type->labels->singular_name;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
        echo ' ' . $delimiter . ' ' . get_the_title();
    } elseif (is_page() && !$post->post_parent) {
        echo get_the_title();
    } elseif (is_page() && $post->post_parent) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_post($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        $breadcrumbsNumber = count($breadcrumbs);
        foreach ($breadcrumbs as $i => $iValue) {
            echo $iValue;
            if ($i !== $breadcrumbsNumber-1) {
                echo ' ' . $delimiter . ' ';
            }
        }
        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
    } elseif (is_tag()) {
        echo '#' . single_tag_title('', false);
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __('Articles posted by', 'prawe-mysli') . ' ' . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo __('Not found', 'prawe-mysli');
    }
    echo $after;
}