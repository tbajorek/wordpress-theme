<?php get_header(); ?>
    <main class="page-main">
        <h2><?php  echo the_post_results_info(); ?></h2>
        <?php
        get_template_part('template-parts/posts-list');
        ?>
    </main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>