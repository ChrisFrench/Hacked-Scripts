<?php
/**
 * @package WordPress
 * @subpackage constructor
 */

// load header.php
get_header();

// load one of layout pages (layouts/*.php) based on settings
get_constructor_layout('date');

// load footer.php
get_footer();
?>