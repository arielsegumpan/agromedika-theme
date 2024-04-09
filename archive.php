<?php
/**
 *
 * @package agromedika
 */
get_header();
?>
<main>
    <section id="prod_jumbotron" class="bg-lteal">
        <div class="jumb-overlay"></div>
      </section>
    <section id="blog">
        <div class="container">
            <div class="row">
                <?php $category = get_queried_object();
                if(!empty($category) && is_tax('herb-category')):?>
                <div class="col-12 col-lg-8 mx-auto text-center mb-5 pb-lg-4">
                    <h1><?php echo $category->name; ?></h1>
                    <div class="category-description"><?php echo category_description($category->term_id); ?></div>
                </div>
                <?php endif; ?>
                <div class="col-12">
                    <div class="row row-cols-1 row-cols-md-2 <?php echo esc_attr( is_post_type_archive( 'herb' ) || is_tax( 'herb-category' ) ? 'row-cols-lg-4' : 'row-cols-lg-3' ); ?> g-3 g-lg-5">
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