<?php
/**
 * @package herbanext
 */
$get_career_form = get_acf_field('career_field');
?>
<div class="card border-0">
    <?php if (!empty($get_career_form)) : ?>
    <div class="blog_title mb-5 d-flex flex-column flex-md-row justify-content-center justify-content-md-between">
        <div class="text-secondary">
            <i class="bi bi-briefcase me-2"></i><?php echo esc_html_e($get_career_form['postion']) ?>
        </div>

        <?php if(isset($get_career_form['file_upload']) && !empty($get_career_form['file_upload']['url'])) :?>  
        <div>
            <a href="<?php echo esc_url($get_career_form['file_upload']['url']) ?>" class="btn btn-success btn-sm rounded-3 px-3 "><i class="bi bi-download me-2"></i><?php echo esc_html_e('Download') ?></a>
        </div>
        <?php endif?>
    </div>
    <?php endif?>
    <div class="blog_feature_img mb-5">
        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())) ?>" alt="<?php echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) ?>" class="img-fluid">
    </div>
    <div class="blog_content text-secondary">
        <p class="lh-lg"><?php the_content() ?></p>
    </div>
    <?php if($get_career_form):?>
        <div class="mt-5">
            <?php echo _e($get_career_form['contact_form'])?>
        </div>
    <?php endif?>
</div>
