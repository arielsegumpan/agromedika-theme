<?php
/**
 * Footer template
 * @package agromedika
 */

$option_fields = array(
    'page_footer_about',
    'page_footer_address_and_contact',
    'page_footer_soc_med',
    'privacy_policy_and_terms_conditions',
    'page_footer_google_map',
);

$option_values = array();

foreach ($option_fields as $field) {
    $option_values[$field] = get_acf_option_field($field);
}

$page_footer_about = $option_values['page_footer_about'];
$page_footer_address_and_contact = $option_values['page_footer_address_and_contact'];
$page_footer_contacts = $page_footer_address_and_contact['page_footer_contact'];
$page_footer_soc_med = $option_values['page_footer_soc_med'];
$privacy_policy_and_terms_conditions = $option_values['privacy_policy_and_terms_conditions'];
$page_footer_google_map = $option_values['page_footer_google_map'];

?>

<footer class="bg-primary">
    <div class="container">
        <div class="row">
            <?php if (!empty($page_footer_about['page_about_logo_icon']['url']) && !empty($page_footer_about['page_about_content'])) : ?>
                <div class="col-12 col-lg-3">
                    <div class="footer-logo">
                        <a href="<?php echo esc_url($page_footer_about['page_about_page_link']); ?>" class="text-decoration-none">
                            <img src="<?php echo esc_url($page_footer_about['page_about_logo_icon']['url']); ?>" alt="<?php echo esc_html($page_footer_about['page_about_logo_icon']['alt']); ?>">
                        </a>
                        <p class="text-lteal mt-4">
                            <?php echo nl2br(esc_textarea($page_footer_about['page_about_content'])); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
                <h6 class="fw-bold text-uppercase text-lteal ps-lg-5"><?php echo esc_html('Applications') ?></h6>
                <?php get_template_part('template-parts/footer/nav'); ?>
            </div>

            <?php if (!empty($page_footer_address_and_contact['page_footer_address'])) : ?>
                <div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
                    <h6 class="fw-bold text-uppercase text-lteal"><?php echo esc_html_e('Address') ?></h6>
                    <div class="d-flex mb-3 mt-4">
                        <div class="flex-shrink-0">
                            <i class="bi bi-geo-alt text-lteal fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 text-lteal">
                            <p><?php echo esc_html($page_footer_address_and_contact['page_footer_address']); ?></p>
                        </div>
                    </div>

                    <?php if (!empty($page_footer_contacts)) : ?>
                        <?php foreach ($page_footer_contacts as $page_footer_contact) : ?>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-telephone text-lteal fs-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3 text-lteal">
                                <p><?php echo esc_html($page_footer_contact['contact_number']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($page_footer_address_and_contact['page_footer_email'])) : ?>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-envelope text-lteal fs-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3 text-lteal">
                                <a class="text-lteal" href="mailto:<?php echo esc_html($page_footer_address_and_contact['page_footer_email']); ?>"><?php echo esc_html($page_footer_address_and_contact['page_footer_email']); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <?php if (!empty($page_footer_google_map)) : ?>
                <div class="col-12 col-lg-3 text-center text-lg-start mt-5 mt-lg-0">
                    <?php echo wp_kses_decode_entities($page_footer_google_map); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row pb-2">
            <div class="d-flex flex-column flex-lg-row justify-content-start justify-content-lg-between align-items-lg-center">
                <?php if (!empty($privacy_policy_and_terms_conditions['privacy_policy_page_link']) && !empty($privacy_policy_and_terms_conditions['terms_and_conditions_page_link'])) : ?>
                    <p><span class="small text-lteal">Copyright © 2024 All rights reserved.</span>&nbsp; <a target="_blank" href="<?php echo esc_url($privacy_policy_and_terms_conditions['privacy_policy_page_link']); ?>" class="text-lteal small"><?php echo esc_html_e('Privacy Policy') ?></a> &nbsp;<a target="_blank" href="<?php echo esc_url($privacy_policy_and_terms_conditions['terms_and_conditions_page_link']) ?>" class="text-lteal small"><?php echo esc_html_e('Terms and Conditions'); ?></a></p>
                <?php endif; ?>
                <div class="d-flex flex-row gap-4 justify-content-start">
                    <?php if (!empty($page_footer_soc_med['footer_soc_med'])) : foreach ($page_footer_soc_med['footer_soc_med'] as $page_footer_socmed) : ?>
                            <a target="_blank" href="<?php echo esc_url($page_footer_socmed['footer_soc_med_link']); ?>" class="text-decoration-none text-lteal fs-5"><?php echo wp_kses_decode_entities($page_footer_socmed['footer_soc_med_icons']) ?></a>
                    <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
