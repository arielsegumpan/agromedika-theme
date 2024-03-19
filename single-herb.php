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
        <section id="products-single" class="bg-lteal">
          <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                  <div class="mt-5 pt-lg-3">
                      <div class="herb-wrap mb-5">
                        <h1 class="text-primary fw-bold"><?php the_title() ;?></h1> 
                        <?php if(!empty($herb_single_contents['herb_scientific_name'])) :?>
                        <h6 class="text-black"><small class="fst-italic"><?php echo esc_html($herb_single_contents['herb_scientific_name']) ;?></small></h6>
                        <?php endif ;?>
                        <?php
                          // Display herb categories
                          if ($herb_categories && !is_wp_error($herb_categories)): ?>
                            <div class="herb-categories mt-4">
                               <p><small style="font-size:11px">
                                <?php foreach ($herb_categories as $category): ?>
                                    <span class="badge px-2 py-1 bg-primary rounded-3 text-lteal fst-italic"><?php echo esc_html($category->name);?></span>
                                <?php endforeach;?>
                                </small></p>
                            </div>
                          <?php endif;?>
                      </div>
                      <div class="lh-lg text-secondary mt-4">
                        <?php echo wp_kses_post($herb_single_contents['herb_short_description']) ;?>
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
                      <div class="tab-pane fade show active mt-5 pt-lg-5 px-xxl-5 text-start" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                        <div class="row align-items-center align-items-lg-start">
                        <div class="col-12 col-lg-7 order-2 order-lg-1">
                            <div class="lh-lg text-secondary text-center text-lg-start">
                              <?php the_content() ;?>
                            </div>
                            <?php if(!empty($herb_single_contents['herb_back_to_product']['herb_back_to_product_page_link'])) :?>
                            <div class="mt-5">
                              <a href="<?php echo esc_url( $herb_single_contents['herb_back_to_product']['herb_back_to_product_page_link'] ) ;?>" class="text-decoration-none text-primary"><i class="bi bi-arrow-left me-2"></i> <?php echo esc_html__( 'Back to All Products', 'agromedika' ) ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-5 order-1 order-lg-2 mb-4 mb-lg-0 mt-5 mt-lg-0">
                          <?php if(!empty(($herb_single_contents['herbs_gallery'][0]['herb_image']['url']))):?>
                          <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="mySwiper"
                          thumbs-swiper=".mySwiper2" space-between="10" navigation="true"  zoom="true" >
                            <?php foreach ($herb_single_contents['herbs_gallery'] as $herb_gal) :?>
                            <swiper-slide>
                              <div class="swiper-zoom-container rounded-5">
                                <img src="<?php echo esc_url($herb_gal['herb_image']['url']) ;?>" loading="lazy" class="rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tooltip on bottom" title="<?php echo esc_attr('Double click to zoom in') ?>"/>
                              </div>
                            </swiper-slide>
                            <?php endforeach ;?>
                          </swiper-container>
                      
                          <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                            watch-slides-progress="true">
                            <?php foreach ($herb_single_contents['herbs_gallery'] as $herb_gal) :?>
                            <swiper-slide>
                              <img src="<?php echo esc_url($herb_gal['herb_image']['url']) ;?>" loading="lazy" class="rounded-4 rounded-lg-5" />
                            </swiper-slide>
                            <?php endforeach ;?>
                          </swiper-container>
                          <?php else:?>
                            <h3 class="fw-bold text-center"><?php echo esc_html('No product gallery');?></h3>
                          <?php endif;?>
                        </div>
                       </div>
                      </div>
                      <div class="tab-pane fade pt-5 px-lg-5" id="nav-document-access" role="tabpanel" aria-labelledby="nav-document-access-tab" tabindex="0">
                        <div class="card rounded-5 border-0 p-3 mt-5 mt-lg-3">
                          <div class="px-3 py-4 py-lg-5 p-lg-5">
                            <div class="mb-5 px-lg-5">
                              <h2><?php echo esc_html($herb_single_contents['safety_data_sheet']['safety_data_sheet_heading'] ) ;?></h2>
                              <p class="text-secondary mt-4"><?php echo nl2br(esc_textarea($herb_single_contents['safety_data_sheet']['safety_data_sheet_sub_heading'] )) ;?></p>
                            </div>
                         
                            <form action="#!">
                              <div class="row mb-md-4">
                                <div class="col-12 mb-3 mt-4">
                                  <h6 class="text-secondary mb-4 text-center"><small class="fst-italic ">Please check any data sheet to download.</small></h6>
                                  <div class="form-check form-check-inline me-3 mb-3">
                                    <input class="form-check-input border border-primary" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label fw-bold" for="inlineCheckbox1">Product Data Sheet</label>
                                  </div>
                                  <div class="form-check form-check-inline me-3 mb-3">
                                    <input class="form-check-input border border-primary" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label fw-bold" for="inlineCheckbox2">Techinical Data Sheet</label>
                                  </div>
                                  <div class="form-check form-check-inline me-3 mb-3">
                                    <input class="form-check-input border border-primary" type="checkbox" id="inlineCheckbox3" value="option3">
                                    <label class="form-check-label fw-bold" for="inlineCheckbox3">Safety Data Sheet</label>
                                  </div>
                                  <div class="form-check form-check-inline me-3 mb-3">
                                    <input class="form-check-input border border-primary" type="checkbox" id="inlineCheckbox4" value="option4">
                                    <label class="form-check-label fw-bold" for="inlineCheckbox4">Certificate of Analysis</label>
                                  </div>
                                  <div class="form-check form-check-inline me-3 mb-3">
                                    <input class="form-check-input border border-primary" type="checkbox" id="inlineCheckbox5" value="option5">
                                    <label class="form-check-label fw-bold" for="inlineCheckbox5">Certificate of Conformity</label>
                                  </div>
                                </div>
                                <div class="col-12 mb-4">
                                  <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" placeholder="Name*">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email*">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                  </div>
                                </div>
                              </div>

                              <div class="mt-5 pt-3 mx-auto text-center">
                                <button class="btn btn-black px-5 py-4 rounded-4"><i class="bi bi-send me-2"></i>Send Request</button>
                              </div>
                          </form>




                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade pt-5 px-lg-5" id="nav-buynow" role="tabpanel" aria-labelledby="nav-buynow-tab" tabindex="0">
                        <div class="card rounded-5 border-0 p-3 mt-5 mt-lg-3">
                          <div class="mt-5">
                            <h2>Enquire Now</h2>
                          </div>
                          <div class="px-3 py-4 py-lg-5 p-lg-5">
                            <form action="#!">
                              <div class="row mb-md-4">
                                <div class="col-12 col-md-6">
                                  <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" placeholder="Name*">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                  </div>
                                </div>
                                <div class="col-12 col-md-6">
                                  <div class="form-floating mb-3">
                                    <input type="phone" class="form-control" id="phone" placeholder="Phone*">
                                    <label for="phone">Phone<span class="text-danger">*</span></label>
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-md-4">
                                <div class="col-12 col-md-6">
                                  <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="youremail@gmail.com">
                                    <label for="email">Email Address<span class="text-danger">*</span></label>
                                  </div>
                                </div>
                                <div class="col-12 col-md-6">
                                  <div class="form-floating mb-3">
                                    <input type="phone" class="form-control" id="phone" placeholder="Phone*">
                                    <label for="phone">Phone Number<span class="text-danger">*</span></label>
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-md-4">
                                <div class="col-12">
                                  <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject*">
                                    <label for="subject">Subject <span class="text-danger">*</span></label>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12">
                                  <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Message<span class="text-danger">*</span></label>
                                  </div>
                                </div>
                              </div>
                              <div class="mt-5 mx-auto text-center">
                                <button class="btn btn-black px-5 py-3"><i class="bi bi-send me-2"></i>Submit</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
            </div>
          </div>
        </section>
    </main>

<?php get_footer(); ?>
