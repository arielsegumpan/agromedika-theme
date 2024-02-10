<?php
/**
 * Footer template
 * @package herbanext
 */
$global_setup = get_acf_option_field('global_settings_setup');
if (is_array($global_setup) && isset($global_setup['global_contact_number'])) :
    $contact_number = strip_tags($global_setup['global_contact_number']);
    substr($contact_number, 0, 1) === '0' ? $contact_number = '+63' . substr($contact_number, 1) : '';
endif?>
    <footer class="bg-success w-100">
        <div class="container">
            <!-- main footer -->
            <div class="row">
                <?php if(!empty($global_setup['subscribe_form']['content_form'])): ?>
                <div class="col-12 col-md-6 mb-5 mb-md-0">
                    <h4 class="fw-bold avenir text-white pe-md-5 mb-4 text-center text-md-start"><?php echo esc_html_e($global_setup['subscribe_form']['title']) ?></h5>
                    <?php echo wp_kses_decode_entities( $global_setup['subscribe_form']['content_form'] ) ?>
                </div>
                <?php endif ?>
                <?php if(has_nav_menu('herbanext-footer-menu')):?>
                <div class="col-12 col-md-3 mb-5 mb-md-0">
                    <h4 class="fw-bold avenir text-white pe-md-5 mb-4 text-center"><?php echo esc_html_e('Quicklinks') ?></h5>
                   <?php get_template_part('template-parts/footer/nav');?>
                </div>
                <?php endif?>
                <div class="col-12 col-md-3 text-center text-md-start">
                    <div class="d-flex flex-column gap-5">
                        <?php if(!empty($contact_number)):?>
                        <div class="col text-center text-md-start">
                            <h4 class="avenir fw-bold text-white mb-3"><?php echo esc_html_e('Call') ?></h4>
                            <div class="d-flex flex-row justify-content-center justify-content-md-start">
                                <i class="bi bi-telephone-outbound text-black fs-5 me-3"></i>
                                <a href="tel:<?php echo esc_attr($contact_number); ?>" class="text-decoration-none text-black fw-bold"><?php echo esc_html($contact_number); ?></a>
                            </div>
                        </div>
                        <?php endif?>
                        <?php if(!empty($global_setup['global_email_address'])):?>
                        <div class="col">
                            <h4 class="avenir fw-bold text-white mb-3"><?php echo esc_html_e('Email') ?></h4>
                            <div class="d-flex flex-wrap flex-row align-items-center justify-content-center justify-content-md-start">
                                <i class="bi bi-link-45deg text-black fs-3 me-2"></i>
                                <a href="mailto:<?php echo esc_attr($global_setup['global_email_address'])?>" class="text-decoration-none text-black fw-bold"><?php echo esc_html_e($global_setup['global_email_address'])?></a>
                            </div>
                        </div>
                        <?php endif?>
                        <?php if(!empty($global_setup['socmed_link'])):?>
                        <div class="col">
                            <h4 class="avenir fw-bold text-white mb-3"><?php echo esc_html_e('Follow us') ?></h4>
                            <a href="<?php echo esc_url($global_setup['socmed_link']) ?>" class="text-decoration-none" target="_blank">
                                <?php echo wp_kses_post($global_setup['socmed_icon']) ?>
                            </a>
                        </div>
                        <?php endif?>
                    </div>
                </div>
            </div>
            <!-- bottom footer -->
            <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center gap-4 pb-4">
                <?php if(!empty($global_setup['global_copyright'])) :?>
                    <p class="fw-bold text-black"><?php echo esc_html_e($global_setup['global_copyright']) ?></p>
                <?php endif?>
                <?php if(!empty($global_setup['footer_logo']['url'])) :?>
                <a href="<?php echo esc_url(site_url('/')) ?>" class="text-decoration-none">
                    <img src="<?php echo esc_url( $global_setup['footer_logo']['url'] ) ?>" alt="<?php echo esc_attr( $global_setup['footer_logo']['alt'] ) ?>" style="width:100%;height:50px!important;">
                </a>
                <?php endif?>
                <?php if(!empty($global_setup['global_terms_and_conditions']) || !empty($global_setup['global_privacy_policy'])) :?>
                <div class="d-flex flex-column flex-md-row gap-3 text-center text-lg-start">
                    <a href="<?php echo esc_url($global_setup['global_terms_and_conditions']) ?>" class=" fw-bold text-black"><?php echo esc_html_e('Terms and Conditions') ?></a>
                    <a href="<?php echo esc_url($global_setup['global_privacy_policy']) ?>" class=" fw-bold text-black"><?php echo esc_html_e('Privacy Policy') ?></a>
                </div>
                <?php endif?>
            </div>
        </div>
    </footer>
    <?php wp_footer() ;?>
  </body>
</html>