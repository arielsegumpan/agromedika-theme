<?php
/**
 * Register agromedika Pre Get Posts.
 * @package agromedika
 */
namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class Namespacecpt{
    use Singleton;

    protected function __construct() {
        // Add action hooks to register custom post types
        $this->setup_cpt_hooks();
    }

    protected function setup_cpt_hooks() {
        // Add any setup related to custom post types here
        add_action('pre_get_posts', [$this,'get_queries']);
    }

    // get namespace
    function get_queries($query) {
        if ((is_tag() || is_category()) && $query->is_main_query() && empty($query->query_vars['suppress_filters'])) {
            // Get all public post types
            // $public_post_types = get_post_types(array('public' => true), 'names');
            
            // Set the 'post_type' parameter in the query to include public post types
            $query->set('post_type',  ['post', 'careers', 'publications', 'trainingseminars', 'medicinal_herbs'] );
        }
        return $query;
    }
} 