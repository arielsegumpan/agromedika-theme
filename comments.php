<?php
/**
 * Post Comments
 * @package herbanext
 */

if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area mt-5 pt-3 pt-md-5">
    <?php
    if (have_comments()) :
        $comments_number = get_comments_number();
        ?>
        <h2 class="comments-title fw-bold museo mb-5">
            <?php
            if ('1' === $comments_number) {
                printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'herbanext'), get_the_title());
            } else {
                printf(
                    _nx(
                        '%1$s Reply to &ldquo;%2$s&rdquo;',
                        '%1$s Replies to &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'herbanext'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h2>

        <ol class="comment-list list-unstyled mb-5">
            <?php
            wp_list_comments(
                array(
                    'avatar_size' => 64,
                    'style' => 'ol',
                    'short_ping' => true,
                    'reply_text' => 'Reply',
                    'max-depth' => 5,
                    'format' => 'html5',
                    'type' => 'comment',
                )
            );
            ?>
        </ol>

        <?php
        the_comments_pagination(
            array(
                'prev_text' => '<span class="screen-reader-text">' . __('Previous', 'herbanext') . '</span>',
                'next_text' => '<span class="screen-reader-text">' . __('Next', 'herbanext') . '</span>',
            )
        );

    endif; // Check for have_comments().

    if (!comments_open()) :
        ?>
        <h4 class="no-comments font-weight-bold mt-4"><?php esc_html_e('Comments are closed.', 'herbanext'); ?></h4>
    <?php
    endif;

    $fields = array(
        'author' => '<input id="author" type="text" class="form-control px-3 py-3 mb-4" name="author" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . __('Your Name*', 'herbanext') . '" required/>',
        'email' => '<input id="email" type="text" class="form-control px-3 py-3 mb-5" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . __('Your Email*', 'herbanext') . '" required/>',
    );

    $args = array(
        'title_reply' => __('<span class="fw-bold fs-1 museo mt-5"><i class="bi bi-chat-quote me-3"></i>Share Your Thoughts</span>', 'herbanext'),
        'class_submit' => 'btn btn-success px-5 py-3 mt-4',
        'label_submit' => __('Post Comment', 'herbanext'),
        'comment_field' => '<textarea id="comment" class="form-control px-3 py-3 mb-4 mt-5" name="comment" rows="4" placeholder="' . __('Your comment...', 'herbanext') . '" required></textarea>',
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_notes_before' => '<p class="comment-notes mt-4 text-secondary">' . __('Your email address will not be published. All fields are required <span class="text-danger fw-bold">*</span>.', 'herbanext') . '</p>',
        
    );

    comment_form($args);
    ?>
</div><!-- #comments -->
