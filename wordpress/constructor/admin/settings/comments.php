<?php __('Comments', 'constructor'); // requeried for correct translation ?>
<script type="text/javascript">
/* <![CDATA[ */
(function($){
$(document).ready(function(){
    $("#constructor-avatar-size-slider").slider({
        range: "min",
        value: <?php echo (int)($constructor['comments']['avatar']['size'])?>,
        min: 16,
        max: 128,
        step:8,
        slide: function(event, ui) {
            $("#constructor-comments-avatar-size").val(ui.value);
        }
    });
});
})(jQuery);
/* ]]> */
</script>
<input type="hidden" id="constructor-comments-avatar-pos" name="constructor[comments][avatar][pos]" value="<?php echo $constructor['comments']['avatar']['pos']?>"/>
<table class="form-table">

<tr>
    <th class="slider">
    	<?php _e('Avatar size', 'constructor')?>: 
	    <input type="text" id="constructor-comments-avatar-size" name="constructor[comments][avatar][size]" value="<?php echo $constructor['comments']['avatar']['size']?>" />px
	</th>
    <td class="slider">
    	<br/>
        <div id="constructor-avatar-size-slider"  style="width:200px;"></div>
    </td>
</tr>

<tr>
	<td class="position select" id="comments-avatar-pos">
		<p><?php _e('Thumbnail position', 'constructor'); ?></p>
        <a href="#" title="<?php _e('Left', 'constructor'); ?>" name="left" <?php if($constructor['comments']['avatar']['pos'] == 'left') echo 'class="selected"'; ?>> </a>
        <a href="#" title="<?php _e('Right', 'constructor'); ?>" name="right" <?php if($constructor['comments']['avatar']['pos'] == 'right') echo 'class="selected"'; ?>> </a>
        <br class="clear"/>
    </td>
</tr>
</table>