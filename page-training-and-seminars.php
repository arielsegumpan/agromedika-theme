<?php
/**
 * Template Name: Training and Seminars
 * @package herbanext
 */
get_header();

$has_posts = false;
$args = array(
    'post_type'      => 'trainingseminars',
    'post_status'    => 'publish',
    'posts_per_page' => 10,
);
$getTR = new WP_Query($args);
if ($getTR->have_posts()) {
    $has_posts = true;
}
?>
<main>
    <!-- jumbotron -->
    <section id="jumbotron_product" class="w-100 position-relative">
        <?php if(has_post_thumbnail()):?>
            <img src="<?php echo esc_url(the_post_thumbnail_url()) ?>" alt="<?php echo esc_attr($alt_text) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
        <?php else: ?>
            <img src="<?php echo esc_url($get_blog_img) ?>" alt="<?php echo esc_attr($get_blog_title) ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
        <?php endif ?>
        <div class="container position-absolute">
            <div class="col-12 col-md-8 col-lg-10 me-auto text-center text-md-start my-auto">
                <?php if (is_page()): ?>
                    <h1 class="display-2 museo fw-bold text-success">
                        <?php single_post_title(); ?>
                    </h1>
                <?php endif; ?>
                <h6 class="mt-4">
                    <nav aria-label="breadcrumb">
                        <?php custom_breadcrumbs(); ?>
                    </nav>
                </h6>
            </div>
        </div>
    </section>
    <section id="blog">
        <div class="container">
            <div class="row row-gap-5">
                <?php
                if ($has_posts) :
                    while ($getTR->have_posts()) : $getTR->the_post();
                        get_template_part('template-parts/content/content', $has_posts ? 'regular' : 'empty');
                    endwhile; wp_reset_postdata( );
                else :
                    get_template_part('template-parts/content/content', 'empty');
                endif;
                ?>
                
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
