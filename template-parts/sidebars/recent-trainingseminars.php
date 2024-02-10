<?php
/** get sidebar recent training_seminars
 * @package herbanext
 */
?>
<?php
$args = array(
    'post_type' => 'trainingseminars',
    'post_status' => 'publish',
    'posts_per_page' => 5,
);
$recent_training_seminars = new WP_Query($args);
if ($recent_training_seminars->have_posts()) :
    $count = 0;
    while ($recent_training_seminars->have_posts()) :
        $recent_training_seminars->the_post();
        $count++;
        $training_seminars_link = esc_url(get_permalink());
        $training_seminars_thumbnail = esc_url(get_the_post_thumbnail_url());
        $training_seminars_alt = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
        $training_seminars_title = esc_html(get_the_title());
        ?>
        <li class="list-group-item bg-transparent mb-4 pt-0 px-0 pb-4">
            <a href="<?php echo $training_seminars_link; ?>" class="text-decoration-none text-success">
                <div class="d-flex flex-row align-items-center gap-3">
                    <div class="position-relative">
                        <span class="bg-success position-absolute z-1 text-white">
                            <?php echo $count < 10 ? '0' . $count : $count; ?>
                        </span>
                        <img src="<?php echo $training_seminars_thumbnail; ?>" alt="<?php echo $training_seminars_alt; ?>" class="rounded-4 object-fit-cover">
                    </div>
                    <div>
                        <h6 class="lora fw-bold text-start">
                            <?php echo $training_seminars_title; ?>
                        </h6>
                    </div>
                </div>
            </a>
        </li>
    <?php endwhile;
    wp_reset_postdata();
else : ?>
    <p><?php esc_html_e('No recent post about training and seminars found.'); ?></p>
<?php endif; ?>
