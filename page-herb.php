<?php
/**
 * Template Name: All Herbs
 * @package agromedika
 */

get_header();

$featured_image_url = get_the_post_thumbnail_url(get_the_ID());
$featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

$herb_page_main_section = get_acf_field('herb_page_main_section');
?>

<main>
    
    <section id="jumbotron-2">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-9 mx-auto my-auto text-center mt-5 pt-lg-5 pt-xl-0 mt-xl-3">
              <h1 class="fw-bold text-black"><?php echo esc_html($herb_page_main_section['herb_page_title']) ;?></h1>
              <p class="text-secondary mt-4"><?php echo nl2br(esc_textarea( $herb_page_main_section['herb_page_content']) ) ;?></p>
            </div>
          </div>
        </div>
        <div class="jumb-overlay"></div>
      </section>

    <?php if($herb_page_main_section['herb_page_title']) : ?>
    <section id="products-main" >
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 g-lg-5">
                  <?php get_template_part('template-parts/components/blog/herb', 'page');?>
                </div>
              </div>
              <div class="col-12"> 
                    <div class="d-flex flex-row justify-content-center align-items-center gap-3">
                        <?php
                        $prev_post = get_previous_post(true, '', 'herb');
                        if (!empty($prev_post)) {
                            echo '<a href="' . esc_url(get_permalink($prev_post->ID)) . '" class="btn btn-primary px-4 py-3">Previous<i class="bi bi-arrow-left ms-2"></i></a>';
                        }

                        $next_post = get_next_post(true, '', 'herb');
                        if (!empty($next_post)) {
                            echo '<a href="' . esc_url(get_permalink($next_post->ID)) . '" class="btn btn-primary px-4 py-3"><i class="bi bi-arrow-right me-2"></i>Next</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
          </div>
        </section>
    <?php endif; ?>

    <section id="prod_cat_pharm">
        <div class="container">
            <?php if(!empty($animal_nutrition_block_4['animal_nutrition_block_4_title']) && !empty($animal_nutrition_block_4['animal_nutrition_block_4_content']))  :?>
            <div class="row mb-5 pb-4">
                <div class="col-12 col-lg-8 mx-auto text-center">
                    <h2 class="fw-bold"><?php echo esc_html($animal_nutrition_block_4['animal_nutrition_block_4_title']);?></h2>
                    <p class="lh-lg text-secondary mt-4"><?php echo html_entity_decode(esc_textarea($animal_nutrition_block_4['animal_nutrition_block_4_content']));?></p>
                </div>
            </div>
            <?php endif;?>
            <?php echo shortcode_exists('get_prod_menu_catalogue') ? do_shortcode('[get_prod_menu_catalogue]') : ''; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
