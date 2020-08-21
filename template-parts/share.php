<?php
$facebookUrl = get_theme_mod('facebook_url', null);
$twitterUrl = get_theme_mod('twitter_url', null);
$wykopUrl = get_theme_mod('wykop_url', null);
?>
<?php if ($facebookUrl !== null || $twitterUrl !== null || $wykopUrl !== null) : ?>
<div class="share">
    <span class="share-text"><?php echo __('Share this post:', 'prawe-mysli'); ?></span>
    <ul class="clickable-list">
        <?php if ($facebookUrl !== null) : ?>
        <li class="clickable-list-item bkg-facebook">
            <a href="<?php echo $facebookUrl . get_permalink(); ?>" class="clickable as-icon icon-facebook" aria-label="Facebook" target="_blank"></a>
        </li>
        <?php endif; if ($twitterUrl !== null) : ?>
        <li class="clickable-list-item bkg-twitter">
            <a href="<?php echo $twitterUrl . get_permalink(); ?>" class="clickable as-icon icon-twitter" aria-label="Twitter" target="_blank"></a>
        </li>
        <?php endif; if ($wykopUrl !== null) : ?>
        <li class="clickable-list-item bkg-wykop">
            <a href="<?php echo $wykopUrl . get_permalink(); ?>" class="clickable as-icon icon-wykop" aria-label="Wykop" target="_blank"></a>
        </li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?>