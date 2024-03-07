<?php
/**
 *Template Name: Blog
 * @package agromedika
 */
get_header();

$blog_jumbotron = get_acf_option_field('blog_jumbotron');
$sidebar_socmed = get_acf_option_field('sidebar_socmed');

?>
<main>
    <?php if(!empty($blog_jumbotron['blog_hero_title'])) :?>
    <section id="jumbotron-2" style="background-image: url('<?php  echo esc_url($blog_jumbotron['blog_hero_image']['url']);?>');">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-auto text-center">
              <h1 class="fw-bold text-black"><?php echo esc_html($blog_jumbotron['blog_hero_title']) ;?></h1>
              <h5 class="text-black mt-4"><?php echo nl2br(esc_textarea($blog_jumbotron['blog_hero_sub_title'])) ;?></h5>
            </div>
          </div>
        </div>
        <div class="jumb-overlay"></div>
    </section>
    <?php  endif;?>

    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row row-cols-1 row-cols-md-2  row-cols-lg-3 g-3 g-lg-5">
                    <?php if(have_posts()) : while(have_posts()) : the_post() ;?>
                        <div class="col">
                            <?php get_template_part('template-parts/content/content') ?>
                        </div>
                    <?php endwhile; endif;?>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="d-flex flex-row justify-content-between align-items-center gap-3">
                        <?php if (get_query_var('paged') > 1) : ?>
                            <?php previous_posts_link('<i class="bi bi-arrow-left me-2"></i>Previous'); ?>
                        <?php endif; ?>
                        <?php next_posts_link('Next<i class="bi bi-arrow-right ms-2"></i>'); ?>
                    </div>
              </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer()?>