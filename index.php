<?php
/**
 *Template Name: Blog
 * @package agromedika
 */
get_header();

$blog_jumbotron = get_acf_option_field('blog_jumbotron');


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
                <div class="col-12 col-md-9 mb-5 mb-lg-0 pb-4 pb-lg-0">
                    <div class="row row-cols-2 g-3 g-lg-5">
                        <div class="col-12">
                            <?php if(have_posts()) : while(have_posts()) : the_post() ;?>
                                <?php get_template_part('template-parts/content/content') ?>
                            <?php endwhile; endif;?>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-row justify-content-center align-items-center gap-3">
                                <a href="#!" class="btn btn-primary px-4 py-3">Previous<i class="bi bi-arrow-left ms-2"></i></a>
                                <a href="#!" class="btn btn-primary px-4 py-3"><i class="bi bi-arrow-right me-2"></i>Next</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-md-3">
                  <div id="aside">
                    <?php get_template_part('template-parts/components/aside/aside', 'content')?>
                    <div id="blog_archive" class="mb-5">
                        <h5 class="fw-bold text-primary">Archive</h5>
                        <select class="form-select py-2 mt-4 mb-4" aria-label="Select category">
                            <option selected disabled>Select</option>
                            <option value="Category 1">August (10)</option>
                            <option value="Category 2">September (8)</option>
                            <option value="Category 3">October (12)</option>
                        </select>
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

<?php get_footer()?>