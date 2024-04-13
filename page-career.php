<?php
/**
 * Template Name: Careers
 * @package agromedika
 */

$career_jumbotron = get_acf_field('career_jumbotron');
get_header();?>

<main class="bg-lteal">
    <?php if(!empty($career_jumbotron['career_jumbotron_heading'])) :?>
      <section id="blog_jumb" class="position-relative overflow-hidden">
        <div class="container-fluid px-0">
          <div class="row">
            <div class="position-relative">
              <?php
                $about_thumb_id = $career_jumbotron['career_jumbotron_image']['id'];
                    echo html_entity_decode(esc_html(
                    wp_get_attachment_image($about_thumb_id, 'blog_thumbnail', false, array('class' => 'single-blog-img w-100'))
                )); ;?>
                <div id="blog-cont" class="container position-absolute top-50 start-50 translate-middle">
                  <div class="row"> 
                    <div class="col-12 col-lg-8 mx-auto my-auto text-center px-3 px-lg-0">
                    <h1 class="fw-bold text-white"><?php echo esc_html($career_jumbotron['career_jumbotron_heading']) ;?></h1>
                      <h5 class="text-white mt-4"><?php echo nl2br(esc_textarea($career_jumbotron['career_jumbotron_content'])) ;?></h5>
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
            <?php get_template_part('template-parts/components/blog/career', 'page') ?>
        </div>
    </section>
</main>



<?php get_footer();?>