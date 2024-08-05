<?php if(have_posts()): while(have_posts()) : the_post(); ?>
    <?php
    $dietary_supplements_block_4 = get_acf_field('dietary_supplements_block_4');
    $dietary_supplements_page_link = get_acf_field('dietary_supplements_page_link');
    ?>

    <section id="product_cat" class="bg-white">
        <div class="container">
            <div class="row mb-5 pb-lg-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold text-black">
                        <?php echo !empty($dietary_supplements_block_4['dietary_supplements_block_4_title']) ? esc_html($dietary_supplements_block_4['dietary_supplements_block_4_title']) : esc_html('Product Menu'); ?>
                    </h2>
                </div>
            </div> 
            <div class="row">

                <div class="col-12 col-lg-8 mx-auto">
                <?php echo shortcode_exists('get_supplements_prod_cat_display') ? do_shortcode('[get_supplements_prod_cat_display]') : ''; ?> 
                </div>

            </div>

            <?php if (!empty($dietary_supplements_page_link)) : ?>
            <div class="row mt-5 pt-lg-4">
                <div class="col-6 mx-auto text-center">
                    <a href="<?php echo esc_url($dietary_supplements_page_link) ?>" class="text-decoration-none text-primary fw-bold">
                        <i class="bi bi-arrow-right me-3"></i><?php echo esc_html('Back to All Herbs'); ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

<?php endwhile; endif; ?>
