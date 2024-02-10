<?php
/**
 * @package herbanext
 */
get_header();

$image_id = get_post_thumbnail_id(get_the_ID());
$alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);

?>

<main>
    <!-- jumbotron -->
    <section id="jumbotron_about" class="w-100 position-relative">
        <?php if(has_post_thumbnail()):?>
        <img src="<?php echo esc_url(the_post_thumbnail_url()) ?>" alt="<?php echo esc_attr($alt_text) ?>" class="object-fit-cover w-100 position-absolute bottom-0 left-0">
        <?php endif;?>
        <div class="container position-absolute mt-4 mt-lg-0">
            <div class="col-12 col-md-8 col-lg-10 me-auto text-center text-md-start my-auto">
                <?php if (is_single() && !is_front_page()) : ?>
                    <h2 class=" museo fw-bold text-success display-6"><?php single_post_title(); ?></h2>
                <?php endif; ?>
                <h6 class="mt-4 mt-lg-3">
                    <nav aria-label="breadcrumb">
                        <?php custom_breadcrumbs(); ?>
                    </nav>
                </h6>
                <?php if(shortcode_exists('post_categories')) :?>
                    <div class="d-flex flex-wrap flex-row text-center g-5 text-md-start mt-4 align-items-start">
                        <?php echo do_shortcode('[post_categories]') ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>

    <section id="blog">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-12 col-lg-9">
                    <!-- share button -->
                    <?php echo do_shortcode( '[social_share_buttons]' ) ?>
                    <!-- content -->
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/components/single/single'); ?>
                    <?php endwhile; endif; ?>
                     <!-- comment form -->
                     <?php if (comments_open() || get_comments_number()):?>
                        <?php comments_template(); ?>
                    <?php endif?>
                </div>
                <div class="col-12 col-lg-3">
                    <div id="blog_search" class="mb-5">
                        <h4 class="fw-bold museo mb-4"><i class="bi bi-search me-2"></i><?php echo esc_html__('Search'); ?></h4>
                        <?php get_search_form() ?>
                    </div>
                   <?php
                    $post_types_with_recent = array('post', 'careers', 'publications', 'trainingseminars', 'medicinal_herbs');
                    if (is_single() && in_array(get_post_type(), $post_types_with_recent)):
                    ?>
                    <!-- RECENT POST -->
                        <div id="blog_recent" class="mb-5">
                            <h4 class="fw-bold museo "><i class="bi bi-file-earmark-post me-2"></i><?php echo esc_html__('Recent Post'); ?></h4>
                            <ul class="list-group list-group-flush mt-4">
                                <?php
                                $template_part = get_post_type();
                                get_template_part('template-parts/sidebars/recent-' . $template_part);
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>



                    <?php if(shortcode_exists( 'all_categories' )): ?>
                        <div id="blog_categories" class="mb-5">
                            <h4 class="fw-bold museo "><i class="bi bi-bookmarks me-2"></i><?php echo esc_html__('Categories'); ?></h4>
                            <div class="d-flex flex-wrap flex-row text-center g-5 text-md-start mt-4 align-items-start">
                                <?php echo do_shortcode('[all_categories]'); ?>
                            </div>
                        </div>
                    <?php endif?>
                    <div id="blog_archive" class="mb-5">
                        <h4 class="fw-bold museo mb-4"><i class="bi bi-archive me-2"></i><?php echo esc_html__('Archive'); ?></h4>
                        <?php get_template_part('template-parts/components/archive/archives'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
