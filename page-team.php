<?php
/**
 * Template Name: Team
 * @package herbanext
 */
get_header();
$team_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
// Retrieve ACF values once and store them in variables
$team_jumb = get_acf_field('team_jumbotron');
$team_cards = get_acf_field('team_cards');
$team_card_contents = !empty($team_cards['card']) ? $team_cards['card'] : [];

?>
<main>
    <!-- jumbotron -->
    <section id="jumbotron_about" class="w-100 position-relative">
        <?php if ($team_jumb && !empty($team_jumb['jumbotron_image']['url'])) : ?>
            <img src="<?php echo esc_url($team_jumb['jumbotron_image']['url']) ?>" alt="<?php echo esc_attr($team_jumb['jumbotron_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
        <?php else : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($team_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
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
    <section id="team">
        <div class="container">
            <div class="row">
                <?php if (!empty($team_card_contents)) : $team_delay = 200?>
                    <?php foreach ($team_card_contents as $team_card_content) : ?>
                        <?php if (!empty($team_card_content)) : ?>
                            <div class="col-12 col-md-4 col-lg-3 pb-4 text-center mb-5" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="<?php echo esc_attr($team_delay); ?>">
                                <div class="team_img">
                                    <?php if (!empty($team_card_content['profile_picture']['url'])) : ?>
                                        <img src="<?php echo esc_url($team_card_content['profile_picture']['url']) ?>" alt="<?php echo esc_attr($team_card_content['profile_picture']['alt']) ?>" class="img-fluid object-fit-cover rounded-5">
                                    <?php endif ?>
                                    <?php if (!empty($team_card_content['team_name'])) : ?>
                                        <h4 class="fw-bold text-success museo mt-5"><?php echo esc_html($team_card_content['team_name']) ?></h4>
                                    <?php endif ?>
                                    <?php if (!empty($team_card_content['team_description'])) : ?>
                                        <h6 class="text-secondary px-lg-5 mt-3 small"><?php echo esc_html($team_card_content['team_description']) ?></h6>
                                    <?php endif ?>
                                    <hr class="w-50 mx-auto my-4">
                                    <?php
                                    $team_card_socmeds = !empty($team_card_content['socmed_links']) ? $team_card_content['socmed_links'] : [];

                                    if (!empty($team_card_socmeds)) : ?>
                                        <div class="d-flex flex-row justify-content-center gap-3 mx-auto">
                                            <?php foreach ($team_card_socmeds as $team_card_socmed) : ?>
                                                <?php if (!empty($team_card_socmed['links']) && !empty($team_card_socmed['socmed_icon'])) : ?>
                                                    <a href="<?php echo esc_url($team_card_socmed['links']) ?>" class="text-decoration-none btn btn-success fs-3">
                                                        <?php echo wp_kses_decode_entities($team_card_socmed['socmed_icon']) ?>
                                                    </a>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php $team_delay += 200; endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </section>
    <?php if(!empty( get_the_content())):?>
         <!-- POST CONTENT  -->
        <section id="about">
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
        </section>
    <?php endif?>
</main>
<?php
get_footer();
?>
