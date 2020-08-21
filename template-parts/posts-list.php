<div class="section-wrapper">
<div class="article-grid section">
    <?php
    global $wp_query;

    $paged = (get_query_var('paged')) ?: 1;
    $args = ['post_type' => 'post', 'paged' => $paged];

    if ($wp_query !== null) {
        $args = array_merge($args, $wp_query->query);
    }

    $wp_query = new WP_Query($args);
    while ( have_posts() ) : the_post();
        get_template_part('template-parts/posts-list/preview');
    endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>
<?php
    get_template_part('template-parts/posts-list/list-navigation');
?>
</div>
