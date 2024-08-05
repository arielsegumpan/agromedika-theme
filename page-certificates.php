<?php
/**
 * Template Name: Certificate Gallery Page
 * @package agromedika
 */

get_header();

// Get certificate jumbotron data
$certificate_jumbotron = get_acf_field('certificate_jumbotron');

?>
<main>
    <?php if (!empty($certificate_jumbotron['certificate_jumbotron_heading'])) : ?>
       
        <section id="no-jumbotron" class="bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-auto text-center mt-5">
                        <h1 class="fw-bold text-black"><?php echo esc_html($certificate_jumbotron['certificate_jumbotron_heading']); ?></h1>
                        
                        <?php if (!empty($certificate_jumbotron['certificate_jumbotron_content'])) : ?>
                            <h5 class="text-secondary mt-4"><?php echo nl2br(esc_textarea($certificate_jumbotron['certificate_jumbotron_content'])); ?></h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5 pb-lg-4">
                    <?php
                    // Display certificate categories filter
                    get_certificate_categories_filter();
                    ?>
                </div>
                <div class="col-12 col-md-10 mx-auto mt-5 mt-lg-0">
                    <div class="container-img">
                        <?php
                        // Display certificate galleries
                        get_certificate_galleries();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<?php
// Function to retrieve certificate categories filter
function get_certificate_categories_filter()
{
    $categories = get_terms('certificates-category');

    if (!empty($categories)) :
        ?>
         <?php if(!empty($certificate_jumbotron['certificate_filter_title'])):?>
        <h5 class="fw-bold mb-4"><i class="bi bi-filter me-2"></i><?php echo esc_html($certificate_jumbotron['certificate_filter_title']); ?></h5>
        <?php endif;?>
        <div id="filter-menu" class="d-flex flex-row flex-wrap gap-3 justify-content-center align-items-center">
            <button type="button" class="filter-item btn btn-primary text-lteal" data-filter="all"><?php echo esc_html__('All'); ?></button>
            <?php foreach ($categories as $category) : ?>
                <button type="button" class="filter-item btn btn-primary text-lteal" data-filter="<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></button>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p><?php esc_html_e('No options found.'); ?></p>
    <?php endif;
}

// Function to retrieve and display certificate galleries
function get_certificate_galleries()
{
    $args = array(
        'post_type'      => 'certificate',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
            $certificate_gallery = get_field('certificate_gallery');
            $cert_image_url = !empty($thumbnail_url) ? esc_url($thumbnail_url) : (!empty($certificate_gallery['certificate_gallery_image']['url']) ? esc_url($certificate_gallery['certificate_gallery_image']['url']) : '');
            $caption = esc_attr(get_the_title());
            $data_id = '';
            $categories = get_the_terms(get_the_ID(), 'certificates-category');
            if ($categories) {
                foreach ($categories as $category) {
                    $data_id .= $category->slug;
                }
            }
            ?>
            <div class="card border-0 bg-transparent rounded-4">
                <div class="card-image position-relative rounded-4">
                    <a href="<?php echo $cert_image_url; ?>" class="text-decoration-none text-black" data-fancybox="gallery" data-id="<?php echo esc_attr($data_id); ?>" data-caption="<?php echo $caption; ?>">
                        <?php if (!empty($cert_image_url)) : ?>
                            <img src="<?php echo $cert_image_url; ?>" alt="<?php echo $caption; ?>" class="rounded-5" />
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    else :
        ?>
        <p><?php esc_html_e('No certificate galleries found.'); ?></p>
    <?php endif;
}
?>
