<?php
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
);

$recent_posts = get_posts( $args );

if ( $recent_posts ) :
    $post_delay = 200;
    foreach ( $recent_posts as $post ) :
        setup_postdata( $post );
        ?>
        <li class="list-group-item bg-transparent mb-5 mb-md-4 border-0"
            data-aos="fade-up"
            data-aos-duration="2000"
            data-aos-delay="<?php echo esc_attr( $post_delay ); ?>"
        >
            <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="text-decoration-none">
                <div class="d-flex flex-column flex-md-row justify-content-md-start align-items-center gap-4">
                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID() ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="rounded-4 object-fit-cover">
                    <div>
                        <h6 class="lead museo text-white fw-bold text-center text-md-start">
                            <?php echo esc_html( get_the_title() ); ?>
                        </h6>
                        <div class="flex text-center text-md-start mt-3 justify-content-center justify-content-md-between">
                            <?php echo do_shortcode( '[post_categories]' ); ?>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <?php
        $post_delay += 200;
    endforeach;
    wp_reset_postdata();
else :
    esc_html_e( 'No recent post<br>display', 'herbanext' );
endif;
?>
