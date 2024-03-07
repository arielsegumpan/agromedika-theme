<?php
/**
 * /**
 * 
 * Template Post Type: philippine-medicinal
 *
 * @package agromedika
 */
get_header();
$medicinal_plant_galleries = get_acf_field('medicinal_plant_galleries');
$get_file = esc_url($medicinal_plant_galleries['medicinal_plant_gallery_file_attachment']['url']);
?>


<main>
    <section id="main-pdf" class="bg-lteal">
        <div class="container">
            <div class="row">
            <div class="col-12 col-lg-10 mx-auto text-center">
                <center> 
                <div class="mb-5 pb-lg-4">
                <div class="col-12 col-md-8 col-lg-10 mx-auto">
                    <h1><?php echo esc_html(the_title())?></h1> 
                    <h6 class="text-secondary mt-4"><?php echo esc_html($medicinal_plant_galleries['medicinal_plant_heading_description']) ;?></h6> 
                </div>
                </div>
                <object id="obj" data="<?php echo $get_file ?>" type="<?php echo esc_attr($medicinal_plant_galleries['medicinal_plant_gallery_file_attachment']['mime_type']) ?>" width="100%"></object> 
                </center>
                  
                <div class="dload-btn mt-5 pt-lg-4"></div>
                <a href="<?php echo $get_file ?>" class="btn btn-primary rounded-4 text-lteal px-5 py-4" download><i class="bi bi-file-earmark-arrow-down me-2 fs-5"></i><?php echo esc_html('Download') ;?></a>
            </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
