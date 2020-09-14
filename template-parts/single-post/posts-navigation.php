<?php
$previous = get_previous_post();
$next = get_next_post();
?>
<div class="article-pagination section">
    <div class="pagination-block-wrapper page-prev">
        <?php if (!empty($previous)) : ?>
        <a href="<?php echo esc_url(get_post_permalink($previous)); ?>" class="block pagination-block">
            <i class="pagination-arrow icon-left-open"></i>
            <?php if (has_post_thumbnail($previous)) : ?>
            <img class="pagination-image" src="<?php echo get_the_post_thumbnail_url($previous, 'thumbnail'); ?>" alt="<?php echo __('Prev', 'prawe-mysli') ?>" />
            <?php endif; ?>
            <p class="pagination-title"><?php echo esc_html($previous->post_title); ?></p>
        </a>
        <?php endif; ?>
    </div>

    <div class="pagination-block-wrapper page-next">
        <?php if (!empty($next)) : ?>
        <a href="<?php echo esc_url(get_post_permalink($next)); ?>" class="block pagination-block">
            <p class="pagination-title"><?php echo esc_html($next->post_title); ?></p>
            <?php if (has_post_thumbnail($next)) : ?>
            <img class="pagination-image" src="<?php echo get_the_post_thumbnail_url($next, 'thumbnail'); ?>" alt="<?php echo __('Prev', 'prawe-mysli') ?>" />
            <?php endif; ?>
            <i class="pagination-arrow icon-right-open"></i>
        </a>
        <?php endif; ?>
    </div>
</div>