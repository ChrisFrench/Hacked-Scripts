<?php __('CSS', 'constructor'); // requeried for correct translation 
$css_file = CONSTRUCTOR_DIRECTORY .'/themes/'.$admin['theme'].'/style.css';
?>
<table class="form-table">
<?php if (!is_writable($css_file)) : ?>
    <tr>
        <th scope="row" valign="top" class="th-full updated"><?php printf(__('<font color="red"><b>Warning!</b></font>: File "%s" is not writable.', 'constructor'), $css_file); ?></th>
    </tr>
    <tr>
        <td class="td-full"><textarea name="null[css]" class="big" readonly="readonly"><?php echo file_get_contents($css_file)?></textarea></td>
    </tr>
<?php else: ?>
    <tr>
        <td class="td-full" valign="top"><textarea name="constructor[css]" class="big"><?php echo file_get_contents($css_file)?></textarea></td>
        <td valign="top" class="updated quick-links" width="320px">
        <h3><?php _e('Help', 'constructor'); ?></h3>
        <?php printf(__('CSS is Cascading Style Sheets - read manual for beginners <a href="%1$s">%1$s</a>', 'constructor'), 'http://www.w3schools.com/css/'); ?>
        <h4><?php _e('CSS rules', 'constructor'); ?></h4>
        <dl>
            <dt>color</dt>
            <dd>red, green, blue, #ff0000, #00ff00, #0000ff, etc.</dd>
            <dt>font-size</dt>
            <dd>14px, 1.2em, etc.</dd>
            <dt>font-weight</dt>
            <dd>normal, bold, 400, 700, etc.</dd>
            <dt>text-decoration</dt>
            <dd>none, capitalize, uppercase, lowercase, underline, etc.</dd>
            <dt>text-align</dt>
            <dd>left, center, right</dd>
            <dt>border</dt>
            <dd>0, solid 1px red, dotted 2px green, etc.</dd>
        </dl>
        <h4><?php _e('CSS example', 'constructor'); ?></h4>
        <?php _e('Title');?>
<pre>#name a{
    color:red !important;;
}
#description{
    color:green !important;;
}
</pre>
        <?php _e('Header menu');?>
<pre>#menu li a, #menu li span{
    font-size:1.2em;
}</pre>
        <?php _e('Sidebar');?>
<pre>.sidebar{
    font-size:1.4em;
}</pre>
        <?php _e('Content');?>
<pre>.hentry .title { /* post title */
    border:0;
}
.hentry .entry { /* content */
    font-size:1.6em
}
.hentry .footer { /* footer links */
    color:#ccc /* it's gray color */
}
</pre>
        </td>
    </tr>
<?php endif; ?>
</table>