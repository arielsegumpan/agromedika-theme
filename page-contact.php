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

    <?php if(!empty($contact_jumbotron['contact_hero_title']) && !empty($contact_jumbotron['contact_hero_image']['url'])) : ?>
    <section id="contact" class="bg-lteal">
        <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8 mx-auto position-relative">
                <div class="card rounded-5 border-0 p-3 p-lg-5 mt-5 position-absolute">
                  <div class="px-3 py-5 p-lg-5">
                    <form action="#!">
                      <div class="row mb-md-4">
                        <div class="col-12 col-md-6">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Name*">
                            <label for="name">Name <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="form-floating mb-3">
                            <input type="phone" class="form-control" id="phone" placeholder="Phone*">
                            <label for="phone">Phone<span class="text-danger">*</span></label>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-md-4">
                        <div class="col-12 col-md-6">
                          <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="youremail@gmail.com">
                            <label for="email">Email Address<span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="form-floating mb-3">
                            <input type="phone" class="form-control" id="phone" placeholder="Phone*">
                            <label for="phone">Phone Number<span class="text-danger">*</span></label>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-md-4">
                        <div class="col-12">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="subject" placeholder="Subject*">
                            <label for="subject">Subject <span class="text-danger">*</span></label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Comments<span class="text-danger">*</span></label>
                          </div>
                        </div>
                      </div>
                      <div class="mt-5 mx-auto text-center">
                        <button class="btn btn-black px-5 py-3"><i class="bi bi-send me-2"></i>Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div id="col" class="col-12 col-lg-7 mx-auto text-center mt-5">
                <span><i class="bi bi-geo-alt fs-1 text-primary"></i></span>
                <div class="mt-4">
                  <p class="lh-lg text-secondary mb-3"><?php echo esc_html($contact_content['contact_address']); ?></p>
                  <p><a class="text-secondary" href="mailto:<?php echo esc_attr($contact_content['contact_page_email']); ?>"><?php echo esc_html($contact_content['contact_page_email']); ?></a></p>
                        <p><a href="tel:<?php echo esc_attr($contact_content['contact_page_phone']); ?>" class="text-secondary"><?php echo esc_html($contact_content['contact_page_phone']); ?></a></p>
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
