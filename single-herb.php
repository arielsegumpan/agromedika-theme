<?php
/**
 * /**
 * Template Name: Herb
 * Template Post Type: herb
 *
 * @package agromedika
 */
get_header();
$sproduct_image_url = get_the_post_thumbnail_url(get_the_ID());
$sproduct_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

$herb_single_contents = get_acf_field('herb_single_contents');

$herb_categories = get_the_terms(get_the_ID(), 'herb-category');
?>

    <main>
      <section id="prod_jumbotron" class="bg-lteal">
        <div class="jumb-overlay"></div>
      </section>
        <section id="products-single">
          <div class="container">
            <div class="row">
              <div class="col-12">
              <div class="d-flex flex-column flex-md-row justify-content-center jsutify-content-md-start gap-4 align-items-center">
                <div class="prod-img">
                  <?php
                    if (has_post_thumbnail()) {
                        $thumbnail_id = get_post_thumbnail_id();
                        $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        echo get_the_post_thumbnail($thumbnail_id, 'single_herb_thumbnail', array('class' => 'img-fluid rounded-5', 'alt' => $thumbnail_alt));
                    } else {
                        $single_content_id = $herb_single_contents['herbs_gallery'][0]['herb_image']['id'];
                        echo wp_get_attachment_image($single_content_id, 'single_herb_thumbnail', false, array('class' => 'img-fluid rounded-5'));
                    }
                  ?>
                </div>
                <div>
                  <div class="herb-wrap text-center text-md-start px-4 px-lg-0">
                    <h1 class="text-primary fw-bold"><?php the_title() ;?></h1> 
                    <?php if(!empty($herb_single_contents['herb_scientific_name'])) :?>
                    <h6 class="text-black"><small class="fst-italic"><?php echo esc_html($herb_single_contents['herb_scientific_name']) ;?></small></h6>
                    <?php endif ;?>
                    <?php
                          // Display herb categories
                    if ($herb_categories && !is_wp_error($herb_categories)): ?>
                      <div class="herb-categories mt-4">
                          <p><small class="d-flex flex-wrap justify-content-center justify-content-md-start gap-1" style="font-size:11px">
                          <?php foreach ($herb_categories as $category): ?>
                              <span class="badge px-2 py-1 bg-primary rounded-3 text-lteal fst-italic"><?php echo esc_html($category->name);?></span>
                          <?php endforeach;?>
                          </small></p>
                      </div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
              </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-12 mx-auto text-center">
                 
                  <div class="mt-4 pt-lg-3 text-start">
                      <div class="lh-lg text-secondary mt-4">
                        <?php echo !empty($herb_single_contents['herb_short_description']) ? html_entity_decode(wp_kses_post($herb_single_contents['herb_short_description'])) : esc_html('No short description') ;?>
                      </div>
                  </div>
 
                  <div class="prod-single-content mt-5 pt-lg-5">
                    <nav>
                      <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                        <button class="nav-link text-black text-uppercase active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo esc_html__( 'Product Overview', 'agromedika') ;?></button>
                        <button class="nav-link text-black text-uppercase" id="nav-document-access-tab" data-bs-toggle="tab" data-bs-target="#nav-document-access" type="button" role="tab" aria-controls="nav-document-access" aria-selected="false"><?php echo esc_html__( 'Request Specifications', 'agromedika') ;?></button>
                        <button class="nav-link text-black text-uppercase" id="nav-buynow-tab" data-bs-toggle="tab" data-bs-target="#nav-buynow" type="button" role="tab" aria-controls="nav-buynow" aria-selected="false"><?php echo esc_html('Send Inquiry', 'agromedika') ?></button>
                      </div> 
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active mt-5 pt-lg-5 text-start" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                        <div class="row align-items-center align-items-lg-start">
                        <div class="col-12 col-lg-5 mb-4 mb-lg-0 mt-5 mt-lg-0">
                          <?php if(!empty(($herb_single_contents['herbs_gallery'][0]['herb_image']['url']))):?>
                          <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="mySwiper"
                          thumbs-swiper=".mySwiper2" space-between="10" navigation="true"  zoom="true" >
                            <?php foreach ($herb_single_contents['herbs_gallery'] as $herb_gal) :?>

                            <swiper-slide>
                              <div class="swiper-zoom-container rounded-5">

                                <figure class="w-100">
                                  <?php
                                    $hrb_img_id = $herb_gal['herb_image']['id'];
                                    $image_caption = wp_get_attachment_caption($hrb_img_id);
                                    echo html_entity_decode(esc_html(
                                    wp_get_attachment_image($hrb_img_id, 'herb_thumbnail', false, array('class' => 'rounded-5', 'title' => 'Double click to zoom in'))
                                  ));?>

                                  <?php if (!empty($image_caption)): ?>
                                    <figcaption><?php echo esc_html($image_caption) ;?></figcaption>
                                  <?php endif;?>
                                </figure>

                              </div>
                            </swiper-slide>

                            <?php endforeach ;?>
                          </swiper-container>
                      
                          <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                            watch-slides-progress="true">
                            <?php foreach ($herb_single_contents['herbs_gallery'] as $herb_gal) :?>
                            <swiper-slide>
                              <?php
                                  $herb_gal_id =  $herb_gal['herb_image']['id'];
                                  echo html_entity_decode(esc_html(
                                  wp_get_attachment_image($herb_gal_id, 'herb_sm_thumbnail', false, array('class' => 'rounded-4 rounded-lg-5'))
                                ));?>
                            </swiper-slide>
                            <?php endforeach ;?>
                          </swiper-container>
                          <?php else:?>
                            <h3 class="fw-bold text-center"><?php echo esc_html('No product gallery');?></h3>
                          <?php endif;?>
                        </div> 
                        <div class="col-12 col-lg-7 pt-3">

                          <div class="lh-lg text-secondary text-lg-start">

                            <?php echo !empty($herb_single_contents['herb_long_description']) ? html_entity_decode(wp_kses_post($herb_single_contents['herb_long_description'])) : esc_html('No long description') ;?>
                            
                          </div>

                          <?php if(!empty($herb_single_contents['herb_back_to_product']['herb_back_to_product_page_link'])) :?>
                          <div class="mt-5">
                            <a href="<?php echo esc_url( $herb_single_contents['herb_back_to_product']['herb_back_to_product_page_link'] ) ;?>" class="text-decoration-none text-primary"><i class="bi bi-arrow-left me-2"></i> <?php echo esc_html__( 'Back to All Herbs', 'agromedika' ) ?></a>
                          </div>
                          <?php endif; ?> 
                        </div>
                       </div>
                      </div>
                      <div class="tab-pane fade pt-5 px-lg-5" id="nav-document-access" role="tabpanel" aria-labelledby="nav-document-access-tab" tabindex="0">
                        <div class="card rounded-5 border-0 p-3 mt-5 mt-lg-3">
                          <div class="px-3 py-4 py-lg-5 p-lg-5">
                            <?php if(!empty($herb_single_contents['data_sheet_files']['data_sheet_heading'])) :?>
                            <div class="mb-5 px-lg-5">
                              <h2><?php echo esc_html($herb_single_contents['data_sheet_files']['data_sheet_heading'] ) ;?></h2>
                              <p class="text-secondary mt-4"><?php echo nl2br(esc_textarea($herb_single_contents['data_sheet_files']['data_sheet_sub_heading'] )) ;?></p>
                            </div>
                            <?php endif; ?>
                            <?php echo !empty( $herb_single_contents['data_sheet_files']['data_sheet_shortcode'] ) ? do_shortcode($herb_single_contents['data_sheet_files']['data_sheet_shortcode']) : '';?>

                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade pt-5 px-lg-5" id="nav-buynow" role="tabpanel" aria-labelledby="nav-buynow-tab" tabindex="0">
                        <div class="card rounded-5 border-0 p-3 mt-5 mt-lg-3">
                          <div class="mt-5">
                            <h2><?php echo !empty($herb_single_contents['send_inquirybuy_product']['send_inquirybuy_product_title']) ? esc_html($herb_single_contents['send_inquirybuy_product']['send_inquirybuy_product_title']) : esc_hmtl('Enquire Now');?></h2>
                          </div>
                          <div class="px-3 py-4 py-lg-5 p-lg-5">
                            <?php echo !empty($herb_single_contents['send_inquirybuy_product']['send_inquirybuy_product_content']) ? do_shortcode($herb_single_contents['send_inquirybuy_product']['send_inquirybuy_product_content']) : '';?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
            </div>

            <div class="row">
              <div class="col-12 mt-5 pt-md-3 pt-lg-5">
                <?php the_content() ;?>
              </div>
            </div>
          </div>
        </section>
    </main>



<?php get_footer(); ?>