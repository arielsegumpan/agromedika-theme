<?php
/**
 *Template Name: Blog
 * @package agromedika
 */
get_header();

$blog_jumbotron = get_acf_option_field('blog_jumbotron');
$sidebar_socmed = get_acf_option_field('sidebar_socmed');

?>
<main class="bg-lteal">
    <?php if(!empty($blog_jumbotron['blog_hero_title'])) :?>
      <section id="blog_jumb" class="position-relative overflow-hidden">
        <div class="container-fluid px-0">
          <div class="row">
            <div class="position-relative">
              <?php
                $about_thumb_id = $blog_jumbotron['blog_hero_image']['id'];
                    echo html_entity_decode(esc_html(
                    wp_get_attachment_image($about_thumb_id, 'blog_thumbnail', false, array('class' => 'single-blog-img w-100'))
                )); ;?>
                <div id="blog-cont" class="container position-absolute top-50 start-50 translate-middle">
                  <div class="row"> 
                    <div class="col-12 col-lg-8 mx-auto my-auto text-center px-3 px-lg-0">
                    <h1 class="fw-bold text-white"><?php echo esc_html($blog_jumbotron['blog_hero_title']) ;?></h1>
                      <h5 class="text-white mt-4"><?php echo nl2br(esc_textarea($blog_jumbotron['blog_hero_sub_title'])) ;?></h5>
                    </div>
                  </div>
                </div> 
            </div>
          </div>
        </div>
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
                <?php if (get_query_var('paged') > 1 || get_next_posts_link() || get_previous_posts_link()) : ?>
                    <div class="col-12 mt-5 text-center">
                        <div class="d-flex flex-row justify-content-center align-items-center gap-4">
                            <?php if (get_query_var('paged') > 1 && get_previous_posts_link()) : ?>
                                <a href="<?php echo previous_posts(); ?>" class="btn btn-primary text-lteal px-4 py-3 rounded-4"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html('Previous') ?></a>
                            <?php endif; ?>

                            <?php if (get_next_posts_link()) : ?>
                                <a href="<?php echo next_posts(); ?>" class="btn btn-primary text-lteal px-4 py-3 rounded-4"><?php echo esc_html('Next') ?><i class="bi bi-arrow-right ms-2"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
</main>

<?php get_footer()?>