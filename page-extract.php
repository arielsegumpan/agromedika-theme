<?php
/**
 * Template Name: Extract List
 * @package agromedika
 */

 get_header();
$extract_list_jumbotron = get_acf_field('extract_list_jumbotron');

 ?>
 <main>
    <section id="prod_jumbotron" class="bg-lteal">  
        <div class="jumb-overlay"></div>
    </section>
    <?php if(!empty($extract_list_jumbotron['extract_list_heading'])) :?>
     <section id="no-jumbotron">
         <div class="container">
             <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                     <h1 class="fw-bold text-black"><?php echo esc_html($extract_list_jumbotron['extract_list_heading']);?></h1>
                     <h6 class="text-secondary mt-4"><?php echo nl2br(esc_textarea($extract_list_jumbotron['extract_list_sub_heading']));?></h6>
                 </div>
             </div>
         </div>
     </section>
    <?php endif;?>
     <section id="main">
         <div class="container">
             <div class="row">
                 <div class="col-12 mx-auto">
                     <div class="cont-img extract_lists">
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
 