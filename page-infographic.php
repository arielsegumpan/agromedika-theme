<?php
/**
 * Template Name: Infographic Gallery
 * @package agromedika
 */

get_header();

// Retrieve infographic content and filter title
$infographic_content = get_acf_field('infographic_content');
$infographic_filter_title = get_acf_field('infographic_filter_title');

// Query for infographics
$query_args = array(
    'post_type'      => 'infographic',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
);
$query = new WP_Query($query_args);
?>

<main>
    <?php if (!empty($infographic_content['infographic_heading'])) : ?>
        <section id="no-jumbotron" class="bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-auto text-center mt-5">
                        <h1 class="fw-bold text-black"><?php echo esc_html($infographic_content['infographic_heading']); ?></h1>
                        <?php if (!empty($infographic_content['infographic_sub_heading'])) : ?>
                            <h5 class="text-black mt-4"><?php echo esc_html($infographic_content['infographic_sub_heading']); ?></h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section id="main" class="bg-white"> 
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5 pb-lg-4">
                    <?php if(!empty($infographic_filter_title['infographic_menu_filter_title'])) :?>
                    <h5 class="fw-bold mb-4"><i class="bi bi-filter me-2"></i><?php echo esc_html($infographic_filter_title['infographic_menu_filter_title']); ?></h5>
                    <?php endif;?>
                    <div id="filter-menu" class="d-flex flex-row flex-wrap gap-3 justify-content-center align-items-center">
                        <button type="button" class="filter-item btn btn-primary text-lteal" data-filter="all"><?php esc_html_e('All'); ?></button>
                        <?php
                        // Display infographic categories filter
                        get_infographic_categories_filter();
                        ?>
                    </div>
                </div>
                <div class="col-12 col-md-10 mx-auto mt-5 mt-lg-0">
                    <div class="container-img">
                        <?php
                        // Display infographic galleries
                        display_infographic_galleries($query);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<?php
// Function to retrieve and display infographic categories filter
function get_infographic_categories_filter()
{
    $categories = get_terms('infographic-category');
    if (!empty($categories)) {
        foreach ($categories as $category) {
            echo '<button type="button" class="filter-item btn btn-primary text-lteal" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
        }
    } else {
        echo '<p>' . esc_html__('No options found', 'tqp') . '</p>';
    }
}

// Function to display infographic galleries
function display_infographic_galleries($query)
{
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $infographic_images = get_acf_field('infographic_images');
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
            $cert_image_url = !empty($thumbnail_url) ? esc_url($thumbnail_url) : (!empty($infographic_images['infographic_image']['url']) ? esc_url($infographic_images['infographic_image']['url']) : '');
            $caption = esc_attr(get_the_title());
            $data_id = '';
            $categories = get_the_terms(get_the_ID(), 'infographic-category');
            if ($categories) {
                foreach ($categories as $category) {
                    $data_id .= $category->slug;
                }
            }
            ?>
            <?php if (!empty($cert_image_url)) : ?>
                <div class="card border-0 bg-transparent rounded-4">
                    <div class="card-image position-relative rounded-4">
                        <a href="<?php echo $cert_image_url; ?>" class="text-decoration-none text-black" data-fancybox="gallery" data-id="<?php echo esc_attr($data_id); ?>" data-caption="<?php echo $caption; ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php $featured_image_id = get_post_thumbnail_id();
                                echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'gallery_img', false, array('class' => 'rounded-4'))));
                                ?>
                            <?php else : ?>
                                <?php
                                $gall_cert_id = $infographic_images['infographic_image']['id'];
                                echo html_entity_decode(esc_html(
                                    wp_get_attachment_image($gall_cert_id, 'gallery_img', false, array('class' => 'rounded-4'))
                                ));
                                ?>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        <?php
        }
        wp_reset_postdata();
    } else {
        ?>
        <p><?php esc_html_e('No infographic galleries found.'); ?></p>
<?php }
}
?>
