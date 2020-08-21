<div class="article-header">
    <div class="article-category"><?php echo get_the_category_list(', '); ?></div>
    <h1 class="article-title"><?php echo esc_html(get_the_title()); ?></h1>
    <div class="article-details">
        <div class="inline-row">
            <div class="article-published-date icon-calendar"><?php echo get_the_date();?></div>
            <?php $commentsCount = get_comments_number(); ?>
            <?php if ($commentsCount > 0) : ?>
            <a href="#comments" class="article-comments-count icon-chat"><?php echo $commentsCount; ?></a>
            <?php endif; ?>
        </div>
        <div class="article-tags">
            <?php echo get_the_tag_list(null, ', '); ?>
        </div>
    </div>
</div>