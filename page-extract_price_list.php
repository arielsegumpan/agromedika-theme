<?php
/**
 * Template Name: Extract Price Lists
 * @package agromedika
 */

 get_header();

$acf_fields = array();

// Retrieve and store ACF fields
$acf_fields['extract_price_jumbotron'] = get_field('extract_price_jumbotron');

$jumbotron_image_url = $acf_fields['extract_price_jumbotron']['extract_price_jumbotron_image']['url'];
$jumbotron_title = $acf_fields['extract_price_jumbotron']['extract_price_jumbotron_title'];
$jumbotron_content = $acf_fields['extract_price_jumbotron']['extract_price_jumbotron_content'];

?>

<main>
  <?php if (!empty($jumbotron_image_url) && !empty($jumbotron_title)) : ?>
      <section id="jumbotron-2" style="background-image: url('<?php echo esc_url($jumbotron_image_url); ?>');">
          <div class="container">
              <div class="row">
                  <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                      <h1 class="fw-bold text-black"><?php echo esc_html($jumbotron_title); ?></h1>
                      <h5 class="text-black mt-4">
                          <?php echo nl2br(esc_textarea($jumbotron_content)); ?>
                      </h5>
                  </div>
              </div>
          </div>
          <div class="jumb-overlay"></div>
      </section>
  <?php endif; ?>

    <section id="who">
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <?php if(have_posts( ) && !empty(get_the_content())) : while(have_posts(  )) : the_post() ; ?>
                      <?php the_content() ?>
                    <?php endwhile; else:?>
                     <div class="text-center">
                      <h4 class="text-black mb-4">No post content</h4>
                      <a href="<?php echo esc_url(site_url('/')) ?>" class="btn btn-primary px-4 py-3 rounded-4 text-lteal"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html__( 'Back to Page', 'agromedika') ?></a>
                     </div>
                  <?php endif;?>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>
