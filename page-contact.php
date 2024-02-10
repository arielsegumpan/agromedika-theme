<?php
/**
 * Template Name: Contact
 * @package herbanext
 */
get_header();
$contact_alt_text = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
// Define an array of ACF field names
$contact_acf_fields = array(
    'contact_jumbotron_image' => 'contact_jumbotron_image',
    'body_map' => 'body_map',
    'contact_form' => 'contact_form',
    'location'  => 'location',
    'office_hours'  => 'office_hours',
    'contact_section_page'    => 'contact_section_page'
);
// Initialize an empty array to store the field values
$contact_acf_values = array();
// Loop through the field names and fetch their values
foreach ($contact_acf_fields as $key => $contact_field_name) {
    $contact_acf_values[$key] = get_acf_field($contact_field_name);
}?>
<main>
    <!-- jumbotron -->
    <section id="jumbotron_product" class="w-100 position-relative">
        <?php if (!empty($contact_acf_values['contact_jumbotron_image']['url'])): ?>
             <img src="<?php echo esc_url($contact_acf_values['contact_jumbotron_image']['url']) ?>" alt="<?php echo esc_attr($contact_acf_values['contact_jumbotron_image']['alt']) ?>" class="object-fit-cover w-100 position-absolute bottom-0 left-0">
        <?php else:?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($contact_alt_text); ?>" class="object-fit-cover w-100 position-absolute top-0 left-0">
        <?php endif; ?>
        <div class="container position-absolute">
            <div class="col-12 col-md-8 col-lg-6 me-auto text-center text-md-start my-auto">
                <?php if(is_page() && !is_front_page()): ?>
                    <h1 class="display-2 museo fw-bold text-success">
                        <?php single_post_title(); ?>
                    </h1>
                <?php endif; ?>
                <h6 class="mt-4">
                    <nav aria-label="breadcrumb">
                        <?php custom_breadcrumbs(); ?>
                    </nav>
                </h6>
            </div>
        </div>
    </section>
    <?php if (!empty($contact_acf_values['body_map'])): ?>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                   <?php echo wp_kses_decode_entities($contact_acf_values['body_map']['map']); ?>
                </div>
                <div class="col-12 col-lg-6">
                    <?php echo wp_kses_decode_entities($contact_acf_values['contact_form']); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if(!empty( $contact_acf_values['location']['location_title']) || !empty($contact_acf_values['office_hours']['office_title']) || !empty($contact_acf_values['contact_section_page']['contact_section_page_title'])) :?>
    <section id="officehours" class="bg-gray">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3">
                <?php
                $sections = [
                    'location' => [
                        'title' => $contact_acf_values['location']['location_title'],
                        'icon' => $contact_acf_values['location']['location_icon'],
                        'contents' => $contact_acf_values['location']['contents'],
                    ],
                    'office_hours' => [
                        'title' => $contact_acf_values['office_hours']['office_title'],
                        'icon' => $contact_acf_values['office_hours']['office_icon'],
                        'contents' => $contact_acf_values['office_hours']['contents'],
                    ],
                    'contact_section_page' => [
                        'title' => $contact_acf_values['contact_section_page']['contact_section_page_title'],
                        'icon' => $contact_acf_values['contact_section_page']['contact_section_page_icon'],
                        'contents' => $contact_acf_values['contact_section_page']['contact_section_page_contents'],
                    ],
                ];
                $delay = 200;
                foreach ($sections as $section_key => $section_data) {
                    if (!empty($section_data['title'])) :
                ?>
                        <div class="col text-center text-secondary<?php echo ($section_key === 'contact_section_page') ? '' : ' mb-5 mb-md-0'; ?>" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo esc_attr($delay)?>">
                            <h1 class="fs-3 fw-bold museo mb-4"><?php echo wp_kses_decode_entities($section_data['icon']) ?><?php echo esc_html($section_data['title']) ?></h1>
                            <?php if (!empty($section_data['contents'])) : ?>
                                <?php foreach ($section_data['contents'] as $content) : ?>
                                    <p><?php echo nl2br(esc_textarea($content['content'])) ?></p>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                <?php
                    endif;
                $delay += 200;
                }
                ?>
            </div>
        </div>
    </section>
    <?php endif?>
</main>
<?php get_footer(); ?>
