<?php
/**
 * Header Template
 * @package agromedika
 */
?>
<!doctype html>
<html <?php wp_kses_decode_entities(language_attributes()) ?>>
  <head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html_e(get_bloginfo('name'));?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head()?>
  </head>
  <body <?php body_class();?>>

    <div id="scroll_btn">
      <i class='bi bi-chevron-up text-lteal fs-4 rounded-3 bg-primary'></i>
    </div>

    <header class="position-absolute w-100">
        <nav class="navbar navbar-expand-xl bg-transparent">
            <div class="container">
              <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo_image = wp_get_attachment_image($custom_logo_id, 'logo_thumbnails', false, ['class' => 'mt-2']);
                $logo_url = home_url('/'); // Link to the home page
                if (has_custom_logo()) {
                  echo '<a href="' . esc_url($logo_url) . '">' . html_entity_decode(esc_html($logo_image)) . '</a>';
                } else {
                    echo '<a class="navbar-brand text-white" href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
                }

                

              ;?>
              <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                
                <input type="checkbox" id="checkbox4" class="checkbox4 visuallyHidden">
                <label for="checkbox4">
                    <div class="hamburger hamburger4">
                        <span class="bar bar1"></span>
                        <span class="bar bar2"></span>
                        <span class="bar bar3"></span>
                        <span class="bar bar4"></span>
                        <span class="bar bar5"></span>
                    </div>
                </label>
                
              </button>
              <div class="collapse navbar-collapse py-3 py-lg-auto" id="navbarSupportedContent">

                <?php if(has_nav_menu('agromedika-header-menu')):?>
                    <?php get_template_part('template-parts/header/nav');?>
                <?php endif; ?>

                <div class="d-flex flex-row  ps-3 ps-lg-auto mt-4 mt-xl-0">
                  <div class="search-container me-2">
                    <?php get_search_form() ?>
                  </div> 
                  <a href="<?php echo esc_url(wp_login_url()); ?>" class="btn btn-primary text-white"><i class="bi bi-person"></i></a>
                </div>

              </div>
            </div>
          </nav>
    </header>