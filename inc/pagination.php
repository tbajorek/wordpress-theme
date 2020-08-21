<?php

function get_previous_posts_url(): ?string
{
    global $paged;
    if (!$paged) {
        $paged = 1;
    }
    if ($paged <= 1) {
        return null;
    }
    return previous_posts( false );
}

function get_next_posts_url(): ?string
{
    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;
    if ( ! $paged ) {
        $paged = 1;
    }
    $next_page = $paged + 1;
    if ($next_page > $max_page) {
        return null;
    }
    return next_posts($max_page, false);
}
