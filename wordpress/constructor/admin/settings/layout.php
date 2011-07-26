<?php __('Layout', 'constructor'); // requeried for correct translation  
$layouts = scandir(CONSTRUCTOR_DIRECTORY.'/layouts/');
$layouts = array_diff($layouts, array( '.','..','.svn','.htaccess','readme.txt'));

function is_php($file) {
    $info = pathinfo($file);
    return ($info['extension'] == 'php');
}
$layouts = array_filter($layouts, 'is_php');
?>

<table class="form-table">
    <tr>
        <td>
            
        <div class="constructor-accordion">
            <h3><a href="#"><?php _e('Homepage', 'constructor')?></a></h3>
            <div class="select" id="layout-home"><?php constructor_admin_layout($layouts, 'home'); ?></div>
            <h3><a href="#"><?php _e('Post', 'constructor')?></a></h3>
            <div class="select" id="layout-single"><?php constructor_admin_layout($layouts, 'single'); ?></div>
            <h3><a href="#"><?php _e('Page', 'constructor')?></a></h3>
            <div class="select" id="layout-page"><?php constructor_admin_layout($layouts, 'page'); ?></div>
            <h3><a href="#"><?php _e('Search', 'constructor')?></a></h3>
            <div class="select" id="layout-search"><?php constructor_admin_layout($layouts, 'search'); ?></div>        
            <h3><a href="#"><?php _e('Date', 'constructor')?></a></h3>
            <div class="select" id="layout-date"><?php constructor_admin_layout($layouts, 'date'); ?></div>
            <h3><a href="#"><?php _e('Category', 'constructor')?></a></h3>
            <div class="select" id="layout-category"><?php constructor_admin_layout($layouts, 'category'); ?></div>
            <h3><a href="#"><?php _e('Tag', 'constructor')?></a></h3>
            <div class="select" id="layout-tag"><?php constructor_admin_layout($layouts, 'tag'); ?></div>
        </div>

        </td>
        <td valign="top" class="updated quick-links" width="240px">
            <h3><?php _e('Help', 'constructor'); ?></h3>
            <a href="http://code.google.com/p/wp-constructor/wiki/ConstructorLayouts" title="Create custom layout">Create custom layout</a>
            <br/><br/>
            <dl>
                <dt><?php _e('Homepage', 'constructor')?></dt>
                <dd>http://domain.com</dd>
                <dt><?php _e('Post', 'constructor')?></dt>
                <dd>http://domain.com/?p=123<br/> http://domain.com/the_post_title/</dd>
                <dt><?php _e('Page', 'constructor')?></dt>
                <dd>http://domain.com/?page_id=123<br/> http://domain.com/the_page_title/</dd>
                <dt><?php _e('Search', 'constructor')?></dt>
                <dd>http://domain.com/?s=search%20string</dd>                
                <dt><?php _e('Date', 'constructor')?></dt>
                <dd>http://domain.com/?m=2010<br/> http://domain.com/2010/05</dd>
                <dt><?php _e('Category', 'constructor')?></dt>
                <dd>http://domain.com/?cat=12<br/> http://domain.com/category/name</dd>
                <dt><?php _e('Tag', 'constructor')?></dt>
                <dd>http://domain.com/?tag=name<br/> http://domain.com/tag/name</dd>
            </dl>
            
            
        </td>
    </tr>
</table>
    
<?php       
/**
 * Return string for build options
 *
 * @param  array  $layouts
 * @param  string $key
 * @return string
 */
function constructor_admin_layout($layouts, $key) 
{
    global $constructor;
    ?>    
    <input type="hidden" id="constructor-layout-<?php echo $key ?>" name="constructor[layout][<?php echo $key ?>]" value="<?php echo $constructor['layout'][$key]?>"/>
    <?php
    foreach ($layouts as $layout) {
        $info = pathinfo($layout);
        $name = substr($info['basename'], 0, -4);
        $title = ucfirst(strtolower($name));
        ?>
        <a href="#" title="<?php echo esc_attr(__($title, 'constructor')); ?>" name="<?php echo $name; ?>" <?php if($constructor['layout'][$key] == $name) echo 'class="selected"'; ?>>
            <img src="<?php echo CONSTRUCTOR_DIRECTORY_URI ?>/admin/images/layout-<?php echo $name; ?>.png" alt="<?php echo esc_attr(__($title, 'constructor')); ?>" />
        </a>
        <?php
    }
}
?>