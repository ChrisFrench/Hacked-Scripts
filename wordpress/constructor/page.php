<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
wp_enqueue_script( 'comment-reply' );

// load header.php
get_header();

// load one of layout pages (layouts/*.php) based on settings
get_constructor_layout('page');

// load footer.php
get_footer();