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
                    <img src="<?php echo esc_url($functional_food_block_1['functional_food_block_1_image']['url']) ?>" alt="<?php echo esc_attr($functional_food_block_1['functional_food_block_1_image']['alt']) ?>" class="img-fluid rounded-5 cust-img" >
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
                        <div class="col-12 col-md-6 col-xl-3 text-center text-lg-start mb-5 mb-xl-0">
                            <div class="card border-0 bg-transparent text-center">
                                <div class="card-body">
                                    <div class="num-wrap">
                                        <img src="<?php echo esc_url($get_pharm_icon['functional_food_block_2_icon']['url']) ;?>" alt="<?php echo esc_attr($get_pharm_icon['functional_food_block_2_icon']['alt']) ;?>">
                                    </div>
                                    <div class="cont mt-4 pt-3">
                                        <div class="text-secondary">
                                            <?php echo !empty($get_pharm_icon['functional_food_block_2_icon_content']) ? html_entity_decode(esc_html($get_pharm_icon['functional_food_block_2_icon_content'])) : ''; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
   <?php get_template_part('template-parts/components/custompage/pharm', 'content');?>
    
</main>

<?php get_footer(); ?>
