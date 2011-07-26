<?php __('Footer', 'constructor'); // requeried for correct translation ?>
<table class="form-table">
    <tr>
        <th scope="row" valign="top"  class="th-full"><?php _e('Footer Text', 'constructor'); ?></th>
        <td valign="top" rowspan="2" class="updated quick-links" width="240px">
            <h3><?php _e('Help', 'constructor'); ?></h3>
            <?php _e('Enter the text you want to appear in the Footer (or just enter a space if you don’t want any Footer text)', 'constructor');?>
            <h4>Google Analytics</h4>
            <?php _e('And you can put your Google Analytics code here', 'constructor');?>
        </td>
    </tr>
    <tr>
        <td class="td-full" valign="top">
            <textarea name="constructor[footer][text]" class="big" rows="25" ><?php echo stripslashes($constructor['footer']['text']) ?></textarea>
        </td>
    </tr>
</table>
