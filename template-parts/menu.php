<nav class="page-nav">
    <div class="page-nav-inner">
        <a href="#" class="clickable as-icon icon-menu menu-toggler" aria-label="Otwórz lub zamknij menu"></a>
            <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu([
                        'container_class' => 'page-menu',
                        'theme_location' => 'primary',
                        'menu_class' => 'menu clickable-list',
                        'link_before' => '<span class="menu-link-text">',
                        'link_after' => '</span>',
                        'walker' => new PraweMysli_Walker_Nav_Menu()
                    ]);
                }
            ?>
        <div class="page-menu-others">
            <?php get_search_form([
                'label' => __( 'Search', 'prawe-mysli' )
            ]); ?>
            <?php wp_nav_menu([
                'theme_location'  => 'social',
                'container_class' => 'social-menu'
            ]); ?>
        </div>
    </div>
</nav>