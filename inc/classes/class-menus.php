<?php
/**
 * Register Menus.
 * @package herbanext
 */
namespace HERBANEXT_THEME\Inc;
 use HERBANEXT_THEME\Inc\Traits\Singleton;


 class Menus{
    use Singleton;

    protected function __construct(){
        $this->setup_hooks();
    }

    protected function setup_hooks(){
        add_action('init',[$this,'register_menus']);
    }

    public function register_menus(){
        register_nav_menus(
           [
            'herbanext-header-menu' =>  esc_html__('Header Menu', 'herbanext'),
            'herbanext-footer-menu' =>  esc_html__('Footer Menu', 'herbanext')
           ]
        );
    }

    public function get_menu_id($id_location){
        // get tanan nga locations of nav
        $locates = get_nav_menu_locations();
        $menu_id = $locates[$id_location];
        return !empty($menu_id) ? $menu_id : '';
    }

    public function get_child_menu_items($menu_array, $parent_id){
        $child_menu = [];
        if(!empty($menu_array) && is_array($menu_array)){
            foreach($menu_array as $menu){
                intval($menu->menu_item_parent) === $parent_id ? array_push($child_menu, $menu) : '';
            }
        }
        return $child_menu;
    }
 }