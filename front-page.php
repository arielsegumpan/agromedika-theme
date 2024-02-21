<?php
/**
 * Template Name: Front Page
 * Main template file.
 * @package agromedika
 */
get_header();

// Define array of fields
$acf_fields = array(
    'home_jumbotron' => 'home_jumbotron',
    'home_about' => 'home_about',
    'home_products' => 'home_products',
    'home_grow' => 'home_grow',
    'home_certificate' => 'home_certificate',
    'home_infographics' => 'home_infographics',
    'home_post' => 'home_post',
);

// Initialize an empty array to store the field values
$acf_values = array();

// Loop through the field names and fetch their values
foreach ($acf_fields as $key => $field_name) {
    $acf_values[$key] = get_acf_field($field_name);
}
?>

<main>
    <!-- Jumbotron Section -->
    <?php
    if (!empty($acf_values['home_jumbotron']) && !empty($acf_values['home_jumbotron']['home_jumbotron_image']['url'])) :
    ?>
        <section id="jumbotron" style="background: url('<?php echo esc_url($acf_values['home_jumbotron']['home_jumbotron_image']['url']); ?>') center/cover no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-7 me-auto my-auto text-center text-lg-start">
                        <h1 class="display-3 fw-bold text-black"><?php echo esc_html($acf_values['home_jumbotron']['home_jumbotron_title']); ?></h1>
                        <h5 class=" mt-4 fw-bold"><?php echo esc_html($acf_values['home_jumbotron']['home_jumbotron_sub_title']); ?></h5>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- About Section -->
    <?php
    if (!empty($acf_values['home_about']) && !empty($acf_values['home_about']['home_about_images'])) :
    ?>
        <section id="about" class="bg-lteal">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="row row-cols-1 row-cols-lg-3 about-imgs">
                            <?php foreach ($acf_values['home_about']['home_about_images'] as $home_about_image) : ?>
                                <div class="col">
                                    <img src="<?php echo esc_url($home_about_image['home_about_image']['url']); ?>" alt="<?php echo esc_attr($home_about_image['home_about_image']['alt']) ?>" class="rounded-5">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 my-auto mt-5 text-center text-lg-start">
                        <a href="<?php echo esc_url($acf_values['home_about']['home_about_page_link']); ?>" class="text-decoration-none">
                            <h1 class="fw-bold text-black"><?php echo esc_html($acf_values['home_about']['home_about_title']); ?></h1>
                            <p class="lh-lg text-secondary mt-4 mt-lg-5"><?php echo nl2br(esc_textarea($acf_values['home_about']['home_about_content'])); ?></p>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Products Section -->
    <?php
    if (!empty($acf_values['home_products']) && !empty($acf_values['home_products']['home_product_content_image']['url'])) :
    ?>
        <section id="products">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 mt-auto mb-3 mb-lg-0 text-center text-lg-start">
                        <a href="<?php echo esc_url($acf_values['home_products']['home_product_page_link']); ?>" class="text-decoration-none text-black">
                            <h1 class="fw-bold text-black"><?php echo esc_html($acf_values['home_products']['home_product_title']); ?></h1>
                        </a>
                        <p class="lh-lg mt-4 mt-lg-5 text-secondary"><?php echo nl2br(esc_textarea($acf_values['home_products']['home_product_content'])); ?></p>

                        <div class="mt-5">
                            <img src="<?php echo esc_url($acf_values['home_products']['home_product_content_image']['url']); ?>" alt="<?php echo esc_attr($acf_values['home_products']['home_product_content_image']['alt']); ?>" class="rounded-5">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row row-cols-2 prod-display g-3 g-lg-4">
                            <?php echo do_shortcode('[agromedika_recent_product]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Grow Section -->
    <?php
    if (!empty($acf_values['home_grow']) && !empty($acf_values['home_grow']['home_grow_bg_image']['url'])) :
    ?>
        <section id="grow" style="background-image: url('<?php echo esc_url($acf_values['home_grow']['home_grow_bg_image']['url']); ?>');');">
            <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9 mx-auto text-center">
                <h2 class="fw-bold text-black mb-5"><?php echo esc_html($acf_values['home_grow']['home_grow_title']); ?></h2>
                <a href="<?php echo esc_url($acf_values['home_grow']['home_grow_page_link']['home_grow_link']); ?>" class="text-decoration-none text-black fw-bold fs-6"><i class="bi bi-arrow-right me-2"></i><?php echo esc_html($acf_values['home_grow']['home_grow_page_link']['home_grow_button_name']); ?></a>
                </div>
            </div>
            </div>
        </section>
    <?php endif; ?>


    <!-- Certificate Section -->
    <?php
    if (!empty($acf_values['home_certificate']) && !empty($acf_values['home_certificate']['home_certificate_title'])) :
    ?>
    <section id="certificate" class="bg-primary">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center mb-5 mb-md-auto">
              <div class="cert-wrap-cont">
                <h1 class="fw-bold text-lteal mb-5"><?php echo esc_html($acf_values['home_certificate']['home_certificate_title']); ?></h1>
              </div>
              <div class="certificates">
                <div class="row row-cols-2 row-cols-md-4 g-lg-4 g-3">
                    <?php foreach ($acf_values['home_certificate']['home_certificate_icons'] as $home_certificate_icon) : ?>
                    <div class="col">
                        <img src="<?php echo esc_url($home_certificate_icon['home_certificate_icon']['url']); ?>" alt="<?php echo esc_attr($home_certificate_icon['home_certificate_icon']['alt']); ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php endif;?>


    <!-- Infographics Section -->
    <?php if (!empty($acf_values['home_infographics'])) : ?>
      <section id="infographics" class="bg-lteal">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div id="infographic" class="row">

                <?php foreach ($acf_values['home_infographics']['home_info_cards'] as $home_info_card) : ?>
                <div class="col-12 col-md-6 col-xl-3 text-center text-lg-start mb-5 mb-xl-0">
                  <div class="card border-0 bg-transparent">
                    <div class="card-body">
                      <div class="num-wrap">
                        <div class="display-1 fw-bold  text-primary"><span class="num" data-val="<?php echo esc_attr($home_info_card['home_info_count_number']); ?>">00</span>+</div>
                        <span class="fw-bold fs-5 text-black"><?php echo esc_html($home_info_card['home_info_text_years']); ?></span>
                      </div>
    
                      <div class="cont mt-4">
                        <p class="text-secondary">
                            <?php echo nl2br(esc_textarea($home_info_card['home_info_content'])); ?>
                        </p>
                      </div>
                      <?php if (!empty($home_info_card['home_info_image']['url'])) : ?>
                      <div class="cont-img mt-5">
                        <img src="<?php echo esc_url($home_info_card['home_info_image']['url']); ?>" alt="<?php echo esc_attr($home_info_card['home_info_image']['alt']); ?>" class="img-fluid rounded-4">
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>

              </div>
            </div>
          </div>
        </div>
      </section>

      <?php endif;?>
    <!-- News Update Section -->
    <?php
    if (!empty($acf_values['home_post']['home_post_title']) && !empty($acf_values['home_post']['home_post_content'])) :
    ?>
        <section id="newsupdate">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 text-center text-lg-start mb-5 mb-lg-auto">
                        <h6 class="fw-bold text-uppercase text-black"><?php echo esc_html($acf_values['home_post']['home_post_sub_title']); ?></h6>
                        <h1 class="fw-bold text-black mb-5"><?php echo esc_html($acf_values['home_post']['home_post_title']); ?></h1>
                        <p class="lh-lg text-secondary my-5"><?php echo esc_html($acf_values['home_post']['home_post_content']); ?></p>
                        <a href="<?php echo esc_url($acf_values['home_post']['home_post_page_link']); ?>" class="text-decoration-none text-black fw-bold"><i class="bi bi-arrow-right me-2"></i><?php echo esc_html($acf_values['home_post']['home_post_button_name']); ?></a>
                    </div>
                    <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
                          <?php get_template_part('template-parts/components/blog/recent','front_post');?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

</main>
<?php get_footer(); ?>
