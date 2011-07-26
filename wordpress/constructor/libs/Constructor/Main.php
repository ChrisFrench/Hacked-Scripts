<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
require_once 'Abstract.php';

class Constructor_Main extends Constructor_Abstract
{
    /**
     * init all hooks
     */
    function init() 
    {
        add_action('wp_head', array($this, 'addThemeScripts'), 2);
        add_action('wp_head', array($this, 'addThemeStyles'),  3);
    }
    
    /**
     * add script by wp_head hook
     *
     * @return  void
     */
    function addThemeScripts() 
    {
        wp_enqueue_script('constructor-theme',     CONSTRUCTOR_DIRECTORY_URI.'/js/ready.js', array('jquery'));
    }
    
    /**
     * add styles by wp_head hook
     *
     * @global $blog_id
     * @return void
     */
    function addThemeStyles() 
    {
        global $blog_id;
        
        // need for wordpress MU and WP3
        if (!$blog_id) {
            $blog_id = 1;
        }

        // load style
        if (file_exists(CONSTRUCTOR_DIRECTORY .'/cache/style'.$blog_id.'.css')) {
            wp_enqueue_style('constructor-style',   CONSTRUCTOR_DIRECTORY_URI .'/cache/style'.$blog_id.'.css');
        } else {
            wp_enqueue_style('constructor-style', get_option('home').'/?theme-constructor=css');
        }
        
        // load constructor subtheme style
        if (file_exists(CONSTRUCTOR_DIRECTORY .'/themes/'.$this->getTheme().'/style.css')) {
            wp_enqueue_style( 'constructor-theme', CONSTRUCTOR_DIRECTORY_URI.'/themes/'.$this->getTheme().'/style.css');
        }
    }
    /**
     * get_constructor_slideshow
     *
     * @access  public
     * @param   boolean  $in In or Out of content container
     * @return  rettype  return
     */
    function getSlideshow($in = false)
    {
        if (!$this->_options['slideshow']['flag']) {
            return false;
        }
        if (is_page()   && !$this->_options['slideshow']['onpage'])    return false;
        if (is_single() && !$this->_options['slideshow']['onsingle'])  return false;
        if (is_archive()&& !$this->_options['slideshow']['onarchive']) return false;

        if ( $in && $this->_options['slideshow']['layout'] == 'over') return false;
        if (!$in && $this->_options['slideshow']['layout'] == 'in')   return false;
        
        // height from configuration
        $height = (int)$this->_options['slideshow']['height'];
        
        // calculate slideshow width
        if (!$in) {
            $width = (int)($this->_options['layout']['width'] - 2);
        } else {            
            // switch statement for $this->_options['sidebar']
            switch ($this->_options['sidebar']) {
                case 'none':
                    $width = (int)($this->_options['layout']['width'] - 4);
                    break;
                case 'two':
                case 'two-right':
                case 'two-left':
                    $width = (int)($this->_options['layout']['width'] - $this->_options['layout']['sidebar'] - $this->_options['layout']['extra'] - 6);
                    break;
                default:
                    $width = (int)($this->_options['layout']['width'] - $this->_options['layout']['sidebar'] - 4);
                    break;
            }
        }
        
        
        echo '<div id="slideshow" style="height:'.$height.'px;width:'.$width.'px">';

        // switch statement for true
        switch (true) {
            case (isset($this->_options['slideshow']['id']) && $this->_options['slideshow']['id']!='' && function_exists('nggShowSlideshow')):
                echo nggShowSlideshow((int)$this->_options['slideshow']['id'], $width, $height);
                break;
        
            default:
                $this->getDefaultSlideshow($width, $height);
                break;
        }
        
        
        echo '</div>';
    }
    
    /**
     * get_constructor_default_slideshow
     *
     * generate code for embedded slideshow
     *
     * @param   integer $width
     * @param   integer $height
     * @return  string
     */
    function getDefaultSlideshow($width, $height) 
    {
        $options = $this->_options['slideshow']['advanced'];
        $options['slideshow'] = get_option('home').'/?theme-constructor=slideshow&w='.$width.'&h='.$height;
//        $options['thumbPath'] = CONSTRUCTOR_DIRECTORY_URI."/libs/timthumb.php?src=";
        $options = json_encode($options);
        
        echo '<div class="wp-sl"></div>';
        wp_enqueue_script('constructor-slideshow', CONSTRUCTOR_DIRECTORY_URI.'/js/jquery.wp-slideshow.js', array('jquery'));
        wp_print_scripts('constructor-slideshow');
        echo "
        <script type='text/javascript'>
        /* <![CDATA[ */
            var wpSl = $options;
        /* ]]> */
        </script>";
    }
    
