<?php
/**
 * @package herbanext
 */
get_header();
$post_id = get_the_ID();
$image_id = get_post_thumbnail_id($post_id);

$option_fields = array(
    'page_footer_soc_med',
);

$option_values = array();

foreach ($option_fields as $field) {
    $option_values[$field] = get_acf_option_field($field);
}
$page_footer_soc_med = $option_values['page_footer_soc_med'];

?>
<main>
    <?php if(has_post_thumbnail()):?>
    <section id="blog_jumb" class="position-relative overflow-hidden">
        <div class="container-fluid px-0">
          <div class="row">
            <div class="position-relative">
              <?php
                    echo html_entity_decode(esc_html(
                    wp_get_attachment_image($image_id, 'blog_thumbnail', false, array('class' => 'single-blog-img w-100'))
                )); ;?>
                <div id="blog-cont" class="container position-absolute top-50 start-50 translate-middle">
                  <div class="row"> 
                    <div class="col-12 col-lg-8 mx-auto my-auto text-center px-3 px-lg-0">
                    <?php if (is_single() && !is_front_page()) : ?>
                    <h2 class="fw-bold text-black"><?php single_post_title(); ?></h2>
                    <?php endif; ?>
                    </div>
                  </div>
                </div> 
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
                    <?php if (shortcode_exists('post_categories')) : ?>
                    <div class="d-flex flex-wrap flex-row text-center g-5 text-md-start mt-4 justify-content-start align-items-start mb-4">
                        <?php echo do_shortcode('[post_categories]'); ?>
                    </div>
                    <?php endif ?>
                     
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
                            <div class="row">
                                <?php get_template_part( 'template-parts/components/aside/aside', 'recent' ) ;?>
                            </div>
                        </div>
                        <?php
                        if (!get_transient('blog_archive_displayed')) {
                            ?>
                            <div id="blog_archive" class="mb-5">
                                <h5 class="fw-bold text-primary"><?php echo esc_html__('Archive', 'agromedika') ?></h5>
                                <?php get_template_part('template-parts/components/archive/archives'); ?>
                            </div>
                            <?php
                            // Set the flag to indicate that the archive has been displayed
                            set_transient('blog_archive_displayed', true, 1 * YEAR_IN_SECONDS); // Flag will expire after 1 year
                        }
                        ?>
                        <div id="soc_med">
                            <h5 class="fw-bold text-primary mb-3">Follow us on</h5>
                            <div class="d-flex flex-row gap-4 justify-content-lg-start mb-4">
                            <?php if (!empty($page_footer_soc_med['footer_soc_med'])) : foreach ($page_footer_soc_med['footer_soc_med'] as $page_footer_socmed) : ?>
                                    <a target="_blank" href="<?php echo esc_url($page_footer_socmed['footer_soc_med_link']); ?>" class="text-decoration-none text-primary fs-5"><?php echo wp_kses_decode_entities($page_footer_socmed['footer_soc_med_icons']) ?></a>
                            <?php endforeach;
                            endif; ?>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
      </section>
</main>

<?php get_footer(); ?>
