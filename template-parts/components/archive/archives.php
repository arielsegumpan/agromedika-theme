<select class="form-select py-2 mt-4 mb-4" aria-label="Select category" onchange='document.location.href=this.options[this.selectedIndex].value;'>
    <option selected disabled>Select</option>
    <?php
    // Get the list of monthly archives
    $archives = wp_get_archives(array(
        'type'            => 'monthly',
        'format'          => 'html',
        'show_post_count' => true,
        'echo'            => false, 
    ));

    $doc = new DOMDocument();
    $doc->loadHTML($archives);
    $options = $doc->getElementsByTagName('a');

    foreach ($options as $option) {
        $text = $option->nodeValue;
        $url = $option->getAttribute('href');
        echo '<option value="' . esc_url($url) . '">' . esc_html($text) . '</option>';
    }
    ?>
</select>
