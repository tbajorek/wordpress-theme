<?php

if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
    <aside class="widget-area page-sidebar section-wrapper" role="complementary" aria-label="<?php esc_attr_e( 'Right sidebar'); ?>">
        <?php dynamic_sidebar( 'right-sidebar' ); ?>
    </aside><!-- .widget-area -->

<?php endif; ?>
