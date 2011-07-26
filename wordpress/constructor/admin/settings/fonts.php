<?php __('Fonts', 'constructor'); // requeried for correct translation ?>
<script type="text/javascript">
/* <![CDATA[ */
(function($){
$(document).ready(function(){
    $(".constructor-font-family").change(function(){
		var font = $(this).find("option:selected").html();		
		$('#font-example').css({'font-family':font});
	});
});
})(jQuery);
/* ]]> */
</script>
<table class="form-table">
    <tr>
        <th scope="row" valign="top" class="th-full"><?php _e('Title', 'constructor'); ?></th>
		<td valign="top" class="color-selector">
		    <?php $this->getFontColor('title') ?>
		    <?php $this->getFontFamily('title') ?>
		    <?php $this->getFontSize('title') ?><br/>
		    <?php _e('Font Weight', 'constructor') ?>: <?php $this->getFontWeight('title') ?>
		    <?php _e('Text Decoration', 'constructor') ?>: <?php $this->getFontTransform('title') ?>
		</td>
		<td rowspan="4" valign="top" class="updated quick-links" width="320px">
		
		
		<h3><?php _e('Font Family Example', 'constructor') ?></h3>
		<p id="font-example"><?php
		_e('The quick brown fox jumps over the lazy dog', 'constructor');
		?></p>
		<h3><?php _e('Font Weight', 'constructor') ?></h3>
		<p><?php _e('Defines from thin to thick characters. 400 is the same as "normal", and 700 is the same as "bold"', 'constructor') ?>		 
		</p>
		
		<h3><?php _e('Text Decoration', 'constructor') ?></h3>
		<ul>
		  <li><strong>none</strong> - <?php _e('No capitalization. The text renders as it is. This is default', 'constructor') ?></li>
		  <li><strong>capitalize</strong> - <?php _e('Transforms the first character of each word to uppercase', 'constructor') ?></li>
		  <li><strong>uppercase</strong> - <?php _e('Transforms all characters to uppercase', 'constructor') ?></li>
		  <li><strong>lowercase</strong> - <?php _e('Transforms all characters to lowercase', 'constructor') ?></li>
		</ul>
		</td>
	</tr>
    <tr>
        <th scope="row" valign="top" class="th-full"><?php _e('Description', 'constructor'); ?></th>
		<td valign="top" class="color-selector">
		    <?php $this->getFontColor('description') ?>
		    <?php $this->getFontFamily('description') ?>
		    <?php $this->getFontSize('description') ?><br/>
		    <?php _e('Font Weight', 'constructor') ?>: <?php $this->getFontWeight('description') ?>
		    <?php _e('Text Decoration', 'constructor') ?>: <?php $this->getFontTransform('description') ?>
		</td>
	</tr>
    <tr>
        <th scope="row" valign="top" class="th-full"><?php _e('Headers', 'constructor'); ?></th>
        <td valign="top">
            <?php $this->getFontFamily('header') ?>
        </td>
    </tr>
    <tr>
        <th scope="row" valign="top" class="th-full"><?php _e('Content', 'constructor'); ?></th>
        <td valign="top">
            <?php $this->getFontFamily('content') ?>
        </td>
    </tr>
</table>