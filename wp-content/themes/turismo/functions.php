<?php
function custom_rewrite_rules() {
    add_rewrite_rule(
        '^servicos/page/([0-9]{1,})/?$', 
        'index.php?post_type=servicos&paged=$matches[1]', 
        'top'
    );
}
add_action('init', 'custom_rewrite_rules');

function enable_wpforms_css() {
    wp_enqueue_style('wpforms-css', plugins_url('wpforms/assets/css/wpforms.css'), array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'enable_wpforms_css');