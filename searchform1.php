<?php
$aria_label = !empty($args['label']) ? 'aria-label="' . esc_attr($args['label']) . '"' : '';
$search_query = esc_attr(get_search_query());
?>
<form role="search" <?php echo $aria_label; ?> method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="d-flex flex-row align-items-center">
        <label class="btn btn-primary disabled opacity-100 me-2" for="searchright"><i class="bi bi-search text-white"></i></label>
        <input class="search-1 form-control border border-primary" type="search" name="s" value="<?php echo $search_query; ?>" placeholder="Search" required>
        <input type="hidden" name="post_type[]" value="career"> <!-- Include career posts -->
        <input type="hidden" name="post_type[]" value="post"> <!-- Include blog posts -->
        <input type="hidden" name="post_type[]" value="herb"> <!-- Include herbal custom post type -->
    </div> 
</form>