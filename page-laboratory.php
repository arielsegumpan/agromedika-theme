<?php
/**
 * Template Name: Herbanext Laboratory
 * @package herbanext
 */
get_header();

// Get post thumbnail and alt text
$lab_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));

// Define an array of ACF field names
$acf_fields = array(
    'jumb_lab' => 'laboratory_jumbotron',
    'lab_cont_1' => 'laboratory_section_content_1',
    'lab_cont_2' => 'laboratory_section_content_2',
    'lab_cont_3' => 'laboratory_section_content_3'
);
$acf_lab_values = array();
foreach ($acf_fields as $key => $field_name) {
    $acf_lab_values[$key] = get_acf_field($field_name);
}
?>
    <main>
        <!-- jumbotron -->
        <section id="jumbotron_about" class="w-100 position-relative">
            <?php if (!empty($acf_lab_values['jumb_lab']['image']['url'])): ?>
                <img src="<?php echo esc_url($acf_lab_values['jumb_lab']['image']['url']) ?>" alt="<?php echo esc_attr($acf_lab_values['jumb_lab']['image']['alt']) ?>" class="object-fit-cover w-100 position-absolute bottom-0 left-0">
            <?php else : ?>
                <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($lab_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
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

       <section id="about">
        <!-- CONTENT 1 -->
        <?php if(!empty($acf_lab_values['lab_cont_1']['content']) || !empty($acf_lab_values['lab_cont_1']['title'])):?>              
        <div class="who_are_are bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-5 mb-lg-0 text-center text-md-start">
                        <h1 class="display-3 museo fw-bold" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>"><?php echo esc_html_e($acf_lab_values['lab_cont_1']['title']) ?></h1>
                        <p class="lh-lg text-secondary mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                          <?php echo esc_textarea( $acf_lab_values['lab_cont_1']['content'] ) ?>
                        </p>
                        <div class="d-flex flex-column flex-lg-row gap-lg-3"  data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('300')?>">
                            <a href="#scrollContent" class="btn btn-success px-5 py-4 btn-lg mt-5">
                            <?php echo wp_kses_decode_entities( $acf_lab_values['lab_cont_1']['button_label_with_icon'] ) ?>
                            </a>
                            <?php if(!empty($acf_lab_values['lab_cont_1']['laboratory_button_link'])): ?>
                            <a href="<?php echo esc_url( $acf_lab_values['lab_cont_1']['laboratory_button_link']) ?>" class="btn btn-success px-5 py-4 btn-lg mt-4 mt-lg-5";?><?php echo wp_kses_decode_entities( $acf_lab_values['lab_cont_1']['laboratory_button_label_with_icon'] ) ?></a>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                        <div id="who_we_are">
                            <div class="row row-cols-2 g-4">
                               <?php 
                                if (!empty($acf_lab_values['lab_cont_1']['images'])) : $card_delay = 200;
                                    foreach ($acf_lab_values['lab_cont_1']['images'] as $image) : ?>
                                        <div class="col" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($card_delay); ?>">
                                        <img src="<?php echo esc_url($image['image']['url']); ?>" alt="<?php echo esc_attr($image['image']['alt']); ?>" class="img-fluid w-100 rounded-5 object-fit-cover">
                                        </div>
                                    <?php $card_delay += 200; endforeach ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif?>
        <!-- CONTENT 2 -->
        <?php if(!empty($acf_lab_values['lab_cont_2']['content']) || !empty($acf_lab_values['lab_cont_2']['title'])):?>   
        <div class="novel_portfolio bg-success">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 px-md-5 mb-5 mb-md-0 text-center text-md-start">
                        <h1 class="display-5 museo text-white fw-bold mb-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>"><?php echo esc_html_e($acf_lab_values['lab_cont_2']['title']) ?></h1>
                        <?php if($acf_lab_values['lab_cont_2']['image']):?>
                            <img src="<?php echo esc_url($acf_lab_values['lab_cont_2']['image']['url']) ?>" alt="<?php echo esc_attr($acf_lab_values['lab_cont_2']['image']['alt']) ?>" class="img-fluid rounded-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                        <?php endif?>
                    </div>
                    <div class="col-12 col-lg-6 text-center text-lg-start mt-5 mt-lg-auto my-auto pe-lg-5">
                        <p class="text-secondary text-gray lh-lg" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('300'); ?>">
                            <?php echo nl2br(esc_textarea($acf_lab_values['lab_cont_2']['content'])) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif?>
         <!-- POST CONTENT  -->
        <?php if(!empty( get_the_content())):?>
        <div class="quality_standard bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       <div class="container">
                        <div class="row">
                            <div id="qual_content" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>">
                                <?php get_template_part('template-parts/components/blog/services','content') ?>
                            </div>
                        </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>

        <?php if(!empty($acf_lab_values['lab_cont_3']['title']) || !empty($acf_lab_values['lab_cont_3']['content'])) :?>
        <div class="innovative" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
            <div class="container">
                <div class="row g-lg-5">
                    <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                        <?php if(!empty($acf_lab_values['lab_cont_3']['title']) || !empty($acf_lab_values['lab_cont_3']['content'])) :?>
                       <div id="scrollContent" class="qual_wrapper mb-5 text-center text-lg-start">
                            <h1 class="museo dispaly-5 fw-bold text-center text-lg-start mb-5"><?php echo wp_kses_decode_entities($acf_lab_values['lab_cont_3']['title']) ?></h1>
                            <p class="lh-lg text-secondary"><?php echo nl2br(esc_textarea($acf_lab_values['lab_cont_3']['content'])) ?></p>
                       </div>
                       <?php endif?>
                       <?php
                            echo wp_kses_decode_entities( $acf_lab_values['lab_cont_3']['content_form'] )
                       ?>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <?php if($acf_lab_values['lab_cont_3']['content_3_images']) : $lab_delay = 200?>
                                <?php foreach($acf_lab_values['lab_cont_3']['content_3_images'] as $key => $labcontImages) :?>
                                <div class="col<?php echo $key === array_key_last($acf_lab_values['lab_cont_3']['content_3_images']) ? '-12' : ' mb-4' ?>" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($lab_delay); ?>">
                                    <img src="<?php echo esc_url($labcontImages['image']['url'])?>" alt="<?php echo esc_attr($labcontImages['image']['alt'])?>" class="img-fluid rounded-5">
                                </div>
                                <?php $lab_delay += 200; endforeach?>
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