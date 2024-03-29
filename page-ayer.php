<?php
/**
 * Template Name: ayer
 * @package agromedika
 */
get_header(); ?>

<main class="bg-lteal">
<section id="blog">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <?php if(have_posts()) : while(have_posts()) : the_post() ;?>
                <?php the_content();?>
                <?php endwhile; endif;?>
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
<?php get_footer() ?>
