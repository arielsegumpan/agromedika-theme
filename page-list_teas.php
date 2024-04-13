
<?php
/**
 * Template Name: List of Agromedika Teas
 * @package agromedika
 */

 get_header();
$list_of_teas_jumbotron = get_acf_field('list_of_teas_jumbotron');

 ?>
 <main>
    <section id="prod_jumbotron" class="bg-lteal">  
        <div class="jumb-overlay"></div>
    </section>
    <?php if(!empty($list_of_teas_jumbotron['list_of_teas_heading'])) :?>
     <section id="no-jumbotron">
         <div class="container">
             <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                     <h1 class="fw-bold text-black"><?php echo esc_html($list_of_teas_jumbotron['list_of_teas_heading']);?></h1>
                     <h6 class="text-secondary mt-4"><?php echo nl2br(esc_textarea($list_of_teas_jumbotron['list_of_teas_sub_heading']));?></h6>
                 </div>
             </div>
         </div>
     </section>
    <?php endif;?>
     <section id="main">
         <div class="container">
             <div class="row">
                 <div class="col-12 mx-auto">
                     <div class="cont-img list-teas">
                        <?php if(have_posts( ) && !empty(get_the_content())) : while(have_posts(  )) : the_post() ; ?>
                          <?php echo html_entity_decode(the_content()) ?>
                        <?php endwhile; else:?>
                        <div class="text-center w-100">
                          <h4 class="text-black mb-4"><?php  echo esc_html__('No post content');?></h4>
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
 