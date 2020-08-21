<?php
global $wp_query;
$total_results = $wp_query->found_posts;
?>
<h1><?php echo the_post_results_info(); ?></h1>
<p><?php bloginfo( 'description' ); ?></p>