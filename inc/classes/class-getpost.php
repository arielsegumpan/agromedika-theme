<?php
/**
 * @package agromedika
 */

namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class Getpost {
    use Singleton;

    protected function __construct() {
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        $shortcodes = array(
            'agromedika_career_posts'        => 'careers',
            'agromedika_training_seminar_posts' => 'trainingseminars',
            'agromedika_publications_posts'   => 'publications',
            'agromedika_medicinal_herbs_posts'   => 'medicinal_herbs',
        );
        foreach ($shortcodes as $shortcode => $post_type) {
            add_shortcode($shortcode, function () use ($post_type) {
                return $this->get_recent_posts($post_type);
            });
        }
    }

    // Create shortcode getting recent products displaying on the front page
    private function get_recent_posts($post_type) {
        global $wp_query;

        // Store the main query object in a temporary variable
        $temp_query = $wp_query;

        $args = array(
            'post_type'      => sanitize_key($post_type),
            'post_status'    => 'publish',
            'paged'          => get_query_var('paged') ? get_query_var('paged') : 10, // Use the current page number
        );

        // Create a new query for the specified custom post type
        $post_query = new \WP_Query($args);
        ob_start();

        if ($post_query->have_posts()) :
            while ($post_query->have_posts()) : $post_query->the_post();
                get_template_part('template-parts/components/blog/entry', 'content');
            endwhile;
        else :
            get_template_part('template-parts/content/content', 'empty');
        endif;

        if (get_next_posts_link() || get_previous_posts_link()) :
            ?>
            <div class="row">
                <div class="container text-center">
                    <nav aria-label="Page navigation" class="mt-5 pt-4">
                        <ul class="pagination d-flex flex-row gap-3 justify-content-center list-unstyled">
                            <?php if (get_previous_posts_link()) : ?>
                                <li class="page-item">
                                    <span class="btn btn-success px-4 py-3">
                                        <?php previous_posts_link('<i class="bi bi-arrow-left me-3"></i>Previous', $post_query->max_num_pages); ?>
                                    </span>
                                </li>
                            <?php endif; ?>
                            <?php if (get_next_posts_link()) : ?>
                                <li class="page-item">
                                    <span class="btn btn-success px-4 py-3">
                                        <?php next_posts_link('Next<i class="bi bi-arrow-right ms-3"></i>', $post_query->max_num_pages); ?>
                                    </span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif;

        // Restore the main query from the temporary variable
        $wp_query = $temp_query;

        wp_reset_postdata();

        return ob_get_clean();
    }
}
