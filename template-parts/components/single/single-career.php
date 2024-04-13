<?php
/**
 * @package agromedika
 */

$career_shortcode_form = get_acf_field('career_shortcode_form');
  
?>
<div class="attributes mb-5">
    <div class="d-flex flex-column flex-lg-row gap-3 align-items-start">
        <div>
            <small class="text-secondary"><i class="bi bi-stopwatch text-primary border rounded-2 px-2 border-primary p-1 me-2"></i><?php echo get_the_date('j/ n/ Y') ?></small>
        </div>
        <div>
            <?php get_template_part('template-parts/components/blog/comment','count')?>
        </div>             
    </div>
</div>
<div class="content text-secondary lh-lg">
<?php the_content() ?>
</div>
<?php if(!empty($career_shortcode_form)):?>
<div id="career_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card rounded-5 border-0 p-3 p-xl-5 bg-lteal">
                    <?php echo html_entity_decode(do_shortcode($career_shortcode_form));?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>

 
