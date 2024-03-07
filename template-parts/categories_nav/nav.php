<?php
/**
 * Footer menu
 * @package agromedika
 */

use AGROMEDIKA_THEME\Inc\Menus;

$menu_class = Menus::get_instance();
$footer_menu_id = $menu_class->get_menu_id('agromedika-categories-menu');

$footer_menus_categories = wp_cache_get('footer_menus_categories', 'menu_cache'); 

if (false === $footer_menus_categories) {
    $footer_menus_categories = wp_get_nav_menu_items($footer_menu_id);
    wp_cache_set('footer_menus_categories', $footer_menus_categories, 'menu_cache', 3600); // Cache for 1 hour
}

if (!empty($footer_menus_categories) && is_array($footer_menus_categories)) :
    echo '<ul class="nav flex-column mt-4 ps-lg-5">';
    foreach ($footer_menus_categories as $menu_item) :
        if (!$menu_item->menu_item_parent) :
            $child_menu_items = $menu_class->get_child_menu_items($footer_menus_categories, $menu_item->ID);
            $has_children = !empty($child_menu_items) && is_array($child_menu_items);
            if (!$has_children) : ?>
                <li class="nav-item">
                    <a class="nav-link text-lteal fs-6 px-0" href="<?php echo esc_url($menu_item->url); ?>">
                        <?php echo esc_html($menu_item->title); ?>
                    </a>
                </li>
<?php
            else :
?>
                <li class="nav-item dropdown mb-2">
                    <a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo esc_html($menu_item->title); ?><i class="bi bi-chevron-down ms-2"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        foreach ($child_menu_items as $child_menu_item) :
                        ?>
                            <li><a class="dropdown-item" href="<?php echo esc_url($child_menu_item->url); ?>"><?php echo esc_html($child_menu_item->title); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
<?php
            endif;
        endif;
    endforeach;
    echo '</ul>';
endif;
?>
