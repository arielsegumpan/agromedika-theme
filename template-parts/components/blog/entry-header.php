<?php
/**
 * Template for post entry header
 * @package agromedika
 */
 ?>
<?php
if($has_post_ft_image)?>
<div class="card-header border-0 p-0">
    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>" alt="<?php esc_attr( the_title() )?>" class="img-fluid">
</div>
<?php endif ?>