<?php
/**
 *
 * @package herbanext
 */
get_header();
$image_id = get_post_thumbnail_id(get_the_ID());
$alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
$get_blog_img = get_acf_option_field('blog_post_header_image');
$get_blog_title = get_acf_option_field('blog_post_heading_title');
?>
<main>
 <!-- jumbotron -->
 <section id="jumbotron_about" class="w-100 position-relative">
    <?php if(has_post_thumbnail()):?>
        <img src="<?php echo esc_url(the_post_thumbnail_url()) ?>" alt="<?php echo esc_attr($alt_text) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
   <?php else: ?>
        <img src="<?php echo esc_url($get_blog_img) ?>" alt="<?php echo esc_attr($get_blog_title) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
    <?php endif ?>
    <div class="container position-absolute">
         <div class="col-12 col-md-8 col-lg-6 me-auto text-center text-md-start my-auto">
                <h1 class="display-5 museo fw-bold text-success">
                    <?php echo esc_html_e(wp_title()) ?>
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
         <?php if(have_posts()): while(have_posts()): the_post();?> 
            <?php get_template_part('template-parts/content/content');?> 
        <?php endwhile; endif;?>
         </div>
        <?php if(get_next_posts_link() || get_previous_posts_link() ) :?>
         <div class="row">
            <div class="container text-center">
                <nav aria-label="Page navigation" class="mt-5 pt-4">
                    <ul class="pagination justify-content-center list-unstyled d-flex flex-row gap-3">
                        <?php if (get_previous_posts_link()) : ?>
                            <li class="page-item">
                                <span class="btn btn-success px-4 py-3">
                                    <?php previous_posts_link('<i class="bi bi-arrow-left me-3"></i>Previous'); ?>
                                </span>
                            </li>
                        <?php endif; ?>
                        
                        <?php if (get_next_posts_link()) : ?>
                            <li class="page-item">
                                <span class="btn btn-success px-4 py-3">
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