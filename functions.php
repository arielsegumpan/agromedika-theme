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
    // Check if we have a valid post ID
    if (!isset($atts['post_id'])) {
        return 'No post ID provided.';
    }

    // Get the categories of the provided post ID from the "career-category" taxonomy
    $categories = get_the_terms($atts['post_id'], 'career-category');

    // Check if categories were retrieved
    if (!empty($categories) && !is_wp_error($categories)) {
        $output = '';
        foreach ($categories as $category) {
            $output .= '<a href="' . esc_url(get_term_link($category)) . '" class="text-decoration-none text-lteal">
                <span class="badge text-bg-primary px-2 rounded-2"><small class="text-lteal">
                ' . $category->name . '</small></span></a>';
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
    // Add a new column for the ACF true/false fields
    $columns['is_post_featured'] = 'Is Post Featured?';
    $columns['is_approved_by_the_doh'] = 'Is Approved by DOH?';
    return $columns;
}
add_filter('manage_edit-herb_columns', 'custom_herb_columns');

// Populate the custom columns with data
function custom_herb_column_content($column_name, $post_id) {
    // Ensure ACF is loaded
    if (function_exists('get_field')) {
        // Initialize flags
        $is_featured = false;
        $is_approved = false;

        // Get the value of the ACF true/false fields for the current post
        $herb_single_contents = get_field('herb_single_contents', $post_id);
        if (isset($herb_single_contents['is_approved']['is_post_featured']) && $herb_single_contents['is_approved']['is_post_featured']) {
            $is_featured = true;
        }
        if (isset($herb_single_contents['is_approved']['is_approved_by_the_doh']) && $herb_single_contents['is_approved']['is_approved_by_the_doh']) {
            $is_approved = true;
        }

        // Display "Yes" if the field is true, otherwise display "No"
        if (($column_name === 'is_post_featured' && $is_featured) || ($column_name === 'is_approved_by_the_doh' && $is_approved)) {
            echo 'Yes';
        } else {
            echo 'No';
        }
    }
}
add_action('manage_herb_posts_custom_column', 'custom_herb_column_content', 10, 2);


function custom_format_wysiwyg_content($value, $post_id, $field)
{
    // Check if the field is a WYSIWYG field
    if ($field['type'] === 'wysiwyg') {
        // Add a CSS class to the <em> tags for italic formatting
        $value = str_replace('<em>', '<em class="fst-italic">', $value);
    }
    return $value;
}
add_filter('acf/format_value/type=wysiwyg', 'custom_format_wysiwyg_content', 10, 3);



// create page when application category created
// Hook into the create_term action
add_action('create_term', 'create_category_page', 10, 3);

function create_category_page($term_id, $tt_id, $taxonomy) {
    // Check if the created term is in the application-category taxonomy
    if ($taxonomy === 'application-category') {
        // Get the term object
        $term = get_term($term_id, $taxonomy);

        // Check if the term exists and is not a WP_Error object
        if ($term && !is_wp_error($term)) {
            // Generate a slug for the template name
            $template_slug = sanitize_title($term->name);

            // Check if the template file exists
            $template_file = locate_template('page-' . $template_slug . '.php');

           // If the template file doesn't exist, create a new file
            if (!$template_file) {
                // Prepare the page data
                $page_data = array(
                    'post_title' => $term->name,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'post_name' => $template_slug,
                    'page_template' => get_template_directory() . '/page-' . $template_slug . '.php',
                );

                // Insert the page into the database
                $page_id = wp_insert_post($page_data);

                update_post_meta($page_id, '_wp_page_template', 'page-' . $template_slug . '.php');


                // Prepare the template content
                $template_content = '<?php' . "\n";
                $template_content .= "/**\n";
                $template_content .= " * Template Name: " . $term->name . "\n";
                $template_content .= " * @package agromedika\n";
                $template_content .= " */\n";
                $template_content .= "get_header(); ?>\n\n";
                $template_content .= '<main class="bg-lteal">' . "\n";
                $template_content .= '<section id="blog">' . "\n";
                $template_content .= '    <div class="container">' . "\n";
                $template_content .= '        <div class="row">' . "\n";
                $template_content .= '            <div class="col-12 col-lg-10 mx-auto">' . "\n";
                $template_content .= '                <?php if(have_posts()) : while(have_posts()) : the_post() ;?>' . "\n";
                $template_content .= '                <?php the_content();?>' . "\n";
                $template_content .= '                <?php endwhile; endif;?>' . "\n";
                $template_content .= '            </div>' . "\n";
                $template_content .= '            <?php if (get_query_var(\'paged\') > 1 || get_next_posts_link() || get_previous_posts_link()) : ?>' . "\n";
                $template_content .= '                <div class="col-12 mt-5 text-center">' . "\n";
                $template_content .= '                    <div class="d-flex flex-row justify-content-center align-items-center gap-4">' . "\n";
                $template_content .= '                        <?php if (get_query_var(\'paged\') > 1 && get_previous_posts_link()) : ?>' . "\n";
                $template_content .= '                            <a href="<?php echo previous_posts(); ?>" class="btn btn-primary text-lteal px-4 py-3 rounded-4"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html(\'Previous\') ?></a>' . "\n";
                $template_content .= '                        <?php endif; ?>' . "\n";
                $template_content .= '                        <?php if (get_next_posts_link()) : ?>' . "\n";
                $template_content .= '                            <a href="<?php echo next_posts(); ?>" class="btn btn-primary text-lteal px-4 py-3 rounded-4"><?php echo esc_html(\'Next\') ?><i class="bi bi-arrow-right ms-2"></i></a>' . "\n";
                $template_content .= '                        <?php endif; ?>' . "\n";
                $template_content .= '                    </div>' . "\n";
                $template_content .= '                </div>' . "\n";
                $template_content .= '            <?php endif; ?>' . "\n";
                $template_content .= '        </div>' . "\n";
                $template_content .= '    </div>' . "\n";
                $template_content .= '</section>' . "\n";
                $template_content .= '</main>' . "\n";
                $template_content .= '<?php get_footer() ?>' . "\n";

                // Save the template content to a new file
                $file_path = get_template_directory() . '/page-' . $template_slug . '.php';
                file_put_contents($file_path, $template_content);

                // create_acf($term, $template_slug);
            }

        }
    }
}




// // Create ACF Field
// function create_acf($term, $template_slug){
// add_action( 'acf/include_fields', function() use ($term, $template_slug) {
//     if ( ! function_exists( 'acf_add_local_field_group' ) ) {
//         return;
//     }

//     acf_add_local_field_group( array(
//         'key' => 'group_'. $term_slug .'_afdc7ae',
//         'title' => $term->name,
//         'fields' => array(
//             array(
//                 'key' => 'field_'. $term_slug .'_afdfa58',
//                 'label' => $term->name . 'Page Title',
//                 'name' => $term_slug . '_page_title',
//                 'aria-label' => '',
//                 'type' => 'text',
//                 'instructions' => '',
//                 'required' => 0,
//                 'conditional_logic' => 0,
//                 'wrapper' => array(
//                     'width' => '',
//                     'class' => '',
//                     'id' => '',
//                 ),
//                 'default_value' => '',
//                 'maxlength' => '',
//                 'placeholder' => '',
//                 'prepend' => '',
//                 'append' => '',
//             ),
//             array(
//                 'key' => 'field_'. $term_slug .'_afe23b2',
//                 'label' => $term->name . ' Block 1',
//                 'name' => $term_slug . '_block_1',
//                 'aria-label' => '',
//                 'type' => 'group',
//                 'instructions' => '',
//                 'required' => 0,
//                 'conditional_logic' => 0,
//                 'wrapper' => array(
//                     'width' => '',
//                     'class' => '',
//                     'id' => '',
//                 ),
//                 'layout' => 'block',
//                 'sub_fields' => array(
//                     array(
//                         'key' => 'field_'. $term_slug .'_aff282d',
//                         'label' => $term->name . ' Block 1 Image',
//                         'name' => $term_slug . '_block_1_image',
//                         'aria-label' => '',
//                         'type' => 'image',
//                         'instructions' => '',
//                         'required' => 0,
//                         'conditional_logic' => 0,
//                         'wrapper' => array(
//                             'width' => '',
//                             'class' => '',
//                             'id' => '',
//                         ),
//                         'return_format' => 'array',
//                         'library' => 'all',
//                         'default_value' => '',
//                         'min_width' => '',
//                         'min_height' => '',
//                         'min_size' => '',
//                         'max_width' => '',
//                         'max_height' => '',
//                         'max_size' => '',
//                         'mime_types' => '',
//                         'preview_size' => 'medium',
//                     ),
//                     array(
//                         'key' => 'field_'. $term_slug .'_b00051f',
//                         'label' => $term->name . ' Block 1 Content',
//                         'name' => $term_slug . '_block_1_content',
//                         'aria-label' => '',
//                         'type' => 'wysiwyg',
//                         'instructions' => '',
//                         'required' => 0,
//                         'conditional_logic' => 0,
//                         'wrapper' => array(
//                             'width' => '',
//                             'class' => '',
//                             'id' => '',
//                         ),
//                         'default_value' => '',
//                         'tabs' => 'visual',
//                         'toolbar' => 'full',
//                         'media_upload' => 1,
//                         'delay' => 0,
//                     ),
//                 ),
//             ),
//             array(
//                 'key' => 'field_'. $term_slug .'_afe432c',
//                 'label' => $term->name . ' Block 2',
//                 'name' => $term_slug . '_block_2',
//                 'aria-label' => '',
//                 'type' => 'group',
//                 'instructions' => '',
//                 'required' => 0,
//                 'conditional_logic' => 0,
//                 'wrapper' => array(
//                     'width' => '',
//                     'class' => '',
//                     'id' => '',
//                 ),
//                 'layout' => 'block',
//                 'sub_fields' => array(
//                     array(
//                         'key' => 'field_'. $term_slug .'_b008586',
//                         'label' => $term->name . ' Block 2 Title',
//                         'name' => $term_slug . '_block_2_title',
//                         'aria-label' => '',
//                         'type' => 'text',
//                         'instructions' => '',
//                         'required' => 0,
//                         'conditional_logic' => 0,
//                         'wrapper' => array(
//                             'width' => '',
//                             'class' => '',
//                             'id' => '',
//                         ),
//                         'default_value' => 'Pure and Natural',
//                         'maxlength' => '',
//                         'placeholder' => '',
//                         'prepend' => '',
//                         'append' => '',
//                     ),
//                     array(
//                         'key' => 'field_'. $term_slug .'_b00a877',
//                         'label' => $term->name . ' Block 2 Icons',
//                         'name' => $term_slug . '_block_2_icons',
//                         'aria-label' => '',
//                         'type' => 'repeater',
//                         'instructions' => '',
//                         'required' => 0,
//                         'conditional_logic' => 0,
//                         'wrapper' => array(
//                             'width' => '',
//                             'class' => '',
//                             'id' => '',
//                         ),
//                         'layout' => 'table',
//                         'pagination' => 0,
//                         'min' => 0,
//                         'max' => 3,
//                         'collapsed' => '',
//                         'button_label' => 'Add Icon',
//                         'rows_per_page' => 20,
//                         'sub_fields' => array(
//                             array(
//                                 'key' => 'field_'. $term_slug .'_b00e6f9',
//                                 'label' => $term->name . ' Block 2 Icon',
//                                 'name' => $term_slug . '_block_2_icon',
//                                 'aria-label' => '',
//                                 'type' => 'image',
//                                 'instructions' => '',
//                                 'required' => 0,
//                                 'conditional_logic' => 0,
//                                 'wrapper' => array(
//                                     'width' => '',
//                                     'class' => '',
//                                     'id' => '',
//                                 ),
//                                 'return_format' => 'array',
//                                 'library' => 'all',
//                                 'default_value' => '',
//                                 'min_width' => '',
//                                 'min_height' => '',
//                                 'min_size' => '',
//                                 'max_width' => '',
//                                 'max_height' => '',
//                                 'max_size' => '',
//                                 'mime_types' => '',
//                                 'preview_size' => 'thumbnail',
//                                 'parent_repeater' => 'field_'. $term_slug .'_b00a877',
//                             ),
//                             array(
//                                 'key' => 'field_'. $term_slug .'_6dbd5ec',
//                                 'label' => $term->name . ' Block 2 Title',
//                                 'name' => $term_slug . '_block_2_title',
//                                 'aria-label' => '',
//                                 'type' => 'text',
//                                 'instructions' => '',
//                                 'required' => 0,
//                                 'conditional_logic' => 0,
//                                 'wrapper' => array(
//                                     'width' => '',
//                                     'class' => '',
//                                     'id' => '',
//                                 ),
//                                 'default_value' => '',
//                                 'maxlength' => '',
//                                 'placeholder' => '',
//                                 'prepend' => '',
//                                 'append' => '',
//                                 'parent_repeater' => 'field_'. $term_slug .'_b00a877',
//                             ),
//                             array(
//                                 'key' => 'field_'. $term_slug .'_b01053e',
//                                 'label' => $term->name . ' Block 2 Icon Content',
//                                 'name' => $term_slug . '_block_2_icon_content',
//                                 'aria-label' => '',
//                                 'type' => 'textarea',
//                                 'instructions' => '',
//                                 'required' => 0,
//                                 'conditional_logic' => 0,
//                                 'wrapper' => array(
//                                     'width' => '',
//                                     'class' => '',
//                                     'id' => '',
//                                 ),
//                                 'default_value' => '',
//                                 'maxlength' => '',
//                                 'rows' => '',
//                                 'placeholder' => '',
//                                 'new_lines' => '',
//                                 'parent_repeater' => 'field_'. $term_slug .'_b00a877',
//                             ),
//                             array(
//                                 'key' => 'field_'. $term_slug .'_98634f6',
//                                 'label' => $term->name . ' Block 2 Page Link',
//                                 'name' => $term_slug . '_block_2_page_link',
//                                 'aria-label' => '',
//                                 'type' => 'page_link',
//                                 'instructions' => '',
//                                 'required' => 0,
//                                 'conditional_logic' => 0,
//                                 'wrapper' => array(
//                                     'width' => '',
//                                     'class' => '',
//                                     'id' => '',
//                                 ),
//                                 'post_type' => array(
//                                     0 => 'page',
//                                 ),
//                                 'post_status' => array(
//                                     0 => 'publish',
//                                 ),
//                                 'taxonomy' => '',
//                                 'allow_archives' => 0,
//                                 'multiple' => 0,
//                                 'allow_null' => 0,
//                                 'parent_repeater' => 'field_'. $term_slug .'_b00a877',
//                             ),
//                         ),
//                     ),
//                 ),
//             ),
//             array(
//                 'key' => 'field_'. $term_slug .'_afe625f',
//                 'label' => $term->name . ' Block 3',
//                 'name' => $term_slug . '_block_3',
//                 'aria-label' => '',
//                 'type' => 'group',
//                 'instructions' => '',
//                 'required' => 0,
//                 'conditional_logic' => 0,
//                 'wrapper' => array(
//                     'width' => '',
//                     'class' => '',
//                     'id' => '',
//                 ),
//                 'layout' => 'block',
//                 'sub_fields' => array(
//                     array(
//                         'key' => 'field_'. $term_slug .'_b018a72',
//                         'label' => $term->name . ' Block 3 Title',
//                         'name' => $term_slug . '_block_3_title',
//                         'aria-label' => '',
//                         'type' => 'text',
//                         'instructions' => '',
//                         'required' => 0,
//                         'conditional_logic' => 0,
//                         'wrapper' => array(
//                             'width' => '',
//                             'class' => '',
//                             'id' => '',
//                         ),
//                         'default_value' => 'Product Menu',
//                         'maxlength' => '',
//                         'placeholder' => '',
//                         'prepend' => '',
//                         'append' => '',
//                     ),
//                 ),
//             ),
//             array(
//                 'key' => 'field_'. $term_slug .'_afea019',
//                 'label' => $term->name . ' Block 4',
//                 'name' => $term_slug . '_block_4',
//                 'aria-label' => '',
//                 'type' => 'group',
//                 'instructions' => '',
//                 'required' => 0,
//                 'conditional_logic' => 0,
//                 'wrapper' => array(
//                     'width' => '',
//                     'class' => '',
//                     'id' => '',
//                 ),
//                 'layout' => 'block',
//                 'sub_fields' => array(
//                     array(
//                         'key' => 'field_'. $term_slug .'_b01c88b',
//                         'label' => $term->name . ' Block 4 Title',
//                         'name' => $term_slug . '_block_4_title',
//                         'aria-label' => '',
//                         'type' => 'text',
//                         'instructions' => '',
//                         'required' => 0,
//                         'conditional_logic' => 0,
//                         'wrapper' => array(
//                             'width' => '',
//                             'class' => '',
//                             'id' => '',
//                         ),
//                         'default_value' => 'Product Indications',
//                         'maxlength' => '',
//                         'placeholder' => '',
//                         'prepend' => '',
//                         'append' => '',
//                     ),
//                     array(
//                         'key' => 'field_'. $term_slug .'_b01e8e7',
//                         'label' => $term->name . ' Block 4 Content',
//                         'name' => $term_slug . '_block_4_content',
//                         'aria-label' => '',
//                         'type' => 'textarea',
//                         'instructions' => '',
//                         'required' => 0,
//                         'conditional_logic' => 0,
//                         'wrapper' => array(
//                             'width' => '',
//                             'class' => '',
//                             'id' => '',
//                         ),
//                         'default_value' => '',
//                         'maxlength' => '',
//                         'rows' => '',
//                         'placeholder' => '',
//                         'new_lines' => '',
//                     ),
//                 ),
//             ),
//             array(
//                 'key' => 'field_'. $term_slug .'_afebf26',
//                 'label' => $term->name . ' Page Link',
//                 'name' => $term_slug . '_page_link',
//                 'aria-label' => '',
//                 'type' => 'page_link',
//                 'instructions' => '',
//                 'required' => 0,
//                 'conditional_logic' => 0,
//                 'wrapper' => array(
//                     'width' => '',
//                     'class' => '',
//                     'id' => '',
//                 ),
//                 'post_type' => array(
//                     0 => 'page',
//                 ),
//                 'post_status' => array(
//                     0 => 'publish',
//                 ),
//                 'taxonomy' => '',
//                 'allow_archives' => 0,
//                 'multiple' => 0,
//                 'allow_null' => 0,
//             ),
//         ),
//         'location' => array(
//             array(
//                 array(
//                     'param' => 'page_template',
//                     'operator' => '==',
//                     'value' => 'page-' . $template_slug . '.php',
//                 ),
//             ),
//         ),
//         'menu_order' => 0,
//         'position' => 'normal',
//         'style' => 'default',
//         'label_placement' => 'top',
//         'instruction_placement' => 'label',
//         'hide_on_screen' => '',
//         'active' => true,
//         'description' => '',
//         'show_in_rest' => 0,
//     ) );
// } );
// }




add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
  return 'class="text-decoration-none text-primary"';
}




add_action('wpcf7_init', 'custom_acf_file_url_form_tag');

function custom_acf_file_url_form_tag(){
    wpcf7_add_form_tag('acf_file_url', 'custom_acf_file_url_form_tag_handler');
}

function custom_acf_file_url_form_tag_handler($tag){
    global $post;
    // Get the URL of the ACF file field named 'product_data_sheet_file'
    $acf_field = get_field('product_data_sheet_file', $post_id);
    $url = isset($acf_field['url']) ? $acf_field['url'] : '';

    // Return the URL if available, otherwise return empty string
    return $url;
}



// remove CF7 P and SPAN
add_filter('wpcf7_autop_or_not', '__return_false');
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    $content = str_replace('<br />', '', $content);
    return $content;
});




