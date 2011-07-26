<?php __('Images', 'constructor'); // requeried for correct translation ?>
<div class="constructor-admin-help" title="<?php _e('Help', 'constructor'); ?>" name="Images">
    <div id="constructor-layers">
        <ol>
            <li><?php _e('Body Image', 'constructor'); ?></li>
            <li><?php _e('Background Image', 'constructor'); ?></li>
            <li><?php _e('Header Wrapper Image', 'constructor'); ?></li>
            <li><?php _e('Content Wrapper Image', 'constructor'); ?></li>
            <li><?php _e('Footer Wrapper Image', 'constructor'); ?></li>
            <li><?php _e('Header Image', 'constructor'); ?></li>
            <li><?php _e('Content Image', 'constructor'); ?></li>
            <li><?php _e('Footer Image', 'constructor'); ?></li>
            <li><?php _e('Sidebar Image', 'constructor'); ?></li>
        </ol>
    </div>
</div>

<table class="form-table">
<?php
    $upload = true;
    if (!is_writable(CONSTRUCTOR_DIRECTORY.'/images/')) : $upload = false;
?>

    <tr>
        <th scope="row" colspan="2" valign="top" class="th-full updated"><?php printf(__('<font color="red"><b>Warning!</b></font>: Directory "%s" is not writable.', 'constructor'), CONSTRUCTOR_DIRECTORY.'/images/'); ?></th>
    </tr>
<?php
    endif;
?>
    <tr>
        <td>
        
