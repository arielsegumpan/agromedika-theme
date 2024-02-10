<?php
/**
 * Template Name: Partner with us
 * @package herbanext
 */

get_header();
$partner_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
// Define an array of ACF field names
$partner_acf_fields = array(
    'partner_section_1' => 'partner_section_1',
    'partner_section_2' => 'partner_section_2',
    'partner_team' => 'partner_team',
);

// Initialize an empty array to store the field values
$partner_acf_values = array();

// Loop through the field names and fetch their values
foreach ($partner_acf_fields as $key => $partner_field_name) {
    $partner_acf_values[$key] = get_field($partner_field_name);
}
?>

<main>
    <!-- jumbotron -->
    <?php if (!empty($partner_acf_values['partner_section_1'])) : ?>
        <section id="jumbotron_about" class="w-100 position-relative">
            <?php $jumbotron_image = $partner_acf_values['partner_section_1']['partner_jumbotron_image'] ?>
            <?php if (!empty($jumbotron_image['url'])) : ?>
                <img src="<?php echo esc_url($jumbotron_image['url']); ?>" alt="<?php echo esc_attr($jumbotron_image['alt']); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
            <?php else : ?>
                <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($partner_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
            <?php endif ?>
            <div class="container position-absolute">
                <?php echo do_shortcode('[custom_page_headers]'); ?>
            </div>
        </section>
    <?php endif; ?>

    <section id="about">
        <!-- novel portfolio -->
        <?php if (!empty($partner_acf_values['partner_section_1'])) : ?>
            <div class="novel_portfolio bg-success">
                <div class="container-fluid">
                    <?php $section1 = $partner_acf_values['partner_section_1']; ?>
                    <div class="row">
                        <div class="col-12 col-lg-6 px-md-5 mb-5 mb-lg-0 text-center text-md-start">
                            <div class="mb-5">
                                <h1 class="display-5 museo text-white fw-bold mb-5" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="<?php echo esc_attr('200'); ?>"><?php echo esc_html($section1['partner_title']); ?></h1>
                                <div class="text-white lh-lg" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="<?php echo esc_attr('400'); ?>">
                                    <?php echo wp_kses_post($section1['partner_content']); ?>
                                </div>
                            </div>
                            <?php $partner_image = $section1['partner_image']; ?>
                            <?php if (!empty($partner_image['url'])) : ?>
                                <img src="<?php echo esc_url($partner_image['url']); ?>" alt="<?php echo esc_attr($partner_image['alt']); ?>" class="img-fluid rounded-5" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="<?php echo esc_attr('600'); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-6 px-md-5 px-lg-auto text-center text-md-start my-auto pe-lg-5" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="<?php echo esc_attr('400'); ?>">
                            <?php echo wp_kses_decode_entities($section1['partner_form']); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- certified toll -->
        <?php if (!empty($partner_acf_values['partner_section_2']) || !empty($partner_acf_values['partner_team'])) : ?>
            <div class="certified_toll">
                <div class="container">
                    <div class="col-12 text-center">
                        <div class="certified_toll_content">
                            <?php $section2 = $partner_acf_values['partner_section_2']; ?>
                            <?php if (!empty($section2)) : ?>
                                <div class="col-12 col-lg-10 mx-auto">
                                    <?php $partner_icon = $section2['partner_icon']; ?>
                                    <?php if (!empty($partner_icon['url'])) : ?>
                                        <div class="certified_icon mb-5">
                                            <img src="<?php echo esc_url($partner_icon['url']); ?>" alt="<?php echo esc_attr($partner_icon['alt']); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <h1 class="display-5 museo fw-bold mb-5"><?php echo esc_html($section2['partner_title_section_2']); ?></h1>
                                    <div class="lh-lg my-5 text-secondary px-md-5 fs-5">
                                        <?php echo wp_kses_post($section2['partner_content_section_2']); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php $partner_team = $partner_acf_values['partner_team']; ?>
                            <?php if (!empty($partner_team)) : $part_delay = 200 ?>
                                <div class="container-fluid p-0">
                                    <div id="partner">
                                        <div class="row row-cols row-cols-md-2 row-cols-lg-3 row-gap-lg-5">
                                            <?php foreach ($partner_team as $partner) : ?>
                                                <?php $team_image = $partner['team_image']; ?>
                                                <?php if (!empty($team_image['url'])) : ?>
                                                    <div class="col" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="<?php echo esc_attr($part_delay); ?>">
                                                        <div class="d-flex flex-column justify-content-center align-items-center gap-4 rounded-5 py-4 py-md-5">
                                                            <img src="<?php echo esc_url($team_image['url']); ?>" alt="<?php echo esc_attr($team_image['alt']); ?>" class="bg-gray rounded-5 p-3">
                                                            <div class="vision_title_Wrap text-center">
                                                                <h6 class="museo fw-bold fs-3"><?php echo wp_kses_post($partner['team_name']); ?></h6>
                                                                <small class="text-secondary"><?php echo wp_kses_post($partner['team_content']); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php $part_delay += 200; endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

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

<?php get_footer(); ?>
