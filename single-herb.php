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


?>

    <main>
        <section id="products-single" class="bg-lteal">
          <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto text-center">
                  <div class="prod-img">
                    <img src="<?php echo esc_url($sproduct_image_url) ?>" alt="<?php echo esc_attr($sproduct_image_alt)?>" class="img-fluid rounded-5">
                  </div>
                  <div class="mt-5 pt-lg-3">
                      <div class="herb-wrap mb-5">
                        <h1 class="text-primary fw-bold"><?php the_title() ;?></h1> 
                        <?php if(!empty($herb_single_contents['herb_scientific_name'])) :?>
                        <h6 class="text-black"><small class="fst-italic"><?php echo esc_html($herb_single_contents['herb_scientific_name']) ;?></small></h6>
                        <?php endif ;?>
                      </div>
                      <div class="lh-lg text-secondary mt-4">
                        <?php echo wp_kses_post($herb_single_contents['herb_short_description']) ;?>
                      </div>
                  </div>
 
                  <div class="prod-single-content mt-5 pt-lg-5">
                    <nav>
                      <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                        <button class="nav-link text-black text-uppercase active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo esc_html__( 'Product Overview', 'agromedika') ;?></button>
                        <button class="nav-link text-black text-uppercase" id="nav-safety-data-sheet-tab" data-bs-toggle="tab" data-bs-target="#nav-safety-data-sheet" type="button" role="tab" aria-controls="nav-safety-data-sheet" aria-selected="false"><?php echo esc_html__( 'Safety Data sheet', 'agromedika') ;?></button>
                        <button class="nav-link text-black text-uppercase" id="nav-technical-data-sheet-tab" data-bs-toggle="tab" data-bs-target="#nav-technical-data-sheet" type="button" role="tab" aria-controls="nav-technical-data-sheet" aria-selected="false"><?php echo esc_html__( 'Technical Data Sheet', 'agromedika') ;?></button>
                        <button class="nav-link text-black text-uppercase" id="nav-product-data-sheet-tab" data-bs-toggle="tab" data-bs-target="#nav-product-data-sheet" type="button" role="tab" aria-controls="nav-product-data-sheet" aria-selected="false"><?php echo esc_html__( 'Product Data Sheet', 'agromedika') ;?></button>
                        <button class="nav-link text-black text-uppercase" id="nav-analysis-conformity-tab" data-bs-toggle="tab" data-bs-target="#nav-analysis-conformity" type="button" role="tab" aria-controls="nav-analysis-conformity" aria-selected="false"><?php echo esc_html__( 'Analysis and Conformity', 'agromedika') ;?></button>
                        <button class="nav-link text-black text-uppercase" id="nav-buynow-tab" data-bs-toggle="tab" data-bs-target="#nav-buynow" type="button" role="tab" aria-controls="nav-buynow" aria-selected="false">Send Inquiry/Buy Product</button>
                      </div> 
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active pt-5 px-lg-5 text-start" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                        <div class="lh-lg text-secondary">
                          <?php the_content() ;?>
                        </div>
                        <?php if(!empty($herb_single_contents['herb_overview']['herb_overview_page_link'])) :?>
                        <div class="mt-5">
                          <a href="<?php echo esc_url( $herb_single_contents['herb_overview']['herb_overview_page_link'] ) ;?>" class="text-decoration-none text-primary"><i class="bi bi-arrow-left me-2"></i> <?php echo esc_html__( 'Back to All Products', 'agromedika' ) ?></a>
                        </div>
                        <?php endif; ?>
                      </div>
                      <div class="tab-pane fade pt-5 px-lg-5" id="nav-safety-data-sheet" role="tabpanel" aria-labelledby="nav-safety-data-sheet-tab" tabindex="0">
                        <div class="card rounded-5 border-0 p-3 mt-5 mt-lg-3">
                          <div class="px-3 py-4 py-lg-5 p-lg-5">
                            <div class="mb-5">
                              <h2><?php echo esc_html($herb_single_contents['safety_data_sheet']['safety_data_sheet_heading'] ) ;?></h2>
                              <p class="text-secondary mt-4"><?php echo nl2br(esc_textarea($herb_single_contents['safety_data_sheet']['safety_data_sheet_sub_heading'] )) ;?></p>
                            </div>
                          <form action="#!">
                            <div class="row mb-md-4">
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
                            <div class="mt-5 mx-auto text-center">
                              <button class="btn btn-black px-5 py-3"><i class="bi bi-send me-2"></i>Send Request</button>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade pt-5 px-lg-5" id="nav-technical-data-sheet" role="tabpanel" aria-labelledby="nav-technical-data-sheet-tab" tabindex="0">
                        <div class="lh-lg text-secondary">
                          <?php echo wp_kses_post($herb_single_contents['technical_data_sheet']['technical_data_sheet_content']) ;?>
                        </div>
                        <?php if(!empty($herb_single_contents['technical_data_sheet']['technical_data_sheet_page_link'])) :?>
                        <div class="mt-5">
                          <a href="<?php echo esc_url( $herb_single_contents['technical_data_sheet']['technical_data_sheet_page_link'] ) ;?>" class="text-decoration-none text-primary"><i class="bi bi-arrow-left me-2"></i> <?php echo esc_html__( 'Back to All Products', 'agromedika' ) ?></a>
                        </div>
                        <?php endif; ?>
                      </div>
                      <div class="tab-pane fade pt-5 px-lg-5" id="nav-product-data-sheet" role="tabpanel" aria-labelledby="nav-product-data-sheet-tab" tabindex="0">
                        <div class="lh-lg text-secondary text-start">
                        <?php echo wp_kses_post($herb_single_contents['product_data_sheet']['product_data_sheet_content']) ;?>
                        </div>
                        <?php if(!empty($herb_single_contents['product_data_sheet']['product_data_sheet_page_link'])) :?>
                        <div class="mt-5">
                          <a href="<?php echo esc_url( $herb_single_contents['product_data_sheet']['product_data_sheet_page_link'] ) ;?>" class="text-decoration-none text-primary"><i class="bi bi-arrow-left me-2"></i> <?php echo esc_html__( 'Back to All Products', 'agromedika' ) ?></a>
                        </div>
                        <?php endif; ?>
                      </div>
                      <div class="tab-pane fade pt-5 px-lg-5" id="nav-analysis-conformity" role="tabpanel" aria-labelledby="nav-analysis-conformity-tab" tabindex="0">
                        <div class="lh-lg text-secondary">
                        <?php echo wp_kses_post($herb_single_contents['analysis_and_conformity']['analysis_and_conformity_content']) ;?>
                        </div>
                        <?php if(!empty($herb_single_contents['analysis_and_conformity']['analysis_and_conformity_page_link'])) :?>
                        <div class="mt-5">
                          <a href="<?php echo esc_url( $herb_single_contents['analysis_and_conformity']['analysis_and_conformity_page_link'] ) ;?>" class="text-decoration-none text-primary"><i class="bi bi-arrow-left me-2"></i> <?php echo esc_html__( 'Back to All Products', 'agromedika' ) ?></a>
                        </div>
                        <?php endif; ?>
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
