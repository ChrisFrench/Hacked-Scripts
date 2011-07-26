<?php __('Design', 'constructor'); // requeried for correct translation 
?>
<script type="text/javascript">
/* <![CDATA[ */
(function($){
$(document).ready(function(){
    $("#constructor-design-box-radius-slider").slider({
        range: "min",
        value: <?php echo (int)($constructor['design']['box']['radius'])?>,
        min: 0,
        max: 16,
        step:1,
        slide: function(event, ui) {
            $("#constructor-design-box-radius").val(ui.value);
        }
    });
    $("#constructor-design-shadow-x-slider").slider({
        range: "min",
        value: <?php echo (int)($constructor['design']['shadow']['x'])?>,
        min: 0,
        max: 16,
        step:1,
        slide: function(event, ui) {
            $("#constructor-design-shadow-x").val(ui.value);
        }
    });
    $("#constructor-design-shadow-y-slider").slider({
        range: "min",
        value: <?php echo (int)($constructor['design']['shadow']['y'])?>,
        min: 0,
        max: 16,
        step:1,
        slide: function(event, ui) {
            $("#constructor-design-shadow-y").val(ui.value);
        }
    });
    $("#constructor-design-shadow-blur-slider").slider({
        range: "min",
        value: <?php echo (int)($constructor['design']['shadow']['blur'])?>,
        min: 0,
        max: 16,
        step:1,
        slide: function(event, ui) {
            $("#constructor-design-shadow-blur").val(ui.value);
        }
    });
});
})(jQuery);
/* ]]> */
</script>
<table class="form-table">
<tr>
    <th scope="row" valign="top"><?php _e('Borders', 'constructor'); ?></th>
    <td>
		<fieldset>
			<legend>
		        <input type="checkbox" id="constructor-design-box-flag" name="constructor[design][box][flag]" value="1" <?php if ($constructor['design']['box']['flag']) echo 'checked="checked"'; ?> />
                <label for="constructor-design-box-flag"><?php _e('Enable', 'constructor'); ?></label>
			</legend>
			<dl>
				<dt class="slider"><?php _e('Border radius', 'constructor')?>: 
	               <input type="text" id="constructor-design-box-radius" name="constructor[design][box][radius]" value="<?php echo $constructor['design']['box']['radius']?>" />px</dt>
				<dd class="slider"><div id="constructor-design-box-radius-slider"  style="width:200px;"></div></dd>
			</dl>
		</fieldset>
    </td>
    <td rowspan="2" valign="top" class="updated quick-links" width="320px">
        <h3><?php _e('Help', 'constructor'); ?></h3>
        <?php _e('Features for modern browsers (not IE of course)', 'constructor'); ?>
    </td>
</tr>
<tr>
    <th scope="row" valign="top"><?php _e('Shadow', 'constructor'); ?></th>
    <td>
    
		<fieldset>
			<legend>		        
                <input type="checkbox" id="constructor-design-shadow-flag" name="constructor[design][shadow][flag]" value="1" <?php if ($constructor['design']['shadow']['flag']) echo 'checked="checked"'; ?>/>
                <label for="constructor-design-shadow-flag"><?php _e('Enable', 'constructor')?></label>
			</legend>
			<dl>
				<dt class="slider"><?php _e('Horizontal offset', 'constructor')?>: 
	               <input type="text" id="constructor-design-shadow-x" name="constructor[design][shadow][x]" value="<?php echo $constructor['design']['shadow']['x']?>" />px</dt>
				<dd class="slider"><div id="constructor-design-shadow-x-slider"  style="width:200px;"></div></dd>
				<dt class="slider"><?php _e('Vertical offset', 'constructor')?>: 
	               <input type="text" id="constructor-design-shadow-y" name="constructor[design][shadow][y]" value="<?php echo $constructor['design']['shadow']['y']?>" />px</dt>
				<dd class="slider"><div id="constructor-design-shadow-y-slider"  style="width:200px;"></div></dd>
				<dt class="slider"><?php _e('Blur', 'constructor')?>: 
	               <input type="text" id="constructor-design-shadow-blur" name="constructor[design][shadow][blur]" value="<?php echo $constructor['design']['shadow']['blur']?>" />px</dt>
				<dd class="slider"><div id="constructor-design-shadow-blur-slider"  style="width:200px;"></div></dd>
			</dl>
		</fieldset>
    </td>
</tr>
</table>