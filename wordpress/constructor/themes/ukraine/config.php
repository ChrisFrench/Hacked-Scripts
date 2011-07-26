<?php
/**
 * Don't change this is file
 */
return array(
            "sidebar"   => 'right',
            'layout'    =>  array(           // layouts styles
            			'header'  => 140,    // header height
                        'width'   => 1024,   // container width
                        'sidebar' => 240,    // sidebar width
                        'extra'   => 240,    // extrabar  width
                        'home'    => 'default',
                        'archive' => 'default',
                        'search'  => 'default',
                        'index'   => 'default',
                                 ),
            "title"     => array(
                        "pos" => 'center bottom'
                    ),
            "content"   => array(            // content
                        "author" => 0,       // - link to author page                        
                        ),
            "footer"    => array(            // footer text
                        "text" => null
                    ),
            "fonts"     => array(
                        'title' => array('family' => 'Arial,Helvetica,sans-serif', 
                                         'size'   => 64,
                                         'weight' => 800,
                                         'color'  => '#333',
                                         'transform' => 'uppercase',
                                         
                                         ),       
                        'description' => array('family' => 'Arial,Helvetica,sans-serif', 
                                         'size'   => 14,
                                         'weight' => 600,
                                         'color'  => '#777',
                                         'transform' => 'uppercase'                                         
                                         ),
                        'header'      => array('family' => 'Arial,Helvetica,sans-serif'),
                        'content'     => array('family' => 'Arial,Helvetica,sans-serif'),
                    ),
            "menu"     => array(             // menu with links
                        "flag" => 1,         // - enable/disable
                        "home" => true,     // - link to home page
                        "rss"  => true,     // - link to RSS
                        "search" => false,    // - search form
                        "pages"      => array('depth'=>2),
                        "categories" => array('depth'=>0, 'group'=>1)
                        ),
            "slideshow" => array(            // Slideshow options
                        "flag" => 1,         // - enable/disable
                        "layout" => 'in',
                        "showposts" => 10,   // - show last N slides
                        "metakey" => 'thumb-slideshow', // - custom field name
                        "id" => null,
                        "height" => 200,
                        "onpage" => false,    // show slideshow on page
                        "onsingle" => false   // show slideshow on single post
                    ),
            "images"   => array(
                        "body" => array('src'=>'themes/ukraine/body.png', 'pos'=>'left top', 'repeat'=>'repeat-y', 'fixed'=>true),
                        "wrap" => array('src'=>'','pos'=>'center top', 'repeat'=>'no-repeat', 'fixed'=>false),
                        "wrapper"  => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        "sidebar"  => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        "extrabar" => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        "footer"   => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                    ),
            "opacity"   => 'lighthigh',
            "shadow"    => true,             // create shadow
            "color"   => array(
                        "bg"      => '#fff',
                        "bg2"     => '#fff5c5',
                        "opacity" => '#fff',
                        "title"   => '#333',
                        "title2"  => '#e60000',
                        "text"    => '#333',
                        "text2"   => '#aaa',
                        "border"  => '#aaa',
                        "border2" => '#999',

					    'header1' => '#ff0000',
					    'header2' => '#ff1212',
					    'header3' => '#ff3333',
                    ),
            );