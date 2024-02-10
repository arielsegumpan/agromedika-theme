<?php
/**
 * Template Name: Medicinal Herbs
 * @package herbanext
 */
get_header();
$get_med_herb = get_acf_option_field('medicinal_herb_header_image');
$get_med_herb_title = get_acf_option_field('medicinal_herb_post_heading_title');
?>
<main>
 <!-- jumbotron -->
 <section id="jumbotron_about" class="w-100 position-relative">
    <?php if (!empty($get_med_herb['url'])) : ?>
        <img src="<?php echo esc_url($get_med_herb['url']); ?>" alt="<?php echo esc_attr($get_med_herb['alt']); ?>" class="object-fit-cover w-100 position-absolute bottom-0 left-0">
    <?php else : ?>
        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
    <?php endif; ?>
     <div class="container position-absolute">
         <div class="col-12 col-md-8 col-lg-6 me-auto text-center text-md-start my-auto">
                <h1 class="display-5 museo fw-bold text-success">
                    <?php echo esc_html_e($get_med_herb_title)?>
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
           <?php echo do_shortcode( '[herbanext_medicinal_herbs_posts]' ) ?>
         </div>
     </div>
 </section>
</main>

<?php get_footer()?>