    /**
     * get_constructor_layout
     *
     * @param  string $where
     * @return string
     */
    function getLayout($where = 'index')
    {
        if (!isset($this->_options['layout'][$where])) {
            return include_once CONSTRUCTOR_DIRECTORY .'/layouts/default.php';
        }
        
        $layout = $this->_options['layout'][$where];
        
        if (is_file(CONSTRUCTOR_DIRECTORY .'/layouts/'.$layout.'.php')) {
            include_once CONSTRUCTOR_DIRECTORY .'/layouts/'.$layout.'.php';
        } else {
            include_once CONSTRUCTOR_DIRECTORY .'/layouts/default.php';
        }
        return true;
    }
    
    /**
     * get_constructor_menu
     *
     * @param  string $before
     * @param  string $after
     * @return string
     */
    function getMenu($before = '', $after = '')
    {
        if (!isset($this->_options['menu']['flag']) or !$this->_options['menu']['flag']) return false;

        echo '<div id="menu" class="opacity shadow">';
        echo '<ul class="menu opacity">';
        
        // before items
        if (!empty($before)) {
            echo '<li class="before-item">';
            if (is_array($before)) {
                echo join('</li><li class="before-item">', $before);
            } else {
                echo $before;
            }
            echo '</li>';
        }
        
        // navigation menu - WP3
        if (function_exists('wp_nav_menu')
            && has_nav_menu('header')
        ) {
            $nav_menu = wp_nav_menu( array( 
                                            'sort_column' => 'menu_order',
                                            'container'   => '', 'echo' => 0, 'depth' => 0,
                                            'theme_location' => 'header',
                                            'menu_class'  => 'menu opacity' ) );
            $nav_menu = preg_replace('/<ul(?:.*?)>(.*)<\/ul>/s', '\1', $nav_menu);
            
            echo $nav_menu;
        }
        // maybe "else" or not? 
        {
            
            // show link to homepage
            if ($this->_options['menu']['home']) {
                echo '<li id="home"><a href="'.get_option('home').'/" title="'.get_bloginfo('name').'">'.__('Home', 'constructor').'</a></li>';
            }
            
            // show pages drop-down menu (or as is)
            if ($this->_options['menu']['pages']['depth']) {
                $arg = array('title_li'=>'',
                             'exclude' => $this->_options['menu']['pages']['exclude'],
                             'depth'   => $this->_options['menu']['pages']['depth']
                             );
                wp_list_pages($arg);
            }
            
            // dynamic sidebar "header"
            if ( function_exists('dynamic_sidebar')) {
                dynamic_sidebar('header');
            }
            
            // show categories drop-down menu (or as is)
            if ($this->_options['menu']['categories']['depth']) {  
                $arg = array('title_li'=>'',
                     'exclude' => $this->_options['menu']['categories']['exclude'],
                     'depth'   => $this->_options['menu']['categories']['depth']
                     );
    
                if (isset($this->_options['menu']['categories']['group']) && $this->_options['menu']['categories']['group']) {
                    $cat_title = !empty($this->_options['menu']['categories']['title'])?$this->_options['menu']['categories']['title']:__('Categories','constructor');
                    echo '<li><a href="#" title="'.$cat_title.'">'.$cat_title.'</a><ul>';
                    wp_list_categories($arg);
                    echo '</ul></li>';
                } else {
                    wp_list_categories($arg);
                }
            }
            
            // show search bar
            if ($this->_options['menu']['search'])  {
                echo '<li id="menusearchform">
                          <form method="get" action="' . get_option('home') . '/" >
                          <input class="s" type="text" value="' . esc_attr(apply_filters('the_search_query', get_search_query())) . '" name="s"/>
                          
                          </form>
                      </li>';
            }
            
            // show link to RSS
            if ($this->_options['menu']['rss'])  {
                echo '<li id="rss"><a href="'.get_bloginfo('rss2_url').'"  title="'.__('RSS Feed', 'constructor').'">'. __('RSS Feed', 'constructor').'</a></li>';
            }
            
        }
        // after items
        if (!empty($after)) {            
            echo '<li class="after-item">';
            if (is_array($after)) {
                echo join('</li><li class="after-item">', $after);
            } else {
                echo $after;
            }
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    
    /**
     * get constructor content widget
     * 
     * @param integer $i post counter
     * @return 
     */
    function getContentWidget($i)
    {
        // widget is not enabled
        if (!$this->_options['content']['widget']['flag']) return false;
        
        // wrong position
        if ($this->_options['content']['widget']['after'] != $i) return false;
        echo "<div id=\"content-widget\" class=\"box\">\n";
        dynamic_sidebar('content');
        echo "</div>";
    }

    /**
     * get_constructor_author
     *
     * @param  string $before
     * @param  string $after
     * @return string
     */
    function getAuthor($before = '', $after = '')
    {
        if ($this->_options['content']['author'])
            echo $before; the_author_posts_link(); echo $after;
    }
    
    /**
     * get_constructor_author
     *
     * @param  string $before
     * @param  string $after
     * @return string
     */
    function getAvatarSize($size = 32)
    {
        if (isset($this->_options['comments']['avatar']['size'])) {
            return (int)$this->_options['comments']['avatar']['size'];
        } else {
            return $size;
        }
    }
    
    /**
     * get_constructor_sidebar
     *
     * @access  public
     * @return  string
     */
    function getSidebar()
    {
        // switch statement for $this->_options['sidebar']
        switch ($this->_options['sidebar']) {
            case 'left':
            case 'right':
                get_sidebar();
                break;
            case 'left':
            case 'right':
                get_sidebar();
                break;
            case 'two':
            case 'two-right':
            case 'two-left':
                get_sidebar();
                get_sidebar('extra');
                break;
            case 'none':
            default:
                // nothing
                break;
        }
    }
    
    /**
     * get_constructor_navigation
     *
     * @access  public
     * @return  string
     */
    function getNavigation()
    {
        include_once CONSTRUCTOR_DIRECTORY . '/navigation.php';
    }
    
    /**
     * get_constructor_footer
     *
     * @access public
     * @return string
     */
    function getFooter()
    {
        if ($this->_options['footer']['text']) {
            echo stripslashes($this->_options['footer']['text']);
        } else {
            echo '&copy; '.date('Y') .' '. sprintf(__('%1$s is proudly powered by %2$s', 'constructor'), get_bloginfo('name'), '<a href="http://wordpress.org/">WordPress</a>') .
                 ' | <a href="http://anton.shevchuk.name/">'. __('Constructor Theme', 'constructor') .'</a><br />'.
                 sprintf(__('%1$s and %2$s.', 'constructor'), '<a href="' . get_bloginfo('rss2_url') . '">' . __('Entries (RSS)', 'constructor') . '</a>', '<a href="' . get_bloginfo('comments_rss2_url') . '">' . __('Comments (RSS)', 'constructor') . '</a>');
        }

        if (defined('WP_DEBUG') && WP_DEBUG) {
            printf(__('%d queries. %s seconds.', 'constructor'), get_num_queries(), timer_stop(0, 3));
        }
    }
    
    /**
     * get constructor category
     * 
     * @return string
     */
    function getCategory()
    {
        global $wp_query;

        $category = array();
        
        if (is_single()) {
            $cat = get_the_category($wp_query->post->ID);
            if ($cat) {
                $category = split('/', rtrim(get_category_parents($cat[0], false, '/', true), '/'));
            }
        } elseif (is_page()) {
            $category = get_post_custom_values('category_name', $wp_query->post->ID);
        } elseif (is_category()) {
            $cat = get_category(get_query_var('cat'));
            if ($cat) {
                $category = split('/', rtrim(get_category_parents($cat, false, '/', true), '/'));
            }
        }
        return $category;
    }
    
    /**
     * get constructor category classname
     * 
     * @return string
     */
    function getCategoryClass()
    {
        global $category_class;
        
        if ($category_class) {
            // nothing
        } elseif ($category = get_constructor_category()) {
            if (sizeof($category) > 0)
                $category_class =  'category-' .join(' category-', $category);
        } else {
            $category_class = '';
        }
        
        return $category_class;
    }
}
?>