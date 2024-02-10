<?php
/**
 * Register agromedika Custom Post Type.
 * @package agromedika
 */
namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class Restriction {
    use Singleton;

    protected function __construct() {
        // Add action hooks to register custom post types
        $this->restrict_hooks();
    }

    protected function restrict_hooks() {
        add_filter('acf/settings/show_admin', [$this, 'hide_acf_options_pages_for_non_admins']);
        add_action('admin_menu', [$this, 'remove_menus']);
        add_action('admin_init', [$this, 'restrict_menus_for_non_admin']);
        add_action('init', [$this,'add_hr_role']);
    }

    public function hide_acf_options_pages_for_non_admins($show_admin) {
        return current_user_can('administrator') ? $show_admin : false;
    }

    public function remove_menus() {
        // if not admin remove tools, acf option page,page, contact form 7
        if (!current_user_can('administrator')) {
            remove_menu_page('tools.php');
            remove_menu_page('options-general.php');
            remove_menu_page('page');
            remove_menu_page('wpcf7');
        }
        // if hr remove other cpt
        if(current_user_can('hr') && !current_user_can('administrator')){
            remove_menu_page('edit.php?post_type=publications'); 
            remove_menu_page('edit.php'); 
            remove_menu_page('edit.php?post_type=trainingseminars'); 
            remove_menu_page('edit.php?post_type=medicinal_herbs'); 
        }
        // remove hr cpt if not hr
        if(!current_user_can('hr') && !current_user_can('administrator')){
            remove_menu_page('edit.php?post_type=careers');
        }
    }
    //  remove acf option page if not admin
    public function restrict_menus_for_non_admin() {
        if (!current_user_can('administrator')) {
            remove_menu_page('blog-settings');
            remove_menu_page('agromedika-shop');
        }
    }
    // add hr role custom role and permission   
    function add_hr_role() {
        add_role('hr', 'HR', array(
            'read' => true,
            'create_careers' => true,
            'edit_careers' => true,
            'edit_others_careers' => true,
            'publish_careers' => true,
            'manage_categories' => true,
        ));
    }
    
}
