<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
// requeried comments
wp_enqueue_script( 'comment-reply' );

// load header.php
get_header();

// load one of layout pages (layouts/*.php) based on settings
get_constructor_layout('single');

// load footer.php
get_footer();
?>