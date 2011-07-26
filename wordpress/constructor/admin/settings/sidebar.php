<?php __('Sidebar', 'constructor'); // requeried for correct translation ?>
<script type="text/javascript">
/* <![CDATA[ */
(function($){
$(document).ready(function(){
    $("#constructor-layout-width-slider").slider({
        range: "min",
        value: <?php echo (int)$constructor['layout']['width']?>,
        min: 640,
        max: 1280,
        step:8,
        slide: function(event, ui) {
            $("#constructor-layout-width").val(ui.value);
        }
    });

    $("#constructor-layout-sidebar-slider").slider({
        range: "min",
        value: <?php echo (int)$constructor['layout']['sidebar']?>,
        min: 160,
        max: 420,
        step:8,
        slide: function(event, ui) {
            $("#constructor-layout-sidebar").val(ui.value);
        }
    });


    $("#constructor-layout-extra-slider").slider({
        range: "min",
        value: <?php echo (int)$constructor['layout']['extra']?>,
        min: 160,
        max: 420,
        step:8,
        slide: function(event, ui) {
            $("#constructor-layout-extra").val(ui.value);
        }
    });
});
})(jQuery);
/* ]]> */
</script>
<input type="hidden" id="constructor-sidebar" name="constructor[sidebar]" value="<?php echo $constructor['sidebar']?>"/>
<table class="form-table">
<tr>
	<tr>
	    <th rowspan="3"><?php _e('Width', 'constructor')?></th>
        <td class="slider">
            <p>
                <label for="constructor-layout-width"><?php _e('Container Width', 'constructor'); ?>:</label>
                <input type="text" id="constructor-layout-width" name="constructor[layout][width]" value="<?php echo $constructor['layout']['width']?>" style="border:0; color:#21759B; font-weight:bold; width:42px" /> px
            </p>
            <div id="constructor-layout-width-slider"  style="width:600px;"></div>
        </td>
	</tr>
	<tr>
	    <td class="slider">
	        <p>
	            <label for="constructor-layout-sidebar"><?php _e('Sidebar Width', 'constructor'); ?>:</label>
	            <input type="text" id="constructor-layout-sidebar" name="constructor[layout][sidebar]" value="<?php echo $constructor['layout']['sidebar']?>" style="border:0; color:#21759B; font-weight:bold; width:42px" /> px
	        </p>
	        <div id="constructor-layout-sidebar-slider"  style="width:600px;"></div>
	    </td>
	</tr>
	<tr>
	    <td class="slider">
	        <p>
	            <label for="constructor-layout-extra"><?php _e('Extra Bar Width', 'constructor'); ?>:</label>
	            <input type="text" id="constructor-layout-extra" name="constructor[layout][extra]" value="<?php echo $constructor['layout']['extra']?>" style="border:0; color:#21759B; font-weight:bold; width:42px" /> px
	        </p>
	        <div id="constructor-layout-extra-slider"  style="width:600px;"></div>
	    </td>
	</tr>
    <th scope="row" valign="top"><?php _e('Sidebar', 'constructor'); ?></th>
    <td class="select" id="sidebar">
        <a href="#" title="<?php echo esc_attr(__('Left', 'constructor')); ?>" name="left" <?php if($constructor['sidebar'] == 'left') echo 'class="selected"'; ?>>
            <img src="<?php echo CONSTRUCTOR_DIRECTORY_URI ?>/admin/images/sidebar-left.png" alt="<?php echo esc_attr(__('Left', 'constructor')); ?>" />
        </a>
        <a href="#" title="<?php echo esc_attr(__('Right', 'constructor')); ?>" name="right" <?php if($constructor['sidebar'] == 'right') echo 'class="selected"'; ?>>
            <img src="<?php echo CONSTRUCTOR_DIRECTORY_URI ?>/admin/images/sidebar-right.png" alt="<?php echo esc_attr(__('Right', 'constructor')); ?>" />
        </a>
        <br class="clear"/>
        <a href="#" title="<?php echo esc_attr(__('Two', 'constructor')); ?>" name="two" <?php if($constructor['sidebar'] == 'two') echo 'class="selected"'; ?>>
            <img src="<?php echo CONSTRUCTOR_DIRECTORY_URI ?>/admin/images/sidebar-two.png" alt="<?php echo esc_attr(__('Two', 'constructor')); ?>" />
        </a>
        <a href="#" title="<?php echo esc_attr(__('None', 'constructor')); ?>" name="none" <?php if($constructor['sidebar'] == 'none') echo 'class="selected"'; ?>>
            <img src="<?php echo CONSTRUCTOR_DIRECTORY_URI ?>/admin/images/sidebar-none.png" alt="<?php echo esc_attr(__('None', 'constructor')); ?>" />
        </a>
        <br class="clear"/>
        <a href="#" title="<?php echo esc_attr(__('Two Right', 'constructor')); ?>" name="two-right" <?php if($constructor['sidebar'] == 'two-right') echo 'class="selected"'; ?>>
            <img src="<?php echo CONSTRUCTOR_DIRECTORY_URI ?>/admin/images/sidebar-two-right.png" alt="<?php echo esc_attr(__('Two Right', 'constructor')); ?>" />
        </a>
        <a href="#" title="<?php echo esc_attr(__('Two Left', 'constructor')); ?>" name="two-left" <?php if($constructor['sidebar'] == 'two-left') echo 'class="selected"'; ?>>
            <img src="<?php echo CONSTRUCTOR_DIRECTORY_URI ?>/admin/images/sidebar-two-left.png" alt="<?php echo esc_attr(__('Two Left', 'constructor')); ?>" />
        </a>
    </td>
</tr>
</table>