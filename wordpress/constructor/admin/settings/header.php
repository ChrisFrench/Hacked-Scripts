<?php __('Header', 'constructor'); // requeried for correct translation ?>
<script type="text/javascript">
/* <![CDATA[ */
(function($){
$(document).ready(function(){
    $("#constructor-layout-header-slider").slider({
        range: "min",
        value: <?php echo (int)($constructor['layout']['header'])?>,
        min: 0,
        max: 320,
        step:8,
        slide: function(event, ui) {
            $("#constructor-layout-header").val(ui.value);
        }
    });
});
})(jQuery);
/* ]]> */
</script>
<input type="hidden" id="constructor-title-pos" name="constructor[title][pos]" value="<?php echo $constructor['title']['pos']?>"/>
<input type="hidden" id="constructor-menu-pos" name="constructor[menu][pos]" value="<?php echo $constructor['menu']['pos']?>"/>
<table class="form-table">
<tr>
    <th scope="row" valign="top"><?php _e('Title position', 'constructor'); ?></th>
    <td class="position select" id="title-pos">
        
        <a href="#" title="<?php _e('Top Left', 'constructor'); ?>" name="left top" <?php if($constructor['title']['pos'] == 'left top') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Top Center', 'constructor'); ?>" name="center top" <?php if($constructor['title']['pos'] == 'center top') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Top Right', 'constructor'); ?>" name="right top" <?php if($constructor['title']['pos'] == 'right top') echo 'class="selected"'; ?>> </a>

        <br class="clear"/>
        
        <span name="center left"> </span>
        <span name="center center"> </span>
        <span name="center right"> </span>
        
        <br class="clear"/>

        <a href="#" title="<?php _e('Bottom Left', 'constructor'); ?>" name="left bottom" <?php if($constructor['title']['pos'] == 'left bottom') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Bottom Center', 'constructor'); ?>" name="center bottom" <?php if($constructor['title']['pos'] == 'center bottom') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Bottom Right', 'constructor'); ?>" name="right bottom" <?php if($constructor['title']['pos'] == 'right bottom') echo 'class="selected"'; ?>> </a>
     
        
    </td>
</tr>
<tr>
    <th scope="row" valign="top"><?php _e('Hidden title', 'constructor'); ?></th>
    <td>
		<input type="checkbox" id="constructor-title-hidden" name="constructor[title][hidden]" value="1" <?php if ($constructor['title']['hidden']) echo 'checked="checked"'; ?> />
        <label for="constructor-title-hidden"><?php _e('hide title by CSS', 'constructor'); ?></label>
    </td>
</tr>
<tr>
    <th class="slider">
    	<?php _e('Header height', 'constructor')?>: 
	    <input type="text" id="constructor-layout-header" name="constructor[layout][header]" value="<?php echo $constructor['layout']['header']?>" />px
	</th>
    <td class="slider">
    	<br/>
        <div id="constructor-layout-header-slider"  style="width:200px;"></div>
    </td>
