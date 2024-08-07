<?php
/**
 * Template Name: Essential Oils
 * @package agromedika
 */
get_header();
$essential_oil_page_title = get_acf_field('essential_oil_page_title');
$essential_oil_block_1 = get_acf_field('essential_oil_block_1');
$essential_oil_block_2 = get_acf_field('essential_oil_block_2');
$essential_oil_block_3 = get_acf_field('essential_oil_block_3');
$page_title = get_the_title();
?>

<main>
    <section id="jumb_custom_ing"> 
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                    <h1 class="fw-bold text-black">
                        <?php echo !empty($essential_oil_page_title) ? esc_html($essential_oil_page_title) : esc_html($page_title); ?>
                    </h1>
                </div> 
            </div> 
        </div>
    </section>

    <?php if (!empty($essential_oil_block_1['essential_oil_block_1_image']['url']) && $essential_oil_block_1['essential_oil_block_1_content']) : ?>
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 pe-lg-5">
                <?php if (has_post_thumbnail()) : ?>
                    <?php $featured_image_id = get_post_thumbnail_id();
                        echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'sg_img', false, array('class' => 'img-fluid rounded-5 cust-img'))));
                    ?>
                <?php else:?>
                    <?php
                    $essen_oil_id = $essential_oil_block_1['essential_oil_block_1_image']['id'];
                    echo html_entity_decode(esc_html(
                    wp_get_attachment_image($essen_oil_id, 'sg_img', false, array('class' => 'img-fluid rounded-5 cust-img'))
                    )); ;?>
                <?php endif;?>
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 text-center text-lg-start">
                    <div class="lh-lg text-secondary">
                        <?php echo !empty($essential_oil_block_1['essential_oil_block_1_content']) ? html_entity_decode(esc_html($essential_oil_block_1['essential_oil_block_1_content'])) : ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($essential_oil_block_2['essential_oil_block_2_title']) && !empty($essential_oil_block_2['essential_oil_block_2_icons'][0]['essential_oil_block_2_icon']['url'])): ?>
    <section id="infographics" class="bg-primary">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto text-center">
                    <h2 class="fw-bold mb-5 pb-4 text-lteal"><?php echo esc_html($essential_oil_block_2['essential_oil_block_2_title']) ?></h2>
                </div>
                <div class="col-12 px-lg-5">
                    <div id="infographic" class="row px-lg-4">
                    <?php foreach($essential_oil_block_2['essential_oil_block_2_icons'] as $get_oil_icon) : ?>
                        <div class="col-12 col-md-4 text-center text-lg-start mb-5 mb-xl-0">
                            <a href="<?php echo esc_url(!empty($get_oil_icon['essential_oil_block_2_page_link']) ? $get_oil_icon['essential_oil_block_2_page_link'] : '#!'); ?>" class="text-decoration-none">
                            <div class="card border-0 bg-transparent text-center">
                                <div class="card-body">
                                    <div class="num-wrap"> 
                                    <?php
                                         $get_oil_id = $get_oil_icon['essential_oil_block_2_icon']['id'];
                                        echo html_entity_decode(esc_html(
                                        wp_get_attachment_image($get_oil_id, 'info_img', false,[])
                                    ));?>
                                    </div>
                                    <div class="cont mt-4 pt-1">
                                        <div class="mb-3">
                                            <span class="fw-bold fs-4 text-lteal"><?php echo esc_html($get_oil_icon['essential_oil_block_2_title']); ?></span>
                                        </div>
                                        <div class="text-lteal">
                                        <?php echo !empty($get_oil_icon['essential_oil_block_2_icon_content']) ? html_entity_decode(esc_html($get_oil_icon['essential_oil_block_2_icon_content'])) : ''; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?> 

    <?php if(!empty($essential_oil_block_3['essential_oil_block_3_content'])) :?>
        <section id="added_block" class="bg-lteal">
          <div class="container">
            <?php if(!empty($essential_oil_block_3['essential_oil_block_3_title'])) :?>
            <h2 class="fw-bold text-center mb-5 pb-lg-5"><?php echo esc_html( $essential_oil_block_3['essential_oil_block_3_title'] );?></h2>
            <?php endif;?>
            <div class="row">
              <div class="col-12 col-lg-6 mt-5 mt-lg-0 text-center text-lg-start">
                <div class="lh-lg text-secondary">
                    <?php echo html_entity_decode(esc_html($essential_oil_block_3['essential_oil_block_3_content'])); ?>
                </div>
                
              </div>
              <div class="col-12 col-lg-6 ps-lg-5 mt-5 mt-lg-0">
                <?php if (!empty($essential_oil_block_3['essential_oil_block_3_image']['url'])) : ?>
                    <?php
                    $pharm_id = $essential_oil_block_3['essential_oil_block_3_image']['id'];
                    echo html_entity_decode(esc_html(
                        wp_get_attachment_image($pharm_id, 'sg_img', false, array('class' => 'img-fluid rounded-5 cust-img'))
                    ));; ?>
                <?php endif; ?>
              </div>
            </div>
          </div> 
        </section>
    <?php endif; ?>

    
   <?php get_template_part('template-parts/components/custompage/oil', 'content');?>
   <?php get_template_part('template-parts/components/custompage/page', 'content');?>
    
   
</main>

<?php get_footer(); ?>
