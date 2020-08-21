<?php
get_header();
?>
    <main class="page-main">
        <article class="single-article section-wrapper">
            <div class="block section not-found-block">
                <h2><?php echo __('Site not found', 'prawe-mysli'); ?></h2>
                <p class="form-info"><?php echo __('You can find a page using this form or go directly to homepage', 'prawe-mysli'); ?>&nbsp;<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo __('clicking this link', 'prawe-mysli'); ?></a>.</p>
                <?php get_search_form(); ?>
            </div>
        </article>
    </main>
<?php
get_sidebar();
get_footer();