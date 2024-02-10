<?php
/** get sidebar recent career
 * @package herbanext
 */
?>
<?php
$args = array(
    'post_type' => 'careers',
    'post_status' => 'publish',
    'posts_per_page' => 5,
);
$recent_careers = new WP_Query($args);
if ($recent_careers->have_posts()) :
    $count = 0;
    while ($recent_careers->have_posts()) :
        $recent_careers->the_post();
        $count++;
        $career_link = esc_url(get_permalink());
        $career_thumbnail = esc_url(get_the_post_thumbnail_url());
        $career_alt = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
        $career_title = esc_html(get_the_title());
        ?>

        <li class="list-group-item bg-transparent mb-4 pt-0 px-0 pb-4">
            <a href="<?php echo $career_link; ?>" class="text-decoration-none text-success">
                <div class="d-flex flex-row align-items-center gap-3">
                    <div class="position-relative">
                        <span class="bg-success position-absolute z-1 text-white">
                            <?php echo $count < 10 ? '0' . $count : $count; ?>
                        </span>
                        <img src="<?php echo $career_thumbnail; ?>" alt="<?php echo $career_alt; ?>" class="rounded-4 object-fit-cover">
                    </div>
                    <div>
                        <h6 class="lora fw-bold text-start">
                            <?php echo $career_title; ?>
                        </h6>
                    </div>
                </div>
            </a>
        </li>
    <?php endwhile;
    wp_reset_postdata();
else : ?>
    <p><?php esc_html_e('No recent post about careers found.') ?></p>
<?php endif; ?>
