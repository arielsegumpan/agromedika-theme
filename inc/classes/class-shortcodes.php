<?php
/**
 * Register Shortcodes.
 * @package agromedika
 */
namespace AGROMEDIKA_THEME\Inc;
 use AGROMEDIKA_THEME\Inc\Traits\Singleton;


 class Shortcodes{
    use Singleton;

    private function __construct() {
        // Add your shortcode hooks here
        $this->setup_hooks();
    }

    protected function setup_hooks(){
        add_shortcode('social_share_buttons', array($this, 'social_share_buttons_shortcode'));
        add_shortcode('get_prod_menu_catalogue', [$this,'get_prod_menu_catalogue_shortcode']);
        add_shortcode('agromedika_get_approve_doh_product', [$this, 'agromedika_get_approve_doh_products']);
        add_shortcode('get_supplements_prod_cat_display', [$this, 'get_supplements_prod_cat']);
        add_shortcode('get_oil_prod_categories', [$this, 'get_oils_prod_categories']);
        add_shortcode('get_food_prod_categories', [$this, 'get_foods_prod_categories']);
        add_shortcode('get_personal_cosmetic_categories', [$this, 'get_personal_cosmetics_categories']);
        add_shortcode('get_animal_nutrition_categories', [$this, 'get_animal_nutritions_categories']);
        add_shortcode('get_career_related_categories', [$this,'display_related_categories_shortcode']);
    }

    public function social_share_buttons_shortcode($atts) {
        // Extract attributes (if any), although we're not using any attributes in this example
        extract(shortcode_atts(array(), $atts));

        // Get post information
        $title = get_the_title();
        $url = get_permalink();
        $media = get_the_post_thumbnail_url(get_the_ID());

        // Sanitize the dynamic data
        $title = esc_attr($title);
        $url = esc_url($url);
        $media = esc_url($media);

        // Build the HTML for social share buttons
        $output = '
            <h6 class="fw-bold text-primary ps-0"><i class="bi bi-share me-2"></i>Share this post</h6>
            <ul class="d-flex flex-row mt-2 gap-3 list-unstyled">
                <li>
                    <a class="share-twitter" href="https://twitter.com/intent/tweet?text=' . $title . '&amp;url=' . $url . '&amp;via=hoptravelph" target="_blank">
                        <i class="bi bi-twitter text-primary fs-3"></i>
                    </a>
                </li>
                <li>
                    <a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank">
                        <i class="bi bi-facebook text-primary fs-3"></i>
                    </a>
                </li>
                <li>
                    <a class="share-pinterest" href="http://pinterest.com/pin/create/button/?url=' . $url . '&amp;media=' . $media . '&amp;description=' . $title . '" target="_blank">
                        <i class="bi bi-pinterest text-primary fs-3"></i>
                    </a>
                </li>
                <li class="d-flex flex-row">
                    <a class="share-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&amp;description=' . $title . '" target="_blank">
                        <i class="bi bi-linkedin text-primary fs-3"></i>
                    </a>
                </li>
            </ul>
        ';

        return $output;
    }

    function get_prod_menu_catalogue_shortcode() {
        $categories = get_terms(array(
            'taxonomy' => 'herb-category',
            'hide_empty' => false,
        ));
         
        $output = '';
        
        foreach ($categories as $category) {
            $args = array(
                'post_type' => 'herb',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'herb-category',
                        'field' => 'slug',
                        'terms' => $category->slug, // Sanitization not required, WordPress function get_terms already returns sanitized values
                    ),
                ),
            ); 
        
            $query = new \WP_Query($args);
        
            if ($query->have_posts()) {
                $output .= '<div class="row mb-5 pb-lg-3">';
                $output .= '<div class="col-12">';
                $output .= '<h4>' . esc_html($category->name) . '</h4>';
                $output .= '<div style="overflow-x:auto;">';
                $output .= '<table class="table table-striped table-borderless mt-4">';
                $output .= '<tbody>';
                $output .= '<tr>';
        
                $count = 0;
                while ($query->have_posts()) {
                    $query->the_post();
                    $output .= '<td class="w-25">';
                    $output .= '<a href="' . esc_url(get_permalink()) . '" class="text-primary text-decoration-none">';
                    $output .= esc_html(get_the_title());
                    $output .= '</a>';
                    $output .= '</td>';
        
                    $count++;
                    if ($count % 4 == 0) {
                        $output .= '</tr><tr>';
                    }
                }
        
                $output .= '</tbody>';
                $output .= '</table>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }
        
            wp_reset_postdata();
        }
        
        return $output;
        
    }
    
    function get_supplements_prod_cat(){
    
      // Define an array of possible spellings and cases
        $possible_names = array('Dietary Supplements', 'Dietary Supplement', 'Supplements', 'Supplement', 'Dietary', 'dietary supplements', 'dietary supplement', 'supplements', 'supplement', 'dietary');

        // Initialize the term variable
        $dietary_supplements_term = false;

        // Find the correct term
        foreach ($possible_names as $name) {
            $term = get_term_by('name', $name, 'application-category');
            if ($term && !is_wp_error($term)) {
                $dietary_supplements_term = $term;
                break;
            }
        }

        if ($dietary_supplements_term) {
            // Get all the child terms of the "Dietary Supplements" category
            $child_terms = get_term_children($dietary_supplements_term->term_id, 'application-category');

            // Initialize an array to store the child categories
            $child_categories = array();

            // Output Bootstrap table header
            echo '<div class="table-responsive"><table class="table table-md table-striped align-middle">';
            echo '<thead><tr><th>Products</th>';
            foreach ($child_terms as $child_term_id) {
                $child_term = get_term($child_term_id, 'application-category');
                $child_categories[$child_term_id] = $child_term->name;
                echo '<th>' . esc_html($child_term->name) . '</th>';
            }
            echo '</tr></thead>';
            echo '<tbody class="table-group-divider">';

            // Loop through each post
            $args = array(
                'post_type' => 'herb',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'application-category',
                        'field' => 'term_id',
                        'terms' => $child_terms,
                    ),
                ),
            );

            $query = new \WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $herb_single_contents = get_acf_field('herb_single_contents');
                    $post_id = get_the_ID();
                    echo '<tr><td>
                    <a href="' . esc_url(get_permalink($post_id)) . '" class="text-decoration-none text-primary">';
                     esc_html(get_the_title($post_id));
                    echo '<div class="thumbnail d-flex flex-row g-2 align-items-center">';
                    echo has_post_thumbnail() ? wp_get_attachment_image(get_post_thumbnail_id(), 'cust_img_thumb', false,['class' => 'rounded-4']) : wp_get_attachment_image($herb_single_contents['herbs_gallery'][0]['herb_image']['id'], 'cust_img_thumb', false,['class' => 'rounded-4']);
                    echo '<span class="ms-3">' . esc_html(get_the_title()) . '</span>';
                    echo '</div>';
                     echo '</a>
                    </td>';
                    foreach ($child_terms as $child_term_id) {
                        $has_post = has_term($child_term_id, 'application-category', $post_id);
                        echo '<td>' . ($has_post ? '<i class="bi bi-check-circle text-primary fs-5"></i>' : '<i class="bi bi-circle text-primary fs-5"></i>') . '</td>';
                    }
                    echo '</tr>';
                }
            }

            wp_reset_postdata();

            echo '</tbody>';
            echo '</table></div>';
        } else {
            // Handle case where the term does not exist
            echo 'The term does not exist.';
        }





    }
    //Get herb doh approved
    function agromedika_get_approve_doh_products() {
        $args = array(
            'post_type'      => 'herb',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
            'meta_query' => array(
                array(
                    'key'   => 'herb_single_contents_is_approved_is_approved_by_the_doh',
                    'value' => '1',
                )
            )
        );
     
        $loop = new \WP_Query($args);

        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post(); 
                $scientific_name = get_acf_field('herb_single_contents');
                if ($scientific_name['is_approved']['is_approved_by_the_doh']) :
                    ?>
                    <div class="col">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                            <div class="card mb-3 border-0 bg-transparent">
                                <div class="row g-0 align-items-center">
                                    <div class="col-12 col-xl-4 text-center">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php $featured_image_id = get_post_thumbnail_id();
                                            echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'cust_img_thumb', false, array('class' => 'img-fluid rounded-4'))));
                                        ?>
                                    <?php else:?>
                                        <?php
                                            $scientific_name_id = $scientific_name['herbs_gallery'][0]['herb_image']['id'];
                                            echo html_entity_decode(esc_html(
                                            wp_get_attachment_image($scientific_name_id, 'cust_img_thumb', false,['class' => 'img-fluid rounded-4'])
                                        ));?>
                                    <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-xl-8 text-center text-xl-start mt-3 mt-xl-0">
                                        <div class="card-body ps-2 pt-xl-4">
                                            <h6 class="fw-bold text-primary"><?php the_title(); ?></h6>
                                        <?php if (!empty($scientific_name['herb_scientific_name'])) : ?>
                                            <small class="text-secondary fst-italic">
                                                <?php echo esc_html('(' . $scientific_name['herb_scientific_name'] . ')'); ?>
                                            </small>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p class="text-center"><?php esc_html_e('No herb-approved display.', 'agromedika'); ?></p>
        <?php endif;
    }

    function get_oils_prod_categories(){
       // Initialize output variable
        $output = '';
        $essential_oils_term = '';

        $possible_names = array('Essential Oils', 'Essential Oil', 'Essential', 'Oils', 'essential oils', 'essential oil', 'essential', 'oils', 'essential oil');

        // Find the correct term
        foreach ($possible_names as $name) {
            $term = get_term_by('name', $name, 'application-category');
            if ($term && !is_wp_error($term)) {
                $essential_oils_term = $term;
                break;
            }
        }

        $essential_oils_term;

        // Check if the term exists
        if ($essential_oils_term) {
            // Query posts using WP_Query
            $args = array(
                'post_type' => 'herb',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'application-category',
                        'field' => 'term_id',
                        'terms' => $essential_oils_term->term_id,
                    ),
                ),
            );

            $query = new \WP_Query($args);

            // Check if posts are found
            if ($query->have_posts()) {
                $output .= '<div class="row mb-5 pb-lg-3">'. "\n";
                $output .= '<div class="col-12 table-responsive">';
                $output .= '<table class="table table-md table-striped align-middle">';
                $output .= '<tbody>';
                $output .= '<tr>';

                $count = 0;
                while ($query->have_posts()) {
                    $query->the_post();
                    $herb_single_contents = get_acf_field('herb_single_contents');

                    $output .= '<td class="w-25">';
                    $output .= '<a href="' . esc_url(get_permalink()) . '" class="text-primary text-decoration-none">';
                    // Output the thumbnail
                    $output .= '<div class="thumbnail d-flex flex-row g-2 align-items-center">';
                    $output .= has_post_thumbnail() ? wp_get_attachment_image(get_post_thumbnail_id(), 'cust_img_thumb', false,['class' => 'rounded-4']) : wp_get_attachment_image($herb_single_contents['herbs_gallery'][0]['herb_image']['id'], 'cust_img_thumb', false,['class' => 'rounded-4']);
                    $output .= '<span class="ms-3">' . esc_html(get_the_title()) . '</span>';
                    $output .= '</div>';
                    $output .= '</a>';
                    $output .= '</td>';


                    $count++;
                    if ($count % 4 == 0) {
                        $output .= '</tr><tr>';
                    } 
                }

                $output .= '</tbody>';
                $output .= '</table>';
                $output .= '</div>';
                $output .= '</div>';
            } else {
                // Handle case when no posts are found
                $output .= '<p>No herb posts found for Essential Oils.</p>';
            }

            // Reset post data
            wp_reset_postdata();
        } else {
            // Handle case when term is not found
            $output .= '<p>Term "Essential Oils" not found in application-category taxonomy.</p>';
        }

        // Return output
        return $output;
    }


    function get_foods_prod_categories(){
        // Initialize output variable
         $output = '';
         $essential_oils_term = '';
 
         $possible_names = array('Functional Foods', 'Functional Food', 'Functional', 'Food', 'functional food', 'functional', 'food', 'functional foods');
 
         // Find the correct term
         foreach ($possible_names as $name) {
             $term = get_term_by('name', $name, 'application-category');
             if ($term && !is_wp_error($term)) {
                 $essential_oils_term = $term;
                 break;
             }
         }
 
         $essential_oils_term;
 
         // Check if the term exists
         if ($essential_oils_term) {
             // Query posts using WP_Query
             $args = array(
                 'post_type' => 'herb',
                 'posts_per_page' => -1,
                 'tax_query' => array(
                     array(
                         'taxonomy' => 'application-category',
                         'field' => 'term_id',
                         'terms' => $essential_oils_term->term_id,
                     ),
                 ),
             );
 
             $query = new \WP_Query($args);
 
             // Check if posts are found
             if ($query->have_posts()) {
                 $output .= '<div class="row mb-5 pb-lg-3">'. "\n";
                 $output .= '<div class="col-12 table-responsive">';
                 $output .= '<table class="table table-md table-striped align-middle">';
                 $output .= '<tbody>';
                 $output .= '<tr>';
 
                 $count = 0;
                 while ($query->have_posts()) {
                     $query->the_post();
                     $herb_single_contents = get_acf_field('herb_single_contents');
 
                     $output .= '<td class="w-25">';
                     $output .= '<a href="' . esc_url(get_permalink()) . '" class="text-primary text-decoration-none">';
                     // Output the thumbnail
                     $output .= '<div class="thumbnail d-flex flex-row g-2 align-items-center">';
                     $output .= has_post_thumbnail() ? wp_get_attachment_image(get_post_thumbnail_id(), 'cust_img_thumb', false,['class' => 'rounded-4']) : wp_get_attachment_image($herb_single_contents['herbs_gallery'][0]['herb_image']['id'], 'cust_img_thumb', false,['class' => 'rounded-4']);
                     $output .= '<span class="ms-3">' . esc_html(get_the_title()) . '</span>';
                     $output .= '</div>';
                     $output .= '</a>';
                     $output .= '</td>';
 
 
                     $count++;
                     if ($count % 4 == 0) {
                         $output .= '</tr><tr>';
                     } 
                 }
 
                 $output .= '</tbody>';
                 $output .= '</table>';
                 $output .= '</div>';
                 $output .= '</div>';
             } else {
                 // Handle case when no posts are found
                 $output .= '<p>No herb posts found for Functional Food.</p>';
             }
 
             // Reset post data
             wp_reset_postdata();
         } else {
             // Handle case when term is not found
             $output .= '<p>Term "Functional Food" not found.</p>';
         }
 
         // Return output
         return $output;
    }

    function get_personal_cosmetics_categories(){
        // Initialize output variable
         $output = '';
         $personal_cosmetics_term = '';
 
         $possible_names = array('Personal Care/Cosmetic','Personal Care/Cosmetics', 'personal care/cosmetics', 'personal care/cosmetic', 'Personal Care Cosmetics', 'Personal Care Cosmetic', 'Personal Care', 'Personal', 'Cosmetics', 'Care Cosmetics', 'Personal Cosmetics', 'personal care cosmetics');
 
         // Find the correct term
         foreach ($possible_names as $name) {
             $term = get_term_by('name', $name, 'application-category');
             if ($term && !is_wp_error($term)) {
                 $personal_cosmetics_term = $term;
                 break;
             }
         }
 
         $personal_cosmetics_term;
 
         // Check if the term exists
         if ($personal_cosmetics_term) {
             // Query posts using WP_Query
             $args = array(
                 'post_type' => 'herb',
                 'posts_per_page' => -1,
                 'tax_query' => array(
                     array(
                         'taxonomy' => 'application-category',
                         'field' => 'term_id',
                         'terms' => $personal_cosmetics_term->term_id,
                     ),
                 ),
             );
 
             $query = new \WP_Query($args);
 
             // Check if posts are found
             if ($query->have_posts()) {
                 $output .= '<div class="row mb-5 pb-lg-3">'. "\n";
                 $output .= '<div class="col-12 table-responsive">';
                 $output .= '<table class="table table-md table-striped align-middle">';
                 $output .= '<tbody>';
                 $output .= '<tr>';
 
                 $count = 0;
                 while ($query->have_posts()) {
                     $query->the_post();
                     $herb_single_contents = get_acf_field('herb_single_contents');
 
                     $output .= '<td class="w-25">';
                     $output .= '<a href="' . esc_url(get_permalink()) . '" class="text-primary text-decoration-none">';
                     // Output the thumbnail
                     $output .= '<div class="thumbnail d-flex flex-row g-2 align-items-center">';
                     $output .= has_post_thumbnail() ? wp_get_attachment_image(get_post_thumbnail_id(), 'cust_img_thumb', false,['class' => 'rounded-4']) : wp_get_attachment_image($herb_single_contents['herbs_gallery'][0]['herb_image']['id'], 'cust_img_thumb', false,['class' => 'rounded-4']);
                     $output .= '<span class="ms-3">' . esc_html(get_the_title()) . '</span>';
                     $output .= '</div>';
                     $output .= '</a>';
                     $output .= '</td>';
 
 
                     $count++;
                     if ($count % 4 == 0) {
                         $output .= '</tr><tr>';
                     } 
                 }
 
                 $output .= '</tbody>';
                 $output .= '</table>';
                 $output .= '</div>';
                 $output .= '</div>';
             } else {
                 // Handle case when no posts are found
                 $output .= '<p>No herb posts found for Personal Care Cosmetics.</p>';
             }
             // Reset post data
             wp_reset_postdata();
         } else {
             // Handle case when term is not found
             $output .= '<p>No assigned products for "Personal Care Cosmetics".</p>';
         }
 
         // Return output
         return $output;
    }


    function get_animal_nutritions_categories(){
        // Initialize output variable
         $output = '';
         $anim_nut_term = '';
 
         $possible_names = array('Animal Nutritions', 'Animal Nutrition', 'Animal', 'Nutritions', 'animal nutritions', 'animal nutrition', 'animal', 'nutrition', 'animals');
 
         // Find the correct term
         foreach ($possible_names as $name) {
             $term = get_term_by('name', $name, 'application-category');
             if ($term && !is_wp_error($term)) {
                 $anim_nut_term = $term;
                 break;
             }
         }
 
         $anim_nut_term;
 
         // Check if the term exists
         if ($anim_nut_term) {
             // Query posts using WP_Query
             $args = array(
                 'post_type' => 'herb',
                 'posts_per_page' => -1,
                 'tax_query' => array(
                     array(
                         'taxonomy' => 'application-category',
                         'field' => 'term_id',
                         'terms' => $anim_nut_term->term_id,
                     ),
                 ),
             );
 
             $query = new \WP_Query($args);
 
             // Check if posts are found
             if ($query->have_posts()) {
                 $output .= '<div class="row mb-5 pb-lg-3">'. "\n";
                 $output .= '<div class="col-12 table-responsive">';
                 $output .= '<table class="table table-md table-striped align-middle">';
                 $output .= '<tbody>';
                 $output .= '<tr>';
 
                 $count = 0;
                 while ($query->have_posts()) {
                     $query->the_post();
                     $herb_single_contents = get_acf_field('herb_single_contents');
 
                     $output .= '<td class="w-25">';
                     $output .= '<a href="' . esc_url(get_permalink()) . '" class="text-primary text-decoration-none">';
                     // Output the thumbnail
                     $output .= '<div class="thumbnail d-flex flex-row g-2 align-items-center">';
                     $output .= has_post_thumbnail() ? wp_get_attachment_image(get_post_thumbnail_id(), 'cust_img_thumb', false,['class' => 'rounded-4']) : wp_get_attachment_image($herb_single_contents['herbs_gallery'][0]['herb_image']['id'], 'cust_img_thumb', false,['class' => 'rounded-4']);
                     $output .= '<span class="ms-3">' . esc_html(get_the_title()) . '</span>';
                     $output .= '</div>';
                     $output .= '</a>';
                     $output .= '</td>';
 
 
                     $count++;
                     if ($count % 4 == 0) {
                         $output .= '</tr><tr>';
                     } 
                 }
 
                 $output .= '</tbody>';
                 $output .= '</table>';
                 $output .= '</div>';
                 $output .= '</div>';
             } else {
                 // Handle case when no posts are found
                 $output .= '<p>No herb posts found for Essential Oils.</p>';
             }
 
             // Reset post data
             wp_reset_postdata();
         } else {
             // Handle case when term is not found
             $output .= '<p>Term "Essential Oils" not found in application-category taxonomy.</p>';
         }
 
         // Return output
         return $output;
    }
    


    function display_related_categories_shortcode($atts) {
        // Get the post ID from the shortcode attributes or the global $post
        $post_id = !empty($atts['post_id']) ? intval($atts['post_id']) : get_the_ID();
    
        // Get the terms (categories) associated with the career post in the 'career-category' taxonomy
        $terms = get_the_terms($post_id, 'career-category');
    
        // Initialize output variable
        $output = '';
    
        // Check if terms were found
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                // Generate the HTML for each category
                $category_output = '<a href="' . esc_url(get_term_link($term)) . '" class="text-decoration-none text-lteal">';
                $category_output .= '<span class="badge text-bg-primary px-2 rounded-2"><small class="text-lteal">';
                $category_output .= esc_html($term->name);
                $category_output .= '</small></span></a>';
                // Add category output to overall output
                $output .= $category_output;
            }
        }
    
        return $output;
    }
    
    
    
 }