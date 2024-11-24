<?php
function custom_rewrite_rules() {
    add_rewrite_rule(
        '^servicos/page/([0-9]{1,})/?$', 
        'index.php?post_type=servicos&paged=$matches[1]', 
        'top'
    );
}
add_action('init', 'custom_rewrite_rules');