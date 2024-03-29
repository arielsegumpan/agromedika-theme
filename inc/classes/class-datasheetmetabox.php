<?php
/**
 * Register agromedika Custom Post Type.
 * @package agromedika
 */
namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class DataSheetMetabox {
    use Singleton;

    private $screens = array('herb');

    private $fields = array(
        array(
            'label' => 'Product Data Sheet',
            'id' => 'product_data_sheet',
            'type' => 'product_data_sheet_field',
        ),
        array(
            'label' => 'Technical Data Sheet',
            'id' => 'technical_data_sheet',
            'type' => 'technical_data_sheet_field',
        ),
        array(
            'label' => 'Safety Data Sheet',
            'id' => 'safety_data_sheet',
            'type' => 'safety_data_sheet_field',
        )
    );

    protected function __construct() {
        // Add metabox only when WordPress is ready
        add_action('init', array($this, 'init'));
    }

    public function init() {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_fields'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_media_uploader'));
    }

    public function add_meta_boxes() {
        foreach ($this->screens as $s) {
            add_meta_box(
                'ProductDataSheet',
                __('Data Sheets', 'agromedika'),
                array($this, 'meta_box_callback'),
                $s,
                'advanced',
                'high'
            );
        }
    }

    public function meta_box_callback($post) {
        wp_nonce_field('ProductDataSheet_data', 'ProductDataSheet_nonce');
        $this->field_generator($post);
    }


    public function field_generator($post) {
        foreach ($this->fields as $field) {
            $label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
            $meta_value = get_post_meta($post->ID, $field['id'], true);
            $button_label = empty($meta_value) ? 'Select File' : 'Change File';
    
            printf(
                '<p>%s</p><button type="button" class="button button-secondary upload-file">%s</button><input type="text" name="%s" id="%s" class="file-url" value="%s" readonly />',
                $label,
                $button_label,
                $field['id'],
                $field['id'],
                $meta_value
            );
        }
    }
    


    public function enqueue_media_uploader() {
        global $pagenow, $typenow;
    
        if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && in_array($typenow, $this->screens)) {
            wp_enqueue_media();
            wp_enqueue_script('custom-upload', get_template_directory_uri() . '/assets/js/upload.js', array('jquery', 'media-upload', 'thickbox'), null, true);
        }
    }
    




    public function save_fields($post_id) {
        if (!isset($_POST['ProductDataSheet_nonce'])) {
            return $post_id;
        }

        $nonce = $_POST['ProductDataSheet_nonce'];

        if (!wp_verify_nonce($nonce, 'ProductDataSheet_data')) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        foreach ($this->fields as $field) {
            if (isset($_POST[$field['id']])) {
                update_post_meta($post_id, $field['id'], $_POST[$field['id']]);
            }
        }
    }
}
