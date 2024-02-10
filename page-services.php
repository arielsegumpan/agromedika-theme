<?php
/**
 * Template Name: Services
 * @package herbanext
 */
get_header();

$service_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));

$acf_services_fields = array(
    'jumb_serv_dev' => 'services_page_jumbotron',
    'serv_cont_1' => 'services_page_content_1',
    'serv_cont_2' => 'services_page_content_2',
    'serv_cont_3' => 'services_page_content_3',
    'serv_cont_4' => 'services_page_content_4',
);
$acf_services_values = array();

foreach ($acf_services_fields as $key => $field_name) {
    $acf_services_values[$key] = get_acf_field($field_name);
}
?>
    <main>
        <?php if (!empty($acf_services_values['jumb_serv_dev'])) : ?>
        <section id="jumbotron_about" class="w-100 position-relative">
            <?php if (!empty($acf_services_values['jumb_serv_dev']['image']['url'])) : ?>
                <img src="<?php echo esc_url($acf_services_values['jumb_serv_dev']['image']['url']) ?>" alt="<?php echo esc_attr($acf_services_values['jumb_serv_dev']['image']['alt']) ?>" class="object-fit-cover w-100 position-absolute bottom-0 left-0">
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
            <?php if (!empty($acf_services_values['serv_cont_1'])) :?>
            <!-- CONTENT 1 -->
            <div class="novel_portfolio bg-success">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6 px-md-5 mb-5 mb-md-0 text-center text-md-start">
                            <div id="services_carous" class="owl-theme owl-carousel position-relative">
                            <?php if (!empty($acf_services_values['serv_cont_1']['slide_images'])) : 
                                foreach ($acf_services_values['serv_cont_1']['slide_images'] as $key =>  $slide_image) : ?>
                                    <div class="item">
                                        <img src="<?php echo esc_url($slide_image['image']['url']); ?>" alt="<?php echo esc_attr($slide_image['image']['alt']); ?>" class="img-fluid rounded-5 object-fit-cover">
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 text-center text-lg-start my-auto pe-lg-5 mt-5 mt-lg-0 pt-md-4">
                            <h1 class="display-5 museo text-white fw-bold mb-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>"><?php echo esc_html_e($acf_services_values['serv_cont_1']['title']) ?></h1>
                            <p class="text-secondary text-gray lh-lg" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('400'); ?>">
                               <?php echo nl2br(esc_textarea( $acf_services_values['serv_cont_1']['content'] )) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif?>
            <?php if (!empty($acf_services_values['serv_cont_2']['background_image']) && !empty($acf_services_values['serv_cont_2']['title'])) :?>
            <!-- CONTENT 2 -->
            <div class="organic position-relative w-100">
                <img id="organic_img" src="<?php echo esc_url($acf_services_values['serv_cont_2']['background_image']['url']) ?>" alt="<?php echo esc_attr($acf_services_values['serv_cont_2']['background_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute">
                <div class="bg_color"></div>
                <div class="container position-absolute">
                    <div class="row">
                        <div class="col-12 col-lg-7 me-auto my-auto px-5 px-md-auto">
                            <h2 class="museo dispaly-5 text-success fw-bold text-center text-lg-start pe-lg-5 mb-5"><?php echo esc_html_e($acf_services_values['serv_cont_2']['title']) ?></h2>
                            <div class="row row-cols-2 g-4">
                            <?php if (!empty($acf_services_values['serv_cont_2']['images'])) : $ser_opt_delay = 200;
                                foreach ($acf_services_values['serv_cont_2']['images'] as $key =>  $get_image) : ?>
                                    <div class="org_img" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($serv_opt_delay); ?>">
                                        <img src="<?php echo esc_url($get_image['image']['url']); ?>" alt="<?php echo esc_attr($get_image['image']['alt']); ?>" class="img-fluid rounded-5 object-fit-cover">
                                    </div>
                                <?php $ser_opt_delay += 200; endforeach ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif?>
            <?php if (!empty($acf_services_values['serv_cont_3']['services_lists'])) : $serv_card_delay = 200;?>
            <!-- CONTENT 3 -->
            <div class="certified_toll">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 g-4">
                        <?php foreach($acf_services_values['serv_cont_3']['services_lists'] as $key => $service_list):?>
                        <div class="cert_img" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($serv_card_delay); ?>">
                            <a href="<?php echo esc_url($service_list['page_link_to']) ?>" class="text-decoration-none">
                                <div class="card mb-3 border-0" >
                                    <div class="row g-0">
                                        <?php if(!empty($service_list['card_image'])) :?>
                                        <div class="col-md-4">
                                            <img src="<?php echo esc_url($service_list['card_image']['url']) ?>" alt="<?php echo esc_attr($service_list['card_image']['alt']) ?>" class="img-fluid rounded-5">
                                        </div>
                                        <?php endif?>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                            <h3 class="card-title museo"><?php echo esc_html_e($service_list['title']) ?></h3>
                                            <p class="card-text text-secondary"><?php echo nl2br(esc_textarea( $service_list['excerpt'] ))?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php $serv_card_delay += 200; endforeach?>
                    </div>
                </div>
            </div>
            <?php endif?>

            <?php if (!empty($acf_services_values['serv_cont_4']['title']) && !empty($acf_services_values['serv_cont_4']['content'])) :?>
            <!-- CONTENT 4 -->
            <div class="quality_standard">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h1 class="museo dispaly-5 fw-bold text-center text-md-start" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>"><?php echo esc_html_e($acf_services_values['serv_cont_4']['title']) ?></h1>
                            <p class="lh-lg mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('400'); ?>"><?php echo nl2br(esc_textarea( $acf_services_values['serv_cont_4']['content'] )) ?></p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                            <?php if (!empty($acf_services_values['serv_cont_4']['images'])) : $serv_cont4_delay = 200;
                            foreach ($acf_services_values['serv_cont_4']['images'] as $key =>  $getimage) : ?>
                                <div class="col<?php echo $key === 0 ? '-12 mb-4' : '' ?>" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($serv_cont4_delay); ?>">
                                    <img src="<?php echo esc_url($getimage['image']['url']); ?>" alt="<?php echo esc_attr($getimage['image']['alt']); ?>" class="img-fluid w-100 rounded-5 object-fit-cover">
                                </div>
                            <?php $serv_cont4_delay += 200; endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif?>
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