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