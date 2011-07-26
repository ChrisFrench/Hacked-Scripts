<?php __('Content', 'constructor'); // requeried for correct translation ?>

<table class="form-table">
<tr>
    <th scope="row" valign="top"><?php _e('Posts', 'constructor'); ?></th>
    <td>
        <input type="checkbox" id="constructor-author" name="constructor[content][author]" value="1" <?php if (isset($constructor['content']['author']) && $constructor['content']['author'] == 1) echo 'checked="checked"'; ?> />
        <label for="constructor-author"><?php _e('Show author link', 'constructor'); ?></label>
    </td>
    <td rowspan="2" valign="top" class="updated quick-links" width="320px">
    <h3><?php _e('Help', 'constructor'); ?></h3>
    <?php _e('You can use short code [widgets] in your post, and can configured with <a href="widgets.php">widgets</a> (use "In Posts" sidebar)', 'constructor')?>
    <br />
    <br />
    <?php _e('Available <a href="http://code.google.com/p/wp-constructor/wiki/ConstructorShortcodes" title="Constructor Short Codes">short codes</a>:', 'constructor')?>
    <ul>
        <li>[attachments <em>type=image</em> <em>preview=1</em>]</li>
        <li>[subpages]</li>
        <li>[widgets]</li>
    </ul>
    
    </td>
</tr>


<tr>
    <th scope="row" valign="top">
        <?php _e('Content widgets place', 'constructor'); ?><br/>
        <small><em><?php _e('can configured with <a href="widgets.php">widgets</a>, use "After N Post" sidebar', 'constructor'); ?></em></small>
    </th>
    <td>
		<fieldset>
			<legend>
				<input type="checkbox" id="constructor-content-widget-flag" name="constructor[content][widget][flag]" value="1" <?php if ($constructor['content']['widget']['flag']) echo 'checked="checked"'; ?> />
                <label for="constructor-menu-flag"><?php _e('Show widgets place', 'constructor'); ?></label>
			</legend>
			<dl>
				<dt><?php _e('Position', 'constructor'); ?></dt>
				<dd><select name="constructor[content][widget][after]" id="constructor-content-widget-after">
		                <option value="1" <?php if ($constructor['content']['widget']['after'] == 1) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),1); ?></option>
		                <option value="2" <?php if ($constructor['content']['widget']['after'] == 2) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),2); ?></option>
		                <option value="3" <?php if ($constructor['content']['widget']['after'] == 3) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),3); ?></option>
		                <option value="4" <?php if ($constructor['content']['widget']['after'] == 4) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),4); ?></option>
		                <option value="5" <?php if ($constructor['content']['widget']['after'] == 5) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),5); ?></option>
		                <option value="6" <?php if ($constructor['content']['widget']['after'] == 6) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),6); ?></option>
		                <option value="7" <?php if ($constructor['content']['widget']['after'] == 7) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),7); ?></option>
		                <option value="8" <?php if ($constructor['content']['widget']['after'] == 8) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),8); ?></option>
		                <option value="9" <?php if ($constructor['content']['widget']['after'] == 9) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),9); ?></option>
		                <option value="10" <?php if ($constructor['content']['widget']['after'] == 10) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),10); ?></option>
		                       
		            </select></dd>			
			</dl>
		</fieldset>
    </td>
</tr>
</table>