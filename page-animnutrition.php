<?php
/**
 * Template Name: Animal Nutrition
 * @package agromedika
 */
get_header();
$animal_nutrition_page_title = get_acf_field('animal_nutrition_page_title');
$animal_nutrition_block_1 = get_acf_field('animal_nutrition_block_1');
$animal_nutrition_block_2 = get_acf_field('animal_nutrition_block_2');
$animal_nutrition_block_3 = get_acf_field('animal_nutrition_block_3');
$page_title = get_the_title();
?>

<main>
    <section id="prod_jumbotron" class="bg-lteal">  
        <div class="jumb-overlay"></div>
    </section>
    <section id="jumb_custom_ing" class="bg-white"> 
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                    <h1 class="fw-bold text-black">
                        <?php echo !empty($animal_nutrition_page_title) ? esc_html($animal_nutrition_page_title) : esc_html($page_title); ?>
                    </h1>
                </div> 
            </div> 
        </div>
    </section>

    <?php if (!empty($animal_nutrition_block_1['animal_nutrition_block_1_image']['url']) && $animal_nutrition_block_1['animal_nutrition_block_1_content']) : ?>
    <section id="main" class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 pe-lg-5">
                <?php if (has_post_thumbnail()) : ?>
                    <?php $featured_image_id = get_post_thumbnail_id();
                        echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'sg_img', false, array('class' => 'img-fluid rounded-5 cust-img'))));
                    ?>
                <?php else:?>
                    <?php
                    $anim_id = $animal_nutrition_block_1['animal_nutrition_block_1_image']['id'];
                    echo html_entity_decode(esc_html(
                    wp_get_attachment_image($anim_id, 'sg_img', false, array('class' => 'img-fluid rounded-5 cust-img'))
                    )); ;?>
                <?php endif;?> 
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 text-center text-lg-start">
                    <div class="lh-lg text-secondary">
                        <?php echo !empty($animal_nutrition_block_1['animal_nutrition_block_1_content']) ? html_entity_decode(esc_html($animal_nutrition_block_1['animal_nutrition_block_1_content'])) : ''; ?>
                    </div>
                </div>
            </div> 
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($animal_nutrition_block_2['animal_nutrition_block_2_title']) && !empty($animal_nutrition_block_2['animal_nutrition_block_2_icons'][0]['animal_nutrition_block_2_icon']['url'])): ?>
    <section id="infographics" class="bg-lteal">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto text-center">
                    <h2 class="fw-bold mb-5 pb-4"><?php echo esc_html($animal_nutrition_block_2['animal_nutrition_block_2_title']) ?></h2>
                </div>
                <div class="col-12 px-lg-5">
                    <div id="infographic" class="row px-lg-4">
                        <?php foreach($animal_nutrition_block_2['animal_nutrition_block_2_icons'] as $get_pharm_icon) : ?>
                        <div class="col-12 col-md-4 text-center text-lg-start mb-5 mb-xl-0">
                            <a href="<?php echo esc_url(!empty($get_pharm_icon['animal_nutrition_block_2_page_link']) ? $get_pharm_icon['animal_nutrition_block_2_page_link'] : '#!'); ?>" class="text-decoration-none">
                            <div class="card border-0 bg-transparent text-center">
                                <div class="card-body">
                                    <div class="num-wrap"> 
                                    <?php
                                    $get_supp_id = $get_pharm_icon['animal_nutrition_block_2_icon']['ID']; // Assuming this is the attachment ID
                                    echo wp_get_attachment_image($get_supp_id, 'info_img', false, array());
                                    ?>
                                    </div>
                                    <div class="cont mt-4 pt-1">
                                    <div class="mb-3">
                                        <span class="fw-bold fs-4 text-primary"><?php echo esc_html($get_pharm_icon['animal_nutrition_block_2_title']); ?></span>
                                    </div>
                                        <div class="text-secondary">
                                            <?php echo !empty($get_pharm_icon['animal_nutrition_block_2_icon_content']) ? html_entity_decode(esc_html($get_pharm_icon['animal_nutrition_block_2_icon_content'])) : ''; ?>
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
   <?php get_template_part('template-parts/components/custompage/animalnutrition', 'content');?>
   <?php get_template_part('template-parts/components/custompage/page', 'content');?>
    
</main>

<?php get_footer(); ?>
