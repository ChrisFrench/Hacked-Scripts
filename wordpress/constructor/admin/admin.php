<?php
/**
 * Start admin customization
 *
 * @package WordPress
 * @subpackage Constructor
 */
// only for administrator
if (CONSTRUCTOR_DEBUG || isset($_REQUEST['debug'])) {
    require_once CONSTRUCTOR_DIRECTORY .'/libs/debug.php';
}

// PHP4 compatibility
if (version_compare(phpversion(), '5.0.0', '<')) {
    require_once CONSTRUCTOR_DIRECTORY .'/admin/compatibility.php';
}

// init modules for admin pages
// you can disable any
$constructor_modules = array(
    __('Themes',  'constructor') => 'themes',
    __('Layout',  'constructor') => 'layout',
    __('Sidebar', 'constructor') => 'sidebar',
    __('Header',  'constructor') => 'header',
    __('Content', 'constructor') => 'content',
    __('Comments','constructor') => 'comments',
    __('Footer',  'constructor') => 'footer',
    __('Fonts',   'constructor') => 'fonts',
    __('Colors',  'constructor') => 'colors',
    __('Design',  'constructor') => 'design',
    __('CSS',     'constructor') => 'css',
    __('Images',  'constructor') => 'images',
    __('Slideshow', 'constructor') => 'slideshow',
    __('Save',    'constructor') => 'save',
    __('Help',    'constructor') => 'help'
);

require_once CONSTRUCTOR_DIRECTORY .'/libs/Constructor/Admin.php';

$admin = new Constructor_Admin();
$admin -> init($constructor_modules);
 
