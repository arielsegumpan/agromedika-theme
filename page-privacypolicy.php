<?php
/**
 * Template Name: Privacy Policy
 * @package agromedika
 */
get_header();
?>

<main>

    <section id="contact" class="bg-lteal">
        <div class="container">
            <div class="row">
              <div class="col-12 col-md-10 mx-auto mt-5 pt-lg-4">
                <?php if(have_posts()): while(have_posts()): the_post();?>
                <div class="mb-5">
                    <h1><?php the_title() ?></h1>
                </div>
                <div>
                <?php the_content() ;?>
                </div>
                <?php endwhile;endif;?>
              </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer()?>