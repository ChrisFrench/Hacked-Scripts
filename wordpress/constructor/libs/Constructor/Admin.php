<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
require_once 'Abstract.php';

class Constructor_Admin extends Constructor_Abstract
{
    var $_modules = array();
    var $_donate  = '
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_donations" />
            <input type="hidden" name="business" value="mxleod@yahoo.com" />
            <input type="hidden" name="lc" value="US" />
            <input type="hidden" name="item_name" value="Wordpress Constructor Theme" />
            <input type="hidden" name="currency_code" value="USD" />
            <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest" />
            <input type="submit" name="Submit" class="button-primary" value="Donate" />
            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
        </form>';
    
    /**
     * init all hooks
     */
    function init($modules = array()) 
    {
        $this->_modules = $modules;
     
        require_once CONSTRUCTOR_DIRECTORY .'/admin/ajax.php';

        // process request
        $this->request();

        add_action('admin_head', array($this, 'addThemeScripts'), 2);
        add_action('admin_head', array($this, 'addThemeStyles'),  3);
        add_action('admin_menu', array($this, 'addMenuItem'));
        
        add_action('switch_theme', array($this, 'disable'));
    }

    /**
     * Process the request
     *
     * @return bool
     */
    function request()
    {
        if (isset($_GET['page']) && ($_GET['page'] == "functions.php" or $_GET['page'] == "admin/admin.php")){
            if (isset($_REQUEST['action']) && 'save' == $_REQUEST['action']) {
                check_admin_referer('constructor');
                if (isset($_REQUEST['constructor'])) {

                    $files = isset($_FILES['constructor'])?$_FILES['constructor']:array();
                    $data  = $_REQUEST['constructor'];

                    if (isset ($data['theme-reload']) && $data['theme-reload'] != 0) {
                        // loading theme and forgot all changes
                        $theme = $data['theme'];
                        $data  = require CONSTRUCTOR_DIRECTORY.'/themes/'.$theme.'/config.php';
                        $this->_admin['theme'] = $theme;
                        unset($data['theme']);
                    } else {
                    	global $blog_id;
        				// is MU WP
        				if ($blog_id && $blog_id != 1) {
        					$upload = CONSTRUCTOR_DIRECTORY.'/images/'.$blog_id.'/';
        					$path   = 'images/'.$blog_id.'/';

        					if (!is_dir($upload)) {
        						if (!@mkdir($upload)) {
        							$errors[] = sprintf(__('System can\'t create "%s" directory','constructor'), $upload);
        						}
        					}
        				} else {
        					$upload = CONSTRUCTOR_DIRECTORY.'/images/';
        					$path   = 'images/';
        				}

                        if ($files && is_writable($upload)) {

                            $errors = array();
                            foreach ($files['name']['images'] as $name => $image) {
                                if (isset($image['src']) && is_uploaded_file($files['tmp_name']['images'][$name]['src'])) {

                                    if (!preg_match('/\.(jpe?g|png|gif|tiff)$/i', $image['src'])) {
                                        $errors[] = sprintf(__('File "%s" is not a image (jpeg, png, gif, tiff)','constructor'), $image['src']);
                                        continue;
                                    }

                                    if (move_uploaded_file($files['tmp_name']['images'][$name]['src'], $upload . $image['src'])) {
                                        $data['images'][$name]['src'] = $path.$image['src'];
                                    } else {
                                        $errors[] = sprintf(__('File "%s" can\'t be move to "images" folder','constructor'), $image['src']);
                                        continue;
                                    }
                                }
                            }
                        }
                        /**
                         * Shadow
                         */
                        if (isset($data['shadow'])) $data['shadow'] = true;

                        /**
                         * CSS changes
                         */
                        if (isset($data['css']) && is_writable(CONSTRUCTOR_DIRECTORY.'/themes/'.$data['theme'].'/style.css')) {
                            file_put_contents(CONSTRUCTOR_DIRECTORY.'/themes/'.$data['theme'].'/style.css', stripslashes($data['css']));
                            unset($data['css']);
                        }

                        /**
                         * Slideshow
                         */
                        $data['slideshow']['id']        = isset($data['slideshow']['id'])?(int)$data['slideshow']['id']:null;
                        $data['slideshow']['showposts'] = isset($data['slideshow']['showposts'])?(int)$data['slideshow']['showposts']:10;

                        /**
                         * Flags changes
                         * @todo Need check follows code
                         */
        				/*
        			    $arr_false = array_keys(array_diff_key($this->_options, $data));
        			    $arr_false = array_fill_keys($arr_false, false);
        			    $data      = array_merge($this->_options, $arr_false);
        				*/

        				$fonts = require CONSTRUCTOR_DIRECTORY . '/admin/fonts.php';
                        $font_face = require CONSTRUCTOR_DIRECTORY . '/admin/font-face.php';
                        $fonts = array_merge($fonts, $font_face);

        				$data['fonts']['title']['family'] = $fonts[$data['fonts']['title']['family']];
        				$data['fonts']['description']['family'] = $fonts[$data['fonts']['description']['family']];
        				$data['fonts']['header']['family'] = $fonts[$data['fonts']['header']['family']];
        				$data['fonts']['content']['family'] = $fonts[$data['fonts']['content']['family']];

                        $data['menu']['flag']   = isset($data['menu']['flag'])?true:false;

                        if ($data['menu']['flag']) {
                            $data['menu']['home']   = isset($data['menu']['home'])?true:false;
                            $data['menu']['rss']    = isset($data['menu']['rss'])?true:false;
                            $data['menu']['search'] = isset($data['menu']['search'])?true:false;

                            $data['menu']['categories']['group'] = isset($data['menu']['categories']['group'])?true:false;
    
                            $data['menu']['pages']['exclude'] = join(',',array_map(array($this, 'toInt'), spliti(',', $data['menu']['pages']['exclude'])));
                            $data['menu']['categories']['exclude'] = join(',',array_map(array($this, 'toInt'), spliti(',', $data['menu']['categories']['exclude'])));
                        }

                        $data['title']['hidden'] = isset($data['title']['hidden'])?true:false;

        				$data['content']['author'] = isset($data['content']['author'])?true:false;
                        $data['content']['widget']['flag'] = isset($data['content']['widget']['flag'])?true:false;

                        $data['design']['box']['flag']    = isset($data['design']['box']['flag'])?true:false;
                        $data['design']['shadow']['flag'] = isset($data['design']['shadow']['flag'])?true:false;

        				$data['images']['body']['fixed'] = isset($data['images']['body']['fixed'])?true:false;
                        $data['images']['wrap']['fixed'] = isset($data['images']['wrap']['fixed'])?true:false;

                        $data['slideshow']['flag']      = isset($data['slideshow']['flag'])?true:false;
                        $data['slideshow']['onpage']    = isset($data['slideshow']['onpage'])?true:false;
        				$data['slideshow']['onsingle']  = isset($data['slideshow']['onsingle'])?true:false;
        				$data['slideshow']['onarchive'] = isset($data['slideshow']['onarchive'])?true:false;

        				$data['slideshow']['advanced']['thumb'] = isset($data['slideshow']['advanced']['thumb'])?true:false;
        				$data['slideshow']['advanced']['play']  = isset($data['slideshow']['advanced']['play'])?true:false;

                    }

                    $this->_updateOptions($data);
                    $this->_updateAdmin();
                }

                if (isset($errors) && sizeof($errors) > 0) {
                    wp_redirect("themes.php?page={$_GET['page']}&saved=true&errors=true");
                } else {
                    wp_redirect("themes.php?page={$_GET['page']}&saved=true");
                }
                die;
            }
        }
    }

