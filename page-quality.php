<?php
/**
 * Template Name: Quality
 * @package agromedika
 */

get_header();
$acf_field_names = array(
    'quality_jumbotron',
    'quality_control',
    'quality_assurance'
);

$acf_fields = array();

foreach ($acf_field_names as $field_name) {
    $acf_fields[$field_name] = get_acf_field($field_name);
}

$quality_jumbotron = $acf_fields['quality_jumbotron'];
$quality_control = $acf_fields['quality_control'];
$quality_assurance = $acf_fields['quality_assurance'];

get_header();

?>

<main>
    <?php if(!empty($quality_jumbotron['quality_hero_title']) && !empty($quality_jumbotron['quality_hero_image']['url'])) :?>
    <section id="jumbotron-2" style="background-image: url('<?php echo esc_url($quality_jumbotron['quality_hero_image']['url']) ?>');">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                  <h1 class="fw-bold text-black"><?php echo esc_html($quality_jumbotron['quality_hero_title']) ;?></h1>
                  <h5 class="text-black mt-4"><?php echo nl2br(esc_textarea( $quality_jumbotron['quality_hero_sub_title'] )) ;?></h5>
                </div>
              </div>
            </div>
        <div class="jumb-overlay"></div>
    </section>
    <?php endif ;?>
    <?php if(!empty($quality_control['quality_control_title']) && !empty($quality_control['quality_control_content'])) :?>
    <section id="quality_control">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mx-auto text-center">
                  <h2 class="fw-bold"><?php echo esc_html($quality_control['quality_control_title']);?></h2>
                  <p class="lh-lg text-secondary mt-4"><?php echo nl2br(esc_textarea($quality_control['quality_control_content']));?></p>
                </div>
                <div class="col-12 mt-4">
                  <img src="<?php echo esc_url($quality_control['quality_control_image']['url']) ;?>" alt="<?php echo esc_attr($quality_control['quality_control_image']['alt']) ;?>" class="qa-img-1 img-fluid rounded-4">
                </div>
              </div>
              
              <div class="row mt-5 pt-lg-5">
                <div class="col-12 col-lg-8 px-lg-5">
                  <h2 class="mb-3"><?php echo esc_html($quality_assurance['quality_assurance_title']);?></h2>
                  <p class="lh-lg text-secondary">
                  <?php echo nl2br(esc_textarea($quality_assurance['quality_assurance_content']));?>
                  </p>
                  <?php if(!empty($quality_assurance['quality_assurance_cards'][0]['quality_assurance_card_image']['url'])) :?>
                  <div id="qa-icons" class="mt-5">
                    <div class="row row-cols-1 row-cols-md-2 gy-5">
                    <?php foreach($quality_assurance['quality_assurance_cards'] as $qa_card) :?>
                      <div class="col">
                        <div class="d-flex">
                          <div class="flex-shrink-0">
                            <img src="<?php echo esc_url($qa_card['quality_assurance_card_image']['url']) ;?>" alt="<?php echo esc_attr($qa_card['quality_assurance_card_image']['alt']) ;?>">
                          </div>
                          <div class="flex-grow-1 ms-3 text-secondary">
                            <?php echo esc_html($qa_card['quality_assurance_card_content']);?>
                          </div>
                        </div>
                      </div>
                    <?php endforeach;endif;?>
                    </div>
                  </div>

                </div>
                <?php if(!empty($quality_assurance['quality_assurance_image']['url'])) :?>
                <div class="col-12 col-lg-4 mt-5 mt-lg-0">
                  <img src="<?php echo esc_url($quality_assurance['quality_assurance_image']['url']) ;?>" alt="<?php echo esc_url($quality_assurance['quality_assurance_image']['alt']);?>" class="qa-img-2 img-fluid rounded-4">
                </div>
                <?php endif ;?>
            </div>
        </div>
    </section>
    <?php endif ;?>

    <?php $content = get_the_content();
    if(have_posts( ) && !empty($content)) : ?>
        <section id="team">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-lg text-secondary">
                    <?php while(have_posts()) : the_post() ;?>
                        <?php echo $content;?>
                    <?php endwhile;?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    
</main>
<?php get_footer(); ?>
