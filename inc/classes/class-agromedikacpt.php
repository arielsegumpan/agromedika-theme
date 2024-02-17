<?php

/**
 * Register agromedika Custom Post Type.
 * @package agromedika
 */

namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class AGROMEDIKACPT
{
    use Singleton;

    protected function __construct()
    {
        // Add action hooks to register custom post types
        $this->setup_cpt_hooks();
    }

    protected function setup_cpt_hooks()
    {
        add_action('init', [$this, 'register_careers_post_type']);
        add_action('init', [$this, 'register_publications_post_type']);
        add_action('init', [$this, 'register_trainingseminars_post_type']);
        add_action('init', [$this, 'register_medicinal_herbs_post_type']);
    }
    // Register Custom Post Type for Careers
    public function register_careers_post_type()
    {
        $labels = array(
            'name'                  => 'Careers',
            'singular_name'         => 'Career',
            'menu_name'             => 'Careers',
            'add_new'               => 'Add New Career',
            'add_new_item'          => 'Add New Career',
            'edit_item'             => 'Edit Career',
            'new_item'              => 'New Career',
            'all_items'             => 'All Careers',
            'view_item'             => 'View Career',
            'search_items'          => 'Search Careers',
            'not_found'             => 'No careers found',
            'not_found_in_trash'    => 'No careers found in trash',
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'careers'),
            'taxonomies'            => ['post_tag', 'category'],
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 4,
            'show_in_rest'          => true,
            'supports'              => array(
                'title',
                'editor',
                'excerpt',
                'trackbacks',
                'custom-fields',
                'comments',
                'revisions',
                'thumbnail',
                'author',
                'page-attributes',
                'permalinks',
            ),
            'menu_icon'             => 'dashicons-businessman', // Icon for Careers
        );

        register_post_type('careers', $args);
    }

    // Register Custom Post Type for Publications
    public function register_publications_post_type()
    {
        $labels = array(
            'name'                  => 'Publications',
            'singular_name'         => 'Publication',
            'menu_name'             => 'Publications',
            'add_new'               => 'Add New Publication',
            'add_new_item'          => 'Add New Publication',
            'edit_item'             => 'Edit Publication',
            'new_item'              => 'New Publication',
            'all_items'             => 'All Publications',
            'view_item'             => 'View Publication',
            'search_items'          => 'Search Publications',
            'not_found'             => 'No publications found',
            'not_found_in_trash'    => 'No publications found in trash',
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'publications'),
            'taxonomies'            => ['post_tag', 'category'],
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 5,
            'show_in_rest'          => true,
            'supports'              => array(
                'title',
                'editor',
                'excerpt',
                'trackbacks',
                'custom-fields',
                'comments',
                'revisions',
                'thumbnail',
                'author',
                'page-attributes',
                'permalinks',
            ),
            'menu_icon'             => 'dashicons-welcome-write-blog', // Icon for Publications
        );

        register_post_type('publications', $args);
    }

    // Register Custom Post Type for Training Seminars
    public function register_trainingseminars_post_type()
    {
        $labels = array(
            'name'                  => 'Training Seminars',
            'singular_name'         => 'Training Seminar',
            'menu_name'             => 'Training Seminars',
            'add_new'               => 'Add New Training Seminar',
            'add_new_item'          => 'Add New Training Seminar',
            'edit_item'             => 'Edit Training Seminar',
            'new_item'              => 'New Training Seminar',
            'all_items'             => 'All Training Seminars',
            'view_item'             => 'View Training Seminar',
            'search_items'          => 'Search Training Seminars',
            'not_found'             => 'No training seminars found',
            'not_found_in_trash'    => 'No training seminars found in trash',
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'training-and-seminars'),
            'taxonomies'            => ['post_tag', 'category'],
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 6,
            'show_in_rest'          => true,
            'supports'              => array(
                'title',
                'editor',
                'excerpt',
                'trackbacks',
                'custom-fields',
                'comments',
                'revisions',
                'thumbnail',
                'author',
                'page-attributes',
                'permalinks',
            ),
            'menu_icon'             => 'dashicons-groups', // Icon for Training Seminars
        );
        register_post_type('trainingseminars', $args);
    }

    // Register Custom Post Type for Medicinal Herbs
    public function register_medicinal_herbs_post_type()
    {
        $labels = array(
            'name'                  => 'Medicinal Herbs',
            'singular_name'         => 'Medicinal Herb',
            'menu_name'             => 'Medicinal Herbs',
            'add_new'               => 'Add New Medicinal Herb',
            'add_new_item'          => 'Add New Medicinal Herb',
            'edit_item'             => 'Edit Medicinal Herb',
            'new_item'              => 'New Medicinal Herb',
            'all_items'             => 'All Medicinal Herbs',
            'view_item'             => 'View Medicinal Herb',
            'search_items'          => 'Search Medicinal Herbs',
            'not_found'             => 'No medicinal herbs found',
            'not_found_in_trash'    => 'No medicinal herbs found in trash',
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'medicinal-herbs'), // Updated slug
            'taxonomies'            => ['post_tag', 'category'],
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 6,
            'show_in_rest'          => true,
            'supports'              => array(
                'title',
                'editor',
                'excerpt',
                'trackbacks',
                'custom-fields',
                'comments',
                'revisions',
                'thumbnail',
                'author',
                'page-attributes',
                'permalinks',
            ),
            'menu_icon'             => 'dashicons-image-filter', // Icon for Medicinal Herbs
        );
        register_post_type('medicinal_herbs', $args); // Updated post type name
    }
}
