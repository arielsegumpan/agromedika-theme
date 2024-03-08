<?php
/**
 * Template Name: Infographic Gallery
 * @package agromedika
 */

 get_header();

 $args = array(
    'post_type'      => 'infographic',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
);

$query = new WP_Query($args);

$infographic_content = get_acf_field('infographic_content');
$infographic_images = get_field('infographic_images');
?>
<main>
    <section id="no-jumbotron" class="bg-lteal">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                    <h1 class="fw-bold text-black"><?php echo esc_html($infographic_content['infographic_heading']) ?></h1>
                    <h5 class="text-black mt-4"><?php echo esc_html($infographic_content['infographic_sub_heading']) ?></h5>
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
                        <button type="button" class="filter-item list-group-item list-group-item-action text-secondary  bg-transparent" data-filter="all">All</button>
                        <?php
                        // Get all certificate categories
                        $categories = get_terms('infographic-category');
                        foreach ($categories as $category) {
                            echo '<button type="button" class="filter-item list-group-item list-group-item-action text-secondary  bg-transparent" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
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

                                $infographic_images = get_field('infographic_images');
                                $cert_image_url = esc_url($infographic_images['infographic_image']['url']);
                                $image_alt = esc_attr($infographic_images['infographic_image']['alt']) ;
                                $caption = esc_attr(get_the_title());
                                $data_id = '';
                                $categories = get_the_terms(get_the_ID(), 'infographic-category');
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        $data_id .= $category->slug;
                                    }
                                }
                                ?>
                                <?php if(!empty($cert_image_url)) :?>
                                <div class="card border-0 bg-transparent rounded-4">
                                    <div class="card-image position-relative rounded-4">
                                        <a href="<?php echo $cert_image_url; ?>" class="text-decoration-none text-black" data-fancybox="gallery" data-id="<?php echo esc_attr($data_id); ?>" data-caption="<?php echo $caption; ?>">
                                            <img src="<?php echo $cert_image_url; ?>" alt="<?php echo $image_alt; ?>" class="rounded-4">
                                        </a>
                                    </div>
                                </div>
                            <?php 
                            endif;
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <p><?php esc_html_e('No infographic galleries found.'); ?></p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer() ;?>