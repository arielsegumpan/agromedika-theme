<?php
/**
 * Template Name: Toll Manufacturing
 * @package herbanext
 */
get_header();
$toll_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
$jumb = get_acf_field('jumbotron');
$cont_sec_1 = get_acf_field('content_section_1');
$cont_imgs = $cont_sec_1 ? $cont_sec_1['content_image'] : [];
$cont_sec_2 = get_acf_field('content_section_2');
$cont_sec_3 = get_acf_field('content_section_3');
$cont_sec_4 = get_acf_field('content_section_4');
$cont_sec_5 = get_acf_field('content_section_5');
$cont_imgs_5 = $cont_sec_5 ? $cont_sec_5['content_5_image'] : [];
?>
    <main>
        <!-- jumbotron -->
        <section id="jumbotron_about" class="w-100 position-relative">
           <?php if(!empty($jumb['jumbotron_background_image']['url'])): ?>
            <img src="<?php echo esc_url($jumb['jumbotron_background_image']['url']) ?>" alt="<?php echo esc_url($jumb['jumbotron_background_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute bottom-0 left-0">
            <?php else:?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($toll_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
            <?php endif?>
            <div class="container position-absolute">
                <div class="col-12 col-md-8 col-lg-6 mx-auto text-center my-auto">
                <?php
                    if(is_page() && !is_front_page()):?>
                        <h1 class="display-2 museo fw-bold text-success">
                            <?php single_post_title() ?>
                        </h1>
                    <?php endif
                ?>
                    <h6 class="mt-4">
                        <nav aria-label="breadcrumb">
                            <?php custom_breadcrumbs() ?>
                        </nav>
                    </h6>
                </div>
            </div>
        </section>  

         <!-- CONTENT 1-->
       <section id="about">
        <?php if($cont_sec_1) : ?>
            <div class="who_are_are">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-5 mb-md-0 text-center text-md-start">
                            <h1 class="display-3 museo fw-bold"><?php echo esc_html_e($cont_sec_1['content_title']) ?></h1>
                            <p class="lh-lg text-secondary mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>">
                            <?php echo nl2br(esc_textarea( $cont_sec_1['content'] ))?>
                            </p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row mb-4">
                                <?php foreach ($cont_imgs as $key => $cont_img):?>
                                <div class="col<?php echo $key === array_key_first($cont_imgs) ? '-12 mb-4' : '' ?>">
                                    <img src="<?php echo esc_url($cont_img['image']['url'])?>" alt="<?php echo esc_attr($cont_img['image']['alt'])?>" class="img-fluid w-100 rounded-5 object-fit-cover">
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <!-- CONTENT 2 -->
        <?php if($cont_sec_2) :?>
        <div class="novel_portfolio bg-success">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 px-md-5 mb-5 mb-md-0 text-center text-md-start">
                        <h1 class="display-5 museo text-white fw-bold mb-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>"><?php echo esc_html_e($cont_sec_2['content_title']) ?></h1>
                        <img src="<?php echo esc_url($cont_sec_2['content_image']['url']) ?>" alt="<?php echo esc_url($cont_sec_2['content_image']['alt']) ?>" class="img-fluid rounded-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-start my-auto pe-md-5">
                        <p class="text-secondary text-gray lh-lg" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('300'); ?>">
                            <?php echo nl2br(esc_textarea( $cont_sec_2['content'] )) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>

        <!-- CONTENT 3 -->
        <?php if($cont_sec_3) :?>
        <div class="organic position-relative w-100">
            <img id="organic_img" src="<?php echo esc_url($cont_sec_3['content_3_background_image']['url']) ?>" alt="<?php echo esc_url($cont_sec_3['content_3_background_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute">
            <div class="container position-absolute">
                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-6 me-auto my-auto px-5 px-md-auto">
                        <h1 class="museo dispaly-5 text-success fw-bold pe-lg-5"><?php echo esc_html_e($cont_sec_3['content_title']) ?></h1>
                        <p class="lh-lg text-secondary mt-5">
                            <?php echo nl2br(esc_textarea( $cont_sec_3['content'] ))?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>

        <!-- CONTENT 4 -->
        <?php if($cont_sec_4) :?>
        <div class="innovative">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                   <?php if($cont_sec_4['content_4_image']):?>
                    <img src="<?php echo esc_url($cont_sec_4['content_4_image']['url']) ?>" alt="<?php echo esc_attr($cont_sec_4['content_4_image']['alt']) ?>" class="img-fluid rounded-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>">
                    <?php endif?>
                    </div>
                    <div class="col-12 col-lg-6 my-auto px-md-5 text-center text-md-start mt-5 mt-lg-0">
                        <h1 class="museo dispaly-5 text-success fw-bold pe-md-5 mt-5 mt-md-0" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>"><?php echo esc_html_e($cont_sec_4['content_title']) ?></h1>
                        <p class="lh-lg text-secondary mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('300'); ?>">
                            <?php if($cont_sec_4['content']):?>
                                <?php echo nl2br(esc_textarea( $cont_sec_4['content'] )) ?>
                            <?php endif?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
        <?php if(!empty( get_the_content())):?>
         <!-- POST CONTENT  -->
            <div class="page_post">
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
       </section>
    </main>




<?php
get_footer()?>