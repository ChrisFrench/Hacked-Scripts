<?php __('Colors', 'constructor'); // requeried for correct translation ?>
<script type="text/javascript">
(function($){
$(document).ready(function(){
    initColorPicker('color_header1');
    initColorPicker('color_header2');
    initColorPicker('color_header3');

    initColorPicker('color_bg');
    initColorPicker('color_bg2');
    
    initColorPicker('color_opacity');

    initColorPicker('color_title');
    initColorPicker('color_title2');

    initColorPicker('color_text');
    initColorPicker('color_text2');

    initColorPicker('color_border');
    initColorPicker('color_border2');
});
})(jQuery);
</script>

<input type="hidden" id="constructor-opacity" name="constructor[opacity]" value="<?php echo $constructor['opacity']?>"/>

<input type="hidden" id="constructor-color_title" name="constructor[color][title]" value="<?php echo $constructor['color']['title']?>"/>
<input type="hidden" id="constructor-color_title2" name="constructor[color][title2]" value="<?php echo $constructor['color']['title2']?>"/>

<input type="hidden" id="constructor-color_bg" name="constructor[color][bg]" value="<?php echo $constructor['color']['bg']?>"/>
<input type="hidden" id="constructor-color_bg2" name="constructor[color][bg2]" value="<?php echo $constructor['color']['bg2']?>"/>

<input type="hidden" id="constructor-color_opacity" name="constructor[color][opacity]" value="<?php echo $constructor['color']['opacity']?>"/>

<input type="hidden" id="constructor-color_text" name="constructor[color][text]" value="<?php echo $constructor['color']['text']?>"/>
<input type="hidden" id="constructor-color_text2" name="constructor[color][text2]" value="<?php echo $constructor['color']['text2']?>"/>

<input type="hidden" id="constructor-color_border" name="constructor[color][border]" value="<?php echo $constructor['color']['border']?>"/>
<input type="hidden" id="constructor-color_border2" name="constructor[color][border2]" value="<?php echo $constructor['color']['border2']?>"/>

<input type="hidden" id="constructor-color_header1" name="constructor[color][header1]" value="<?php echo $constructor['color']['header1']?>"/>
<input type="hidden" id="constructor-color_header2" name="constructor[color][header2]" value="<?php echo $constructor['color']['header2']?>"/>
<input type="hidden" id="constructor-color_header3" name="constructor[color][header3]" value="<?php echo $constructor['color']['header3']?>"/>

<table class="form-table">
<tr>
    <th scope="row" valign="top"><?php _e('Opacity', 'constructor'); ?></th>
    <td class="select" id="opacity" >
        <a href="#" title="<?php echo esc_attr(__('None', 'constructor')); ?>" name="none" <?php if($constructor['opacity'] == 'none') echo 'class="selected"'; ?>>
            <div class="none"><?php echo esc_attr(__('None', 'constructor')); ?></div>
        </a>
        <a href="#" title="<?php echo esc_attr(__('Color', 'constructor')); ?>" name="color" <?php if($constructor['opacity'] == 'color') echo 'class="selected"'; ?>>
            <div style="background-color: <?php echo $constructor['color']['opacity'] ?>"><?php echo esc_attr(__('Color', 'constructor')); ?></div>
        </a>
		<br class="clear"/>
        <a href="#" title="<?php echo esc_attr(__('Dark Low', 'constructor')); ?>" name="darklow" <?php if($constructor['opacity'] == 'darklow') echo 'class="selected"'; ?>>
            <div class="darklow"><?php echo esc_attr(__('Dark Low', 'constructor')); ?></div>
        </a>
        <a href="#" title="<?php echo esc_attr(__('Dark', 'constructor')); ?>" name="dark" <?php if($constructor['opacity'] == 'dark') echo 'class="selected"'; ?>>
            <div class="dark"><?php echo esc_attr(__('Dark', 'constructor')); ?></div>
        </a>
        <a href="#" title="<?php echo esc_attr(__('Dark High', 'constructor')); ?>" name="darkhigh" <?php if($constructor['opacity'] == 'darkhigh') echo 'class="selected"'; ?>>
            <div class="darkhigh"><?php echo esc_attr(__('Dark High', 'constructor')); ?></div>
        </a>
		<br class="clear"/>
        <a href="#" title="<?php echo esc_attr(__('Light Low', 'constructor')); ?>" name="lightlow" <?php if($constructor['opacity'] == 'lightlow') echo 'class="selected"'; ?>>
            <div class="lightlow"><?php echo esc_attr(__('Light Low', 'constructor')); ?></div>
        </a>
        <a href="#" title="<?php echo esc_attr(__('Light', 'constructor')); ?>" name="light" <?php if($constructor['opacity'] == 'light') echo 'class="selected"'; ?>>
            <div class="light"><?php echo esc_attr(__('Light', 'constructor')); ?></div>
        </a>
        <a href="#" title="<?php echo esc_attr(__('Light High', 'constructor')); ?>" name="lighthigh" <?php if($constructor['opacity'] == 'lighthigh') echo 'class="selected"'; ?>>
            <div class="lighthigh"><?php echo esc_attr(__('Light High', 'constructor')); ?></div>
        </a>
    </td>
</tr>
<tr>
    <th scope="row" valign="top"><?php _e('Elements Colors', 'constructor'); ?></th>
    <td class="color-selector">
        <div id="color_header1" class="color"><div style="background-color: <?php echo $constructor['color']['header1'] ?>"></div></div>
        - <?php echo esc_attr(__('tags', 'constructor')); ?> H1, H2, HR, A:hover
        <br class="clear"/>
        <div id="color_header2" class="color"><div style="background-color: <?php echo $constructor['color']['header2'] ?>"></div></div>
        - <?php echo esc_attr(__('tags', 'constructor')); ?> H3, H4
        <br class="clear"/>
        <div id="color_header3" class="color"><div style="background-color: <?php echo $constructor['color']['header3'] ?>"></div></div>
        - <?php echo esc_attr(__('tags', 'constructor')); ?> H5, H6, TH
        <br class="clear"/>
        <div id="color_text" class="color"><div style="background-color: <?php echo $constructor['color']['text'] ?>"></div></div>
        - <?php echo esc_attr(__('text', 'constructor')); ?>
        <br class="clear"/>
        <div id="color_text2" class="color"><div style="background-color: <?php echo $constructor['color']['text2'] ?>"></div></div>
        - <?php echo esc_attr(__('text alternative', 'constructor')); ?>
        <br class="clear"/>
        <div id="color_bg" class="color"><div style="background-color: <?php echo $constructor['color']['bg'] ?>"></div></div>
        - <?php echo esc_attr(__('background', 'constructor')); ?>
        <br class="clear"/>
        <div id="color_bg2" class="color"><div style="background-color: <?php echo $constructor['color']['bg2'] ?>"></div></div>
        - <?php echo esc_attr(__('background alternative', 'constructor')); ?>
        <br class="clear"/>
        <div id="color_border" class="color"><div style="background-color: <?php echo $constructor['color']['border'] ?>"></div></div>
        - <?php echo esc_attr(__('border', 'constructor')); ?>
        <br class="clear"/>
        <div id="color_border2" class="color"><div style="background-color: <?php echo $constructor['color']['border2'] ?>"></div></div>
        - <?php echo esc_attr(__('border alternative', 'constructor')); ?>
        <br class="clear"/>
        <div id="color_opacity" class="color"><div style="background-color: <?php echo $constructor['color']['opacity'] ?>"></div></div>
        - <?php echo esc_attr(__('opacity style color', 'constructor')); ?>
        <br class="clear"/>
    </td>
</tr>
</table>