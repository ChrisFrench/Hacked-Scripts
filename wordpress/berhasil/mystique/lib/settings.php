<?php /* Mystique/digitalnature */

// default theme settings
function mystique_default_settings(){
  $defaults = array(
    'theme_version' => THEME_VERSION,
    'layout' => 'col-2-right',
    'dimensions' => array('fixed' => array('col-2-left' => '310', 'col-2-right' => '630', 'col-3' => '230;710', 'col-3-left' => '230;460', 'col-3-right' => '480;710'),
                          'fluid' => array('col-2-left' => '30', 'col-2-right' => '70', 'col-3' => '25;75', 'col-3-left' => '25;50', 'col-3-right' => '50;75')),
    'page_width' => 'fixed',
    'color_scheme' => 'green',
    'font_style' => 0,
    'footer_content' => '[credit] <br /> [rss] [xhtml] [top]',
    'navigation' => 'pages',
    'navigation_links' => 'Blogroll',
    'exclude_home' => '',
    'exclude_pages' => '',
    'exclude_categories' => '',
    'post_title' => 1,
    'post_info' => 1,
    'post_tags' => 1,
    'post_content' => 1,
    'post_content_length' => 'f',
    'post_thumb' => '64x64',
    'post_thumb_auto' => 1,
    'post_single_print' => 1,
    'post_single_meta' => 1,
    'post_single_share' => 1,
    'post_single_author' => 0,
    'post_single_tags' => 1,
    'post_single_related' => 1,
    'read_more' => 0,
    'seo' => 1,
    'jquery' => 1,
    'ajax_commentnavi' => 1,
    'lightbox' => 1,
    'user_css' => '',
    'logo' => '',
    'background' => '',
    'background_color' => '000000',
    'ad_code_1' => '',
    'ad_code_2' => '',
    'ad_code_3' => '',
    'ad_code_4' => '',
    'ad_code_5' => '',
    'ad_code_6' => '',
    'functions' => '<?php'.str_repeat(PHP_EOL, 3),
    'remove_settings' => 0);

  $defaults = apply_filters("mystique_default_settings", $defaults); // check for new default setting entries from extensions
  return $defaults;
}

function font_styles(){
 // default font styles
 return array(
  0 => array('code' => '"Segoe UI",Calibri,"Myriad Pro",Myriad,"Trebuchet MS",Helvetica,Arial,sans-serif',
             'desc' => 'Segoe UI (Windows Vista/7)'),

  1 => array('code' => '"Helvetica Neue",Helvetica,Arial,Geneva,"MS Sans Serif",sans-serif',
             'desc' => 'Helvetica/Arial'),

  2 => array('code' => 'Georgia,"Nimbus Roman No9 L",serif',
             'desc' => 'Georgia (sans serif)'),

  3 => array('code' => '"Lucida Grande","Lucida Sans","Lucida Sans Unicode","Helvetica Neue",Helvetica,Arial,Verdana,sans-serif',
             'desc' => 'Lucida Grande/Sans (Mac/Windows)')
  // you can add more font styles here based on the above entries (4, 5, 6 etc...)
 );
}

function mystique_theme_install_notification(){ ?>
  <div class='updated fade'><p><?php printf(__('You can configure Mystique from the <a%s>theme settings</a> page.','mystique'),' href="themes.php?page=theme-settings"'); ?></p></div>
<?php
}

function mystique_verify_options(){
  $default_settings = mystique_default_settings();
  $current_settings = get_option('mystique');
  if(!$current_settings):
   mystique_setup_options();
   add_action('admin_notices', 'mystique_theme_install_notification');
  else:
   // only go further if the theme version from the database differs from the one in the theme files
   if (version_compare($current_settings['theme_version'], THEME_VERSION, '!=')):
     // check for new options
     foreach($default_settings as $option=>$value):
      if(!array_key_exists($option, $current_settings)) $current_settings[$option] = $default_settings[$option];
     endforeach;

    // update theme version
    $current_settings['theme_version'] = THEME_VERSION;
    update_option('mystique' , $current_settings);
    do_action('mystique_verify_options');
   endif;
  endif;
}