<div class="constructor-accordion">
    <h3><a href="#"><?php _e('Body Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('body', $upload) ?>
            <?php constructor_admin_image_fixed('body') ?>
    		<?php constructor_admin_image('body') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Background Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('wrap', $upload) ?>
            <?php constructor_admin_image_fixed('wrap') ?>
    		<?php constructor_admin_image('wrap') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Header Wrapper Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('wrapheader', $upload) ?>
    		<?php constructor_admin_image('wrapheader') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Header Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('header', $upload) ?>
    		<?php constructor_admin_image('header') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Content Wrapper Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('wrapcontent', $upload) ?>
    		<?php constructor_admin_image('wrapcontent') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Content Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('wrapper', $upload) ?>
    		<?php constructor_admin_image('wrapper') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Sidebar Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('sidebar', $upload) ?>
    		<?php constructor_admin_image('sidebar') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Extrabar Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('extrabar', $upload) ?>
    		<?php constructor_admin_image('extrabar') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Footer Wrapper Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('wrapfooter', $upload) ?>
    		<?php constructor_admin_image('wrapfooter') ?>
		</table>
    </div>
    <h3><a href="#"><?php _e('Footer Image', 'constructor'); ?></a></h3>
    <div>
        <table class="form-table">
            <?php constructor_admin_image_src('footer', $upload) ?>
    		<?php constructor_admin_image('footer') ?>
		</table>
    </div>
</div>
        
        </td>
        <td valign="top" class="updated quick-links" width="320px">
            <h3><?php _e('Help', 'constructor'); ?></h3>
            <a href="#" class="help-button" title="<?php _e('Help', 'constructor'); ?>"><?php _e('See helpful illustration!', 'constructor'); ?></a></td>
    </tr>
</table>

<?php 

/**
 * Return string for build options
 *
 * @param  string $key
 * @return string
 */
function constructor_admin_image_src($key, $upload) 
{
    global $constructor;
    ?>
    <tr>
    <td colspan="2">
        <input type="text" name="constructor[images][<?php echo $key?>][src]" value="<?php echo $constructor['images'][$key]['src']?>"/>
        <?php if ($upload) : ?><input type="file" name="constructor[images][<?php echo $key?>][src]"/><?php endif; ?>
        <?php if ($constructor['images'][$key]['src']) : ?>
            (<a class="thickbox" href="<?php echo CONSTRUCTOR_DIRECTORY_URI .'/'.$constructor['images'][$key]['src']; ?>" title="<?php _e('Preview image', 'constructor'); ?>"><?php _e('preview', 'constructor'); ?></a>, 
             <a href="#" class="clear-link" title="<?php _e('Remove image (only from theme)', 'constructor'); ?>"><?php _e('clear', 'constructor'); ?></a>)
        <?php endif; ?>
    </td>
    </tr>
    <?php
}

/**
 * Return string for build options
 *
 * @param  string $key
 * @return string
 */
function constructor_admin_image_fixed($key) 
{
    global $constructor;
    ?>
    <tr>
    <td colspan="2">
        <input type="checkbox" id="constructor-images-<?php echo $key?>-fixed" name="constructor[images][<?php echo $key?>][fixed]" value="1" <?php if($constructor['images'][$key]['fixed']) : ?>checked="checked" <?php endif; ?>/>
    	<label for="constructor-images-<?php echo $key?>-fixed"><?php _e('Fixed position', 'constructor')?></label>
	</td>
	</tr>
    <?php
}

/**
 * Return string for build options
 *
 * @param  string $key
 * @return string
 */
function constructor_admin_image($key) 
{
    global $constructor;
    ?>
    <tr>
    <td class="position select" id="images-<?php echo $key?>-pos" width="330px">
    
        <input type="hidden" id="constructor-images-<?php echo $key?>-repeat" name="constructor[images][<?php echo $key?>][repeat]" value="<?php echo $constructor['images'][$key]['repeat']?>"/>
        <input type="hidden" id="constructor-images-<?php echo $key?>-pos" name="constructor[images][<?php echo $key?>][pos]" value="<?php echo $constructor['images'][$key]['pos']?>"/>
        
        <p><?php _e('Image Position', 'constructor'); ?></p>
        <a href="#" title="<?php _e('Top Left', 'constructor'); ?>" name="left top" <?php if($constructor['images'][$key]['pos'] == 'left top') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Top Center', 'constructor'); ?>" name="center top" <?php if($constructor['images'][$key]['pos'] == 'center top') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Top Right', 'constructor'); ?>" name="right top" <?php if($constructor['images'][$key]['pos'] == 'right top') echo 'class="selected"'; ?>> </a>

        <br class="clear"/>

        <a href="#" title="<?php _e('Center Left', 'constructor'); ?>" name="left center" <?php if($constructor['images'][$key]['pos'] == 'left center') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Center Center', 'constructor'); ?>" name="center center" <?php if($constructor['images'][$key]['pos'] == 'center center') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Center Right', 'constructor'); ?>" name="right center" <?php if($constructor['images'][$key]['pos'] == 'right center') echo 'class="selected"'; ?>> </a>

        <br class="clear"/>

        <a href="#" title="<?php _e('Bottom Left', 'constructor'); ?>" name="left bottom" <?php if($constructor['images'][$key]['pos'] == 'left bottom') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Bottom Center', 'constructor'); ?>" name="center bottom" <?php if($constructor['images'][$key]['pos'] == 'center bottom') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Bottom Right', 'constructor'); ?>" name="right bottom" <?php if($constructor['images'][$key]['pos'] == 'right bottom') echo 'class="selected"'; ?>> </a>
     </td>
    <td class="repeat select" id="images-<?php echo $key?>-repeat">
        <p><?php _e('Image Repeat', 'constructor'); ?></p>
        <a href="#" title="<?php _e('No Repeat', 'constructor'); ?>" name="no-repeat" class="norepeat <?php if($constructor['images'][$key]['repeat'] == 'no-repeat') echo 'selected'; ?>"> </a>
        <a href="#" title="<?php _e('Repeat Horizontal', 'constructor'); ?>" name="repeat-x" class="repeatx <?php if($constructor['images'][$key]['repeat'] == 'repeat-x') echo 'selected'; ?>"> </a>
        <br class="clear"/>
        <a href="#" title="<?php _e('Repeat Vertical', 'constructor'); ?>" name="repeat-y" class="repeaty <?php if($constructor['images'][$key]['repeat'] == 'repeat-y') echo 'selected'; ?>"> </a>
        <a href="#" title="<?php _e('Tile', 'constructor'); ?>" name="repeat" class="repeat <?php if ($constructor['images'][$key]['repeat'] == 'repeat') echo 'selected'; ?>"> </a>
    </td>
	</tr>
    <?php
}
?>