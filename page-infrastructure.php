<?php
/**
 * Template Name: Infrastructure
 * @package agromedika
 */

get_header();

$acf_field_names = array(
    'infrastructure_jumbotron',
    'infrastructure_rnd',
    'infrastructure_organic'
);

$acf_fields = array();

foreach ($acf_field_names as $field_name) {
    $acf_fields[$field_name] = get_acf_field($field_name);
}

$infrastructure_jumbotron = $acf_fields['infrastructure_jumbotron'];
$infrastructure_rnd = $acf_fields['infrastructure_rnd'];
$infrastructure_organic = $acf_fields['infrastructure_organic'];

?>
<main>
    <?php
    if (!empty($infrastructure_jumbotron['infrastructure_hero_title'])) : ?>
        <section id="jumbotron-2" style="background-image: url('<?php echo esc_url($infrastructure_jumbotron['infrastructure_hero_image']['url']); ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                        <h1 class="fw-bold text-black"><?php echo esc_html($infrastructure_jumbotron['infrastructure_hero_title']); ?></h1>
                        <h5 class="text-black mt-4">
                            <?php echo nl2br(esc_textarea($infrastructure_jumbotron['infrastructure_hero_sub_title'])); ?>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="jumb-overlay"></div>
        </section>
    <?php endif; ?>

    <?php if (!empty($infrastructure_rnd['infrastructure_rnd_title'])) : ?>
        <section id="rnd" class="bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="row row-cols-2 g-3 g-lg-4">
                            <?php if (!empty($infrastructure_rnd)) :
                                $col_class = 'col-12';
                                foreach ($infrastructure_rnd['infrastructure_rnd_images'] as $index => $rnd_img_gallery) :
                                    $col_class = ($index > 0) ? 'col' : 'col-12'; ?>
                                    <div class="<?php echo esc_attr($col_class); ?>">
                                        <img src="<?php echo esc_url($rnd_img_gallery['infrastructure_rnd_image']['url']); ?>" alt="<?php echo esc_attr($rnd_img_gallery['infrastructure_rnd_image']['alt']); ?>" class="img-fluid rounded-4">
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-5 mt-lg-0 text-center text-lg-start">
                        <h2 class="fw-bold text-lteal"><?php echo esc_html($infrastructure_rnd['infrastructure_rnd_title']) ?></h2>
                        <div class="lh-lg text-lteal mt-4"><?php echo wp_kses_decode_entities($infrastructure_rnd['infrastructure_rnd_content']); ?></div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (!empty($infrastructure_organic['infrastructure_organic_title'])) : ?>
        <section id="organic">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 text-center text-lg-start">
                        <h2 class="fw-bold mb-4 text-black"><?php echo esc_html($infrastructure_organic['infrastructure_organic_title']) ?></h2>
                        <div class="lh-lg text-secondary mt-4"><?php echo wp_kses_decode_entities($infrastructure_organic['infrastructure_organic_content']); ?></div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div id="organicGallery" class="carousel slide">
                            <div class="carousel-inner">

                                <?php
                                foreach ($infrastructure_organic['infrastructure_organic_carousel'] as $key => $organic_carousel) : ?>
                                    <div class="carousel-item <?php echo esc_attr($key === 0 ? 'active' : ''); ?>">
                                        <img src="<?php echo esc_url($organic_carousel['organic_carousel_image']['url']); ?>" alt="<?php echo esc_attr($organic_carousel['organic_carousel_image']['alt']); ?>" class="d-block w-100 rounded-4">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5><?php echo esc_html($organic_carousel['organic_carousel_title']); ?></h5>
                                            <p><?php echo nl2br(esc_textarea($organic_carousel['organic_carousel_content'])); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>


                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#organicGallery" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#organicGallery" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

     <?php $content = get_the_content();
    if(have_posts( ) && !empty($content)) : ?>
        <section id="team">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-lg text-secondary">
                    <?php while(have_posts()) : the_post() ;?>
                        <?php echo $content;?>
                    <?php endwhile;?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>

</main>
<?php get_footer(); ?>
