<?php

class PraweMysli_Walker_Nav_Menu extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $item->classes[] = 'clickable-list-item';
        parent::start_el($output, $item, $depth, $args, $id);
    }

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<div class="sub-menu-opener"><a href="#" class="sub-menu-opener-inner clickable as-icon icon-down-open" aria-label="Otwórz menu dla Lista artykułów"></a></div>';
        $output .= '<div class="sub-menu-wrapper">';
        parent::start_lvl($output, $depth, $args);
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        parent::end_lvl($output, $depth, $args);
        $output .= '</div>';
    }
}