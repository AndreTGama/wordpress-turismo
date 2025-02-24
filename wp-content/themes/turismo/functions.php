<?php

function wordpress_pagination($object)
{
    echo paginate_links(array(
        'format'  => 'page/%#%',
        'current' => max(1, get_query_var('paged')),
        'total'   => $object->max_num_pages,
        'prev_text' => '← Anterior',
        'next_text' => 'Próximo →',
        'offset' => '-1',
    ));
}

function get_first_image($post_id, $default = '') {
    $images = get_field('pictures', $post_id);

    if (!empty($images) && is_array($images)) {
        $first_image = reset($images);
        if (!empty($first_image['url'])) {
            return esc_url($first_image['url']);
        }
    }

    return esc_url($default);
}

