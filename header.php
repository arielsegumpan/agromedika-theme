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

  <?php
$excluded_pages = array('contact-us', 'contact', 'careers', 'quality', 'blog', 'news-and-updates');
$excluded_posts = array('news-and-updates', 'herb');

$music_file = get_acf_option_field('music_file');
$should_display_music = !empty($music_file) && 
    !is_page($excluded_pages) &&
    !is_single($excluded_posts) && 
    !is_singular('herb') &&
    !is_home();
?>

<?php if ($should_display_music) : ?>
    <div id="music">
        <div class="card py-2 rounded-4 shadow border border-primary text-center">
            <div id="audio_btn" class="d-flex flex-row gap-2 align-items-center justify-content-center">
                <i class="bi bi-volume-up fs-5"></i>
            </div>
            <audio controls autoplay loop>
                <source src="<?php echo esc_url($music_file['url']); ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
<?php endif; ?>



  <body <?php body_class();?>>
    <header id="hdr_main" class="<?php echo esc_attr(is_page( ['about', 'company','history'] ) ? 'hdr_bg' : 'bg-lteal');?> position-fixed w-100">
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

                <div id="sm_search" class="d-flex flex-row justify-content-between align-items-center mb-4">
                  <div class="me-2 w-100">
                  <?php get_template_part( 'searchform1'); ?>
                  </div>
                  <a href="#!" class="btn btn-primary text-white"><i class="bi bi-person"></i></a>
                </div>

                <?php if(has_nav_menu('agromedika-header-menu')):?>
                    <?php get_template_part('template-parts/header/nav');?>
                <?php endif; ?>

                <div id="lrg_search" class="d-flex flex-row  ps-3 ps-lg-auto mt-4 mt-xl-0">
                  <div class="search-container me-2">
                    <?php get_search_form() ?>
                  </div> 
                  <a href="<?php echo esc_url(wp_login_url()); ?>" class="btn btn-primary text-white"><i class="bi bi-person"></i></a>
                </div>

              </div>
            </div>
          </nav>
    </header>