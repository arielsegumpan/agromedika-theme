<?php
/**
 * Template Name: Company Profile
 * @package agromedika
 */

get_header();

$acf_field_names = array(
    'company_jumbotron',
    'company_about',
    'company_timeline',
    'company_team',
    'company_mission_and_vision',
    'company_youtube'
);

$acf_fields = array();

foreach ($acf_field_names as $field_name) {
    $acf_fields[$field_name] = get_acf_field($field_name);
}
?>

<main>

    <?php if (!empty($acf_fields['company_jumbotron']['company_hero_text_slides']['0']['company_hero_text_slide'])): ?>
        <section id="jumbotron-product" class="bg-lteal">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-9 mx-auto my-auto text-center">
                        <div class="l-realise-slider-card-block">
                            <div class="card-block-wrap">
                                <?php foreach ($acf_fields['company_jumbotron']['company_hero_text_slides'] as $key => $getSlide) :
                                    $class = ($key == 1) ? 'c' : (($key == 2) ? 'a' : 'b');
                                    $id = ($key == 1) ? 'first' : (($key == 2) ? 'second' : 'third');
                                ?>
                                    <div class="card <?php echo $class; ?> border-0 bg-transparent" id="<?php echo $id; ?>">
                                        <h1 class="fw-bold"><?php echo esc_html($getSlide['company_hero_text_slide']); ?></h1>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="jumb-overlay opacity-50"></div>
        </section>
    <?php endif; ?>
 
    <?php if (!empty($acf_fields['company_about']['company_about_title'])) : ?>
        <section id="who" class="bg-lteal">
            <div class="container">
              <div class="row">
                <div class="col-12 col-lg-6 mb-5 mb-xl-0">
                  <img src="<?php echo esc_url($acf_fields['company_about']['company_about_image']['url']) ;?>" alt="<?php echo esc_attr($acf_fields['company_about']['company_about_image']['alt']) ;?>" class="img-fluid rounded-4">
                </div>
                <?php if (!empty($acf_fields['company_about']['company_about_title'])) : ?>
                <div class="col-12 col-lg-6 text-center text-lg-start">
                    <h2 class="fw-bold text-black mb-4"><?php echo esc_html($acf_fields['company_about']['company_about_title']); ?></h2>
                    <p class="lh-lg text-secondary">
                        <?php echo nl2br(esc_textarea($acf_fields['company_about']['company_about_content'])) ?>
                    </p>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </section>
    <?php endif; ?>

    <?php if (!empty($acf_fields['company_timeline']['company_timeline_title'])) : ?>
        <section id="company-info" class="bg-primary">
            <div class="container-fluid">
              <div class="row">
                <?php if (!empty($acf_fields['company_timeline']['company_timeline_cards'])) :
                foreach ($acf_fields['company_timeline']['company_timeline_cards'] as $index => $timeline_card) : ?>
                <div class="col-12 col-md-6 col-xl-3 text-center mb-3 mb-lg-5 mb-xl-0">
                  <a href="<?php echo esc_url($timeline_card['timeline_card_page_link']);echo esc_attr($timeline_card['in_what_section_of_the_page']) ?>" class="text-decoration-none">
                    <div class="card border-0 bg-transparent">
                      <div class="card-body">

                        <div class="cont-img mb-3">
                        <img src="<?php echo esc_url($timeline_card['timeline_card_image']['url']); ?>" alt="<?php echo esc_attr($timeline_card['timeline_card_image']['alt']); ?>">
                        </div>

                        <div class="num-wrap">
                          <span class="fw-bold fs-4 text-lteal"><?php echo esc_html($timeline_card['timeline_card_title']); ?></span>
                        </div>
      
                        <div class="cont mt-4">
                          <p class="text-lteal">
                          <?php echo html_entity_decode(esc_textarea($timeline_card['timeline_card_content'])); ?>
                          </p>
                        </div>


                      </div>
                    </div>
                  </a>
                </div>
                <?php endforeach; endif; ?>
              </div>
            </div>
          </section>
    <?php endif; ?>

    <?php if (!empty($acf_fields['company_team']['company_title']) && !empty($acf_fields['company_team']['company_team_content'])) : ?>
        <section id="team">
            <div class="container">
              <div class="row">
                <div class="col-12 col-lg-8 mx-auto text-center">
                  <h2 class="fw-bold text-black"><?php echo esc_html($acf_fields['company_team']['company_title']); ?></h2>
                  <p class="text-secondary mt-4"><?php echo nl2br(esc_textarea($acf_fields['company_team']['company_team_content'])); ?></p>
                </div>
                <?php if (!empty($acf_fields['company_team']['company_team_image']['url'])) : ?>
                    <div class="col-12 mt-3 mt-lg-5">
                        <img src="<?php echo esc_url($acf_fields['company_team']['company_team_image']['url']); ?>" alt="<?php echo esc_attr($acf_fields['company_team']['company_team_image']['alt']); ?>" class="img-fluid rounded-4">
                    </div>
                <?php endif; ?>
              </div>
            </div>
    
            <div id="mission_vision">
              <div class="container">
                  <div class="row">
                      <div class="col-12 col-md-9 col-lg-6 mx-auto text-center mt-5">
                          <div class="mission">
                              <h2 class="fw-bold"><?php echo esc_html($acf_fields['company_mission_and_vision']['company_vision_title']); ?></h2>
                              <p class="lh-lg text-secondary"><?php echo esc_html($acf_fields['company_mission_and_vision']['company_vision_content']); ?></p>
                          </div>
                      </div>
                  </div>
                  <div class="vision">
                      <div class="row mb-5">
                          <div class="col-12 col-md-10 mx-auto text-center mt-5">
                              <div class="mission">
                                <h2 class="fw-bold"><?php echo esc_html($acf_fields['company_mission_and_vision']['company_mission_title']); ?></h2>
                                <p class="lh-lg text-secondary"><?php echo esc_html($acf_fields['company_mission_and_vision']['company_mission_content']); ?></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </section>
    <?php endif; ?>
    <?php if(!empty($acf_fields['company_youtube']['company_youtube_link'])) :?>
        <section id="yt">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="ratio ratio-16x9">
                    <?php echo html_entity_decode(esc_html($acf_fields['company_youtube']['company_youtube_link'])) ;?>
                  </div>
                </div>
              </div>
            </div>
        </section>
    <?php endif;?>

    <?php $content = get_the_content();
    if(have_posts( ) && !empty($content)) : ?>
        <section id="team">
            <div class="container">
                <div class="row">
                    <div class="col-12">
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
