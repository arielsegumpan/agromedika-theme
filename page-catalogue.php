<?php
/**
 * Template Name: Product Catalogue
 * @package agromedika
 */

 get_header();

 $args = array(
     'post_type'      => 'product-catalogue',
     'post_status'    => 'publish',
     'posts_per_page' => -1,
 );
 
 $query = new WP_Query($args); 

 $product_catalogue_jumbotron = get_acf_field('product_catalogue_jumbotron');
 $product_catalogue_featured_image_url = get_the_post_thumbnail_url(get_the_ID());
 $product_catalogue_featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
 
 ?>
    <main>
    <section id="prod_jumbotron" class="bg-lteal">
        <div class="jumb-overlay"></div>
    </section>
        <?php if(!empty($product_catalogue_jumbotron['product_catalogue_jumbotron_heading'])) :?>
        <section id="no-jumbotron" class="bg-white">
            <div class="container">
              <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                  <h1 class="fw-bold text-black"><?php echo esc_html($product_catalogue_jumbotron['product_catalogue_jumbotron_heading']) ;?></h1>
                  <h5 class="text-secondary mt-4"><?php echo html_entity_decode(esc_textarea( $product_catalogue_jumbotron['product_catalogue_jumbotron_content'] )) ;?></h5>
                </div>
              </div>
            </div>
          </section>
        <?php endif;?>
    

        <section id="main" class="bg-white">
            <div class="container">
              <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                  <h5 class="fw-bold mb-4"><i class="bi bi-filter me-2"></i><?php echo esc_html('Filter Options') ;?></h5>
                  <ul id="filter-menu-2" class="list-unstyled list-group list-group-flush">
                    <button type="button" class="filter-item list-group-item list-group-item-action text-secondary bg-transparent" data-filter="all"><?php echo esc_html('All') ;?></button>
                    <?php
                        // Get all certificate categories
                        $categories = get_terms('product-catalogue-category');
                        foreach ($categories as $category) {
                            echo '<button type="button" class="filter-item list-group-item list-group-item-action text-secondary bg-transparent" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
                        }
                        ?>
                  </ul>
                </div>
                <div class="col-12 col-md-8 col-lg-9 mt-5 mt-lg-0">
                  <div class="container-img-pdf">
                   
                  <?php
                        if ($query->have_posts()) :
                            while ($query->have_posts()) :
                                $query->the_post(); 
                                $product_catalogue_galleries = get_field('product_catalogue_galleries');
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
                                $prod_cat_image_url = isset($product_catalogue_galleries['product_catalogue_gallery_cover']['url']) ? esc_url($product_catalogue_galleries['product_catalogue_gallery_cover']['url']) : esc_url($product_catalogue_featured_image_url);
                                $image_alt = isset($product_catalogue_galleries['product_catalogue_gallery_cover']['alt']) ? esc_attr($product_catalogue_galleries['product_catalogue_gallery_cover']['alt']) : esc_attr($product_catalogue_featured_image_alt);
                                $caption = esc_attr(get_the_title());
                                $data_id = '';
                                $categories = get_the_terms(get_the_ID(), 'product-catalogue-category');
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        $data_id .= $category->slug;
                                    }
                                }
                                ?>
                      <div class="card" data-id="<?php echo esc_attr($data_id) ?>">
                        <div class="card-image position-relative">
                          <div class="card-header text-center bg-primary py-3">
                            <img src="<?php echo $prod_cat_image_url ;?>" alt="<?php echo $image_alt ;?>" class="img-fluid">
                          </div>
                          <div class="card-body"> 
                            <a href="<?php echo esc_url(the_permalink()) ;?>" class="text-decoration-none">
                                <h5 class="text-primary"><?php echo esc_html( substr( get_the_title(), 0, 30 ) ) . '...'; ?></h5>
                            </a>
                            <div class="d-flex flex-row justify-content-start align-items-center mt-3">
                              
                              <div class="me-3">
                                <a href="#!" class="text-decoration-none text-secondary bookmark-button" data-post-id="<?php echo esc_attr( get_the_ID() ); ?>">
                                    <i class="bi bi-bookmark fs-5"></i>
                                </a>

                              </div>
                              <div>
                                <a href="<?php echo esc_url(the_permalink()) ;?>" class="view text-decoration-none text-secondary"><i class="bi bi-eye fs-5"></i></a>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p><?php esc_html_e('No product catalogues found.'); ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </section>
    </main>

 <?php get_footer(); ?>
 