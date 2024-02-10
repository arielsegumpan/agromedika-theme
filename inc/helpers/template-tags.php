<?php
function get_the_post_custom_thumbnail($post_id, $size = 'featured-image', $add_attrs = []){

    $cust_thumbnail = '';

    null === $post_id ? $post_id = get_the_ID() : '';


    if(has_post_thumbnail($post_id)){
        $daf_attr = [
            'loading' => 'lazy'
        ];
    }

    $attr = array_merge($add_attrs, $def_attr);

    $cust_thumbnail = wp_get_attachment_image(
        get_post_thumbnail_id( $post_id ),
        $size,
        false,
        $add_attrs
    );


    return $cust_thumbnail;
}

function the_post_custom_image($post_id, $size = 'featured-image', $add_attrs = []){
    echo get_the_post_thumbnail( $post_id, $size, $add_attrs);  
}