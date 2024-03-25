<?php
/**
 *
 * @package agromedika
 */
get_header();
?>
<main class="bg-lteal">
    <section id="blog">
        <div class="container">

            <div class="row mt-5 pt-4">
                <div class="col-12">
                    <div class="row row-cols-1 row-cols-md-2  row-cols-lg-3 g-3 g-lg-5">
                    <?php
                    if(have_posts()) : while(have_posts()) : the_post() ;?>
                        <div class="col">
                            <?php get_template_part('template-parts/content/content') ?>
                        </div>
                    <?php endwhile;  else:?>
                       <div class="text-center mx-auto">
                            <h3 class="fw-bold text-center mx-auto pb-3"><?php echo esc_html('There is no content to display.') ?></h3>
                            <a href="<?php echo esc_url(site_url('/'));?>" class="text-decoration-none text-primary"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html('Go Back') ?></a>
                       </div>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer()?>