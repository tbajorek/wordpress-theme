<?php get_header(); ?>
    <main class="page-main">
        <article class="single-article section-wrapper">
            <?php
                get_template_part( 'template-parts/single-post/content' );
                get_template_part( 'template-parts/single-post/posts-navigation' );
                get_template_part( 'template-parts/single-post/comments' );
            ?>
        </article>
    </main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>