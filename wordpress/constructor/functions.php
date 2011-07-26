<?php
/**
 * @package WordPress
 * @subpackage Constructor
 * 
 * Don't work preview on admin page?
 * Read issue 11006 for more details
 * 
 * @see      http://core.trac.wordpress.org/ticket/11006
 * 
 * @author   Anton Shevchuk <AntonShevchuk@gmail.com>
 * @link     http://anton.shevchuk.name
 */
// need for defence
define('CONSTRUCTOR', true);

// debug only current theme
define('CONSTRUCTOR_DEBUG', false);

define('CONSTRUCTOR_DIRECTORY',     get_template_directory());
define('CONSTRUCTOR_DIRECTORY_URI', get_template_directory_uri());

load_theme_textdomain('constructor', CONSTRUCTOR_DIRECTORY.'/lang');

// support features
if (function_exists('add_theme_support')) { // Added in 2.9
	// This theme uses post thumbnails
	add_theme_support('post-thumbnails' );
	set_post_thumbnail_size( 64, 64, true ); // Normal post thumbnail
	add_image_size('list-post-thumbnail', 128, 128, true );
	add_image_size('tile-post-thumbnail', 312, 292, true );
	add_image_size('slideshow-thumbnail');
	    
	// This theme uses wp_nav_menu()
	add_theme_support('menus');

	// Add default posts and comments RSS feed links to head
	add_theme_support('automatic-feed-links');    	
}

// sidebar registration
if ( function_exists('register_sidebar') ) {

    register_sidebar(array(
        'id'=>'header',
        'name'=>'Top Menu',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<span>',
        'after_title' => '</span>',
    )); 
    
    register_sidebar(array(
        'id'=>'content',
        'name'=>'After N Post',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'id'=>'incontent',
        'name'=>'In Posts',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));
    
    // options for all follows sidebars
    $widget_options = array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    );
    
    register_sidebar(array_merge($widget_options, array('id'=>'sidebar','name'=>'Sidebar')));
    register_sidebar(array_merge($widget_options, array('id'=>'sidebar-categories', 'name'=>'Sidebar for Categories')));
    register_sidebar(array_merge($widget_options, array('id'=>'sidebar-posts', 'name'=>'Sidebar for Posts')));
    register_sidebar(array_merge($widget_options, array('id'=>'sidebar-pages', 'name'=>'Sidebar for Pages')));
    
    register_sidebar(array_merge($widget_options, array('id'=>'extra','name'=>'Extrabar')));
    register_sidebar(array_merge($widget_options, array('id'=>'extra-categories','name'=>'Extrabar for Categories')));
    register_sidebar(array_merge($widget_options, array('id'=>'extra-posts','name'=>'Extrabar for Posts')));
    register_sidebar(array_merge($widget_options, array('id'=>'extra-pages','name'=>'Extrabar for Pages')));
    
    register_sidebar(array_merge($widget_options, array('id'=>'footer', 'name'=>'Footer'))); 
    register_sidebar(array_merge($widget_options, array('id'=>'footer-categories', 'name'=>'Footer for Categories'))); 
    register_sidebar(array_merge($widget_options, array('id'=>'footer-posts', 'name'=>'Footer for Posts'))); 
    register_sidebar(array_merge($widget_options, array('id'=>'footer-pages', 'name'=>'Footer for Pages'))); 
}

// navigation menu
if (function_exists('register_nav_menu')) {
    register_nav_menu('header', __('Header Menu','constructor'));
}

if (!is_admin()) {    
    
    /**
     * Parse request
     *
     * @param unknown_type $wp
     */
    function constructor_parse_request($wp) {
        // only process requests with "my-plugin=ajax-handler"
        if (array_key_exists('theme-constructor', $wp->query_vars)){
            switch ($wp->query_vars['theme-constructor']) {
                case 'css':
                    require_once 'css.php';
                    break;
                case 'slideshow':
                    require_once 'slideshow.php';
                    break;
            }
            // die after return data
            die();
        } elseif (array_key_exists('preview', $wp->query_vars)) {
            global $postfix;
            
        }
    }
    add_action('wp', 'constructor_parse_request');
    
    /**
     * register query vars
     *
     * @param array $vars
     * @return array
     */
    function constructor_query_vars($vars) {
        $vars[] = 'theme-constructor';
        return $vars;
    }
    add_filter('query_vars', 'constructor_query_vars');
    
    /**
     * Preview filter
     *
     * @param string $content
     */
    function constructor_preview($content) {
        $link = add_query_arg(array('preview' => 1, 'template' => get_template()), '?theme-constructor=css');
        
        $content = str_replace('?theme-constructor=css', $link, $content);
        return $content;
    }
    
    add_filter('preview_theme_ob_filter', 'constructor_preview');
    
    require_once CONSTRUCTOR_DIRECTORY .'/libs/Constructor/Main.php';
    require_once CONSTRUCTOR_DIRECTORY .'/libs/Constructor/Shortcodes.php';
    
    $main = new Constructor_Main();
    $main -> init();
    
    /* Alias section for fast theme development */    
    /**
     * get_constructor_slideshow
     *
     * @access  public
     * @param   boolean  $in In or Out of content container
     * @return  rettype  return
     */
    function get_constructor_slideshow($in = false)
    {
        global $main;
        $main->getSlideshow($in);
    }
    
    /**
     * get_constructor_layout
     *
     * return layout by admin options for $where
     * 
     * @param  string $where
     * @return string
     */
    function get_constructor_layout($where = 'index')
    {
        global $main;
        $main->getLayout($where);
    }
    
    /**
     * get top menu
     *
     * @param  string $before
     * @param  string $after
     * @return string
     */
    function get_constructor_menu($before = '', $after = '')
    {
        global $main;
        $main->getMenu($before, $after);
    }
        
    /**
     * get content widget
     * 
     * @param integer $i post counter
     * @return 
     */
    function get_constructor_content_widget($i)
    {
        global $main;
        $main->getContentWidget($i);
    }

    /**
     * get author name
     *
     * @param  string $before
     * @param  string $after
     * @return string
     */
    function get_constructor_author($before = '', $after = '')
    {
        global $main;
        echo $main->getAuthor($before, $after);
    }
    
    /**
     * get avatar size
     *
     * @return string
     */
    function get_constructor_avatar_size($size = 32)
    {
        global $main;
        return $main->getAvatarSize($size);
    }
    
    /**
     * get no image
     *
     * @return string
     */
    function get_constructor_noimage($width = 312, $height = 292, $align = 'none') 
    {
        return '<img class="thumb align'.$align.'" src="' .CONSTRUCTOR_DIRECTORY_URI. '/images/noimage.png" width="'.$width.'px" height="'.$height.'px" alt="' .__('No Image', 'constructor'). '"/>';
    }
    
    /**
     * get sidebar
     *
     * @access  public
     * @return  string
     */
    function get_constructor_sidebar()
    {
        global $main;
        $main->getSidebar();
    }
    
    /**
     * get navigation
     *
     * @access  public
     * @return  string
     */
    function get_constructor_navigation()
    {
        global $main;
        $main->getNavigation();
    }
    
    /**
     * get footer
     *
     * @access public
     * @return string
     */
    function get_constructor_footer()
    {
        global $main;
        $main->getFooter();
    }

    /**
     * get constructor category classname
     * 
     * @return string
     */
    function get_constructor_category_class()
    {
        global $main;
        return $main->getCategoryClass();
    }

    /**
     * get constructor category
     * 
     * @return string
     */
    function get_constructor_category()
    {
        global $main;
        return $main->getCategory();
    }
    
} else {
    require_once 'admin/admin.php';
}