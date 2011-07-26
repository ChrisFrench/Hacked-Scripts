<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title('&raquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>"/>
    <link rel="stylesheet" type="text/css" media="print" href="<?php echo CONSTRUCTOR_DIRECTORY_URI; ?>/print.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="<?php echo CONSTRUCTOR_DIRECTORY_URI; ?>/style-480.css" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_get_archives('type=monthly&format=link'); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
<div id="body">
   <div id="wrapheader" class="wrapper">
       <div id="header">
            <?php get_constructor_menu() ?>
            <div id="title">
				<?php if (is_home() || is_front_page()) { ?>
					<h1 id="name"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); echo " &raquo; "; bloginfo('description');?>"><?php bloginfo('name'); ?></a></h1>
				<?php } else { ?>	
					<div id="name"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); echo " &raquo; "; bloginfo('description');?>"><?php bloginfo('name'); ?></a></div>
				<?php } ?>
                <div id="description"><?php bloginfo('description');?></div>
            </div>
       </div>
   </div>
   
   <div id="wrapcontent" class="wrapper">
       <?php get_constructor_slideshow() ?>