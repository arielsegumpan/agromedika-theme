<?php
/**
 * Template Name: Certificate Gallery
 * @package agromedika
 */

get_header();

$args = array(
    'post_type'      => 'certificate',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
);

$query = new WP_Query($args);

$certificate_featured_cert_image_url = get_the_post_thumbnail_url(get_the_ID());
$certificate_featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

?>
<main>
    <section id="no-jumbotron" class="bg-lteal">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                    <h1 class="fw-bold text-black">Certificate</h1>
                    <h5 class="text-black mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus sint ea facilis vel et aut earum deserunt? Harum, tempore sequi.</h5>
                </div>
            </div>
        </div>
    </section>

    <section id="main" class="bg-lteal">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <h5 class="fw-bold mb-4"><i class="bi bi-filter me-2"></i>Filter Options</h5>
                    <ul id="filter-menu" class="list-unstyled list-group list-group-flush">
                        <button type="button" class="filter-item list-group-item list-group-item-action text-secondary bg-transparent" data-filter="all"><?php echo esc_html('All') ;?></button>
                        <?php
                        // Get all certificate categories
                        $categories = get_terms('certificates-category');
                        foreach ($categories as $category) {
                            echo '<button type="button" class="filter-item list-group-item list-group-item-action text-secondary bg-transparent" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-12 col-md-8 col-lg-9 mt-5 mt-lg-0">
                    <div class="container-img">
                        <?php
                        if ($query->have_posts()) :
                            while ($query->have_posts()) :
                                $query->the_post(); 
                                $certificate_gallery = get_field('certificate_gallery');
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
                                $cert_image_url = !empty($thumbnail_url) ? esc_url($thumbnail_url) : esc_url($certificate_gallery['certificate_gallery_image']['url']);
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
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php $featured_image_id = get_post_thumbnail_id();
                                                    echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'gallery_img', false, array('class' => 'rounded-5'))));
                                                ?>
                                            <?php else:?> 
                                                <?php
                                                    $gall_cert_id =  $certificate_gallery['certificate_gallery_image']['id'];
                                                    echo html_entity_decode(esc_html(
                                                    wp_get_attachment_image($gall_cert_id, 'gallery_img', false, array('class' => 'rounded-4'))
                                                ));?>
                                            <?php endif; ?>

                                        </a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <p><?php esc_html_e('No certificate galleries found.'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
