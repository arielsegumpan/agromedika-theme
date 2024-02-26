<?php
/**
 * Template Name: Extract and Powder Price Lists
 * @package agromedika
 */

get_header();


$price_lists_jumbotron = get_acf_field('price_lists_jumbotron');
?>

<main>
    <?php if(!empty($price_lists_jumbotron['price_lists_heading'])):?>
    <section id="no-jumbotron" class="bg-lteal">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-auto text-center">
              <h1 class="fw-bold text-black"><?php echo esc_html($price_lists_jumbotron['price_lists_heading']) ?></h1>
              <h5 class="text-black mt-4"><?php echo esc_html($price_lists_jumbotron['price_lists_sub_heading']) ?></h5>
            </div>
          </div>
        </div>
    </section>
    <?php endif ;?>

    <section id="main" class="bg-lteal">
         <div class="container">
             <div class="row">

                 <div class="col-12 col-xl-10 mt-5 mt-lg-0 mx-auto">
                     <div class="cont-img">
                        <?php if(have_posts( ) && !empty(get_the_content())) : while(have_posts(  )) : the_post() ; ?>
                          <div class="lh-lg">
                          <?php the_content() ?>
                          </div>
                        <?php endwhile; else:?>
                        <div class="text-center w-100">
                          <h4 class="text-black mb-4"><?php  echo esc_html__('No post about price lists content');?></h4>
                          <a href="<?php echo esc_url(site_url('/')) ?>" class="btn btn-primary px-4 py-3 rounded-4 text-lteal"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html__( 'Back to Page', 'agromedika') ?></a>
                        </div>
                        <?php endif;?>
                     </div>
                 </div>

             </div>
         </div>
     </section>


</main>

<?php get_footer(); ?>

