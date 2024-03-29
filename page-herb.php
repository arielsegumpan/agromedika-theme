<?php
/**
 * Template Name: All Herbs
 * @package agromedika
 */

get_header();

$herb_page_main_section = get_acf_field('herb_page_main_section');
$herbs_indication = $herb_page_main_section['herbs_indication'];

?>

<main class="bg-lteal">
    
    <section id="jumbotron-2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9 mx-auto my-auto text-center mt-5 pt-lg-5 pt-xl-0 mt-xl-3">
                    <h1 class="fw-bold text-black"><?php echo !empty($herb_page_main_section['herb_page_title']) ? esc_html($herb_page_main_section['herb_page_title']) : esc_html('Our Herbs') ;?></h1>
                    <p class="text-secondary mt-4"><?php echo !empty($herb_page_main_section['herb_page_content']) ? nl2br(esc_textarea($herb_page_main_section['herb_page_content'])) : esc_html('No post content') ;?></p>
                </div>
            </div>
        </div>
        <div class="jumb-overlay"></div>
    </section>

    <?php if($herb_page_main_section['herb_page_title']) : ?>
    <section id="products-main">
        <div class="container">
            <?php get_template_part('template-parts/components/blog/herb', 'page');?>
        </div>
    </section>
    <?php endif; ?>

    <section id="prod_cat_pharm">
        <div class="container">
            <?php if(!empty($herbs_indication['herb_indication_title'])) : ?>
            <div class="row mb-5 pb-4">
                <div class="col-12 col-lg-8 mx-auto text-center">
                    <h2 class="fw-bold"><?php echo esc_html($herbs_indication['herb_indication_title']);?></h2>
                    <?php if(!empty($herbs_indication['herb_indication_content'])) : ?>
                    <p class="lh-lg text-secondary mt-4"><?php echo html_entity_decode(esc_textarea($herbs_indication['herb_indication_content']));?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif;

            $term_slugs = array();

            // Check if herb product indications exist and is an array
            if (!empty($herbs_indication['herb_product_indication']) && is_array($herbs_indication['herb_product_indication'])) {
                foreach ($herbs_indication['herb_product_indication'] as $get_herb_terms) {
                    if (!empty($get_herb_terms->slug) && !in_array($get_herb_terms->slug, $term_slugs)) {
                        // Add the term slug to the array
                        $term_slugs[] = $get_herb_terms->slug;
                    }
                }
            }

            $output = '';
            $categories = get_terms(array(
                'taxonomy' => 'herb-category',
                'hide_empty' => false,
                'slug' => $term_slugs, // Pass the collected term slugs to retrieve specific terms
            ));

            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $category) {
                    $args = array(
                        'post_type' => 'herb',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'herb-category',
                                'field' => 'slug',
                                'terms' => $category->slug,
                            ),
                        ),
                    );

                    $query = new WP_Query($args);

                    // If there are posts for the current term, generate output
                    if ($query->have_posts()) {
                        $output .= '<div class="row mb-5 pb-lg-3">';
                        $output .= '<div class="col-12">';
                        $output .= '<h4>' . esc_html($category->name) . '</h4>';
                        $output .= '<div class="table-responsive">';
                        $output .= '<table class="table table-striped table-borderless mt-4 align-middle">';
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
            }

            echo $output;
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
