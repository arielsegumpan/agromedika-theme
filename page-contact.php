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
$contact_map = $acf_fields['contact_map'];

?>

<main>
    <?php if(!empty($contact_jumbotron['contact_hero_title']) && !empty($contact_jumbotron['contact_hero_image']['url'])) :?>
    <section id="jumbotron-2" style="background: url('<?php echo esc_url($contact_jumbotron['contact_hero_image']['url']); ?>') center/cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                    <h1 class="fw-bold text-black"><?php echo esc_html($contact_jumbotron['contact_hero_title']); ?></h1>
                    <h5 class="text-black mt-4"><?php echo nl2br(esc_textarea($contact_jumbotron['contact_hero_content'])); ?></h5>
                </div>
            </div>
        </div>
        <div class="jumb-overlay"></div>
    </section>
    <?php endif; ?>

    <?php if(!empty($contact_content['contact_page_title']) && !empty($contact_content['contact_page_content'])) : ?>
    <section id="contact" class="bg-lteal">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 my-auto text-center text-lg-start">
                    <div class="mb-5">
                        <h1 class="fw-bold text-black mb-5"><i class="bi bi-send me-2"></i><?php echo esc_html($contact_content['contact_page_title']); ?></h1>
                        <p class="lh-lg text-secondary mb-3"><?php echo esc_html($contact_content['contact_page_content']); ?></p>
                        <p class="lh-lg text-secondary mb-3"><?php echo esc_html($contact_content['contact_address']); ?></p>
                        <p><a class="text-secondary" href="mailto:<?php echo esc_attr($contact_content['contact_page_email']); ?>"><?php echo esc_html($contact_content['contact_page_email']); ?></a></p>
                        <p><a href="tel:<?php echo esc_attr($contact_content['contact_page_phone']); ?>" class="text-secondary"><?php echo esc_html($contact_content['contact_page_phone']); ?></a></p>
                    </div>

                    <div class="map">
                        <?php echo wp_kses_decode_entities($contact_map['contact_page_map']); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                    <div class="card border-0 rounded-5 bg-primary p-4 p-md-5">
                        <form action="#!">
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="name" class="form-label fw-bold text-lteal">Name</label>
                                    <input type="text" class="form-control px-3 py-3" id="name" placeholder="Your name...">
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label fw-bold text-lteal">Email</label>
                                    <input type="email" class="form-control px-3 py-3" placeholder="Your email..." aria-label="email">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold text-lteal">Phone</label>
                                <input type="phone" class="form-control px-3 py-3" id="phone" placeholder="Your phone...">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold text-lteal">Address</label>
                                <input type="text" class="form-control px-3 py-3" id="address" placeholder="Your address...">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label fw-bold text-lteal">Subject</label>
                                <input type="text" class="form-control px-3 py-3" id="subject" placeholder="Your subject...">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label fw-bold text-lteal">Message</label>
                                <textarea class="form-control px-3 py-3 rounded-4" name="message" id="message" cols="30" rows="5"></textarea>
                            </div>

                            <div class="mt-5">
                                <button class="btn btn-black px-5 py-3"><i class="bi bi-send me-2"></i>Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

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
