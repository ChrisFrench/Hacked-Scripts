<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
function constructor_admin_save()
{
    global $current_user, $template_uri;
    // setup permissions for save
    $permission = 0777;
    
    $directory   = get_template_directory();
    
    // get theme options
    $constructor = get_option('constructor');
    $admin       = get_option('constructor_admin');
    
    // get theme name
    $theme = isset($_REQUEST['theme'])?$_REQUEST['theme']:$admin['theme'];
    $theme_old = $constructor['theme'];
    $theme_new = strtolower($theme);
    $theme_new = preg_replace('/\W/', '-', $theme_new);
    $theme_new = preg_replace('/[-]+/', '-', $theme_new);
    
    $theme_uri   = isset($_REQUEST['theme-uri'])?$_REQUEST['theme-uri']:'';
    $description = stripslashes(isset($_REQUEST['description'])?$_REQUEST['description']:'');
    $version     = isset($_REQUEST['version'])?$_REQUEST['version']:'0.0.1';
    $author      = isset($_REQUEST['author'])?$_REQUEST['author']:'';
    $author_uri  = isset($_REQUEST['author-uri'])?$_REQUEST['author-uri']:$current_user->user_nicename;
    
    if (is_dir($directory.'/themes/'.$theme_new) &&
        !is_writable($directory.'/themes/'.$theme_new)) {
        returnResponse(RESPONSE_KO,  sprintf(__('Directory "%s" is not writable.', 'constructor'), $directory.'/themes/'.$theme_new));
    } else {
        if (!is_writable($directory.'/themes/')) {
            returnResponse(RESPONSE_KO, sprintf(__('Directory "%s" is not writable.', 'constructor'), $directory.'/themes/'));
        } else {
            @mkdir($directory.'/themes/'.$theme_new);
            @chmod($directory.'/themes/'.$theme_new, $permission);
        }
    }
    
    // copy all theme images to new? directory
    foreach ($constructor['images'] as $img => $data) {
        if (!empty($data['src'])) {
            $file = pathinfo($data['src']);
            
            $old_image = $directory . '/'. $data['src'];
            $new_image = $directory . '/themes/'. $theme_new .'/'. $file['basename'];
            
            if ($old_image != $new_image) {
                // we are already check directory permissions
                if (!@copy($old_image, $new_image)) {
                     returnResponse(RESPONSE_KO, sprintf(__('Can\'t copy file "%s".', 'constructor'), $old_image));
                }
                
                // read and write for owner and everybody else
                @chmod($new_image, $permission);
                $constructor['images'][$img]['src'] = 'themes/'. $theme_new .'/'. $file['basename'];
            }
        }
    }
    
    // copy default screenshot (if not exist)
    if (!file_exists($directory.'/themes/'.$theme_new.'/screenshot.png') && 
         file_exists($directory.'/themes/'.$theme_old.'/screenshot.png')) {
        if (!@copy($directory.'/themes/'.$theme_old.'/screenshot.png', $directory.'/themes/'.$theme_new.'/screenshot.png')) {
            returnResponse(RESPONSE_KO, sprintf(__('Can\'t copy file "%s".', 'constructor'), '/themes/'.$theme_old.'/screenshot.png'));
        }
    } elseif (!file_exists($directory.'/themes/'.$theme_new.'/screenshot.png')) {
        if (!@copy($directory.'/admin/images/screenshot.png', $directory.'/themes/'.$theme_new.'/screenshot.png')) {
            returnResponse(RESPONSE_KO, sprintf(__('Can\'t copy file "%s".', 'constructor'), '/admin/images/screenshot.png'));
        }
    }
    
    // read and write for owner and everybody else
    @chmod($directory.'/themes/'.$theme_new.'/screenshot.png', $permission);
    
    // update style file
    if (file_exists($directory.'/themes/'.$theme_old.'/style.css')) {
        $style = file_get_contents($directory.'/themes/'.$theme_old.'/style.css');
        // match first comment /* ... */
        $style = preg_replace('|\/\*(.*)\*\/|Umis', '', $style, 1);
    } else {
        $style = '';
    }
    
    $style = "/*
Theme Name: $theme
Theme URI: $theme_uri
Description: $description
Version: $version
Author: $author
Author URI: $author_uri
*/".$style;
        
    unset($constructor['theme']);
    
    $config = "<?php \n".
              "/* Save on ".date('Y-m-d H:i')." */ \n".
              "return ".
              var_export($constructor, true).
              "\n ?>";
              
    // update files content
    if (!@file_put_contents($directory.'/themes/'.$theme_new.'/style.css', $style)) {
        returnResponse(RESPONSE_KO, sprintf(__('Can\'t save file "%s".', 'constructor'), '/themes/'.$theme_new.'/style.css'));
    }
    
    if (!@file_put_contents($directory.'/themes/'.$theme_new.'/config.php', $config)) {
        returnResponse(RESPONSE_KO, sprintf(__('Can\'t save file "%s".', 'constructor'), '/themes/'.$theme_new.'/config.php'));
    }
    
    returnResponse(RESPONSE_OK, __('Theme was saved, please reload page for view changes', 'constructor'));
    die();
}

add_action('wp_ajax_constructor_admin_save', 'constructor_admin_save');
?>