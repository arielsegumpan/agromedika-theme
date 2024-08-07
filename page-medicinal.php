<?php
/**
 * Template Name: Medicinal Plants
 * @package agromedika
 */

get_header();

// Query arguments for medicinal plants
$args = array(
    'post_type'      => 'philippine-medicinal',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);

// Retrieve jumbotron and filter title fields
$medicinal_plant_jumbotron = get_acf_field('medicinal_plant_jumbotron');
$medicinal_plant_filter_title = get_acf_field('medicinal_plant_filter_title');

// Retrieve featured image alt attribute
$medicinal_featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
?>

<main>
    <?php if (!empty($medicinal_plant_jumbotron['medicinal_plant_jumbotron_heading'])) : ?>
        <section id="no-jumbotron" class="bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-auto text-center mt-5">
                        <h1 class="fw-bold text-black"><?php echo esc_html($medicinal_plant_jumbotron['medicinal_plant_jumbotron_heading']); ?></h1>
                        <h5 class="text-secondary mt-4"><?php echo html_entity_decode(esc_textarea($medicinal_plant_jumbotron['medicinal_plant_jumbotron_content'])); ?></h5>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section id="main" class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5 pb-lg-4">
                    <?php if(!empty($medicinal_plant_filter_title['medicianl_plant_menu_filter_title'])):?>
                    <h5 class="fw-bold mb-4"><i class="bi bi-filter me-2"></i><?php echo esc_html($medicinal_plant_filter_title['medicianl_plant_menu_filter_title']); ?></h5>
                    <?php endif;?>
                    <div id="filter-menu-2" class="d-flex flex-row flex-wrap gap-3 justify-content-center align-items-center">
                        <button type="button" class="filter-item btn btn-primary text-lteal" data-filter="all"><?php echo esc_html('All'); ?></button>
                        <?php
                        // Display medicinal plant categories filter
                        display_medicinal_plant_categories_filter();

                        ?> 
                    </div>
                </div>
                <div class="col-12 col-md-10 mx-auto mt-5 mt-lg-0">
                    <div class="container-img-pdf">
                        <?php
                        // Display medicinal plant galleries
                        display_medicinal_plant_galleries($query, $medicinal_featured_image_alt);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<?php
// Function to display medicinal plant categories filter
function display_medicinal_plant_categories_filter()
{
    $categories = get_terms('medicinal-category');
    if (!empty($categories)) {
        foreach ($categories as $category) {
            echo '<button type="button" class="filter-item btn btn-primary text-lteal" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
        }
    } else {
        echo '<p>' . esc_html__('No options found') . '</p>';
    }
}

// Function to display medicinal plant galleries
function display_medicinal_plant_galleries($query, $medicinal_featured_image_alt)
{
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $medicinal_plant_galleries = get_field('medicinal_plant_galleries');
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
            $med_plant_image_url = !empty($medicinal_plant_galleries['medicinal_plant_gallery_cover']['url']) ? esc_url($medicinal_plant_galleries['medicinal_plant_gallery_cover']['url']) : esc_url($thumbnail_url);
            $image_alt = !empty($medicinal_plant_galleries['medicinal_plant_gallery_cover']['alt']) ? esc_attr($medicinal_plant_galleries['medicinal_plant_gallery_cover']['alt']) : esc_attr($medicinal_featured_image_alt);
            $caption = esc_attr(get_the_title());
            $data_id = '';
            $categories = get_the_terms(get_the_ID(), 'medicinal-category');
            if ($categories) {
                foreach ($categories as $category) {
                    $data_id .= $category->slug;
                }
            }
            ?>
            <?php if (!empty($med_plant_image_url)) : ?>
                <div class="card" data-id="<?php echo esc_attr($data_id) ?>">
                    <div class="card-image position-relative">
                        <div class="card-header text-center bg-primary py-3">
                            <img src="<?php echo $med_plant_image_url; ?>" alt="<?php echo $image_alt; ?>" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <a href="<?php echo esc_url(the_permalink()); ?>" class="text-decoration-none">
                                <h5 class="text-primary"><?php echo esc_html(substr(get_the_title(), 0, 30)) . '...'; ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php
        }
        wp_reset_postdata();
    } else {
        ?>
        <p><?php esc_html_e('No medicinal plants galleries found.'); ?></p>
<?php }
}
?>
