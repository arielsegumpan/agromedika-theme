<?php 
/**
 * Template Name: 404 Error
 * @package agromedika
 */
get_header();
$err_page = get_acf_option_field('error_page');
$error_image_id = get_post_thumbnail_id();
$error_alt_text = get_post_meta($error_image_id, '_wp_attachment_image_alt', true);
?>
    <main>
        <!-- jumbotron -->
        <section id="jumbotron_about" class="w-100 position-relative">
            <?php if(!empty($err_page['error_jumbotron']['url'])):?>
                <img src="<?php echo esc_url($err_page['error_jumbotron']['url']) ?>" alt="<?php echo esc_attr($err_page['error_jumbotron']['alt']) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
            <?php else:?>
                <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($error_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
            <?php endif?>
            <?php if(!empty($err_page['error_header_title'])): ?>
            <div class="container position-absolute">
                <div class="col-12 col-md-8 col-lg-6  text-center my-auto mx-auto">
                    <h1 class="display-2 museo fw-bold text-primary">
                       <?php echo esc_html_e($err_page['error_header_title'])?>
                    </h1>
                </div>
            </div>
            <?php endif?>
        </section> 
        <?php if(!empty($err_page['error_image']) && $err_page['error_title']):?>
        <section id="error">
            <div class="container">
               <div class="row">
                    <div class="col-12 col-md-5 my-auto mb-5 mb-md-0">
                        <img src="<?php echo esc_url($err_page['error_image']['url']) ?>" alt="<?php echo esc_attr($err_page['error_image']['alt']) ?>" class="img-fluid">
                    </div>
                    <div class="col-12 col-md-7 my-auto text-center text-md-start">
                        <h1 class="display-5 museo"><?php echo nl2br(wp_kses_decode_entities( $err_page['error_title'] )) ?></h1>
                        <a href="<?php echo esc_url($err_page['error_link']) ?>" class="btn btn-lg btn-success px-4 py-3 mt-5"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html_e($err_page['error_link_text'])?></a>
                    </div>
               </div>
            </div>
        </section>
        <?php endif?>
    </main>





<?php get_footer()?>