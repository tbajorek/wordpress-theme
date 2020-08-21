<?php
$previous = get_previous_post();
$next = get_next_post();
?>
<div class="article-pagination section">
    <?php if (!empty($previous)) : ?>
        <a href="<?php echo esc_url(get_post_permalink($previous)); ?>" class="block pagination-item page-prev">
            <i class="pagination-arrow icon-left-open"></i>
            <?php if (has_post_thumbnail($previous)) : ?>
            <img class="pagination-image" src="<?php echo get_the_post_thumbnail_url($previous); ?>" alt="<?php echo __('Prev', 'prawe-mysli') ?>" />
            <?php endif; ?>
            <p class="pagination-title"><?php echo esc_html($previous->post_title); ?></p>
        </a>
    <?php endif; ?>

    <?php if (!empty($next)) : ?>
        <a href="<?php echo esc_url(get_post_permalink($next)); ?>" class="block pagination-item page-next">
            <p class="pagination-title"><?php echo esc_html($next->post_title); ?></p>
            <?php if (has_post_thumbnail($next)) : ?>
                <img class="pagination-image" src="<?php echo get_the_post_thumbnail_url($next); ?>" alt="<?php echo __('Prev', 'prawe-mysli') ?>" />
            <?php endif; ?>
            <i class="pagination-arrow icon-right-open"></i>
        </a>
    <?php endif; ?>
</div>