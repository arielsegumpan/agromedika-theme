<?php
/**
 * 
 * @package herbanext
 */
get_header('shop');
$woo_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
$shop_page_id = wc_get_page_id('shop');
$shop = get_field('herbanext_shop', $shop_page_id);
?>
    <main>
        <!-- jumbotron -->
        <section id="jumbotron_product" class="w-100 position-relative">
            <?php if(!empty($shop['shop_background_image']['url'])):?>
            <img src="<?php echo esc_url($shop['shop_background_image']['url']) ?>" alt="<?php echo esc_attr($shop['shop_background_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
            <?php else : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($woo_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
            <?php endif ?>
            <div class="container position-absolute">
                <div class="col-12 col-md-8 col-lg-6 me-auto text-center text-md-start my-auto">
                    <h1 class="display-2 museo fw-bold text-success">
                      <?php echo esc_html_e('Our Products')?>
                    </h1>
                    <h6 class="mt-4 fs-6">
                        <!-- display breadcrumb -->
                    <?php class_exists('WooCommerce') ? woocommerce_breadcrumb() : '' ?>
                    </h6>
                </div>
            </div>
        </section>  
        <section id="product_lists">
            <?php if (is_shop() && !is_product()) : ?> 
            <div class="featured_products mb-5 pb-5">
                <div class="container">
                    <div class="col mb-5">
                        <h3 class="fw-bold"> 
                            <i class="bi bi-bookmark-star me-3 bg-success text-white px-3 py-2 rounded-4"></i><?php echo esc_html_e('Featured Products') ?>
                        </h3>
                    </div>
                    <div class="row row-cols-2 row-cols-lg-4 row-gap-4 texct-center">
                        <?php echo do_shortcode('[custom_featured_products]'); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(woocommerce_product_loop()):?>
            <div class="lists">
                <div class="container">
                    <div class="row">
                        <div class="col-12 <?php echo (is_product() || is_singular()) ? 'col-lg-9 mb-5 mb-lg-0 pb-4 pb-md-auto' : ''; ?>">
                            <?php if (is_shop() && !is_product()) : ?>
                            <div class="row">
                                <div class="col mb-5">
                                    <h2 class="fw-bold"><i class="bi bi-basket2 me-3 bg-success text-white px-3 py-2 rounded-4"></i><?php echo esc_html_e('Products') ?></h2>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php woocommerce_content(); ?>
                        </div>
                        <?php if ((is_product() || is_singular()) && !is_shop()) : ?>
                            <!-- aside -->
                            <div class="col-12 col-lg-3">
                                <?php is_active_sidebar('herbanext-product-sidebar') ? dynamic_sidebar('herbanext-product-sidebar') : ''?>
                                <hr class="my-5">
                                <div id="product_categories" class="mb-5">
                                    <h4 class="fw-bold museo"><?php echo esc_html_e('Product Categories') ?></h4>
                                    <?php echo do_shortcode( '[herbanext_product_categories]' ) ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </section>
    </main>
<?php get_footer()?>