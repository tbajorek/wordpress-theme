<?php
$prawemysli_aria_label = ! empty( $args['label'] ) ? 'aria-label="' . esc_attr( $args['label'] ) . '"' : '';
?>
<form role="search" <?php echo $prawemysli_aria_label; ?> method="GET" class="icon-search search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" class="search-input" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo __('Search'); ?>" aria-label="<?php echo __('Search'); ?>" />
</form>
