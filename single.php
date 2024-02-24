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
    <?php if(has_post_thumbnail()):?>
    <section id="jumbotron-2" style="background: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id));?>') center/cover no-repeat;">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-auto text-center">
            <?php if (is_single() && !is_front_page()) : ?>
                <h2 class="fw-bold text-black"><?php single_post_title(); ?></h2>
                <?php endif; ?>
                <?php if (shortcode_exists('post_categories')) : ?>
                    <div class="d-flex flex-wrap flex-row text-center g-5 text-md-start mt-4 justify-content-center align-items-start">
                        <?php echo do_shortcode('[post_categories]'); ?>
                    </div>
                <?php endif ?>
            </div>
          </div>
        </div>
        <div class="jumb-overlay"></div>
    </section>
    <?php endif;?>
    <section id="blog" class="single_blog">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-9 pb-3 pb-xl-0 mb-5 mb-xl-0">
                     <!-- share buttons -->
                     <?php echo do_shortcode('[social_share_buttons]'); ?>
                    <!-- content -->
                    <?php get_template_part('template-parts/components/single/single'); ?>
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
                                    <span class="badge rounded-pill text-bg-primary text-lteal p-2">#<?php echo esc_html($tag->name); ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- comment form -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <?php comments_template(); ?>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-xl-3">
                    <div id="aside">
                        <div id="featured_prod_aside" class="mb-5">
                            <h5 class="fw-bold text-primary mb-4"><?php echo esc_html__('Recent Posts', 'agromedika' ) ?></h5>
                            <div class="row row-cols-2 row-cols-lg-2 g-3">
                                <?php get_template_part( 'template-parts/components/aside/aside', 'recent' ) ;?>
                            </div>
                        </div>
                        <div id="blog_archive" class="mb-5">
                            <h5 class="fw-bold text-primary"><?php  echo esc_html__( 'Archive', 'agromedika' )?></h5>
                            <?php get_template_part('template-parts/components/archive/archives'); ?>
                       </div>
                        <div id="soc_med">
                            <h5 class="fw-bold text-primary mb-3">Follow us on</h5>
                            <div class="d-flex flex-row gap-4 fs-4">
                                <a href="#!" target="_blank" class="text-decoration-none text-primary"><i class="bi bi-facebook"></i></a>
                                <a href="#!" target="_blank" class="text-decoration-none text-primary"><i class="bi bi-twitter-x"></i></a>
                                <a href="#!" target="_blank" class="text-decoration-none text-primary"><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
</main>

<?php get_footer(); ?>
