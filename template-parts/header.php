<header class="page-header">
    <div class="page-header-parallax">
        <?php if (is_single() && has_post_thumbnail()) : ?>
        <div class="header-bkg" style="
            background-image: url(<?php echo esc_url(get_the_post_thumbnail_url()); ?>);
            background-position: center center;
            "></div>
        <?php else: ?>
        <div class="header-bkg" style="
            background-image: url(<?php bloginfo('template_url'); ?>/images/default_image.jpg);
            background-position: center center;
            "></div>
        <?php endif; ?>
        <?php
            $thumbsLayerColor = sprintf('%s, %s, %s, %s', ...get_average_color(get_the_thumbnail_path()));
        ?>
        <div class="header-bkg-tint" style="
                    background-color: rgba(<?php echo $thumbsLayerColor; ?>);
                "></div>
        <div class="header-content">
            <div class="header-content-inner">
                <?php
                    if (is_single() && !is_page()) {
                        get_template_part('template-parts/header/post-header');
                    } else if (is_page()) {
                        get_template_part('template-parts/header/page-header');
                    } else if (is_search()) {
                        get_template_part('template-parts/header/search-header');
                    } else {
                        get_template_part('template-parts/header/default-header');
                    }
                ?>
            </div>
        </div>
    </div>
</header>