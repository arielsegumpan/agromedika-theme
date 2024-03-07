<?php 
/**
 * Template Name: 404 Error
 * @package agromedika
 */
get_header();

$fof_error = get_acf_option_field('error');
?>
<main>
    <section id="error" class="bg-lteal">   
        <div class="container">
            <div class="row">
            <?php if(!empty($fof_error['error_image']['url'])) :?>
                <div class="col-12 col-md-7 col-lg-6 text-center">
                <img src="<?php echo esc_url($fof_error['error_image']['url']);?>" alt="<?php echo esc_attr($fof_error['error_image']['alt']);?>" class="img-fluid rounded-4">
                </div>
            <?php endif;?>
                <div class="col-12 col-md-5 col-lg-6 my-auto text-center text-md-start pt-3 pt-lg-0">
                    <h3 class="text-black mb-5"><?php echo html_entity_decode(esc_textarea($fof_error['error_message'])) ;?></h3>
                    <a href="<?php echo esc_url(site_url('/')) ;?>" class="btn btn-primary px-5 py-4 text-lteal rounded-4"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html('Back to main page') ?></a>
                </div>
            </div>
        </div>
    </section>
 </main>


<?php get_footer()?>