    /**
     * unload callback
     *
     * @param string $theme
     */
    function disable($theme)
    {
        // disable autoload
    }
    
    /**
     * remove callback
     */
    function remove()
    {
        // remove theme options
        delete_option('constructor');
        delete_option('constructor_admin');
    }
    
    /**
     * to integer
     *
     * @param   string   $el  array element
     * @return  integer  $el
     */
    function toInt($el) 
    {
        return (int)$el;
    }
    
    /**
     * add scripts by wp_head hook
     *
     * @return  void
     */
    function addThemeScripts() 
    {
        global $wp_version;
        wp_enqueue_script('thickbox');

        if (version_compare($wp_version, '2.8', '<')) {
            wp_deregister_script('jquery');
            wp_deregister_script('jquery-ui');
            
            wp_enqueue_script('jquery',              CONSTRUCTOR_DIRECTORY_URI .'/admin/js/jquery.js');
        }
        
        wp_enqueue_script('jquery-ui',               CONSTRUCTOR_DIRECTORY_URI .'/admin/js/jquery-ui.js', 'jquery');
            
        wp_enqueue_script('constructor-colorpicker', CONSTRUCTOR_DIRECTORY_URI .'/admin/js/colorpicker.js', 'jquery');
        wp_enqueue_script('constructor-settings',    CONSTRUCTOR_DIRECTORY_URI .'/admin/js/settings.js', 'jquery');
        wp_enqueue_script('constructor-messages',    CONSTRUCTOR_DIRECTORY_URI .'/admin/js/messages.js', 'jquery');
        wp_print_scripts();
    }
    
