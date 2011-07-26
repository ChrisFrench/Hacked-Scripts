<?php __('Save As', 'constructor'); // requeried for correct translation 

$theme_data = get_theme_data(CONSTRUCTOR_DIRECTORY.'/themes/'.$admin['theme'].'/style.css');

$author = strip_tags($theme_data['Author']);
$author_uri = '';
$matches = array();
if (preg_match('/href=\"([^"]*)\"/', $theme_data['Author'],$matches)) {
    $author_uri = $matches[1];
}
?>

<b><?php _e('Save Current Theme As ...', 'constructor') ?></b>
<table class="form-table">
    <?php
    $save = true;
    if (!is_writable(CONSTRUCTOR_DIRECTORY.'/themes/')) : $save = false;
    ?>
    <tr>
        <th scope="row" valign="top" colspan="2" class="th-full updated"><?php printf(__('<font color="red"><b>Warning!</b></font>: Directory "%s" is not writable.', 'constructor'), CONSTRUCTOR_DIRECTORY.'/themes/'); ?></th>
    </tr>
    <?php endif; ?>
    <tr>
        <th scope="row"><?php _e('Theme Name', 'constructor') ?>:</th>
        <td><input name="save[theme-name]" id="save-theme-name" value="<?php echo $theme_data['Title'];?>"/></td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Theme URI', 'constructor') ?>:</th>
        <td><input name="save[theme-uri]" id="save-theme-uri" value="<?php echo $theme_data['URI'];?>"/></td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Description', 'constructor') ?>:</th>
        <td><textarea name="save[description]" id="save-description" rows="5" cols="64"><?php echo $theme_data['Description'];?></textarea></td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Version', 'constructor') ?>:</th>
        <td><input name="save[version]" id="save-version" value="<?php echo $theme_data['Version'];?>"/></td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Author', 'constructor') ?>:</th>
        <td><input name="save[author]" id="save-author" value="<?php echo $author;?>"/></td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Author URI', 'constructor') ?>:</th>
        <td><input name="save[author-uri]" id="save-author-uri" value="<?php echo $author_uri;?>"/></td>
    </tr>
</table>
<p>
    <a href="<?php echo get_bloginfo('wpurl') ?>/wp-admin/admin-ajax.php" id="save-link" class="button-secondary"><?php _e('Save Theme', 'constructor'); ?></a>
</p>