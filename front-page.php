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
has_post_thumbnail() ? $background_image = get_the_post_thumbnail_url(get_the_ID(), 'full') : '';
$background_image = empty($background_image) && !empty($acf_values['home_jumbotron']['home_jumbotron_image']['url']) ? $acf_values['home_jumbotron']['home_jumbotron_image']['url'] : $background_image;
$jumb_id = $acf_values['home_jumbotron']['home_jumbotron_image']['ID'];
?>
<main>
    <!-- Jumbotron Section -->
    <?php if (!empty($background_image)) : ?>
    <section id="jumbotron" class="bg-lteal overflow-hidden">
        <div class="container-fluid px-0">
          <div class="row">
              <div class="jumb-wrap position-relative">
                <?php echo html_entity_decode(esc_html(
                  wp_get_attachment_image($jumb_id, 'jumbotron', false, array('class' => 'object-fit-cover'))
                  )); ;?>
                <div id="content-wrap" class="col-12 col-lg-7 col-xxl-6 me-auto my-auto text-center text-xl-start px-5 px-lg-1">
                  <h1 class="display-5 fw-bold text-white px-md-3 px-lg-0"><?php echo esc_html($acf_values['home_jumbotron']['home_jumbotron_title']); ?></h1>
                  <h5 class=" mt-4 fw-bold text-white px-md-3 px-lg-0"><?php echo esc_html($acf_values['home_jumbotron']['home_jumbotron_sub_title']); ?></h5>
                </div>
              </div>
          </div>
        </div>
      </section>
    <?php endif; ?>
    <!-- About Section -->
    <?php if (!empty($acf_values['home_about']) && !empty($acf_values['home_about']['home_about_images'])) :?>
      <section id="about" class="bg-lteal">
        <div class="container container-lg-fluid">
          <div class="row">
            <div class="col-12 col-lg-6 order-2 order-lg-1 mt-5 mt-lg-0 pe-lg-5">
            <?php foreach ($acf_values['home_about']['home_about_images'] as $home_about_image) : ?>
              <?php
              $about_img_id = $home_about_image['home_about_image']['id'];
              echo html_entity_decode(esc_html(
                  wp_get_attachment_image($about_img_id, 'sg_img', false, array('id'=> 'home-about-img','class' => 'rounded-5 object-fit-cover'))
                  )); ;?>
            <?php endforeach; ?>
            </div>
            <div class="col-12 col-lg-6 my-auto mt-lg-5 text-center text-lg-start  order-1 order-lg-2">
              <a href="about.html" class="text-decoration-none">
                <a href="<?php echo esc_url($acf_values['home_about']['home_about_page_link']); ?>" class="text-decoration-none">
                  <h1 class="fw-bold text-black"><?php echo esc_html($acf_values['home_about']['home_about_title']); ?></h1>
                  <p class="lh-lg text-secondary mt-4 mt-lg-5"><?php echo nl2br(esc_textarea($acf_values['home_about']['home_about_content'])); ?></p>
              </a>
              </a>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>

    <!-- Products Section -->
    <?php if (!empty($acf_values['home_products']) && !empty($acf_values['home_products']['home_product_content_image']['url'])) :?>
      <section id="products">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-9 mx-auto mt-auto mb-lg-0 text-center">
              <a href="<?php echo esc_url($acf_values['home_products']['home_product_page_link']); ?>" class="text-decoration-none text-black">
                <h1 class="fw-bold text-black"><?php echo esc_html($acf_values['home_products']['home_product_title']); ?></h1>
              </a>
              <p class="lh-lg mt-4 mt-lg-5 text-secondary"><?php echo nl2br(esc_textarea($acf_values['home_products']['home_product_content'])); ?></p>
            </div>
            <div class="col-12 img-prod-front mt-5">
              <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 prod-display g-4 g-lg-5">
                <?php 
                  if(shortcode_exists('agromedika_recent_product')){
                    echo do_shortcode('[agromedika_recent_product]'); 
                  }?>   
              </div>
            </div>
          </div>
          <?php if(!empty($acf_values['home_products']['home_page_carousel'][0]['home_page_carousel_image']['url']) && !empty($acf_values['home_products']['home_page_carousel'][0]['home_page_carousel_title'])) :?>
          <div class="row">
            <div class="col-12">
              <div id="carous_product">
                  <h2 class="text-center mb-5 pb-lg-3"><?php echo esc_html($acf_values['home_products']['home_page_carousel_main_title']) ?></h2>
                  <div class="row row-cols-1 row-cols-md-2 row-cols-xxl-3 g-4 g-lg-5 justify-content-center">
                  <?php foreach($acf_values['home_products']['home_page_carousel'] as $key => $get_prod_carous) :?>
                    <div class="col">
                      <a href="<?php echo esc_url($get_prod_carous['home_page_carousel_page_link']) ;?>" class="text-decoration-none text-white">
                        <div class="card border-0 bg-transparent">

                          <?php
                          $prod_img_id =  $get_prod_carous['home_page_carousel_image']['id'];
                          echo html_entity_decode(esc_html(
                            wp_get_attachment_image($prod_img_id, 'prod_carousel_img', false, array('class' => 'd-block w-100 rounded-5'))
                          ));?>

                          <div class="carous_caption position-absolute text-white mx-3 mx-sm-4 mx-lg-4 mt-3">
                          
                            <h3><?php echo esc_html($get_prod_carous['home_page_carousel_title']); ?></h3>
                            <small class="text-uppercase"><?php echo esc_html($acf_values['home_products']['home_page_carousel_button_title']); ?><i class="bi bi-arrow-right ms-2 text-white"></i></small>
                          
                          </div>
                        </div>
                      </a>
                    </div>
                  <?php endforeach;?>
                </div>
                 
              </div>
            </div>
          <?php endif;?>
        </div>
      </section>
    <?php endif; ?>

    <!-- Infographics Section -->
    <?php if (!empty($acf_values['home_infographics'])) : ?>
      <section id="infographics" class="bg-primary">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12  px-5">
              <div id="infographic" class="row px-lg-5">
              <?php if(!empty($acf_values['home_infographics']['home_info_cards'][0]['home_info_content'])):?>
                <?php foreach ($acf_values['home_infographics']['home_info_cards'] as $home_info_card) : ?>
                <div class="col-12 col-md-6 col-xl-3 text-center text-lg-start mb-5 mb-xl-0">
                  <div class="card border-0 bg-transparent text-center">
                    <div class="card-body">
                      <?php if (!empty($home_info_card['home_info_image']['url'])) : ?>
                      <div class="num-wrap">
                        <?php
                            $grow_id =  $home_info_card['home_info_image']['id'];
                            echo html_entity_decode(esc_html(
                            wp_get_attachment_image($grow_id, 'info_img', false, array(''))
                        ));?>
                      </div>
                      <?php endif; ?>
    
                      <div class="cont mt-4 pt-3">
                        <p class="text-lteal">
                        <?php echo html_entity_decode(esc_textarea($home_info_card['home_info_content'])); ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
                <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php endif;?>
    <!-- Grow Section -->
    <?php
    if (!empty($acf_values['home_grow']) && !empty($acf_values['home_grow']['home_grow_bg_image']['url'])) :
    ?>
    <section id="grow" class="position-relative overflow-hidden">
    <?php
        $grow_id =  $acf_values['home_grow']['home_grow_bg_image']['id'];
        echo html_entity_decode(esc_html(
        wp_get_attachment_image($grow_id, 'grow_img', false, array(''))
    ));?>
        <div class="container position-absolute">
          <div class="row">
            <div class="col-12 col-lg-9 mx-auto text-center">
              <h2 class="fw-bold text-black mb-5"><?php echo esc_html($acf_values['home_grow']['home_grow_title']); ?></h2>
              <a href="<?php echo esc_url($acf_values['home_grow']['home_grow_page_link']['home_grow_link']); ?>" class="text-decoration-none text-black fw-bold fs-6"><i class="bi bi-arrow-right me-2"></i><?php echo esc_html($acf_values['home_grow']['home_grow_page_link']['home_grow_button_name']); ?></a>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>
    
    <!-- News Update Section -->
    <?php
    if (!empty($acf_values['home_post']['home_post_title']) && !empty($acf_values['home_post']['home_post_content'])) :
    ?>
        <section id="newsupdate">
        <div class="container">
          <div class="row">
            <div class="text-center mb-5 pb-lg-4">
              <h6 class="fw-bold text-uppercase text-black"><?php echo esc_html($acf_values['home_post']['home_post_sub_title']); ?></h6>
              <h1 class="fw-bold text-black mb-5"><?php echo esc_html($acf_values['home_post']['home_post_title']); ?></h1>
            </div>
 
            <div class="col-12">
              <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 g-xl-5 blog-display">

                <?php get_template_part('template-parts/components/blog/recent','front_post');?>

              </div>
            </div>

            <div class="text-center mt-5">
              <a href="<?php echo esc_url($acf_values['home_post']['home_post_page_link']); ?>" class="text-decoration-none text-primary fw-bold"><i class="bi bi-arrow-right me-2"></i><?php echo esc_html($acf_values['home_post']['home_post_button_name']); ?></a>
            </div>
          
          </div>
        </div>
      </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>

