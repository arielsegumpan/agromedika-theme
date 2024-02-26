<?php
/**
 * Template Name: Ingredients
 * @package agromedika
 */
get_header();

$ingredients_jumbotron = get_acf_field('ingredients_jumbotron');
$ingredients_form_content = get_acf_field('ingredients_form_content');
?>

<main>
    <?php if(isset($ingredients_jumbotron['ingredients_jumbotron_heading'])) :?>
    <section id="no-jumbotron" class="bg-lteal">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-auto text-center">
              <h1 class="fw-bold text-black"><?php echo esc_html( $ingredients_jumbotron['ingredients_jumbotron_heading'] ) ;?></h1>
              <h5 class="text-black mt-4"><?php echo html_entity_decode($ingredients_jumbotron['ingredients_jumbotron_sub_heading']) ;?></h5>
            </div>
          </div>
        </div>
    </section>
    <?php endif;?>

    <section id="custom-content" class="bg-lteal">
      <div class="container">
          <div class="row">
            <div class="col-12">
            <?php if(have_posts( ) && !empty(get_the_content())) : while(have_posts(  )) : the_post() ; ?>
              <div class="lh-lg">
                <?php the_content() ?>
              </div>
            <?php endwhile; else:?>
              <div class="text-center w-100">
                <h4 class="text-black mb-4"><?php  echo esc_html__('No post content', 'agromedika');?></h4>
                <a href="<?php echo esc_url(site_url('/')) ?>" class="btn btn-primary px-4 py-3 rounded-4 text-lteal"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html__( 'Back to Home', 'agromedika') ?></a>
              </div>
            <?php endif;?>
            </div>
          </div> 
      </div>
    </section>
    
    <section id="inq" class="bg-lteal">
      <div class="container">
          <div class="row">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto position-relative">


              <div class="card rounded-5 border-0 p-3 p-lg-5">
                  <div class="col-12 col-md-9 mx-auto mt-5 text-center">
                      <div class="mb-3">
                          <i class="bi bi-send-fill fs-1 text-primary"></i>
                      </div>
                      <h2 class="fw-bold text-center">
                          Contact Us for Your Ingredient Development Needs
                      </h2>
                  </div>
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
                          <label for="floatingTextarea">Message<span class="text-danger">*</span></label>
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
          </div>
      </div>
    </section>


</main>

<?php get_footer(); ?>
