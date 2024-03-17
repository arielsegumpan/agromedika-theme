<?php
/**
 * Template Name: Pharmaceuticals
 * @package agromedika
 */

 get_header();
$pharmaceutical_page_title = get_acf_field('pharmaceutical_page_title');
 $pharmaceutical_block_1 = get_acf_field('pharmaceutical_block_1');
 $pharmaceutical_block_2 = get_acf_field('pharmaceutical_block_2');
 $pharmaceutical_page_link = get_acf_field('pharmaceutical_page_link');
$page_title = get_the_title();
?>
<main>
    <section id="jumb_custom_ing" class="bg-lteal"> 
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                  <?php if(!empty($pharmaceutical_page_title)):?>
                    <h1 class="fw-bold text-black"><?php echo esc_html($pharmaceutical_page_title); ?></h1>
                  <?php else:?>
                    <h1 class="fw-bold text-black"><?php echo esc_html($page_title); ?></h1>
                  <?php endif;?>
                </div> 
            </div> 
        </div>
    </section>
    <?php if(!empty($pharmaceutical_block_1['pharmaceutical_block_1_image']['url']) && $pharmaceutical_block_1['pharmaceutical_block_1_content']) :?>
    <section id="main" class="bg-lteal">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="<?php echo esc_url($pharmaceutical_block_1['pharmaceutical_block_1_image']['url']) ?>" alt="<?php echo esc_attr($pharmaceutical_block_1['pharmaceutical_block_1_image']['alt']) ?>" class="img-fluid rounded-5 cust-img" >
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 text-center text-lg-start">
                    <div class="lh-lg text-secondary">
                      <?php echo html_entity_decode(esc_html($pharmaceutical_block_1['pharmaceutical_block_1_content'])) ;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if(!empty($pharmaceutical_block_2['pharmaceutical_block_2_title']) && !empty($pharmaceutical_block_2['pharmaceutical_block_2_icons'][0]['pharmaceutical_block_2_icon']['url'])):?>
    <section id="infographics">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto text-center">
                    <h2 class="fw-bold mb-5 pb-4"><?php echo esc_html($pharmaceutical_block_2['pharmaceutical_block_2_title']) ?></h2>
                </div>
                <div class="col-12 px-lg-5">
                  <div id="infographic" class="row px-lg-4">
                    <?php foreach($pharmaceutical_block_2['pharmaceutical_block_2_icons'] as $get_pharm_icon) : ?>
                    <div class="col-12 col-md-6 col-xl-3 text-center text-lg-start mb-5 mb-xl-0">
                      <div class="card border-0 bg-transparent text-center">
                        <div class="card-body">
                          <div class="num-wrap">
                            <img src="<?php echo esc_url($get_pharm_icon['pharmaceutical_block_2_icon']['url']) ;?>" alt="<?php echo esc_attr($get_pharm_icon['pharmaceutical_block_2_icon']['alt']) ;?>">
                          </div>
                          <div class="cont mt-4 pt-3">
                            <div class="text-secondary">
                              <?php echo html_entity_decode(esc_html($get_pharm_icon['pharmaceutical_block_2_icon_content'])) ;?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach;?>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <section id="product_cat" class="bg-lteal">
        <div class="container">
            <div class="row mb-5 pb-lg-5">
                <div class="col-12 text-center">
                <h2 class="fw-bold text-black">Product Menu/Catalogue</h2>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 g-3 row-cols-md-4 g-lg-5 justify-content-center align-items-center">
              <?php echo do_shortcode('[agromedika_get_approve_doh_product]'); ?>  
            </div>

            <?php if(!empty($pharmaceutical_page_link)) :?>
            <div class="row mt-5 pt-lg-4">
              <div class="col-6 mx-auto text-center">
                <a href="<?php echo esc_url($pharmaceutical_page_link) ?>" class="text-decoration-none text-black"><i class="bi bi-arrow-right me-3"></i><?php echo esc_html('View More') ;?></a>
              </div>
            </div>
            <?php endif;?>
        </div>
    </section>
</main>

<?php get_footer(); ?>