</tr>
<tr>
    <th scope="row" valign="top">
        <?php _e('Header menu', 'constructor'); ?><br/>
        <small><em><?php _e('menu can configured with <a href="widgets.php">widgets</a>, use "header" sidebar', 'constructor'); ?></em></small>
    </th>
    <td>
		<fieldset>
			<legend>
				<input type="checkbox" id="constructor-menu-flag" name="constructor[menu][flag]" value="1" <?php if ($constructor['menu']['flag']) echo 'checked="checked"'; ?> />
                <label for="constructor-menu-flag"><?php _e('Show top menu', 'constructor'); ?></label>
			</legend>
			<dl>
			    <dt><?php _e('Position', 'constructor'); ?></dt>
			    <dd class="position select" id="menu-pos">
                    <a href="#" title="<?php _e('Top Left', 'constructor'); ?>" name="left top" <?php if ($constructor['menu']['pos'] == 'left top') echo 'class="selected"'; ?>> </a>
                    <span name="center top"> </span>
                    <a href="#" title="<?php _e('Top Right', 'constructor'); ?>" name="right top" <?php if ($constructor['menu']['pos'] == 'right top') echo 'class="selected"'; ?>> </a>

                    <br class="clear"/>
            
                    <a href="#" title="<?php _e('Center Left', 'constructor'); ?>" name="left center" <?php if ($constructor['menu']['pos'] == 'left center') echo 'class="selected"'; ?>> </a>
                    <span name="center center"> </span>
                    <a href="#" title="<?php _e('Center Right', 'constructor'); ?>" name="right center" <?php if ($constructor['menu']['pos'] == 'right center') echo 'class="selected"'; ?>> </a>
            
                    <br class="clear"/>
            
                    <a href="#" title="<?php _e('Bottom Left', 'constructor'); ?>" name="left bottom" <?php if ($constructor['menu']['pos'] == 'left bottom') echo 'class="selected"'; ?>> </a>        
                    <span name="center bottom"> </span>
                    <a href="#" title="<?php _e('Bottom Right', 'constructor'); ?>" name="right bottom" <?php if ($constructor['menu']['pos'] == 'right bottom') echo 'class="selected"'; ?>> </a>
                    
                    <br class="clear"/>
			    </dd>
			    <dt><?php _e('Width', 'constructor'); ?></dt>
			    <dd>
			         <input type="checkbox" id="constructor-menu-width" name="constructor[menu][width]" value="100%" <?php if ($constructor['menu']['width'] == '100%') echo 'checked="checked"'; ?>/>
                     <label for="constructor-menu-width"><?php _e('stretch across the width', 'constructor'); ?></label>
                </dd>
                <?php if (function_exists('wp_nav_menu')) : ?>
                <dt><?php _e('Header Menu', 'constructor'); ?></dt>
                <dd><?php _e('You can use <a href="nav-menus.php">navigation menu</a> with name "Header Menu"', 'constructor');?></dd>
                <?php endif; ?>
				<dt><?php _e('Pages', 'constructor'); ?></dt>
				<dd><select name="constructor[menu][pages][depth]" id="constructor-menu-pages">
		                <option value="0" <?php if ($constructor['menu']['pages']['depth'] == 0) echo 'selected="selected"'; ?>><?php _e('Disable pages', 'constructor'); ?></option>
		                <option value="1" <?php if ($constructor['menu']['pages']['depth'] == 1) echo 'selected="selected"'; ?>><?php _e('Show first-level pages', 'constructor'); ?></option>
		                <option value="2" <?php if ($constructor['menu']['pages']['depth'] == 2) echo 'selected="selected"'; ?>><?php _e('Show pages in drop-down menu', 'constructor'); ?></option>
		                <option value="3" <?php if ($constructor['menu']['pages']['depth'] == 3) echo 'selected="selected"'; ?>><?php _e('Show pages in drop-down menu (2-levels)', 'constructor'); ?></option>  
		                <option value="4" <?php if ($constructor['menu']['pages']['depth'] == 4) echo 'selected="selected"'; ?>><?php _e('Show pages in drop-down menu (3-levels)', 'constructor'); ?></option>         
		            </select>
					<br/>
                    <label for="constructor-menu-pages-exclude"><?php _e('Exclude:', 'constructor'); ?></label>
                    <input type="text" name="constructor[menu][pages][exclude]" id="constructor-menu-pages-exclude" value="<?php echo $constructor['menu']['pages']['exclude']; ?>"/>
                    <span><?php _e('(IDs, coma separated)', 'constructor'); ?></span>
                    </dd>
                <dt><?php _e('Categories', 'constructor'); ?></dt>
				<dd>
					<input type="checkbox" id="constructor-menu-categories-group" name="constructor[menu][categories][group]" value="1" <?php if ($constructor['menu']['categories']['group']) echo 'checked="checked"'; ?>/>
                    <label for="constructor-menu-categories-group"><?php _e('Group categories in one menu item', 'constructor'); ?></label>
					<br/>
			        <select name="constructor[menu][categories][depth]" id="constructor-menu-categories">
		                <option value="0" <?php if ($constructor['menu']['categories']['depth'] == 0) echo 'selected="selected"'; ?>><?php _e('Disable categories', 'constructor'); ?></option>
		                <option value="1" <?php if ($constructor['menu']['categories']['depth'] == 1) echo 'selected="selected"'; ?>><?php _e('Show first-level categories', 'constructor'); ?></option>
		                <option value="2" <?php if ($constructor['menu']['categories']['depth'] == 2) echo 'selected="selected"'; ?>><?php _e('Show categories in drop-down menu', 'constructor'); ?></option>
		                <option value="3" <?php if ($constructor['menu']['categories']['depth'] == 3) echo 'selected="selected"'; ?>><?php _e('Show categories in drop-down menu (2-levels)', 'constructor'); ?></option>
		                <option value="4" <?php if ($constructor['menu']['categories']['depth'] == 4) echo 'selected="selected"'; ?>><?php _e('Show categories in drop-down menu (3-levels)', 'constructor'); ?></option>
		            </select>
					<br/>
                    <label for="constructor-menu-categories-exclude"><?php _e('Exclude:', 'constructor'); ?></label>
                    <input type="text" name="constructor[menu][categories][exclude]" id="constructor-menu-categories-exclude" value="<?php echo $constructor['menu']['categories']['exclude']; ?>"/>
                    <span><?php _e('(IDs, coma separated)', 'constructor'); ?></span>
					<br/>
                    <label for="constructor-menu-categories-title"><?php _e('Custom title:', 'constructor'); ?></label>
                    <input type="text" name="constructor[menu][categories][title]" id="constructor-menu-categories-title" value="<?php echo $constructor['menu']['categories']['title']; ?>"/>
					<br/>
			    </dd>
                <dt><?php _e('Links', 'constructor'); ?></dt>
				<dd>
					<input type="checkbox" id="constructor-menu-home" name="constructor[menu][home]" value="1" <?php if ($constructor['menu']['home']) echo 'checked="checked"'; ?>/>
			        <label for="constructor-menu-home"><?php _e('Show link to home page', 'constructor'); ?></label>
			        <br/>
			        <input type="checkbox" id="constructor-menu-rss" name="constructor[menu][rss]" value="1" <?php if ($constructor['menu']['rss']) echo 'checked="checked"'; ?>/>
                    <label for="constructor-menu-rss"><?php _e('Show link to RSS feed', 'constructor'); ?></label>
				</dd>
				<dt><?php _e('Tools', 'constructor'); ?></dt>
				<dd>
				   <input type="checkbox" id="constructor-menu-search" name="constructor[menu][search]" value="1" <?php if ($constructor['menu']['search']) echo 'checked="checked"'; ?>/>
                   <label for="constructor-menu-search"><?php _e('Show search form', 'constructor'); ?></label>
			   </dd>
			</dl>
		</fieldset>
        <?php
        /*
        // TODO: Requeried cookie support in constructor.js
        <br/>
        <input type="checkbox" id="constructor-menu-size" name="constructor[menu][size]" value="1" <?php if ($constructor['menu']['size']) echo 'checked="checked"'; ?>/>
        <label for="constructor-menu-size"><?php _e('Show font resizer', 'constructor'); ?></label>
        */ 
        /*
        // TODO: Theme switcher
        <br/>
        <input type="checkbox" id="constructor-menu-theme" name="constructor[menu][theme]" value="1" <?php if ($constructor['menu']['theme']) echo 'checked="checked"'; ?>/>
        <label for="constructor-menu-theme"><?php _e('Theme switcher', 'constructor'); ?></label>
        */ ?>
    </td>
</tr>
</table>