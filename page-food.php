<?php
/**
 * Template Name: Functional Foods
 * @package agromedika
 */
get_header();
$functional_food_page_title = get_acf_field('functional_food_page_title');
$functional_food_block_1 = get_acf_field('functional_food_block_1');
$functional_food_block_2 = get_acf_field('functional_food_block_2');
$functional_food_block_3 = get_acf_field('functional_food_block_3');
$page_title = get_the_title();
?>

<main>
    <section id="jumb_custom_ing" class="bg-lteal"> 
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                    <h1 class="fw-bold text-black">
                        <?php echo !empty($functional_food_page_title) ? esc_html($functional_food_page_title) : esc_html($page_title); ?>
                    </h1>
                </div> 
            </div> 
        </div>
    </section>

    <?php if (!empty($functional_food_block_1['functional_food_block_1_image']['url']) && $functional_food_block_1['functional_food_block_1_content']) : ?>
    <section id="main" class="bg-lteal">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                <?php if (has_post_thumbnail()) : ?>
                    <?php $featured_image_id = get_post_thumbnail_id();
                        echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'sg_img', false, array('class' => 'img-fluid rounded-5 cust-img'))));
                    ?>
                <?php else:?>
                    <?php
                    $fn_food_id = $functional_food_block_1['functional_food_block_1_image']['id'];
                    echo html_entity_decode(esc_html(
                    wp_get_attachment_image($fn_food_id, 'sg_img', false, array('class' => 'img-fluid rounded-5 cust-img'))
                    )); ;?>
                <?php endif;?>
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 text-center text-lg-start">
                    <div class="lh-lg text-secondary">
                        <?php echo !empty($functional_food_block_1['functional_food_block_1_content']) ? html_entity_decode(esc_html($functional_food_block_1['functional_food_block_1_content'])) : ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($functional_food_block_2['functional_food_block_2_title']) && !empty($functional_food_block_2['functional_food_block_2_icons'][0]['functional_food_block_2_icon']['url'])): ?>
    <section id="infographics">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto text-center">
                    <h2 class="fw-bold mb-5 pb-4"><?php echo esc_html($functional_food_block_2['functional_food_block_2_title']) ?></h2>
                </div>
                <div class="col-12 px-lg-5">
                    <div id="infographic" class="row px-lg-4">
                        <?php foreach($functional_food_block_2['functional_food_block_2_icons'] as $get_pharm_icon) : ?>
                        <div class="col-12 col-md-4 text-center text-lg-start mb-5 mb-xl-0">
                            <a href="<?php echo esc_url(!empty($get_pharm_icon['functional_food_block_2_page_link']) ? $get_pharm_icon['functional_food_block_2_page_link'] : '#!'); ?>" class="text-decoration-none">
                            <div class="card border-0 bg-transparent text-center">
                                <div class="card-body">
                                    <div class="num-wrap"> 
                                    <?php
                                        $get_pharm_icon_id = $get_pharm_icon['functional_food_block_2_icon']['id'];
                                        echo html_entity_decode(esc_html(
                                        wp_get_attachment_image($get_pharm_icon_id, 'info_img', false,['class' => 'rounded-4'])
                                    ));?>
                                    </div>
                                    <div class="cont mt-4 pt-1">
                                        <div class="mb-3">
                                            <span class="fw-bold fs-4 text-primary"><?php echo esc_html($get_pharm_icon['functional_food_block_2_title']); ?></span>
                                        </div>
                                        <div class="text-secondary">
                                        <?php echo !empty($get_pharm_icon['functional_food_block_2_icon_content']) ? html_entity_decode(esc_html($get_pharm_icon['functional_food_block_2_icon_content'])) : ''; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
   <?php get_template_part('template-parts/components/custompage/food', 'content');?>
    
</main>

<?php get_footer(); ?>
