<?php
$aria_label = !empty($args['label']) ? 'aria-label="' . esc_attr($args['label']) . '"' : '';
$search_query = esc_attr(get_search_query());
?>
<form role="search" <?php echo $aria_label; ?> method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="hidden" name="post_type" value="any">
        <input type="search" class="form-control px-3 py-2" name="s" value="<?php echo $search_query; ?>" placeholder="Search here" required />
</form>
