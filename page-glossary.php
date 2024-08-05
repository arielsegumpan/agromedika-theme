<?php
/**
 * Template Name: Glossary
 * @package agromedika
 */

$glossary_group = get_acf_field('glossary_group');

get_header();?>

<main>
    <section id="jumb_custom_ing" class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                  <?php if(!empty(get_the_title())): ?>
                  <h1 class="fw-bold text-black"><?php the_title(); ?></h1>
                  <?php else: ?>
                    <h1 class="fw-bold text-black"><?php echo esc_html($glossary_group['glossary_title']);?></h1>
                  <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="main" class="bg-white"> 
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <?php if(have_posts(  )) : while(have_posts()) : the_post();?>
                  <?php the_content();?>
                  <?php endwhile;?>
                  <?php else:?>
                    <h4 class="text-black mb-4><?php  echo esc_html__('No post content.');?></h4>
                  <?php endif;?>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer();?>