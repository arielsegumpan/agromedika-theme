<select name="archive-dropdown" class="form-control px-3 py-2" id="exampleFormControlSelect1" onChange='document.location.href=this.options[this.selectedIndex].value;'>
    <option disabled selected value=""><?php echo esc_attr(__('Select')); ?></option>
    <?php
    $custom_post_types = array('post', 'careers', 'publications', 'trainingseminars', 'medicinal_herbs');
    foreach ($custom_post_types as $post_type) {
        $post_type_object = get_post_type_object($post_type);
        $post_count = wp_count_posts($post_type)->publish;
        $label = ($post_type === 'post') ? 'News' : $post_type_object->labels->name;
        $label_with_count = sprintf('%s (%d)', esc_html($label), $post_count);
        echo "<option value='" . esc_attr(get_post_type_archive_link($post_type)) . "'>" . esc_html($label_with_count) . "</option>";
    }
    ?>
</select>
