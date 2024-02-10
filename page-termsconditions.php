<?php
/**
 * Template Name: Terms and Condition
 * @package herbanext
 */
get_header();
$image_id = get_post_thumbnail_id();
$tc_alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
$get_img = get_acf_field('terms_and_condition_image');
?>
<main>
    <!-- jumbotron -->
    <section id="jumbotron_about" class="w-100 position-relative">
        <?php if( !empty($get_img['terms_and_condition_jumbotron_image']['url'])):?>
             <img src="<?php echo esc_url($get_img['terms_and_condition_jumbotron_image']['url']) ?>" alt="<?php echo esc_url($get_img['terms_and_condition_jumbotron_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute bottom-0 left-0">
        <?php else:?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($tc_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
        <?php endif?>
        <div class="container position-absolute">
            <div class="col-12 col-md-8 col-lg-6 mx-auto text-center my-auto">
                <?php if (is_page() && !is_front_page()) : ?>
                    <h1 class="display-2 museo fw-bold text-success">
                        <?php single_post_title() ?>
                    </h1>
                <?php endif ?>
                <h6 class="mt-4">
                    <nav aria-label="breadcrumb">
                        <?php custom_breadcrumbs() ?>
                    </nav>
                </h6>
            </div>
        </div>
    </section>
    <?php if(!empty( get_the_content())):?>
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div id="qual_content" class="lh-lg">
                                <?php get_template_part('template-parts/components/blog/services','content') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif?>
</main>
<?php get_footer()?>