function mystique_setup_options() {
  mystique_remove_options();
  $default_settings = mystique_default_settings();
  update_option('mystique' , $default_settings);
  do_action('mystique_setup_options');
}

function mystique_remove_options() {
  delete_option('mystique');
  delete_option('mystique-twitter');
  do_action('mystique_remove_options');
}

function get_mystique_option($option) {
  $get_mystique_options = get_option('mystique');
  return $get_mystique_options[$option];
}

function print_mystique_option($option) {
  $get_mystique_options = get_option('mystique');
  echo $get_mystique_options[$option];
}

function mystique_is_color_dark($hex){

  // hex to rgb first
  $dec = hexdec($hex);
  $r = 0xFF & ($dec >> 0x10);
  $g = 0xFF & ($dec >> 0x8);
  $b = 0xFF & $dec;

  // rgb to hsb (we only need b)
  $max = max(array($r, $g, $b));
  $min = min(array($r, $g, $b));
  $diff = $max - $min;
  $br = $max / 255;
  if ($max > 0) $s = $diff / $max; else $s = 0;

  $s = round($s * 100);    // saturation
  $br = round($br * 100);  // brightness
  return (($br < 66)  || ($s > 66) ? true : false);
}

// user css, dynamic way
function mystique_css(){
  if($_GET['mystique'] == 'css'):

   $mystique_options = get_option('mystique');
   $font_styles = font_styles();
   header('Content-type: text/css');
   header("Expires: Mon, 25 Dec 1989 02:00:00 GMT");
   header("Cache-Control: no-cache");
   header("Pragma: no-cache");

   echo '@import "'.THEME_URL.'/color-'.$mystique_options['color_scheme'].'.css";'.PHP_EOL;
   do_action('mystique_css');

   // font styles
   if($mystique_options['font_style'] != 0)
    echo '*{font-family:'.$font_styles[$mystique_options['font_style']]['code'].';}'.PHP_EOL;

   // column dimensions
   $unit = ($mystique_options['page_width'] == 'fluid') ? '%' : 'px';
   $gs = ($mystique_options['page_width'] == 'fluid') ? '100' : '940';
   switch ($mystique_options['layout']):
    case 'col-2-left':
      $s = explode(";", $mystique_options['dimensions'][$mystique_options['page_width']]['col-2-left']);
      echo 'body.col-2-left #primary-content{width:'.($gs-$s[0]).$unit.';left:'.($s[0]).$unit.';}'.PHP_EOL;
      echo 'body.col-2-left #sidebar{width:'.$s[0].$unit.';left:'.(-($gs-$s[0])).$unit.';}'.PHP_EOL;
      break;
    case 'col-2-right':
      $s = explode(";", $mystique_options['dimensions'][$mystique_options['page_width']]['col-2-right']);
      echo 'body.col-2-right #primary-content{width:'.($gs-($gs-$s[0])).$unit.';left:0;}'.PHP_EOL;
      echo 'body.col-2-right #sidebar{width:'.($gs-$s[0]).$unit.';}'.PHP_EOL;
      break;
    case 'col-3':
      $s = explode(";", $mystique_options['dimensions'][$mystique_options['page_width']]['col-3']);
      echo 'body.col-3 #primary-content{width:'.($gs-$s[0]-($gs-$s[1])).$unit.';left:'.$s[0].$unit.';}'.PHP_EOL;
      echo 'body.col-3 #sidebar{width:'.($gs-$s[1]).$unit.';}'.PHP_EOL;
      echo 'body.col-3 #sidebar2{width:'.$s[0].$unit.';left:'.(-($gs-$s[0]-($gs-$s[1]))).$unit.';}'.PHP_EOL;
      break;
    case 'col-3-left':
      $s = explode(";", $mystique_options['dimensions'][$mystique_options['page_width']]['col-3-left']);
      echo 'body.col-3-left #primary-content{width:'.($gs-$s[1]).$unit.';left:'.$s[1].$unit.';}'.PHP_EOL;
      echo 'body.col-3-left #sidebar{width:'.$s[0].$unit.';left:'.(-($gs-$s[0])).$unit.';}'.PHP_EOL;
      echo 'body.col-3-left #sidebar2{width:'.($s[1]-$s[0]).$unit.';left:'.(-($gs-$s[1])+$s[0]).$unit.';}'.PHP_EOL;
      break;
    case 'col-3-right':
      $s = explode(";", $mystique_options['dimensions'][$mystique_options['page_width']]['col-3-right']);
      echo 'body.col-3-right #primary-content{width:'.$s[0].$unit.';}'.PHP_EOL;
      echo 'body.col-3-right #sidebar{width:'.($gs-$s[1]).$unit.';}'.PHP_EOL;
      echo 'body.col-3-right #sidebar2{width:'.($s[1]-$s[0]).$unit.';}'.PHP_EOL;
      break;
   endswitch;

   if($mystique_options['background']) echo '#page{background-image:none;}'.PHP_EOL.'body{background-image:url("'.$mystique_options['background'].'");background-repeat:no-repeat;background-position:center top;}'.PHP_EOL;
   if(($mystique_options['background_color']) && (strpos($mystique_options['background_color'],'000000') === false)):
    echo 'body{background-color:#'.$mystique_options['background_color'].';}'.PHP_EOL;
    if (!$mystique_options['background']) echo 'body,#page{background-image:none;}'.PHP_EOL;
   endif;

   $thumb_size = explode('x',get_mystique_option('post_thumb'));
   echo '.post-info.with-thumbs{margin-left:'.($thumb_size[0]+30).'px;}'.PHP_EOL;

   if($mystique_options['user_css']) echo $mystique_options['user_css'].PHP_EOL;
   if (is_single() || is_page()):
     global $post;
     $css = get_post_meta($post->ID, 'css', true);
     if (!empty($css)) echo $css.PHP_EOL;
   endif;
   die();
  endif;
}

