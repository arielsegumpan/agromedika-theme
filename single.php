<?php
/**
 * @package herbanext
 */
get_header();
$post_id = get_the_ID();
$image_id = get_post_thumbnail_id($post_id);
$alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
?>
<main>
    <!-- jumbotron -->
    <section id="jumbotron_about" class="w-100 position-relative">
        <?php if(has_post_thumbnail()):?>
        <img src="<?php echo esc_url(get_the_post_thumbnail_url($post_id)); ?>" alt="<?php echo esc_attr($alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
        <?php endif;?>
        <div class="container position-absolute mt-4 mt-lg-0">
            <div class="col-12 col-md-8 col-lg-10 me-auto text-center text-md-start my-auto">
                <?php if (is_single() && !is_front_page()) : ?>
                    <h1 class="display-6 museo fw-bold text-success"><?php single_post_title(); ?></h1>
                <?php endif; ?>
                <h6 class="mt-4 mt-lg-3">
                    <nav aria-label="breadcrumb">
                        <?php custom_breadcrumbs(); ?>
                    </nav>
                </h6>
                <?php if (shortcode_exists('post_categories')) : ?>
                    <div class="d-flex flex-wrap flex-row text-center g-5 text-md-start mt-4 align-items-start">
                        <?php echo do_shortcode('[post_categories]'); ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>

    <section id="blog">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-12 col-lg-9">
                    <!-- share buttons -->
                    <?php echo do_shortcode('[social_share_buttons]'); ?>
                    <!-- content -->
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/components/single/single'); ?>
                    <?php endwhile; endif; ?>
                    <!-- share buttons -->
                    <?php echo do_shortcode('[social_share_buttons]'); ?>
                    <!-- tags -->
                    <?php
                    $post_tags = get_the_tags();
                    if ($post_tags) :
                    ?>
                        <div class="tags">
                            <?php foreach ($post_tags as $tag) : ?>
                                <a class="text-decoration-none me-2" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
                                    <span class="badge rounded-pill text-bg-success p-2">#<?php echo esc_html($tag->name); ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- comment form -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <?php comments_template(); ?>
                    <?php endif; ?>
                </div>

                <div class="col-12 col-lg-3">
                    <div id="blog_search" class="mb-5">
                        <h4 class="fw-bold museo mb-4"><i class="bi bi-search me-2"></i><?php echo esc_html__('Search') ?></h4>
                        <?php get_search_form() ?>
                    </div>

                   <?php
                    $post_types_with_recent = array('post', 'careers', 'publications', 'trainingseminars', 'medicinal_herbs');
                    if (is_single() && in_array(get_post_type(), $post_types_with_recent)):
                    ?>
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
