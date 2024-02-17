<?php
/**
 * Register Shortcodes.
 * @package agromedika
 */
namespace AGROMEDIKA_THEME\Inc;
 use AGROMEDIKA_THEME\Inc\Traits\Singleton;


 class Shortcodes{
    use Singleton;

    private function __construct() {
        // Add your shortcode hooks here
        $this->setup_hooks();
    }

    protected function setup_hooks(){
        add_shortcode('social_share_buttons', array($this, 'social_share_buttons_shortcode'));
        add_shortcode('get_recent_front_page_post', array($this, 'get_recent_front_page_posts'));
    }

    public function social_share_buttons_shortcode($atts) {
        // Extract attributes (if any), although we're not using any attributes in this example
        extract(shortcode_atts(array(), $atts));

        // Get post information
        $title = get_the_title();
        $url = get_permalink();
        $media = get_the_post_thumbnail_url(get_the_ID());

        // Sanitize the dynamic data
        $title = esc_attr($title);
        $url = esc_url($url);
        $media = esc_url($media);

        // Build the HTML for social share buttons
        $output = '
            <h6 class="fw-bold text-success ps-0"><i class="bi bi-share me-2"></i>Share this post</h6>
            <ul class="d-flex flex-row mt-2 gap-3 list-unstyled">
                <li>
                    <a class="share-twitter" href="https://twitter.com/intent/tweet?text=' . $title . '&amp;url=' . $url . '&amp;via=hoptravelph" target="_blank">
                        <i class="bi bi-twitter text-success fs-3"></i>
                    </a>
                </li>
                <li>
                    <a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank">
                        <i class="bi bi-facebook text-success fs-3"></i>
                    </a>
                </li>
                <li>
                    <a class="share-pinterest" href="http://pinterest.com/pin/create/button/?url=' . $url . '&amp;media=' . $media . '&amp;description=' . $title . '" target="_blank">
                        <i class="bi bi-pinterest text-success fs-3"></i>
                    </a>
                </li>
                <li class="d-flex flex-row">
                    <a class="share-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&amp;description=' . $title . '" target="_blank">
                        <i class="bi bi-linkedin text-success fs-3"></i>
                    </a>
                </li>
            </ul>
            <hr class="my-5">
        ';

        return $output;
    }

    // function get_recent_front_page_posts(){
    //     ob_start();
    //     get_template_part('template-parts/components/blog/recent','post');
    //     return ob_get_clean();
    // }
 }