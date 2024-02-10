<?php
/**
 * Template Name: Front Page
 * Main template file.
 * @package herbanext
 */
get_header();

// Define array of fields
$acf_fields = array(
    'jumbotron' => 'jumbotron',
    'features' => 'features',
    'story' => 'story',
    'services' => 'services',
    'products' => 'products',
    'galleries' => 'home_gallery',
    'newsupdates' => 'news_and_updates',
    'partnerus' => 'partner_with_us',
);

// Initialize an empty array to store the field values
$acf_values = array();

// Loop through the field names and fetch their values
foreach ($acf_fields as $key => $field_name) {
    $acf_values[$key] = get_acf_field($field_name);
}
?>

<main>
    <?php
    // Jumbotron Section
    $jumbotron = $acf_values['jumbotron'];
    if (!empty($jumbotron['title']) && !empty($jumbotron['subtitle']) && !empty($jumbotron['jumbotron_image']['url'])) :
    ?>
        <!-- jumbotron -->
        <section id="jumbotron" class="w-100 position-relative">
            <img src="<?php echo esc_url($jumbotron['jumbotron_image']['url']); ?>" alt="<?php echo esc_attr($jumbotron['jumbotron_image']['alt']); ?>" class="object-fit-cover w-100 position-absolute">
        </section>
        <!-- jumbortron content -->
        <section id="jumb_content" class="position-relative">
            <div class="container position-absolute">
                <div class="col-12 col-md-8 col-lg-6 me-auto text-center text-md-start">
                    <h1 class="display-2 museo fw-bold text-success">
                        <?php echo esc_html($jumbotron['title']); ?>
                    </h1>
                    <h4 class="mt-4 mb-5">
                        <?php echo esc_html($jumbotron['subtitle']); ?>
                    </h4>
                    <div class="d-flex flex-row justify-content-center justify-content-md-start gap-3 pt-3">
                        <div class="products_btn">
                            <a href="<?php echo esc_url($jumbotron['product_page_link']); ?>" class="btn btn-lg btn-success px-4 py-3"><i class="bi bi-shop me-2"></i><?php esc_html_e('Products'); ?></a>
                        </div>
                        <div class="more_btn">
                            <a href="<?php echo esc_url($jumbotron['about_page_link']); ?>" class="btn btn-lg btn-outline-success px-4 py-3"><i class="bi bi-arrow-right me-2 border-2"></i><?php esc_html_e('More'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Features Section
    $features = $acf_values['features'];
    if (!empty($features['feature_title']) && !empty($features['feature_content'])) :
    ?>
        <section id="features" class="bg-success">
            <div class="container">
                <div class="row mb-md-5">
                    <div class="col-12 col-md-9 mx-auto text-center mb-5">
                        <div class="features_title text-white">
                            <h1 class="museo fs-1 fw-bold text-white mb-5"><?php echo esc_html($features['feature_title']); ?></h1>
                            <p class="lh-lg">
                                <?php echo nl2br(esc_textarea($features['feature_content'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <?php
                    $feat_repeaters = $features['feature_cards'];
                    $feat_delay = 200;
                    if (!empty($feat_repeaters)) :
                        foreach ($feat_repeaters as $key => $feat_repeater) :
                    ?>
                            <div class="col-12 col-md-4 text-center <?php echo $key !== array_key_last($feat_repeaters) ? 'border_col_feature' : ''; ?>  mb-5 mb-md-0" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($feat_delay); ?>">
                                <div class="feature_icon mb-5">
                                    <img src="<?php echo esc_url($feat_repeater['feature_icon']['url']); ?>" alt="<?php echo esc_attr($feat_repeater['feature_icon']['alt']); ?>">
                                </div>
                                <div class="feature_content px-4">
                                    <p class="lh-lg text-white">
                                        <?php echo esc_textarea(nl2br($feat_repeater['feature_content'])); ?>
                                    </p>
                                </div>
                            </div>
                    <?php
                        $feat_delay += 200;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Story Section
    $story = $acf_values['story'];
    $story_carousel_imgs = $story['story_carousel'];
    if (!empty($story['story_title']) && !empty($story['story_content'])) :
    ?>
        <section id="story">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-5 px-md-5 my-auto text-center text-md-start">
                        <div class="story_title pb-5 mb-5">
                            <h1 class="museo display-2 fw-bold mb-5" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('100'); ?>"><?php echo nl2br(esc_textarea($story['story_title'])); ?></h1>
                            <p class="lh-lg mb-5 text-secondary" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('200'); ?>">
                                <?php echo nl2br(esc_textarea($story['story_content'])); ?>
                            </p>
                            <a href="<?php echo esc_url($story['about_page_link_2']); ?>" class="btn btn-outline-success border-3 px-4 py-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr('300'); ?>"><i class="bi bi-arrow-right me-2 border-2"></i><?php esc_html_e('Read More'); ?></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 pe-md-0 mb-5 mb-md-0 pb-4 pb-md-0">
                        <!-- Displaying Carousel image sa front page -->
                        <?php if ($story['story_carousel']) : ?>
                            <div id="story" class="owl-theme owl-carousel position-relative">
                                <?php foreach ($story_carousel_imgs as $story_carousel_img) : ?>
                                    <div class="item">
                                        <img src="<?php echo esc_url($story_carousel_img['story_carousel_image']['url']); ?>" alt="<?php echo esc_attr($story_carousel_img['story_carousel_image']['alt']); ?>" class="img-fluid">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Services Section
    $services = $acf_values['services'];
    $services_icons = $services['service_cards'];
    if (!empty($services['service_title']) && !empty($services['service_content'])) :
    ?>
        <section id="services" class="bg-success">
            <div class="container">
                <div class="row mb-md-5">
                    <div class="col-12 col-md-8 mx-auto text-center mb-5">
                        <div class="features_title text-white">
                            <h1 class="museo fs-1 fw-bold text-white mb-5"><?php echo esc_html($services['service_title']); ?></h1>
                            <p class="lh-lg">
                                <?php echo esc_html($services['service_content']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php if (!empty($services_icons)) : 
                    $delay = 200; // Starting delay in milliseconds
                    foreach ($services_icons as $services_icon) : ?>
                        <div class="col mb-5 mb-lg-auto" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($delay); ?>">
                            <div class="d-flex flex-row gap-4 text-white align-items-center museo">
                                <div class="services_icon">
                                    <img src="<?php echo esc_url($services_icon['service_card_icon']['url']); ?>" alt="<?php echo esc_attr($services_icon['service_card_icon']['alt']); ?>" class="rounded-4 object-fit-cover" width="100" height="100">
                                </div>
                                <div class="services_content">
                                    <p class="fs-6 fw-bold"><?php echo esc_html($services_icon['service_card_title']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php $delay += 200; // Increment delay by 200 milliseconds for the next iteration ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
                <div class="row mt-5 pt-md-5 text-center">
                    <div class="col-12 col-md-6 mx-auto">
                        <a href="<?php echo esc_url($services['service_page_link']); ?>" class="btn btn-outline-white border-3 px-5 py-3"><i class="bi bi-arrow-right me-2 border-2"></i><?php esc_html_e('More'); ?></a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Products Section
    $products = $acf_values['products'];
    if (!empty($products['product_page_background']['url']) && !empty($products['product_title'])) :
    ?>
        <section id="products" class="position-relative">
            <div class="products_img position-relative">
                <img src="<?php echo esc_url($products['product_page_background']['url']); ?>" alt="<?php echo esc_attr($products['product_page_background']['alt']); ?>" class="position-absolute object-fit-cover">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-5 me-auto">
                        <div class="d-flex flex-row justify-content-between align-items-end mb-5">
                            <h1 class="museo display-4 fw-bold"><?php echo nl2br(esc_html($products['product_title'])); ?></h1>
                            <a href="<?php echo esc_url($products['product_page_link']); ?>" class="btn btn-success px-4 py-3"><i class="bi bi-shop me-2"></i><?php esc_html_e('Products'); ?></a>
                        </div>
                        <div class="row row-cols-2 row-gap-4">
                            <?php echo wp_kses_post_deep(do_shortcode('[herbanext_recent_product]')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Gallery Section
    $galleries = $acf_values['galleries'];
    if (!empty($galleries)) :
    ?>
        <section id="gallery">
            <div class="container-fluid">
                <div class="row gap-0">
                    <?php foreach ($galleries as $gallery) : ?>
                        <div class="col p-0">
                            <img src="<?php echo esc_url($gallery['gallery_image']['url']); ?>" alt="<?php echo esc_attr($gallery['gallery_image']['alt']); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // News and Updates Section
    $newsupdates = $acf_values['newsupdates'];
    if (!empty($newsupdates['news_and_updates_title']) && !empty($newsupdates['news_and_updates_content'])) :
    ?>
        <section id="newsupdates" class="bg-success">
            <div class="container">
                <div class="row mb-md-5">
                    <div class="col-12 col-md-8 mx-auto text-center mb-5">
                        <div class="features_title text-white">
                            <h1 class="museo fs-1 fw-bold text-white mb-5"><?php echo esc_html($newsupdates['news_and_updates_title']); ?></h1>
                            <p class="lh-lg">
                                <?php echo wp_kses_post($newsupdates['news_and_updates_content']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <ul class="border-0 list-group list-group-flush ">
                            <?php echo wp_kses_post(do_shortcode("[get_recent_front_page_post]")); ?>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-6 text-center  mt-5 mgt-lg-0">
                        <img src="<?php echo esc_url($newsupdates['news_and_update_image']['url']); ?>" alt="<?php echo esc_attr($newsupdates['news_and_update_image']['alt']); ?>" class="img-fluid rounded-5">
                    </div>
                </div>
                <div class="row mt-5 pt-5 text-center">
                    <div class="col-6 mx-auto">
                        <a href="<?php echo esc_url($newsupdates['news_and_update_page_link']); ?>" class="btn btn-outline-white border-3 px-4 py-3"><i class="bi bi-arrow-right me-2 border-2"></i><?php esc_html_e('Read More'); ?></a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Partner with Us Section
    $partnerus = $acf_values['partnerus'];
    if (!empty($partnerus['partner_with_us_image']) && !empty($partnerus['partner_with_us_form'])) :?>
        <section id="partner" style="background-image: url('<?php echo esc_url($partnerus['partner_with_us_image']['url']); ?>');" class="object-fit-cover img-fluid">
            <div class="bg-white"></div>
            <div class="container position-relative">
                <?php echo wp_kses_decode_entities($partnerus['partner_with_us_form']); ?>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
