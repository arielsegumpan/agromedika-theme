<?php
/**
 * Functions template
 * @package herbanext
 */
use HERBANEXT_THEME\Inc\HERBANEXT_THEME;
// Define HERBANEXT_DIR_PATH and HERBANEXT_DIR_URI if not defined
!defined('HERBANEXT_DIR_PATH') ? define('HERBANEXT_DIR_PATH',untrailingslashit( get_template_directory() )) : '';
!defined('HERBANEXT_DIR_URI') ? define('HERBANEXT_DIR_URI',untrailingslashit( get_template_directory_uri() )) : '';
require_once HERBANEXT_DIR_PATH . '/inc/helpers/autoloader.php';

function herbanext_get_theme_instance(){
    HERBANEXT_THEME::get_instance();
}
herbanext_get_theme_instance();

function custom_script(){
    wp_enqueue_script('custom_js', get_theme_file_uri() . '/assets/js/js.js', NULL, '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_script');

apply_filters( 'acf/prepare_field', 'herbanext_acf_prepare_field' );
function herbanext_acf_prepare_field($field) {
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
function herbanext_register_custom_sidebars() {
    // Register Herbanext Product Sidebar
    register_sidebar(array(
        'name' => 'Herbanext Product Sidebar',
        'id' => 'herbanext-product-sidebar',
        'description' => 'Widgets in this sidebar will appear on product-related pages.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title fw-bold museo">',
        'after_title' => '</h4>',
    ));

    // Register Herbanext Post Sidebar
    register_sidebar(array(
        'name' => 'Herbanext Post Sidebar',
        'id' => 'herbanext-post-sidebar',
        'description' => 'Widgets in this sidebar will appear on post-related pages.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title fw-bold museo">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'herbanext_register_custom_sidebars');

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

    // Define the allowed post types
    $allowed_post_types = array('careers', 'publications', 'trainingseminars', 'post','medicinal_herbs');

    // Get the post's post type
    $post_type = get_post_type($post);

    // Check if the post type is allowed
    if (in_array($post_type, $allowed_post_types)) {
        // Get the post's categories
        $categories = get_the_category();
        $output = '';
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="text-decoration-none mb-2">
                    <span class="badge text-bg-green rounded-2 text-small px-3 me-2"><small>
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

// Get all categoreis
function display_all_categories() {
    $categories = get_categories(array(
        'hide_empty' => 0,
    ));
    if (empty($categories)) {
        echo 'No categories found.';
        return;
    }
    foreach ($categories as $category) {
        $category_link = esc_url(get_category_link($category->term_id));
        $category_name = esc_html($category->name);

        echo <<<HTML
            <a href="$category_link" class="text-decoration-none mb-2">
                <span class="badge text-bg-green rounded-2 text-small px-3 me-2"><small>$category_name</small></span>
            </a>
    HTML;
    }
}
add_shortcode('all_categories', 'display_all_categories');

// Breadcrumbs
function custom_breadcrumbs() {
    echo '<a class="text-success text-decoration-none" href="'.esc_url(home_url()).'" rel="nofollow"><i class="bi bi-house me-2"></i>'.__('Home', 'herbanext').'</a>';
    $delimiter = "&nbsp;&nbsp;&#187;&nbsp;&nbsp;"; // Delimiter between breadcrumbs
    if (is_archive() || is_home()) {
        echo $delimiter . '<span>' . esc_html(wp_title('', false)) . '</span>';
    }
    if (is_category() || is_single()) {
        $post_type = get_post_type();
        $post_type_slug = ($post_type == 'post') ? __('News', 'herbanext') : ucfirst($post_type);

        $archive_link = esc_url(get_post_type_archive_link($post_type));
        echo $delimiter . '<a class="text-success text-decoration-none" href="' . esc_url($archive_link) . '">' . esc_html($post_type_slug) . '</a>';
        if (is_single()) {
            echo $delimiter . the_title('', '', false);
        }
    } elseif (is_page()) {
        $post_slug = get_post_field('post_name', get_post());
        echo $delimiter . '<a class="text-decoration-none text-secondary" href="' . esc_url(home_url('/' . $post_slug)) . '">' . esc_html(get_the_title()) . '</a>';
    } elseif (is_search()) {
        echo $delimiter . __('Search Results for...', 'herbanext') . ' "<em>' . esc_html(get_search_query()) . '</em>"';
    }
}
  // Remove the product title from WooCommerce product loop
  add_action('init', 'remove_loop_title');
  function remove_loop_title() {
      remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
  }

  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
  add_filter( 'woocommerce_page_title', 'new_woocommerce_page_title' );
  function new_woocommerce_page_title( $page_title ) {
      if ( $page_title == 'Shop' ) {
          return '<span class="fw-bold fs-2">Product Catalog</span>';
      }
  }