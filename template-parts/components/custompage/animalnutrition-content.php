<?php if(have_posts()): while(have_posts()) : the_post(); ?>
    <?php 
    $animal_nutrition_page_link = get_acf_field('animal_nutrition_page_link');
    ?>

    <section id="product_cat" class="bg-white">
        <div class="container">
            <div class="row mb-5 pb-lg-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold text-black">
                        <?php echo !empty($animal_nutrition_block_3['animal_nutrition_block_3_title']) ? esc_html($animal_nutrition_block_3['animal_nutrition_block_3_title']) : esc_html('Product Menu'); ?>
                    </h2>
                </div>
            </div>
            
            <?php echo shortcode_exists('get_animal_nutrition_categories') ? do_shortcode('[get_animal_nutrition_categories]') : ''; ?>

            <?php if (!empty($animal_nutrition_page_link)) : ?>
            <div class="row mt-5 pt-lg-4">
                <div class="col-6 mx-auto text-center">
                    <a href="<?php echo esc_url($animal_nutrition_page_link) ?>" class="text-decoration-none text-black">
                        <i class="bi bi-arrow-right me-3"></i><?php echo esc_html('Back to All Herbs'); ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
<?php endwhile; endif; ?>
