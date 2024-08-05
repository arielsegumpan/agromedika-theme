
<?php
/**
 * Template Name: Agrimedika Shop
 * @package agromedika
 */
get_header();
$woo_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
// $shop_page_id = wc_get_page_id('shop');
?>

    <main>
        <section id="products-main" class="bg-lteal">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8 text-center mx-auto mb-5">
                <h1 class="fw-bold text-black"><?php echo esc_html__( 'Our Products', 'agromedika' );?></h1>
                <p class="mt-4 text-black">
                  <?php esc_html__('Agromediko supplies premium Philippine botanical and plant extracts in  extract and powder forms for companies that manufacture herbal supplements, biopharma and nutraceuticals, functional food and beverages, organic personal care and cosmetic products, and animal feed.  We also offer and pre-mix herbal extracts and customised solutions based on customer demand.', 'agromedika');?>
                </p>
              </div>
            </div>
            <div class="row">
              <div>
                <?php woocommerce_content(); ?>
              </div>
            </div>
          </div>
        </section>
    </main>


<?php get_footer()?>