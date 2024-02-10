<?php
/** Search page
 * @package herbanext
 */
get_header();
$search_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
$get_search_page_img = get_acf_option_field('search_background');
?>
<main>
 <!-- jumbotron -->
 <section id="jumbotron_about" class="w-100 position-relative">
    <?php if(!empty($get_search_page_img['url'])): ?>
    <img src="<?php echo esc_url($get_search_page_img['url']) ?>" alt="<?php echo esc_attr($get_search_page_img['alt']) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
     <?php endif;?>
    <div class="container position-absolute">
         <div class="col-12 col-md-8 col-lg-6 me-auto text-center text-md-start my-auto">
                <h1 class="display-2 museo fw-bold text-success">
                    <?php echo esc_html_e('Search Result') ?>
                </h1>
                <h6 class="mt-4">
                    <nav aria-label="breadcrumb">
                        <?php custom_breadcrumbs() ?>
                    </nav>
                </h6>
         </div>
     </div>
 </section>  
 <section id="blog">
     <div class="container">
         <div class="row row-gap-5">
             <?php if(have_posts()): while(have_posts()): the_post()?>
                     <?php get_template_part('template-parts/content/content')?> 
                <?php endwhile; else:?>
                    <?php get_template_part('template-parts/content/content-empty')?>
            <?php endif;wp_reset_postdata();?>
         </div> 
         <?php if ( $wp_query->max_num_pages > 1 ) : ?>
         <div class="row">
            <div class="container text-center">
                <nav aria-label="Page navigation" class="mt-5 pt-4">
                    <ul class="pagination d-flex flex-column flex-md-row gap-4 justify-content-center list-unstyled">
                        <?php if (get_previous_posts_link()) : ?>
                            <li class="page-item">
                                <span class="btn btn-success px-5 py-3">
                                    <?php previous_posts_link('<i class="bi bi-arrow-left me-3"></i>Previous'); ?>
                                </span>
                            </li>
                        <?php endif; ?>
                        <?php if (get_next_posts_link()) : ?>
                            <li class="page-item">
                                <span class="btn btn-success px-5 py-3">
                                    <?php next_posts_link('Next<i class="bi bi-arrow-right ms-3"></i>'); ?>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
         </div>
        <?php endif?>
     </div>
 </section>
</main>
<?php get_footer()?>