    /**
     * add styles by wp_head hook
     *
     * @return  void
     */
    function addThemeStyles() 
    {
        wp_enqueue_style('thickbox');
        wp_enqueue_style('constructor-admin',       CONSTRUCTOR_DIRECTORY_URI .'/admin/css/admin.css');
        wp_enqueue_style('constructor-colorpicker', CONSTRUCTOR_DIRECTORY_URI .'/admin/css/colorpicker.css');
        wp_enqueue_style('jquery-ui',               CONSTRUCTOR_DIRECTORY_URI .'/admin/css/jquery-ui.css');
        wp_enqueue_style('google-font-face',        'http://code.google.com/webfonts/css');
        wp_print_styles();
    }

    /**
     * Add configuration page
     */
    function addMenuItem()
    {
        // super admin
        add_theme_page(
            __('Customize Theme', 'constructor'),
            __('Customize', 'constructor'),
            'edit_themes',
            'functions.php',
            array($this, 'getPage')
        )
        or
        // admin for MU blog
        add_theme_page(
            __('Customize Theme', 'constructor'),
            __('Customize', 'constructor'),
            'edit_theme_options',
            'admin/admin.php',
            array($this, 'getPage')
        );
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontFamily($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;

        $fonts = require CONSTRUCTOR_DIRECTORY . '/admin/fonts.php';
        echo "<select class='constructor-font-family' name='constructor[fonts][".$key."][family]'>";
        echo "<optgroup label='".__('Standart Fonts', 'constructor')."'>";
        foreach ($fonts as $k => $font) :
        ?>
            <option value="<?php echo $k ?>" <?php if ($font == $constructor['fonts'][$key]['family']) echo 'selected="selected"'; ?>><?php echo $font ?></option>
        <?php
        endforeach;
        $k++; // start from this is font
        $font_face = require CONSTRUCTOR_DIRECTORY . '/admin/font-face.php';
        echo "<optgroup label='".__('Google Fonts', 'constructor')."'>";
        foreach ($font_face as $i => $font) :
        ?>
            <option value="<?php echo $k+$i ?>" <?php if ($font == $constructor['fonts'][$key]['family']) echo 'selected="selected"'; ?>><?php echo $font ?></option>
        <?php
        endforeach;
        echo "</optgroup>";
        echo "</select>";
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontSize($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;
        $size = (int)$constructor['fonts'][$key]['size'];
        
        
        $font_sizes = array(8,9,10,11,12,14,16,18,20,
                            22,24,26,28,32,36,40,44,48,
                            52,56,60,72,76,80,84,88,92);
         
        if ($size && !in_array($size, $font_sizes)) {
            array_unshift($font_sizes, $size);
        }
        
        echo "<select class='constructor-font-size' name='constructor[fonts][".$key."][size]'>";
        foreach ($font_sizes as $font_size) :
        ?>
            <option value='<?php echo $font_size ?>' <?php if ($size == $font_size) echo 'selected="selected"'; ?>><?php echo $font_size ?>px</option>
        <?php
        endforeach;        
        echo "</select>";
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontTransform($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;
        /*
        none	No capitalization. The text renders as it is. This is default
        capitalize	Transforms the first character of each word to uppercase
        uppercase	Transforms all characters to uppercase
        lowercase	Transforms all characters to lowercase
        */
        $options = array('none',
                         'capitalize',
                         'uppercase',
                         'lowercase',
                          );
       
        echo "<select class='constructor-font-transform' name='constructor[fonts][".$key."][transform]'>";
        foreach ($options as $option) :
        ?>
            <option value='<?php echo $option ?>' <?php if ($constructor['fonts'][$key]['transform'] == $option) echo 'selected="selected"'; ?>><?php echo $option ?></option>
        <?php
        endforeach;        
        echo "</select>";
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontWeight($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;
        /*
        Defines from thin to thick characters. 400 is the same as normal, and 700 is the same as bold
        */
        $options = array(100,200,300,400,500,600,700,800,900);
       
        echo "<select class='constructor-font-weight' name='constructor[fonts][".$key."][weight]'>";
        foreach ($options as $option) :
        ?>
            <option value='<?php echo $option ?>' <?php if ($constructor['fonts'][$key]['weight'] == $option) echo 'selected="selected"'; ?>><?php echo $option ?></option>
        <?php
        endforeach;        
        echo "</select>";
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontColor($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;
        $color = $constructor['fonts'][$key]['color'];
        ?>
        <script type="text/javascript">
        /* <![CDATA[ */
        (function($){
            $(document).ready(function(){            
                initColorPicker('fonts-<?php echo $key?>-color');        
            });
        })(jQuery);
        /* ]]> */
        </script>
        <input type="hidden" id="constructor-fonts-<?php echo $key?>-color" name="constructor[fonts][<?php echo $key?>][color]" value="<?php echo $color?>"/>
        <div id="fonts-<?php echo $key?>-color" class="color"><div style="background-color: <?php echo $color ?>"></div></div>
        <?php
    }
    
    /**
     * getPage
     *
     * render admin page
     *
     * @return  string
     */
    function getPage() 
    {
        global $constructor, $admin;
        /*@var $constructor array*/
        $constructor = $this->_options;
        
        /*@var $admin array*/
        $admin = $this->_admin;
        ?>
        <div class='wrap'>
           <h2><?php _e('Customize Theme', 'constructor'); ?></h2>
           <?php
               if ( $this->_admin['donate'] ) {
                   echo '<div id="message" class="updated fade donate"><div class="donate-button">'.$this->_donate.'</div><p>'.__('If you like this theme and find it useful, help keep this theme free and actively developed by clicking the donate button (via PayPal or CC)').'</p><a href="'.get_bloginfo('wpurl').'/wp-admin/admin-ajax.php" class="message-close ui-icon ui-icon-close" title=":("><span/></a><br class="clear"/></div>';
               }
               
               if ( isset( $_REQUEST['saved'] ) ) {
                   echo '<div id="message" class="updated fade"><p><strong>'.__('Options saved.').'</strong></p></div>';
               }
               
               if ( isset( $_REQUEST['errors'] ) ) {
                   echo '<div id="errors" class="error fade"><p><strong>'.__('Some images can\'t be upload. Please check permissions').'</strong></p></div>';
               }
               ?>
           <div class="constructor">
                <form method="post" id="constructor-form" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
                    <?php wp_nonce_field('constructor'); ?>
                    <input type="hidden" name="action" value="save" />
                    <div id="tabs">
                        <ul>
                            <?php foreach ($this->_modules as $module => $file) : ?>
                            <li><a href="#constr-<?php echo $file ?>"><?php echo $module ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php foreach ($this->_modules as $module => $file) : ?>
                        <div id="constr-<?php echo $file ?>">
                            <?php require_once CONSTRUCTOR_DIRECTORY ."/admin/settings/$file.php" ?>
                        </div>
                        <?php endforeach; ?>
    
                    </div>
                    <p class="submit">
                        <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes', 'constructor')?>" />
                    </p>
                </form>
           </div>
        </div>
        <?php
    }
}
?>