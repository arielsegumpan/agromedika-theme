<?php
/**
 * The template for displaying search results
 *
 * @package agromedika
 */

get_header();
?>

<main class="bg-lteal">
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="mt-5 pt-4 text-center pb-5">
                    <h3 class="fw-bold "><?php echo esc_html('Search Results') ?></h3>
                </div>
            </div>
            <div class="row mt-md-4">
                <div class="col-12">
                        <?php if (have_posts()) : ?>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 g-lg-5">
                            <?php while (have_posts()) : the_post(); ?>
                                <div class="col">
                                    <?php get_template_part('template-parts/content/content') ?>
                                </div>
                            <?php endwhile; ?>
                            </div>
                        <?php else : ?>
                            <div class="col-12 text-center">
                                <p><i class="bi bi-search me-2"></i><?php esc_html_e('No results found.', 'agromedika'); ?></p>
                            </div>
                        <?php endif; ?>
                    
                </div>
                <div class="col-12 mt-5">
                    <div class="d-flex flex-row justify-content-between align-items-center gap-3">
                        <?php if (get_previous_posts_link()) : ?>
                            <?php previous_posts_link('<i class="bi bi-arrow-left me-2"></i>Previous'); ?>
                        <?php endif; ?>
                        <?php if (get_next_posts_link()) : ?>
                            <?php next_posts_link('Next<i class="bi bi-arrow-right ms-2"></i>'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
