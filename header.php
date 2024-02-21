<?php
/**
 * Header Template
 * @package agromedika
 */

 $shop_page_id = wc_get_page_id('shop'); // Get the shop page ID
$shop_page = get_post($shop_page_id); // Get the shop page object
$shop_page && $shop_page->post_title !== 'Shop' ? $shop_url = esc_url(get_permalink($shop_page)) : $shop_url = esc_url(wc_get_page_permalink('shop'));
?>
<!doctype html>
<html <?php wp_kses_decode_entities(language_attributes()) ?>>
  <head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html_e(get_bloginfo('name'));?></title>
    <?php wp_head()?>
  </head>
  <body <?php body_class();?>>

    <div id="scroll_btn">
      <i class='bi bi-chevron-up text-lteal fs-4 rounded-3 bg-primary'></i>
    </div>

    <a href="#!" class="text-decoration-none">
      <div id="cart" class="position-fixed shadow">
        <i class="bi bi-cart4 fs-4"></i>
      </div>
    </a>

    <header class="position-absolute w-100">
        <nav class="navbar navbar-expand-xl bg-transparent">
            <div class="container">
              <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if (has_custom_logo()) {
                    echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '"></a>';
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
                    <form action="/search" method="get">
                      <input class="search expandright" id="searchright" type="search" name="q" placeholder="Search">
                      <label class="button searchbutton" for="searchright"><i class="bi bi-search btn btn-primary text-white"></i></label>
                    </form>
                  </div>

                  <a href="<?php echo $shop_url ?>" class="btn btn-primary text-white me-2"><i class="bi bi-shop-window"></i></a>
                  <a href="#!" class="btn btn-primary text-white"><i class="bi bi-person"></i></a>

                </div>

              </div>
            </div>
          </nav>
    </header>