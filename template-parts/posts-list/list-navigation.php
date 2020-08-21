<?php
$previousPosts = get_previous_posts_url();
$nextPosts = get_next_posts_url();
?>
<div class="articles-list-pagination section">
    <?php if (!empty($previousPosts)) : ?>
        <a href="<?php echo esc_url($previousPosts); ?>" class="block pagination-item page-prev">
            <i class="pagination-arrow icon-left-open"></i>
            <p class="pagination-title"><?php echo __('Newer posts', 'prawe-mysli') ?></p>
        </a>
    <?php endif; ?>

    <?php if (!empty($nextPosts)) : ?>
        <a href="<?php echo esc_url($nextPosts); ?>" class="block pagination-item page-next">
            <p class="pagination-title"><?php echo __('Older posts', 'prawe-mysli') ?></p>
            <i class="pagination-arrow icon-right-open"></i>
        </a>
    <?php endif; ?>
</div>
