<?php
/**
 * Template Name: Medicinal Plants
 * @package agromedika
 */
get_header();

$args = array(
    'post_type'      => 'philippine-medicinal',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
);

$query = new WP_Query($args);


$medicinal_plant_jumbotron = get_acf_field('medicinal_plant_jumbotron');
$medicinal_featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
?>
    <main>
        <?php if(!empty($medicinal_plant_jumbotron['medicinal_plant_jumbotron_heading'])) :?>
        <section id="no-jumbotron" class="bg-lteal">
            <div class="container">
              <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                  <h1 class="fw-bold text-black"><?php echo esc_html($medicinal_plant_jumbotron['medicinal_plant_jumbotron_heading']) ;?></h1>
                  <h5 class="text-secondary mt-4"><?php echo html_entity_decode(esc_textarea( $medicinal_plant_jumbotron['medicinal_plant_jumbotron_content'] )) ;?></h5>
                </div>
              </div>
            </div>
          </section>
        <?php endif;?>
    

        <section id="main" class="bg-lteal">
            <div class="container">
              <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                  <h5 class="fw-bold mb-4"><i class="bi bi-filter me-2"></i><?php echo esc_html('Filter Options') ;?></h5>
                  <ul id="filter-menu-2" class="list-unstyled list-group list-group-flush">
                    <button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="all"><?php echo esc_html('All') ;?></button>
                    <?php
                        // Get all certificate categories
                        $categories = get_terms('medicinal-category');
                        foreach ($categories as $category) {
                            echo '<button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
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
                                $medicinal_plant_galleries = get_field('medicinal_plant_galleries');
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
                                $med_plant_image_url = isset($medicinal_plant_galleries['medicinal_plant_gallery_cover']['url']) ? esc_url($medicinal_plant_galleries['medicinal_plant_gallery_cover']['url']) : esc_url($thumbnail_url);
                                $image_alt = isset($medicinal_plant_galleries['medicinal_plant_gallery_cover']['alt']) ? esc_attr($medicinal_plant_galleries['medicinal_plant_gallery_cover']['alt']) : esc_attr($medicinal_featured_image_alt);
                                $caption = esc_attr(get_the_title());
                                $data_id = '';
                                $categories = get_the_terms(get_the_ID(), 'medicinal-category');
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        $data_id .= $category->slug;
                                    }
                                }
                                ?>
                      <div class="card" data-id="fda">
                        <div class="card-image position-relative">
                          <div class="card-header text-center bg-primary py-3">
                            <img src="<?php echo $med_plant_image_url ;?>" alt="<?php echo $image_alt ;?>" class="img-fluid">
                          </div>
                          <div class="card-body"> 
                            <a href="<?php echo esc_url(the_permalink()) ;?>" class="text-decoration-none">
                                <h5 class="text-primary"><?php echo esc_html( substr( get_the_title(), 0, 35 ) ) . '...'; ?></h5>
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
                        <p><?php esc_html_e('No medicinal plants galleries found.'); ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </section>
<pre>
    <?php var_dump( $medicinal_plant_galleries['medicinal_plant_gallery_cover']) ;?>
</pre>
    </main>
<?php get_footer(); ?>
