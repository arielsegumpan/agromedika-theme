<?php
/**
 * Register agromedika Custom Post Type.
 * @package agromedika
 */
namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class Careercat{
    use Singleton;

    protected function __construct() {
        // Add action hooks to register custom post types
        $this->setup_cpt_hooks();
    }

    protected function setup_cpt_hooks() {
        // Add any setup related to custom post types here
    }

    // New public method to get categories
    public function get_categories() {
        // Replace 'your_custom_post_type' with your actual custom post type name
        $custom_post_type = 'careers';
        // Replace 'your_custom_taxonomy' with your actual custom taxonomy name
        $custom_taxonomy = 'career';

        $categories = get_terms(array(
            'taxonomy'   => $custom_taxonomy,
            'hide_empty' => false,
        ));

        if (!empty($categories)) {
            $category_links = array();
            foreach ($categories as $category) {
                $category_links[] = '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
            }
            return implode('<br>', $category_links);
        } else {
            return 'No categories found.';
        }
    }
}

