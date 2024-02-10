<?php
/**
 * Template Name: Herbanext Product Development
 * @package herbanext
 */
get_header();
$prod_dev_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));

$acf_prod_dev_fields = array(
    'jumb_prod_dev' => 'product_development_jumbotron',
    'prod_dev_cont_1' => 'product_development_section_content_1',
    'prod_dev_cont_2' => 'product_development_section_content_2',
);
$acf_prod_dev_values = array();

foreach ($acf_prod_dev_fields as $key => $field_name) {
    $acf_prod_dev_values[$key] = get_acf_field($field_name);
}
?>
    <main>
        <?php if (!empty($acf_prod_dev_values['jumb_prod_dev'])) : ?>
        <section id="jumbotron_about" class="w-100 position-relative">
            <?php if (!empty($acf_prod_dev_values['jumb_prod_dev']['image']['url'])) : ?>
                <img src="<?php echo esc_url($acf_prod_dev_values['jumb_prod_dev']['image']['url']) ?>" alt="<?php echo esc_attr($acf_prod_dev_values['jumb_prod_dev']['image']['alt']) ?>" class="object-fit-cover w-100 position-absolute bottom-0 left-0">
            <?php else : ?>
                <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($prod_dev_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
            <?php endif ?>
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
        <?php endif?>

       <section id="about">
        <?php if(!empty($acf_prod_dev_values['prod_dev_cont_1']['content']) || !empty($acf_prod_dev_values['prod_dev_cont_1']['title'])):?>     
        <!-- CONTENT 1 -->
        <div class="who_are_are">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-5 mb-md-0 text-center text-md-start">
                        <h1 class="display-3 museo fw-bold">
                            <?php echo esc_html_e($acf_prod_dev_values['prod_dev_cont_1']['title']) ?>
                        </h1>
                        <p class="lh-lg text-secondary mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                            <?php echo esc_textarea( $acf_prod_dev_values['prod_dev_cont_1']['content'] ) ?>
                        </p>
                       <a href="#qualContent" class="btn btn-success px-5 py-4 btn-lg mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('400'); ?>"><?php echo wp_kses_decode_entities( $acf_prod_dev_values['prod_dev_cont_1']['button_label_with_icon'] ) ?></a>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row">
                        <?php if (!empty($acf_prod_dev_values['prod_dev_cont_1']['images'])) : $prod_img_delay = 200;
                            foreach ($acf_prod_dev_values['prod_dev_cont_1']['images'] as $key =>  $image) : ?>
                                <div class="col<?php echo $key === 0 ? '-12 mb-4' : '' ?>" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($prod_img_delay); ?>">
                                    <img src="<?php echo esc_url($image['image']['url']); ?>" alt="<?php echo esc_attr($image['image']['alt']); ?>" class="img-fluid w-100 rounded-5 object-fit-cover">
                                </div>
                            <?php $prod_img_delay += 200; endforeach ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif?>

       
        <?php if(!empty( get_the_content())):?>
         <!-- POST CONTENT  -->
        <div class="post_page" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <div class="row">
                                <div id="qual_content">
                                    <?php get_template_part('template-parts/components/blog/services','content') ?>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif?>

        <?php if(!empty($acf_prod_dev_values['prod_dev_cont_2']['title']) || !empty($acf_prod_dev_values['prod_dev_cont_2']['content'])) :?>
        <!-- CONTENT 2 -->
        <div class="quality_standard bg-gray" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
            <div class="container">
                <div class="row g-lg-5">
                    <div class="col-12 col-md-6" id="qualContent">
                    <?php if(!empty($acf_prod_dev_values['prod_dev_cont_2']['title']) || !empty($acf_prod_dev_values['prod_dev_cont_2']['content'])) :?>
                       <div class="qual_wrapper mb-5">
                            <h1 class="museo dispaly-5 fw-bold text-center text-md-start mb-5"><?php echo wp_kses_decode_entities($acf_prod_dev_values['prod_dev_cont_2']['title']) ?></h1>
                            <p class="lh-lg text-secondary"><?php echo nl2br(esc_textarea($acf_prod_dev_values['prod_dev_cont_2']['content'])) ?></p>
                       </div>
                    <?php endif?>
                    <?php echo wp_kses_decode_entities( $acf_prod_dev_values['prod_dev_cont_2']['content_form'] ) ?>
                    </div>
                    <div class="col-12 col-md-6 mt-5 mt-md-0">
                        <div class="row">
                            <?php if($acf_prod_dev_values['prod_dev_cont_2']['content_3_images']) : $prod_form_delay = 200;?>
                                <?php foreach($acf_prod_dev_values['prod_dev_cont_2']['content_3_images'] as $key => $labcontImages) :?>
                                <div class="col<?php echo $key === array_key_last($acf_prod_dev_values['prod_dev_cont_2']['content_3_images']) ? '-12' : ' mb-4' ?>" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($prod_form_delay); ?>">
                                    <img src="<?php echo esc_url($labcontImages['image']['url'])?>" alt="<?php echo esc_attr($labcontImages['image']['alt'])?>" class="img-fluid rounded-5">
                                </div>
                                <?php $prod_form_delay += 200; endforeach?>
                            <?php endif?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif?>
       </section>
    </main>
<?php get_footer() ?>