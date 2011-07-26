<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
function constructor_admin_donate() {
    // set donate flag to false
    $constructor_admin = get_option('constructor_admin');
    $constructor_admin['donate'] = false;
    update_option('constructor_admin', $constructor_admin);
    
    die();
}

add_action('wp_ajax_constructor_admin_donate', 'constructor_admin_donate');
?>