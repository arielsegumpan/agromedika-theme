<?php
/**
 * Template Name: Dietary Supplements
 * @package agromedika
 */
get_header();
$dietary_supplements_page_title = get_acf_field('dietary_supplements_page_title');
$dietary_supplements_block_1 = get_acf_field('dietary_supplements_block_1');
$dietary_supplements_block_2 = get_acf_field('dietary_supplements_block_2');
$dietary_supplements_block_3 = get_acf_field('dietary_supplements_block_3');
$page_title = get_the_title();
?>
 
<main>
    <section id="jumb_custom_ing" class="bg-lteal"> 
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                    <h1 class="fw-bold text-black">
                        <?php echo !empty($dietary_supplements_page_title) ? esc_html($dietary_supplements_page_title) : esc_html($page_title); ?>
                    </h1>
                </div> 
            </div> 
        </div>
    </section>

    <?php if (!empty($dietary_supplements_block_1['dietary_supplements_block_1_image']['url']) && $dietary_supplements_block_1['dietary_supplements_block_1_content']) : ?>
    <section id="main" class="bg-lteal">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="<?php echo esc_url($dietary_supplements_block_1['dietary_supplements_block_1_image']['url']) ?>" alt="<?php echo esc_attr($dietary_supplements_block_1['dietary_supplements_block_1_image']['alt']) ?>" class="img-fluid rounded-5 cust-img" >
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 text-center text-lg-start">
                    <div class="lh-lg text-secondary">
                        <?php echo !empty($dietary_supplements_block_1['dietary_supplements_block_1_content']) ? html_entity_decode(esc_html($dietary_supplements_block_1['dietary_supplements_block_1_content'])) : ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($dietary_supplements_block_2['dietary_supplements_block_2_title']) && !empty($dietary_supplements_block_2['dietary_supplements_block_2_icons'][0]['dietary_supplements_block_2_icon']['url'])): ?>
    <section id="infographics">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto text-center">
                    <h2 class="fw-bold mb-5 pb-4"><?php echo esc_html($dietary_supplements_block_2['dietary_supplements_block_2_title']) ?></h2>
                </div>
                <div class="col-12 px-lg-5">
                    <div id="infographic" class="row px-lg-4">
                        <?php foreach($dietary_supplements_block_2['dietary_supplements_block_2_icons'] as $get_supp_icon) : ?>
                        <div class="col-12 col-md-6 col-xl-3 text-center text-lg-start mb-5 mb-xl-0">
                            <div class="card border-0 bg-transparent text-center">
                                <div class="card-body">
                                    <div class="num-wrap">
                                        <img src="<?php echo esc_url($get_supp_icon['dietary_supplements_block_2_icon']['url']) ;?>" alt="<?php echo esc_attr($get_supp_icon['dietary_supplements_block_2_icon']['alt']) ;?>">
                                    </div>
                                    <div class="cont mt-4 pt-3">
                                        <div class="text-secondary">
                                            <?php echo !empty($get_supp_icon['dietary_supplements_block_2_icon_content']) ? html_entity_decode(esc_html($get_supp_icon['dietary_supplements_block_2_icon_content'])) : ''; ?>
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

    
    <?php get_template_part('template-parts/components/custompage/supplements', 'content');?>
    
</main>

<?php get_footer(); ?>