// dynamic js
function mystique_jquery_init(){
  if($_GET['mystique'] == 'jquery_init'):
   $mystique_options = get_option('mystique');
   header("content-type: application/x-javascript");
   header("Expires: Mon, 25 Dec 1989 02:00:00 GMT");
   header("Cache-Control: no-cache");
   header("Pragma: no-cache");

   ?>
    // some global variables
    var ajaxComments = <?php echo (int)$mystique_options['ajax_commentnavi']; ?>;

    // init
    jQuery(document).ready(function ($) {
    if (isIE6) {
      jQuery('#page').append("<div class='crap-browser-warning'><?php _e("You're using a old and buggy browser. Switch to a <a href='http://www.mozilla.com/firefox/'>normal browser</a> or consider <a href='http://www.microsoft.com/windows/internet-explorer'>upgrading your Internet Explorer</a> to the latest version","mystique"); ?></div>");
    }
    jQuery('#navigation').superfish({ autoArrows: true });

    webshot("a.websnapr", "webshot");

    <?php if($mystique_options['lightbox']): // enable fancyBox for any link with rel="lightbox" and on links which references end in image extensions (jpg, gif, png) ?>
    jQuery("a[rel='lightbox'], a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png'], a[href$='.JPG'], a[href$='.JPEG'], a[href$='.GIF'], a[href$='.PNG']").fancyboxlite({
      'zoomSpeedIn': 333,
      'zoomSpeedOut': 333,
      'zoomSpeedChange': 133,
      'easingIn': 'easeOutQuart',
      'easingOut': 'easeInQuart',
      'overlayShow': true,
      'overlayOpacity': 0.75
    });
    <?php endif; ?>


    // layout controls
    fontControl("#pageControls", "body", 10, 18);
    //pageWidthControl("#pageControls", ".page-content", '100%', '940px', '1200px');
    webshot("a.websnapr", "webshot");
    jQuery(".post-tabs").minitabs({
      content: '.sections',
      nav: '.tabs',
      effect: 'top',
      speed: 333,
      cookies: false
    });

    jQuery(".sidebar-tabs").minitabs({
      content: '.sections',
      nav: '.box-tabs',
      effect: 'slide',
      speed: 150
    });

    jQuery("ul.menuList .cat-item").bubble({
      timeout: 6000
    });
    jQuery(".shareThis, .bubble-trigger").bubble({
      offset: 16,
      timeout: 0
    });

    jQuery("#pageControls").bubble({
      offset: 30
    });
    jQuery('ul.menuList li a').nudge({
      property: 'padding',
      direction: 'left',
      amount: 6,
      duration: 166
    });
    jQuery('a.nav-extra').nudge({
      property: 'marginTop',
      direction: '',
      amount: -18,
      duration: 166
    });

    // fade effect
    if (!isIE) {
      jQuery('.fadeThis').append('<span class="hover"></span>').each(function () {
        var jQueryspan = jQuery('> span.hover', this).css('opacity', 0);
        jQuery(this).hover(function () {
          jQueryspan.stop().fadeTo(333, 1);
        },
        function () {
          jQueryspan.stop().fadeTo(333, 0);
        });
      });
    }
    jQuery("#footer-blocks.withSlider").loopedSlider();
    jQuery("#featured-content.withSlider").loopedSlider({
      autoStart: <?php echo (int)get_mystique_option('featured_timeout')*1000; ?>,
      autoHeight: false
    }); // scroll to top
    jQuery("a#goTop").click(function () {
      jQuery('html').animate({
        scrollTop: 0
      },
      'slow');
    });
    jQuery('.clearField').clearField({
      blurClass: 'clearFieldBlurred',
      activeClass: 'clearFieldActive'
    });

    setup_comments();

    if(redirectReadMore) setup_readmorelink();

    jQuery('a.print').click(function() {
        jQuery('.post.single').printElement({printMode:'popup'});

		return false;
	});

    // set accessibility roles on some elements trough js (to not break the xhtml markup)
    jQuery("#navigation").attr("role", "navigation");
    jQuery("#primary-content").attr("role", "main");
    jQuery("#sidebar").attr("role", "complementary");
    jQuery("#searchform").attr("role", "search");

    <?php if($_GET['preview'] == 1): ?>jQuery('body').addGrid(12, {img_path: '<?php echo THEME_URL; ?>/admin/images/'});<?php endif; ?>

    <?php do_action('mystique_jquery_init'); ?>

    });

   <?php
   die();
  endif;
}

function mystique_user_functions(){
  function eval_functions_error(){ ?>
   <div class='error fade'><p><?php _e("There are one or more PHP parse errors in your custom functions.","mystique"); ?></p></div>
  <?php
  }
  $user_functions = get_mystique_option('functions');
  if ($user_functions && $userfunctions<>('<?php'.str_repeat(PHP_EOL, 3))):
    // remove any php tags from start/end of the string (there shouldn't be html output outside any function)
    $user_functions = mystique_trim_string($user_functions, '<?php');
    $user_functions = mystique_trim_string($user_functions, '?>');
    if (FALSE === @eval($user_functions.' return true;')) add_action('admin_notices', 'eval_functions_error');
  endif;
}

function mystique_load_stylesheets(){ ?>
<style type="text/css">
 @import "<?php bloginfo('stylesheet_url'); ?>";
 @import "<?php echo esc_url_raw(add_query_arg('mystique', 'css', (is_404() ? get_bloginfo('url') : mystique_curPageURL()))); ?>";
</style>
<!--[if lte IE 6]><link media="screen" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie6.css" type="text/css" /><![endif]-->
<!--[if IE 7]><link media="screen" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie7.css" type="text/css" /><![endif]-->
  <?php
}

function mystique_load_scripts(){
 if(get_mystique_option('jquery')):
  wp_enqueue_script('jquery');
  wp_enqueue_script('mystique', THEME_URL.'/js/jquery.mystique.js', array('jquery'), $ver=THEME_VERSION, $in_footer=true);
  wp_enqueue_script('mystique-init', esc_url_raw(add_query_arg('mystique', 'jquery_init', (is_404() ? get_bloginfo('url') : mystique_curPageURL()))), array('jquery', 'mystique'), $ver=THEME_VERSION, $in_footer=true);
 endif;
}
