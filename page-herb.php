<?php
/**
 * Template Name: All Herbs
 * @package agromedika
 */

get_header();

$herb_page_main_section = get_acf_field('herb_page_main_section');
$herbs_indication = $herb_page_main_section['herbs_indication'];

?>

<main>
    <section id="prod_jumbotron" class="bg-lteal">  
        <div class="jumb-overlay"></div>
    </section>

    <?php if($herb_page_main_section['herb_page_title']) : ?>
    <section id="products-main">
        <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8 mx-auto my-auto text-center mb-5 pb-3 pb-md-4 pb-lg-5">
              <h1 class="fw-bold text-black"><?php echo !empty($herb_page_main_section['herb_page_title']) ? esc_html($herb_page_main_section['herb_page_title']) : esc_html('Our Herbs') ;?></h1>
                    <p class="text-secondary mt-4"><?php echo !empty($herb_page_main_section['herb_page_content']) ? nl2br(esc_textarea($herb_page_main_section['herb_page_content'])) : esc_html('No post content') ;?></p>
              </div>
            </div>
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

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
            <?php
            $categories = get_categories(array(
                'taxonomy' => 'herb-category',
                'orderby' => 'name',
                'order' => 'ASC',
                'number' => 6,
            ));

            if ($categories) :
                foreach ($categories as $category) :
                    $posts = new WP_Query(array(
                        'post_type' => 'herb',
                        'posts_per_page' => 6,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'herb-category',
                                'field' => 'id',
                                'terms' => $category->term_id,
                            ),
                        ),
                    ));

                    if ($posts->have_posts()) :
            ?>
                        <div class="col">
                            <div class="card bg-transparent border-0 text-center">
                                <h4 class="mb-3"><?php echo esc_html($category->name); ?></h4>
                                <div class="list-group list-group-flush">
                                    <?php
                                    while ($posts->have_posts()) :
                                        $posts->the_post();
                                    ?>
                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="list-group-item border-0 text-primary" aria-current="true"><?php echo esc_html(get_the_title()); ?></a>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    if ($posts->found_posts >= 6) :
                                    ?>
                                        <div class="list-group-item mt-3">
                                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="btn text-primary fw-bold rounded-3" aria-current="true">
                                                <i class="bi bi-arrow-right me-2"></i>
                                                <?php esc_html_e('See More'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
            <?php
                    endif;
                endforeach;
            endif;
        endif;?>

        </div>
    </section>
</main>

<?php get_footer(); ?>
