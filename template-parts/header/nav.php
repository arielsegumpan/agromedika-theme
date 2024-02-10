<?php
/**
 * Header menu
 * @package herbanext
 */

 use HERBANEXT_THEME\Inc\Menus;

 $menu_class = Menus::get_instance();
 $header_menu_id = $menu_class->get_menu_id('herbanext-header-menu');
 
 $header_menus = wp_cache_get('header_menus', 'menu_cache');
 
 if (false === $header_menus) {
     $header_menus = wp_get_nav_menu_items($header_menu_id);
     wp_cache_set('header_menus', $header_menus, 'menu_cache', 3600); // Cache for 1 hour
 }
 
 if (!empty($header_menus) && is_array($header_menus)) :
     echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-uppercase gap-3 gap-lg-0">';
     foreach ($header_menus as $menu_item) :
         if (!$menu_item->menu_item_parent) :
             $child_menu_items = $menu_class->get_child_menu_items($header_menus, $menu_item->ID);
             $has_children = !empty($child_menu_items) && is_array($child_menu_items);
             if (!$has_children) :
 ?>
                 <li class="nav-item me-3">
                     <a class="nav-link" href="<?php echo esc_url($menu_item->url); ?>">
                         <?php echo esc_html($menu_item->title); ?>
                     </a>
                 </li>
 <?php
             else :
 ?>
                 <li class="nav-item dropdown me-3">
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
 