<?php __('Themes', 'constructor'); // requeried for correct translation ?>
<script type="text/javascript">
(function($){
$(document).ready(function(){
    $("#constr-themes div").hover(function(){
        $(this).toggleClass('hover');
    },function(){
        $(this).toggleClass('hover');
    });

    $("#constr-themes div:not(.selected)").click(function(){
        if (confirm('All data was reloaded from theme config. Continue?..')) {
            $('#constructor-theme').val($(this).attr('title'));
            $('#constructor-theme-reload').val(1);
            $("#constructor-form").submit();
        }
    });
});
})(jQuery);
</script>

<input type="hidden" id="constructor-theme" name="constructor[theme]" value="<?php echo $admin['theme']?>"/>
<input type="hidden" id="constructor-theme-reload" name="constructor[theme-reload]" value="0"/>

<?php
// load themes
$themes = scandir(CONSTRUCTOR_DIRECTORY.'/themes/');

$themes = array_diff($themes, array( '.','..','.svn','.htaccess','readme.txt'));

foreach ($themes as $theme) :
      // don't show files and hidden directories
      if (!is_dir(CONSTRUCTOR_DIRECTORY.'/themes/'.$theme) or 
          substr($theme, 0, 1) == '.') {
          continue;
      }

      $img = null;
      if (file_exists(CONSTRUCTOR_DIRECTORY.'/themes/'.$theme.'/style.css')) {
          $data = get_theme_data(CONSTRUCTOR_DIRECTORY.'/themes/'.$theme.'/style.css');

          if (file_exists(CONSTRUCTOR_DIRECTORY.'/themes/'.$theme.'/screenshot.png')) {
              $img = CONSTRUCTOR_DIRECTORY_URI .'/themes/'.$theme.'/screenshot.png';
          }
          if (empty($data['URI'])) {
              $data['URI'] = '#';
          }
      } else {
          $data = array(
              'Title' => $theme,
              'Description' => __('File "style.css" is not exists','constructor'),
              'Author' => __('Anonymous','constructor'),
              'Version' => '0.0',
              'URI' => '#'
          );

      }
?>

    <div <?php if ($admin['theme'] == $theme) echo 'class="selected"'; ?> title="<?php echo $theme ?>">
        <span>
            <?php if ($img): ?>
            <img src="<?php echo $img ;?>" />
            <?php endif; ?>
        </span>
        <strong><a href="<?php echo $data['URI']?>" title="<?php echo $data['Title'] ?>"><?php echo $data['Title'] ?></a></strong> <em>@<?php echo $data['Author'] ?></em>- <?php _e('version', 'constructor'); ?> <?php echo $data['Version'] ?>
        
        <p><?php echo $data['Description'] ?></p>
        
    </div>
<?php endforeach; ?>
<br class="clear"/>