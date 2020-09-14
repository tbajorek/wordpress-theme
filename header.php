<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <?php if (is_single() && has_post_thumbnail()) : ?>
    <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"/>
    <meta name="twitter:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'twitter-thumbnail')); ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?>" />
    <meta name="twitter:title" content="<?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta property="og:description" content="<?php the_excerpt(); ?>" />
    <meta name="twitter:description" content="<?php the_excerpt(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js"></script>
<div class="page-wrapper">
<?php
    get_template_part('template-parts/header');
    get_template_part('template-parts/menu');
?>
<div class="page-before-main">
    <?php show_breadcrumbs('<div class="breadcrumbs block">', '</div>'); ?>
</div>