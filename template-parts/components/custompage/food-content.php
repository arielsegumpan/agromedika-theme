<?php if(have_posts()): while(have_posts()) : the_post(); ?>
    <?php 
    $functional_food_block_4 = get_acf_field('functional_food_block_4');
    $functional_food_page_link = get_acf_field('functional_food_page_link');
    ?>

    <section id="product_cat" class="bg-white">
        <div class="container">
            <div class="row mb-5 pb-lg-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold text-black">
                        <?php echo !empty($functional_food_block_4['functional_food_block_4_title']) ? esc_html($functional_food_block_4['functional_food_block_4_title']) : esc_html('Product Menu'); ?>
                    </h2>
                </div>
            </div>
            
            <?php echo shortcode_exists('get_food_prod_categories') ? do_shortcode('[get_food_prod_categories]') : ''; ?>  

            <?php if (!empty($functional_food_page_link)) : ?>
            <div class="row mt-5 pt-lg-4">
                <div class="col-6 mx-auto text-center">
                    <a href="<?php echo esc_url($functional_food_page_link) ?>" class="text-decoration-none text-primary fw-bold">
                        <i class="bi bi-arrow-right me-3"></i><?php echo esc_html('Back to All Herbs'); ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

<?php endwhile; endif; ?>
