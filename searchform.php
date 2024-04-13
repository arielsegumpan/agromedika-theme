<?php
$aria_label = !empty($args['label']) ? 'aria-label="' . esc_attr($args['label']) . '"' : '';
$search_query = esc_attr(get_search_query());
?>
<form role="search" <?php echo $aria_label; ?> method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="hidden" name="post_type[]" value="career"> <!-- Include career posts -->
    <input type="hidden" name="post_type[]" value="post"> <!-- Include blog posts -->
    <input type="hidden" name="post_type[]" value="herb"> <!-- Include herbal custom post type -->
    <input class="search expandright" id="searchright" type="search" name="s" value="<?php echo $search_query; ?>" placeholder="Search" required>
    <label class="button searchbutton" for="searchright"><i class="bi bi-search btn btn-primary text-white"></i></label>
</form>
