<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
class Constructor_Abstract 
{
    /**
     * Default options by key "constructor"
     *
     * @var array
     */
    var $_default = array(
            'sidebar'   => 'right',          // sidebar position
            'layout'    =>  array(           // layouts styles
                        'header'  => 140,    // header height
                        'width'   => 1024,   // container width
                        'sidebar' => 240,    // sidebar width
                        'extra'   => 240,    // extrabar  width
                        'fluid'   => array('flag' => false,
                                           'width' => 80, // in %
                                           'min-width' => 960, // in px
                                           'max-width' => 1280, // in px
                                           ),
                        'home'    => 'default', // deprecated
                        'index'   => 'default',
                        'page'    => 'page',
                        'single'  => 'single',
                        'archive' => 'default', // deprecated
                        'date'    => 'default',
                        'category' => 'default',
                        'tag'     => 'default',
                        'search'  => 'default',
                                 ),
            'title'     => array(            // title
                        'pos' => 'left top', // - position
                        'hidden' => false    // - hidden title text
                        ),
            'content'   => array(            // content
                        'author' => 0,       // - link to author page
                        'widget' => array ('flag'   => false,  // - enable content widget place
                                           'after'  => 1       // - show after N post
                                          ),
                        ),
            'comments'  => array(
                        'avatar' => array ('size'   => 64,     // - avatar size (see comments)
                                           'pos'    => 'right' // - avatarposition
                                          ),
                        ),
            'footer'    => array(            // footer text
                        'text' => null,
                        ),
            'fonts'     => array(            // fonts
                        'title' => array('family' => 'Arial,Helvetica,sans-serif', 
                                         'size'   => 48,
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
            'menu'     => array(             // menu with links
                        'pos'  => 'left top',// - position (left|right)+(top|center|bottom)
                        'width'=> false,     // - can be '100%'
                        'flag' => false,     // - enable/disable
                        'home' => false,     // - link to home page
                        'rss'  => false,     // - link to RSS
                        'search' => false,   // - search form
                        'pages'      => array('depth'=>1, 'exclude'=>''),
                        'categories' => array('depth'=>1, 'exclude'=>'', 'group'=>1, 'title'=>'')
                        ),
            'slideshow' => array(            // Slideshow options
                        'flag' => false,     // - enable/disable
                        'layout' => 'in',    // - slideshow 'in' main container or 'over'
                        'onpage' => false,   // - show slideshow on page
                        'onsingle' => false, // - show slideshow on single post
                        'onarchive' => false, // - show slideshow on archives
                        'showposts' => 10,   // - show last N slides
                        'id' => null,        // - slideshow ID - for NextGenGallery
                        'height' => 200,     // - height in px
                        'advanced' => array(
                                'play'       => false,
                                'effect'     => 'slide',
                                'effectTime' => 300,
                                'timeout'    => 3000
                            )
                        ),
            'design'   => array(
                        'box'       => array (
                                'flag' => true, // create box border radius
                                'radius' => 6,  // value of it
                            ),           
                        'shadow'    => array (
                                'flag' => true, // create shadow
                                'x'    => 0,
                                'y'    => 0,
                                'blur' => 3
                                ),           
                        ),
            'images'   => array(             // background images
                        'body' => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat', 'fixed'=>false),
                        'wrap' => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat', 'fixed'=>false),
                        
                        'header'   => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        'wrapper'  => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        'sidebar'  => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        'extrabar' => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        'footer'   => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        
                        'wrapheader'  => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        'wrapcontent' => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        'wrapfooter'  => array('src'=>'', 'pos'=>'left top', 'repeat'=>'no-repeat'),
                        ),
            'opacity'   => 'light',          // type of opacity
            'color'     => array(            // theme colors
                        'bg'      => '#fff',
                        'bg2'     => '#eee',
                        'opacity' => '#fff',
                        'title'   => '#333',
                        'title2'  => '#555',
                        'text'    => '#333',
                        'text2'   => '#aaa',
                        'border'  => '#aaa',
                        'border2' => '#999',

                        'header1'   => '#ff6600',
                        'header2'   => '#ff8833',
                        'header3'   => '#ffaa66',
                        ),
    );
    
    
    /**
     * Options by key "constructor"
     *
     * @var array
     */
    var $_options = array();
    
    
    /**
     * Options by key "constructor_admin"
     *
     * @var array
     */
    var $_admin = array('theme'  => 'default',
                        'donate' => true
                        );
    
    /**
     * Nix_Abstract
     * 
     * @access  public
     */
    function Constructor_Abstract() 
    {
        $this->__construct();
    }
    
    /**
     * Constructor of Nix_Abstract
     *
     * @access  public
     */
    function __construct() 
    {
        $options = get_option('constructor');
        $admin   = get_option('constructor_admin');
        
        if (!$options) {
            $options = require CONSTRUCTOR_DIRECTORY .'/themes/default/config.php';
        }
        
        if (!$admin) {
            $admin   = array();
        }
        
        $this->_options = $this->_arrayMerge($this->_default, $options);
        $this->_admin   = $this->_arrayMerge($this->_admin,   $admin);
    }
    
    /**
     * _updateCache
     *
     * Update cache of style file
     * 
     * @return  rettype  return
     */
    function _updateCache() 
    {
        global $blog_id;
        
        if (!$blog_id) {
            $blog_id = 1;
        }
        
        $css = "/*generated ".date('Y-m-d H:i')."*/\n\n";
        
        ob_start();
        include_once CONSTRUCTOR_DIRECTORY .'/css.php';
        $css .= ob_get_contents();
        ob_end_clean();
        
	    file_put_contents(CONSTRUCTOR_DIRECTORY .'/cache/style'.$blog_id.'.css', $css);
    }
    
    /**
     * _updateOptions
     *
     * update constructor options
     *
     * @param   array    $data
     * @return  array
     */
    function _updateOptions($data = array()) 
    {
        $this->_options = $this->_arrayMerge($this->_default, $data);

        update_option('constructor', $this->_options);
        
        // need update style cache
        $this->_updateCache();

    }
    
    /**
     * _updateAdmin
     *
     * update constructor admin options
     *
     * @param   array    $data
     * @return  array
     */
    function _updateAdmin($data = array()) 
    {
        $this->_admin = $this->_arrayMerge($this->_admin, $data);
        
        update_option('constructor_admin', $this->_admin);
    }
    
    /**
     * array merge
     *
     * @param array $a
     * @param array $b
     * @return array
     */
    function _arrayMerge($a, $b)
    {
        foreach($b as $k=>$v) {
            if (is_array($v)) {
                if (!isset($a[$k])) {
                    $a[$k] = $v;
                } else {
                    $a[$k] = $this->_arrayMerge($a[$k], $v);
                }
            } else {
                $a[$k] = $v;
            }
        }
        return $a;
    }
    
    /**
     * getTheme
     *
     * return theme name
     *
     * @return  string 
     */
    function getTheme() 
    {
        return $this->_admin['theme'];
    }
}
?>