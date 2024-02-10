<?php
/**
 * Template Name: Story
 * @package herbanext
 */
get_header();
$alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
// Retrieve ACF values once and store them in variables
$story_jumb = get_acf_field('story_jumbotron');
$story_who_we_Are = get_acf_field('who_we_are');
$novel_portfolio = get_acf_field('novel_portfolio');
$certified_toll = get_acf_field('certified_toll');
$organic = get_acf_field('organic');
$innovative = get_acf_field('innovative');
$committed = get_acf_field('committed_to_science');
$mission_and_vision = get_acf_field('mission_and_vision');
$core_values = get_acf_field('core_values');
$quality_standard = get_acf_field('quality_standard');

?>

<main>
    <!-- jumbotron -->
    <section id="jumbotron_about" class="w-100 position-relative">
        <?php if (!empty($story_jumb['jumbotron_story_image']['url'])) : ?>
            <img src="<?php echo esc_url($story_jumb['jumbotron_story_image']['url']) ?>" alt="<?php echo esc_attr($story_jumb['jumbotron_story_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
        <?php else : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
        <?php endif ?>
        <div class="container position-absolute">
            <?php echo do_shortcode('[custom_page_headers]') ?>
        </div>
    </section>
    <section id="about">
        <!-- who we are -->
        <?php if (!empty($story_who_we_Are)) : ?>
            <div class="who_are_are">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-5 mb-md-0 text-center text-md-start">
                            <h1 class="display-3 museo fw-bold" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>">
                                <?php echo esc_html($story_who_we_Are['content_title']) ?>
                            </h1>
                            <p class="lh-lg text-secondary mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                                <?php echo esc_textarea($story_who_we_Are['content']) ?>
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                            <div class="row mb-4">
                                <?php if (!empty($story_who_we_Are['content_image'])) : $story_delay = 200  ?>
                                    <?php foreach ($story_who_we_Are['content_image'] as $key => $who_img) : ?>
                                        <div class="col<?php echo $key === 0 ? '-12 mb-4' : '' ?>" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($story_delay); ?>">
                                            <img src="<?php echo esc_url($who_img['image']['url']) ?>" alt="<?php echo esc_attr($who_img['image']['alt']) ?>" class="img-fluid w-100 rounded-5 object-fit-cover">
                                        </div>
                                    <?php $story_delay += 200; endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- novel portfolio -->
        <?php if (!empty($novel_portfolio)) : ?>
            <div class="novel_portfolio bg-success">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 px-md-5 mb-5 mb-md-0 text-center text-md-start">
                            <h1 class="display-5 museo text-white fw-bold mb-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>"><?php echo esc_html($novel_portfolio['content_title']) ?></h1>
                            <img src="<?php echo esc_url($novel_portfolio['content_image']['url']) ?>" alt="<?php echo esc_attr($novel_portfolio['content_image']['alt']) ?>" class="img-fluid rounded-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                        </div>
                        <div class="col-12 col-md-6 text-center text-md-start my-auto pe-md-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('300'); ?>">
                            <p class="text-secondary text-gray lh-lg">
                                <?php echo nl2br(esc_textarea($novel_portfolio['content'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- certified toll -->
        <?php if (!empty($certified_toll)) : ?>
            <div class="certified_toll">
                <div class="container">
                    <div class="col-12 text-center">
                        <img src="<?php echo esc_url($certified_toll['certified_toll_image']['url']) ?>" alt="<?php echo esc_attr($certified_toll['certified_toll_image']['alt']) ?>" class="rounded-5 object-fit-cover">
                        <div class="certified_toll_content">
                            <div class="col-12 col-lg-5 mx-auto">
                                <div class="certified_icon mb-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>">
                                    <img src="<?php echo esc_url($certified_toll['certified_toll_icon']['url']) ?>" alt="<?php echo esc_attr($certified_toll['certified_toll_icon']['alt']) ?>">
                                </div>
                                <h1 class="display-5 museo fw-bold mb-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>"><?php echo esc_html($certified_toll['content_title']) ?></h1>
                            </div>

                            <p class="lh-lg mt-5 text-secondary px-md-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('300'); ?>">
                                <?php echo nl2br(esc_textarea($certified_toll['content'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- organic -->
        <?php if (!empty($organic)) : ?>
            <div class="organic position-relative w-100">
                <img id="organic_img" src="<?php echo esc_url($organic['oragnic_image']['url']) ?>" alt="<?php echo esc_attr($organic['oragnic_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute">
                <div class="container position-absolute">
                    <div class="row">
                        <div class="col-12 col-lg-8 col-xl-7 me-auto my-auto px-5 px-md-auto">
                            <h1 class="museo dispaly-5 text-black fw-bold pe-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>"><?php echo esc_html($organic['organic_title']) ?></h1>
                            <p class="lh-lg text-secondary mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                                <?php echo nl2br(esc_textarea($organic['organic_content'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- innovative solutions -->
        <?php if (!empty($innovative)) : ?>
            <div class="innovative">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <img src="<?php echo esc_url($innovative['innovative_image']['url']) ?>" alt="<?php echo esc_attr($innovative['innovative_image']['alt']) ?>" class="img-fluid rounded-5">
                        </div>
                        <div class="col-12 col-lg-6 my-auto px-md-5 mt-5 md-lg-0 text-center text-md-start">
                            <h1 class="museo dispaly-5 text-black fw-bold pe-md-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>"><?php echo esc_html($innovative['innovative_title']) ?></h1>
                            <p class="lh-lg text-secondary mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                                <?php echo nl2br(esc_textarea($innovative['innovative_content'])) ?>
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
        <!-- committed to science -->
        <?php if (!empty($committed)) : ?>
            <div class="committed bg-success">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6 my-auto text-center text-md-start mb-5 mb-md-0">
                            <h1 class="museo display-5 text-white fw-bold" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>"><?php echo esc_html($committed['committed_title']) ?></h1>
                            <p class="lh-lg text-white mt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                                <?php echo nl2br(esc_textarea($committed['committed_content'])) ?>
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                            <img src="<?php echo esc_url($committed['committed_image']['url']) ?>" alt="<?php echo esc_attr($committed['committed_image']['alt']) ?>" class="img-fluid rounded-4 rounded-md-5">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- mission vision -->
        <?php if (!empty($mission_and_vision)) : ?>
            <div class="mission_vision">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php if (!empty($mission_and_vision['mission_image'])) : ?>
                                <img src="<?php echo esc_url($mission_and_vision['mission_image']['url']) ?>" alt="<?php echo esc_attr($mission_and_vision['mission_image']['alt']) ?>" class="img-fluid rounded-5">
                            <?php endif ?>
                        </div>
                        <div class="col-12 col-md-6 mx-auto text-center mt-5">
                            <div class="mission">
                                <h1 class="museo dispaly-5 fw-bold"><?php echo esc_html($mission_and_vision['mission_title']) ?></h1>
                                <p class="lh-lg lead"><?php echo esc_html($mission_and_vision['mission_subheading']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vision">
                    <div class="container">
                        <div class="row mb-5">
                            <div class="col-12 col-md-6 mx-auto text-center mt-5">
                                <div class="mission">
                                    <h1 class="museo display-5 fw-bold"><?php echo esc_html($mission_and_vision['vision_title']) ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols row-cols-md-2 row-cols-lg-3 row-gap-5">
                            <?php if (!empty($mission_and_vision['herbanext_visions'])) : $vis_delay = 200?>
                                <?php foreach ($mission_and_vision['herbanext_visions'] as $item) : ?>
                                    <div class="col" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($vis_delay); ?>">
                                        <div class="d-flex flex-row justify-content-between align-items-start gap-3">
                                            <?php if (!empty($item['icon']['url'])) : ?>
                                                <img src="<?php echo esc_url($item['icon']['url']) ?>" alt="<?php echo esc_attr($item['icon']['alt']) ?>" class="bg-gray rounded-5 p-3">
                                            <?php endif ?>
                                            <div class="vision_title_Wrap">
                                                <h6 class="museo fw-bold fs-3"><?php echo esc_html($item['title']) ?></h6>
                                                <small class="text-secondary"><?php echo wp_kses_post($item['content']) ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php $vis_delay+=200; endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <!-- core vlaues -->
        <?php if (!empty($core_values)) : ?>
            <div class="core_values bg-success">
                <div class="container">
                    <div class="row">
                        <div class="col-6 mx-auto text-center mt-5">
                            <div class="mission">
                                <h1 class="museo dispaly-5 text-white fw-bold"><?php echo esc_html($core_values['core_title']) ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-3 row-gap-5 mt-5 pt-5">
                        <?php if (!empty($core_values['core_values_cards'])) : $cor_delay=100?>
                            <?php foreach ($core_values['core_values_cards'] as $key => $core_values_img) : ?>
                                <div class="col-12 col-md-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($cor_delay); ?>">
                                    <div class="d-flex flex-column justify-content-center gap-3 align-items-center">
                                        <?php if (!empty($core_values_img['core_card_image']['url'])) : ?>
                                            <img src="<?php echo esc_url($core_values_img['core_card_image']['url']) ?>" alt="<?php echo esc_attr($core_values_img['core_card_image']['alt']) ?>" class="bg-gray rounded-5 p-3">
                                        <?php endif ?>
                                        <div class="vision_title_Wrap text-center">
                                            <h6 class="museo fw-bold text-white fs-3"><?php echo esc_html($core_values_img['core_card_heading']) ?></h6>
                                            <p class="text-secondary text-white mt-3"><?php echo esc_html($core_values_img['core_card_sub_heading']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php $cor_delay+=100; endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- quality standards -->
        <?php if (!empty($quality_standard)) : ?>
            <div class="quality_standard">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h1 class="museo dispaly-5 fw-bold text-center text-md-start"><?php echo wp_kses_decode_entities(nl2br($quality_standard['title'])) ?></h1>
                            <ul class="list-group list-group-flush mt-5">
                                <?php if (!empty($quality_standard['quality_standard_lists'])) : $count_delay = 200; $count = 0; ?>
                                    <?php foreach ($quality_standard['quality_standard_lists'] as $key => $quality_standard_list) : $count++ ?>
                                        <li class="list-group-item bg-transparent mb-5 mb-md-4 pt-0 px-0 pb-4" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($count_delay); ?>">
                                            <div class="d-flex flex-column flex-md-row justify-content-md-start align-items-center gap-3">
                                                <span class="bg-success px-4 py-3 text-white fw-bold rounded-4"><?php echo $count < 10 ? '0' . $count : $count; ?></span>
                                                <div>
                                                    <h5 class="fw-bold text-center text-md-start">
                                                        <?php echo esc_html($quality_standard_list['list_content']) ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </li>
                                    <?php $count_delay += 200; endforeach ?>
                                <?php endif ?>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <?php if (!empty($quality_standard['quality_standard_images'])) : ?>
                                    <?php foreach ($quality_standard['quality_standard_images'] as $key => $quality_standard_img) : ?>
                                        <div class="col<?php echo $key === array_key_last($quality_standard['quality_standard_images']) ? '-12 mt-4' : '' ?>">
                                            <img src="<?php echo esc_url($quality_standard_img['image']['url']) ?>" alt="<?php echo esc_attr($quality_standard_img['image']['alt']) ?>" class="img-fluid w-100 rounded-5 object-fit-cover">
                                        </div>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </section>
</main>

<?php get_footer() ?>
