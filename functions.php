<?php
/**
 * Functions template
 * @package agromedika
 */
use AGROMEDIKA_THEME\Inc\AGROMEDIKA_THEME;
!defined('AGROMEDIKA_DIR_PATH') ? define('AGROMEDIKA_DIR_PATH',untrailingslashit( get_template_directory() )) : '';
!defined('AGROMEDIKA_DIR_URI') ? define('AGROMEDIKA_DIR_URI',untrailingslashit( get_template_directory_uri() )) : '';
require_once AGROMEDIKA_DIR_PATH . '/inc/helpers/autoloader.php';

function agromedika_get_theme_instance(){
    AGROMEDIKA_THEME::get_instance();
}
agromedika_get_theme_instance();

function custom_script(){
    wp_enqueue_script('custom_js', get_theme_file_uri() . '/assets/js/js.js', NULL, '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_script');

apply_filters( 'acf/prepare_field', 'agromedika_acf_prepare_field' );
function agromedika_acf_prepare_field($field) {
    return get_all_acf($field['name'], $field['name'] . '_option');
}

function get_acf_field($field_name) {
    return function_exists('get_field') ? get_field($field_name) : null;
}
function get_acf_option_field($field_name) {
    return function_exists('get_field') ? get_field($field_name,'option') : null;
}



function get_all_acf($acf_val, $acf_option_val){
    $acf_field_value = get_acf_field($acf_val);
    $acf_option_field_value = get_acf_option_field($acf_option_val);

    // Return an array containing both field and option values
    return [
        'acf_field_value' => $acf_field_value,
        'acf_option_field_value' => $acf_option_field_value
    ];
}

// register sidebar widget
function agromedika_register_custom_sidebars() {
    // Register agromedika Product Sidebar
    register_sidebar(array(
        'name' => 'Agromedika Product Sidebar',
        'id' => 'agromedika-product-sidebar',
        'description' => 'Widgets in this sidebar will appear on product-related pages.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title fw-bold museo">',
        'after_title' => '</h4>',
    ));

    // Register agromedika Post Sidebar
    register_sidebar(array(
        'name' => 'Agromedika Post Sidebar',
        'id' => 'agromedika-post-sidebar',
        'description' => 'Widgets in this sidebar will appear on post-related pages.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title fw-bold museo">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'agromedika_register_custom_sidebars');

// Add custom image tag in product catalog
if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
    function woocommerce_template_loop_product_thumbnail() {
        if (!class_exists('WooCommerce')) {
            return;
        }

        global $post;
        $size = 'shop_catalog'; // You can change the image size here.
        $title = get_the_title();
        $image = has_post_thumbnail() ? esc_url(get_the_post_thumbnail_url($post->ID, $size)) : esc_url(wc_placeholder_img_src($size));

        echo '<img class="rounded-3" src="' . $image . '" alt="' . esc_attr($title) . '">';
    }
}

// Get Categories by Post Type
function post_categories_by_post_type_shortcode($atts) {
    global $post;

    // Check if we have a valid post
    if (!isset($post) || empty($post->ID)) {
        return 'No post found.';
    }

    // Define the allowed post types add custom post type if necessary
    $allowed_post_types = array('post');

    // Get the post's post type
    $post_type = get_post_type($post);

    // Check if the post type is allowed
    if (in_array($post_type, $allowed_post_types)) {
        // Get the post's categories
        $categories = get_the_category();
        $output = '';
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="text-decoration-none text-lteal">
                    <span class="badge text-bg-primary px-2 rounded-2"><small class="text-lteal">
                    ' . $category->name . '</small></span></a>';
            }
        } else {
            $output = '';
        }
    } else {
        $output = '';
    }
    return $output;
}

add_shortcode('post_categories', 'post_categories_by_post_type_shortcode');


// Breadcrumbs
function custom_breadcrumbs() {
    echo '<a class="text-success text-decoration-none" href="'.esc_url(home_url()).'" rel="nofollow"><i class="bi bi-house me-2"></i>'.__('Home', 'agromedika').'</a>';
    $delimiter = "&nbsp;&nbsp;&#187;&nbsp;&nbsp;"; // Delimiter between breadcrumbs
    if (is_archive() || is_home()) {
        echo $delimiter . '<span>' . esc_html(wp_title('', false)) . '</span>';
    }
    if (is_category() || is_single()) {
        $post_type = get_post_type();
        $post_type_slug = ($post_type == 'post') ? __('News', 'agromedika') : ucfirst($post_type);

        $archive_link = esc_url(get_post_type_archive_link($post_type));
        echo $delimiter . '<a class="text-success text-decoration-none" href="' . esc_url($archive_link) . '">' . esc_html($post_type_slug) . '</a>';
        if (is_single()) {
            echo $delimiter . the_title('', '', false);
        }
    } elseif (is_page()) {
        $post_slug = get_post_field('post_name', get_post());
        echo $delimiter . '<a class="text-decoration-none text-secondary" href="' . esc_url(home_url('/' . $post_slug)) . '">' . esc_html(get_the_title()) . '</a>';
    } elseif (is_search()) {
        echo $delimiter . __('Search Results for...', 'agromedika') . ' "<em>' . esc_html(get_search_query()) . '</em>"';
    }
}



// Add custom columns to the admin table for the custom post type "herb"
function custom_herb_columns($columns) {
    // Add a new column for the ACF true/false field
    $columns['is_post_featured'] = 'Is Post Featured?';
    return $columns;
}
add_filter('manage_edit-herb_columns', 'custom_herb_columns');

// Populate the custom column with data
function custom_herb_column_content($column_name, $post_id) {
    // Check if the current column is for the ACF true/false field
    if ($column_name === 'is_post_featured') {
        // Ensure ACF is loaded
        if (function_exists('get_field')) {
            // Get the value of the ACF true/false field for the current post
            $is_featured = get_field('herb_single_contents_is_post_featured', $post_id);

            // Display "Yes" if the field is true, otherwise display "No"
            echo $is_featured ? 'Yes' : 'No';
        }
    }
}
add_action('manage_herb_posts_custom_column', 'custom_herb_column_content', 10, 2);

