<?php
/**
 * 
 * @package herbanext
 */
get_header();

$get_publication_bg = get_acf_option_field('publication_post_header_image');
$get_publication_title = get_acf_option_field('publication_post_heading_title');

?>


<main>
 <!-- jumbotron -->
 <section id="jumbotron_product" class="w-100 position-relative">
    <?php if(!empty($get_publication_bg['url'])):?>
    <img src="<?php echo esc_url($get_publication_bg['url']) ?>" alt="<?php echo esc_html_e($get_publication_bg['alt'])?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
     <?php endif;?>
    <div class="container position-absolute">
         <div class="col-12 col-md-8 col-lg-6 me-auto text-center text-md-start my-auto">
                <h1 class="display-5 museo fw-bold text-success">
                    <?php echo esc_html_e($get_publication_title)?>
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
             <?php echo do_shortcode('[herbanext_publications_posts]')?>
         </div>
     </div>
 </section>
</main>

<?php get_footer()?>