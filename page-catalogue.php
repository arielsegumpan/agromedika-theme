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
 
 $brochure_featured_image_url = get_the_post_thumbnail_url(get_the_ID());
 $brochure_featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
 
 ?>
 <main>
     <section id="no-jumbotron" class="bg-lteal">
         <div class="container">
             <div class="row">
                 <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                     <h1 class="fw-bold text-black">Product Catalogue</h1>
                     <h5 class="text-black mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus sint ea facilis vel et aut earum deserunt? Harum, tempore sequi.</h5>
                 </div>
             </div>
         </div>
     </section>
 
     <section id="main" class="bg-lteal">
         <div class="container">
             <div class="row">
                 <div class="col-12 col-md-4 col-lg-3">
                     <h5 class="fw-bold mb-4"><i class="bi bi-filter me-2"></i>Filter Options</h5>
                     <ul id="filter-menu" class="list-unstyled list-group list-group-flush">
                         <button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="all">All</button>
                         <?php
                         // Get all brochure categories
                         $categories = get_terms('product-catalogue-category');
                         foreach ($categories as $category) {
                             echo '<button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
                         }
                         ?>
                     </ul>
                 </div>
                 <div class="col-12 col-md-8 col-lg-9 mt-5 mt-lg-0">
                     <div class="container-img">
                         <?php
                         if ($query->have_posts()) :
                             while ($query->have_posts()) :
                                 $query->the_post();
                                 $product_catalogue = get_field('product-catalogue');
                                 $thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
                                 $image_url = isset($product_catalogue['product_catalogue_galleries']['url']) ? esc_url($product_catalogue['product_catalogue_galleries']['url']) : esc_url($thumbnail_url);
                                 $image_alt = isset($product_catalogue['product_catalogue_galleries']['alt']) ? esc_attr($product_catalogue['product_catalogue_galleries']['alt']) : esc_attr($brochure_featured_image_alt);
                                 $caption = esc_attr(get_the_title());
                                 $data_id = '';
                                 $categories = get_the_terms(get_the_ID(), 'product-catalogue-category');
                                 if ($categories) {
                                     foreach ($categories as $category) {
                                         $data_id .= $category->slug;
                                     }
                                 }
                                 ?>
                                 <div class="card border-0 bg-transparent rounded-4">
                                     <div class="card-image position-relative rounded-4">
                                         <a href="<?php echo $image_url; ?>" class="text-decoration-none text-black" data-fancybox="gallery" data-id="<?php echo esc_attr($data_id); ?>" data-caption="<?php echo $caption; ?>">
                                             <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>" class="rounded-4">
                                         </a>
                                     </div>
                                 </div>
                             <?php
                             endwhile;
                             wp_reset_postdata();
                         else :
                             ?>
                             <p class="fst-italic"><?php esc_html_e('No product catlouge posts found.'); ?></p>
                         <?php endif; ?>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 </main>

 <?php get_footer(); ?>
 