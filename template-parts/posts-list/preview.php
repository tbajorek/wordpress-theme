<div class="article-grid-item">
    <article class="article-preview block section-wrapper">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php echo esc_url(get_permalink())?>" class="article-image-wrapper block-pad-break">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url()) ?>" alt="<?php echo esc_html(the_title()) ?>" class="article-image" />
            </a>
        <?php else: ?>
            <p />
        <?php endif; ?>
        <header class="article-details section">
            <div class="article-category"><?php echo get_the_category_list(', '); ?></div>
            <a href="<?php echo esc_url(get_permalink())?>">
                <h2 class="article-title"><?php echo esc_html(the_title()) ?></h2>
            </a>
            <div class="inline-row">
                <div class="article-published-date icon-calendar"><?php echo get_the_date();?></div>
                <?php $commentsCount = get_comments_number(); ?>
                <?php if ($commentsCount > 0) : ?>
                    <a href="<?php echo esc_url(get_permalink())?>#comments" class="article-comments-count icon-chat"><?php echo $commentsCount; ?></a>
                <?php endif; ?>
                <div class="article-tags">
                    <?php echo get_the_tag_list(null, ', '); ?>
                </div>
            </div>
        </header>
        <div class="article-text section">
            <?php the_excerpt(); ?>
        </div>
        <footer class="article-footer section">
            <a class="button" href="<?php echo esc_url(get_permalink())?>"><?php _e('Read more...', 'prawe-mysli'); ?></a>
        </footer>
    </article>
</div>