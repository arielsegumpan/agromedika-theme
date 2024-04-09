<?php
/**
 * Template Name: Contact
 * @package agromedika
 */

get_header();

// Define ACF field names
$acf_field_names = array(
    'contact_jumbotron',
    'contact_content',
    'contact_map'
);

// Initialize an array to store ACF fields
$acf_fields = array();

// Retrieve and store ACF fields
foreach ($acf_field_names as $field_name) {
    $acf_fields[$field_name] = get_acf_field($field_name);
}

// Assign ACF fields to variables
$contact_jumbotron = $acf_fields['contact_jumbotron'];
$contact_content = $acf_fields['contact_content'];

?>

<main>
    <section id="prod_jumbotron" class="bg-lteal">  
        <div class="jumb-overlay"></div>
    </section>
    <section id="contact" class="bg-white">
        <div class="container">
            <div class="row">
              <div class="col-12 col-lg-10 mx-auto position-relative">
                <div class="card rounded-5 border-0 p-3 p-xl-5 mt-5 bg-lteal">
                  <h1 class="fw-bold text-black text-center pt-4"><?php echo !empty($contact_content['contact_page_title']) ? esc_html($contact_content['contact_page_title']) : get_the_title(); ?></h1>
                  <div class="px-3 py-5 p-xl-5">
                    <?php echo !empty($contact_content['contact_from_shortcode']) ? html_entity_decode(esc_html($contact_content['contact_from_shortcode'])) : ''; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-10 mx-auto text-center">
                <div class="map-wrapper pt-lg-5">
                  <?php echo html_entity_decode(esc_html($contact_content['contact_gmap'] )) ;?>
                </div>
                <div class="mt-4 text-center">

                  <span><i class="bi bi-geo-alt fs-1 text-primary"></i></span>
                  <p class="lh-lg text-secondary mb-3"><?php echo esc_html($contact_content['contact_address']); ?></p>
                  <p><a class="text-secondary" href="mailto:<?php echo esc_attr($contact_content['contact_page_email']); ?>"><?php echo esc_html($contact_content['contact_page_email']); ?></a></p>
                  <p><a href="tel:<?php echo esc_attr($contact_content['contact_page_phone']); ?>" class="text-secondary"><?php echo esc_html($contact_content['contact_page_phone']); ?></a></p>

                </div>
              </div>
            </div>
        </div>
      </section>

    <?php if(have_posts() && !empty($content)) : ?>
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-12 text-lg text-secondary">
                    <?php while(have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
