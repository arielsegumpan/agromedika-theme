<?php if(have_posts()): while(have_posts()) : the_post(); ?>
    <?php 
    $pharmaceutical_block_4 = get_acf_field('pharmaceutical_block_4');
    $pharmaceutical_page_link = get_acf_field('pharmaceutical_page_link');
    ?>

    <section id="product_cat" class="bg-lteal">
        <div class="container">
            <div class="row mb-5 pb-lg-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold text-black">
                        <?php echo !empty($pharmaceutical_block_3['pharmaceutical_block_3_title']) ? esc_html($pharmaceutical_block_3['pharmaceutical_block_3_title']) : esc_html('Product Menu'); ?>
                    </h2>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 g-3 row-cols-md-4 g-lg-5 justify-content-center align-items-center">
            <?php echo shortcode_exists('agromedika_get_approve_doh_product') ? do_shortcode('[agromedika_get_approve_doh_product]') : ''; ?>  
            </div>

            <?php if (!empty($pharmaceutical_page_link)) : ?>
            <div class="row mt-5 pt-lg-4">
                <div class="col-6 mx-auto text-center">
                    <a href="<?php echo esc_url($pharmaceutical_page_link) ?>" class="text-decoration-none text-black">
                        <i class="bi bi-arrow-right me-3"></i><?php echo esc_html('View More'); ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

<?php endwhile; endif; ?>
