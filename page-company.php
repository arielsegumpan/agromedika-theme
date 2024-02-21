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
    'company_mission_and_vision'
);

$acf_fields = array();

foreach ($acf_field_names as $field_name) {
    $acf_fields[$field_name] = get_acf_field($field_name);
}

?>
<main>
    <?php if (!empty($acf_fields['company_jumbotron']['company_hero_image']['url']) && !empty($acf_fields['company_jumbotron']['company_hero_title'])) : ?>
        <section id="jumbotron-2" style="background-image: url('<?php echo esc_url($acf_fields['company_jumbotron']['company_hero_image']['url']); ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                        <h1 class="fw-bold text-black"><?php echo esc_html($acf_fields['company_jumbotron']['company_hero_title']); ?></h1>
                        <h5 class="text-black mt-4">
                            <?php echo nl2br(esc_textarea($acf_fields['company_jumbotron']['company_hero_sub_title'])); ?>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="jumb-overlay"></div>
        </section>
    <?php endif; ?>
 
    <?php if (!empty($acf_fields['company_about']['company_about_title'])) : ?>
        <section id="who" class="bg-lteal">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-7 mb-5 mb-xl-0">
                        <div class="who-imgs row row-cols-2 g-3 g-xl-4">
                            <?php if (!empty($acf_fields['company_about']['company_about_images'])) :
                                $col_class = 'col-12';
                                foreach ($acf_fields['company_about']['company_about_images'] as $index => $about_img_gallery) :
                                    $col_class = ($index > 0) ? 'col' : 'col-12'; ?>
                                    <div class="who-img <?php echo esc_attr($col_class); ?>">
                                        <img src="<?php echo esc_url($about_img_gallery['company_about_image']['url']); ?>" alt="<?php echo esc_attr($about_img_gallery['company_about_image']['alt']); ?>" class="img-fluid rounded-4">
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                    <?php if (!empty($acf_fields['company_about']['company_about_title'])) : ?>
                        <div class="col-12 col-lg-5 text-center text-lg-start">
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
              <div class="row mb-5">
                <div class="col-12 col-lg-9 mx-auto text-center">
                  <h2 class="fw-bold text-lteal mb-4"><?php echo esc_html($acf_fields['company_timeline']['company_timeline_title']); ?></h2>
                  <p class="lh-lg text-lteal">
                  <?php echo nl2br(esc_textarea($acf_fields['company_timeline']['company_timeline_content'])); ?>
                  </p>
                </div>
              </div>
              <div class="row">
                <?php if (!empty($acf_fields['company_timeline']['company_timeline_cards'])) :
                foreach ($acf_fields['company_timeline']['company_timeline_cards'] as $index => $timeline_card) : ?>
                <div class="col-12 col-md-6 col-xl-3 text-center text-lg-start mb-5 mb-xl-0">
                  <a href="<?php echo esc_url($timeline_card['timeline_card_page_link']);echo esc_attr($timeline_card['in_what_section_of_the_page']) ?>" class="text-decoration-none">
                    <div class="card border-0 bg-transparent">
                      <div class="card-body">
                        <div class="num-wrap">
                          <span class="fw-bold fs-4 text-lteal"><?php echo esc_html($timeline_card['timeline_card_title']); ?></span>
                        </div>
      
                        <div class="cont mt-4">
                          <p class="text-lteal">
                          <?php echo nl2br(esc_textarea($timeline_card['timeline_card_content'])); ?>
                          </p>
                        </div>
      
                        <div class="cont-img mt-5">
                          <img src="<?php echo esc_url($timeline_card['timeline_card_image']['url']); ?>" alt="<?php echo esc_attr($timeline_card['timeline_card_image']['alt']); ?>" class="img-fluid rounded-4">
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
