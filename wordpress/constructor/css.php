<?php
/**
 * CSS Generator, please never change this is file, if your not sure what are you doing!
 * 
 * @package WordPress
 * @subpackage Constructor
 */
header('Content-type: text/css');

// template directory
$template_uri = get_template_directory_uri();

// config is null
$constructor = null;

// load custom theme (using theme switcher)
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
    $theme = preg_replace('/[^a-z0-9\-\_]+/i', '', $theme);
    if (file_exists(dirname(__FILE__) . '/themes/'.$theme.'/config.php')) {
       $constructor = include dirname(__FILE__) . '/themes/'.$theme.'/config.php';
    }
} else {
    $constructor = get_option('constructor');
}

if (!$constructor) {
    $constructor = include dirname(__FILE__) . '/themes/default/config.php';
}

$width    = isset($constructor['layout']['width'])?$constructor['layout']['width']:1024;
$sidebar  = isset($constructor['layout']['sidebar'])?$constructor['layout']['sidebar']:240;
$extra    = isset($constructor['layout']['extra'])?$constructor['layout']['extra']:240;

$color1   = $constructor['color']['header1'];
$color2   = $constructor['color']['header2'];
$color3   = $constructor['color']['header3'];

$color_bg      = $constructor['color']['bg'];
$color_bg2     = $constructor['color']['bg2'];
$color_text    = $constructor['color']['text'];
$color_text2   = $constructor['color']['text2'];
$color_border  = $constructor['color']['border'];
$color_border2 = $constructor['color']['border2'];
$color_opacity = isset($constructor['color']['opacity'])?$constructor['color']['opacity']:'#ffffff';

/*Fonts*/

// detect font-face
$font_face = require CONSTRUCTOR_DIRECTORY .'/admin/font-face.php';
$include_fonts = array();
if (array_search($constructor['fonts']['title']['family'], $font_face) !== false) {
    $font = preg_split('/[,]+/', $constructor['fonts']['title']['family']);
    $font = urlencode(trim($font[0],'"'));
    array_push($include_fonts, $font);
}
if (array_search($constructor['fonts']['description']['family'], $font_face) !== false) {
    $font = preg_split('/[,]+/', $constructor['fonts']['description']['family']);
    $font = urlencode(trim($font[0],'"'));
    if (array_search($font, $include_fonts) === false) {
        array_push($include_fonts, $font);
    }
}
if (array_search($constructor['fonts']['header']['family'], $font_face) !== false) {
    $font = preg_split('/[,]+/', $constructor['fonts']['header']['family']);
    $font = urlencode(trim($font[0],'"'));
    if (array_search($font, $include_fonts) === false) {
        array_push($include_fonts, $font);
    }
}
if (array_search($constructor['fonts']['content']['family'], $font_face) !== false) {
    $font = preg_split('/[,]+/', $constructor['fonts']['content']['family']);
    $font = urlencode(trim($font[0],'"'));
    if (array_search($font, $include_fonts) === false) {
        array_push($include_fonts, $font);
    }
}
if (!empty($include_fonts)) {
    $font_face = '@import url(http://fonts.googleapis.com/css?family='.join('|',$include_fonts).');'."\n";
} else {
    $font_face = '';
}

$title_font = <<<CSS
font-family:{$constructor['fonts']['title']['family']};
font-size:{$constructor['fonts']['title']['size']}px;
line-height:{$constructor['fonts']['title']['size']}px;
font-weight:{$constructor['fonts']['title']['weight']};
color:{$constructor['fonts']['title']['color']};
text-transform:{$constructor['fonts']['title']['transform']};
CSS;

$description_font = <<<CSS
font-family:{$constructor['fonts']['description']['family']};
font-size:{$constructor['fonts']['description']['size']}px;
line-height:{$constructor['fonts']['description']['size']}px;
font-weight:{$constructor['fonts']['description']['weight']};
color:{$constructor['fonts']['description']['color']};
text-transform:{$constructor['fonts']['description']['transform']};
CSS;

$body_font = <<<CSS
font-family:{$constructor['fonts']['content']['family']};
CSS;

$header_font = <<<CSS
font-family:{$constructor['fonts']['header']['family']};
CSS;

$content_font = <<<CSS
font-family:{$constructor['fonts']['content']['family']};
CSS;

/*/Fonts*/

/* Opacity */
// switch statement for $constructor['opacity']
switch ($constructor['opacity']) {
    case 'none':
        $opacity = '';
        break;
    case 'color':
        $opacity = <<<CSS
.opacity {
    background-color:{$color_opacity}
}
CSS;
        break;
    case 'darklow':
        $opacity = <<<CSS
.opacity {
    background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA9JREFUeNpiYGBg8AUIMAAAUgBOUWVeTwAAAABJRU5ErkJggg==);
    background:rgba(0, 0, 0, 0.3);
    /*filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#50000000, endColorstr=#50000000);*/   
}
CSS;
        break;
    case 'dark':
        $opacity = <<<CSS
.opacity {
    background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA9JREFUeNpiYmBgaAAIMAAAjwCD5Hc2/AAAAABJRU5ErkJggg==);
    background:rgba(0, 0, 0, 0.5);
    /*filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#75000000, endColorstr=#75000000);*/
}
CSS;
        break;
    case 'darkhigh':
        $opacity = <<<CSS
.opacity {
    background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA9JREFUeNpiYGBgOAMQYAAA0QDNW2hbhQAAAABJRU5ErkJggg==);
    background:rgba(0, 0, 0, 0.8);
    /*filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#90000000, endColorstr=#90000000);*/
}
CSS;
        break;
    case 'lightlow':
        $opacity = <<<CSS
.opacity {
    background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABBJREFUeNpi+P//vy9AgAEACUkDS4BbGHwAAAAASUVORK5CYII=);
    background:rgba(255, 255, 255, 0.3);
    /*filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#50FFFFFF, endColorstr=#50FFFFFF);*/
}
CSS;
        break;
    case 'lighthigh':
        $opacity = <<<CSS
.opacity {
    background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABBJREFUeNpi/P///xmAAAMACc0DyzeP8KAAAAAASUVORK5CYII=);
    background:rgba(255, 255, 255, 0.8);
    /*filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#90FFFFFF, endColorstr=#90FFFFFF);*/
}
CSS;
        break;
    case 'light':
    default:
        $opacity = <<<CSS
.opacity {
    background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABBJREFUeNpi/v//fyxAgAEACWgDXjXePfkAAAAASUVORK5CYII=);
    background:rgba(255, 255, 255, 0.5);
    /*filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#75FFFFFF, endColorstr=#75FFFFFF);*/
}
CSS;
        break;
}
/* Box */
if ($constructor['design']['box']['flag']) {
    $radius = $constructor['design']['box']['radius'];
    
    $box = <<<CSS
.box {
    border-color:{$color_border};
    border-style:solid;
    border-width:1px;
    border-radius: {$radius}px;
    -moz-border-radius: {$radius}px;
    -khtml-border-radius: {$radius}px;
    -webkit-border-radius: {$radius}px
}
CSS;
    // switch statement for $constructor['menu']['pos']
    switch ($constructor['menu']['pos']) {
        case 'left top':
        case 'right top':
            $box .= <<<CSS
#menu {
    -moz-border-radius: 0 0 {$radius}px {$radius}px;
    -webkit-border-bottom-left-radius: {$radius}px;
    -webkit-border-bottom-right-radius: {$radius}px;
    -khtml-border-bottom-left-radius: {$radius}px;
    -khtml-border-bottom-right-radius: {$radius}px;
    border-bottom-left-radius: {$radius}px;
    border-bottom-right-radius: {$radius}px;
    border-color:{$color_border};
    border-style:solid;
    border-width:1px;
    border-top:0;
}
CSS;
            break;
        default: 
           $box .= <<<CSS
#menu {
    -moz-border-radius: {$radius}px;
    -webkit-border-radius: {$radius}px;
    -khtml-border-radius: {$radius}px;
    border-radius: {$radius}px;
    border:{$color_border} solid 1px;
}
CSS;
            break;
    }

    
} else {
    $box = '';
}
// switch statement for $constructor['title']['pos']

list($title_halign, $title_valign) = preg_split('/ /', $constructor['title']['pos']);
$title_align = '';

switch ($title_halign) {
    case 'left':
        $title_align .= 'text-align:left;';
        break;
    case 'center':
        $title_align .= 'text-align:center;';
        break;
    case 'right':
        $title_align .= 'text-align:right;';
        break;
}

switch ($title_valign) {
    case 'bottom':
        $title_align .= 'bottom:0;';
        break;
    case 'top':
    default:
        $title_align .= 'top:0;';
        break;
}

// switch statement for $constructor['menu']['pos']
$menu_center = round(($constructor['layout']['header'] - 40) / 2);

$menu = "";
switch ($constructor['menu']['pos']) {
    case 'right top':
        $menu .="right:0;top:0;";
        break;
    case 'left center':
        $menu .="left:0;top:{$menu_center}px;";
        break;
    case 'right center':
        $menu .="right:0;top:{$menu_center}px;";
        break;
    case 'left bottom':
        $menu .="left:0;bottom:0;margin-bottom: 6px;";
        break;
    case 'right bottom':
        $menu .="right:0;bottom:0;margin-bottom: 6px;";
        break;
    case 'left top':
    default:
        $menu .="left:0;top:0;";
        break;
}

// switch statement for $constructor['menu']['width']
switch ($constructor['menu']['width']) {
    case '100%':
        $menu .= "width:{$width}px;";
        break;
    default:
        break;
}

/* Shadow */
if ($constructor['design']['shadow']['flag']) {
    $x_offset = $constructor['design']['shadow']['x'];
    $y_offset = $constructor['design']['shadow']['y'];
    $blur     = $constructor['design']['shadow']['blur'];
    
    $shadow = <<<CSS
.shadow {
    box-shadow: {$x_offset}px {$y_offset}px {$blur}px {$color_border};
    -moz-box-shadow: {$x_offset}px {$y_offset}px {$blur}px {$color_border};
    -webkit-box-shadow: {$x_offset}px {$y_offset}px {$blur}px {$color_border}
}
CSS;
} else {
    $shadow = '';
}

/* Layout */
$layout = "";
$layout_alt = "";
$layout_fluid = "";

if ($constructor['layout']['fluid']['flag']) {
    $layout_fluid = <<<CSS
    width:{$constructor['layout']['fluid']['width']}%;
    min-width:{$constructor['layout']['fluid']['min-width']}px;
    max-width:{$constructor['layout']['fluid']['max-width']}px;
CSS;
} else {
    $layout_fluid = <<<CSS
    width:{$width}px;
CSS;
}


// width changes
$sidebar2 = $sidebar - 4; // 2px - it's borders width
$extra2   = $extra   - 4;

// switch statement for $sidebar
switch ($constructor['sidebar']) {
    case 'left':
$width2 = $width - ($sidebar + 1); // 1 is border width

$layout = <<<CSS
#container {
    width:{$width2}px;
    margin-left:{$sidebar}px;
    border-left:1px dotted {$color_border};
}
#sidebar {
    margin-left:-{$width}px !important;
}
CSS;
        break;
    case 'two':
$width2 = $width - ($sidebar + $extra + 2); // 2 is borders width
$layout = <<<CSS
#container {
    width:{$width2}px;
    margin-left:{$extra}px;
    border-left:1px dotted {$color_border};

    margin-right:{$sidebar}px;
    border-right:1px dotted {$color_border};
}
#sidebar {
    margin-left:-{$sidebar}px;
}
#extra {
    margin-left:-{$width}px;
}
CSS;
        break;
    case 'two-right':
$margin = $sidebar + $extra + 2;
$width2 = $width - $margin;

$layout = <<<CSS
#container {
    width:{$width2}px;

    margin-right:{$margin}px;
    border-right:1px dotted {$color_border};
}
#sidebar {
    margin-left:-{$margin}px;
    border-right:1px dotted {$color_border};
}
#extra {
    margin-left:-{$extra}px;
}
CSS;
        break;
    case 'two-left':
$margin  = $sidebar + $extra + 2;
$margin2 = $width - $sidebar;
$width2  = $width - $margin;

$layout = <<<CSS
#container {
    width:{$width2}px;
    margin-left:{$margin}px;
    border-left:1px dotted {$color_border};
}
#sidebar {
    margin-left:-{$width}px;
    border-right:1px dotted {$color_border};
}
#extra {
    margin-left:-{$margin2}px;
}
CSS;
        break;
    case 'none':
        $layout = '';
        break;
    case 'right':
    default:
$width2  = $width - $sidebar;
$layout = <<<CSS
#container {
    width:{$width2}px;
    margin-right:{$sidebar}px;
    border-right:1px dotted {$color_border};
}
#sidebar {
    margin-left:-{$sidebar}px;
}
CSS;
        break;
}


// alternative layouts CSS
{
$width2 = $width - ($sidebar + 1); // 1 is border width

$layout_alt .= <<<CSS
.layout-left #container {
    width:{$width2}px;
    margin-left:{$sidebar}px;
    border-left:1px dotted {$color_border};
}
.layout-left #sidebar {
    margin-left:-{$width}px !important;
}

CSS;

$width2 = $width - ($sidebar + $extra + 2); // 2 is borders width

$layout_alt .= <<<CSS
.layout-two #container {
    width:{$width2}px;
    margin-left:{$extra}px;
    border-left:1px dotted {$color_border};

    margin-right:{$sidebar}px;
    border-right:1px dotted {$color_border};
}
.layout-two #sidebar {
    margin-left:-{$sidebar}px;
}
.layout-two #extra {
    margin-left:-{$width}px;
}

CSS;
     
$margin = $sidebar + $extra + 2;
$width2 = $width - $margin;

$layout_alt .= <<<CSS
.layout-two-right #container {
    width:{$width2}px;

    margin-right:{$margin}px;
    border-right:1px dotted {$color_border};
}
.layout-two-right #sidebar {
    margin-left:-{$margin}px;
    border-right:1px dotted {$color_border};
}
.layout-two-right #extra {
    margin-left:-{$extra}px;
}

CSS;

$margin2 = $width - $sidebar;

$layout_alt .= <<<CSS
.layout-two-left #container {
    width:{$width2}px;
    margin-left:{$margin}px;
    border-left:1px dotted {$color_border};
}
.layout-two-left #sidebar {
    margin-left:-{$width}px;
    border-right:1px dotted {$color_border};
}
.layout-two-left #extra {
    margin-left:-{$margin2}px;
}

CSS;

$width2  = $width - $sidebar;
$layout_alt .= <<<CSS
.layout-right #container {
    width:{$width2}px;
    margin-right:{$sidebar}px;
    border-right:1px dotted {$color_border};
}
.layout-right #sidebar {
    margin-left:-{$sidebar}px;
}
CSS;
}

/* Background images */
if (isset($constructor['images']['body']['src']) && !empty($constructor['images']['body']['src'])) {
    
    // required for back compatibility
    /*
    if (false === strpos($constructor['images']['body']['src'], 'http://')) {
        $image = $template_uri .'/'. $constructor['images']['body']['src'];
    } else {
        $image = $constructor['images']['body']['src'];
    }
    */
    
    $body_bg = "background-image: url('{$template_uri}/{$constructor['images']['body']['src']}');\n"
             . "background-repeat: {$constructor['images']['body']['repeat']};\n"
             . "background-position: {$constructor['images']['body']['pos']};\n";
	if (isset($constructor['images']['body']['fixed']) && $constructor['images']['body']['fixed']) {
    	$body_bg .= "background-attachment:fixed;\n";
    }
} else { $body_bg = null; }

if (isset($constructor['images']['wrap']['src']) && !empty($constructor['images']['wrap']['src'])) {
    $wrap_bg = "background-image: url('{$template_uri}/{$constructor['images']['wrap']['src']}');\n"
             . "background-repeat: {$constructor['images']['wrap']['repeat']};\n"
             . "background-position: {$constructor['images']['wrap']['pos']};\n";
    if (isset($constructor['images']['wrap']['fixed']) && $constructor['images']['wrap']['fixed']) {
    	$wrap_bg .= "background-attachment:fixed;\n";
    }
} else { $wrap_bg = null; }

if (isset($constructor['images']['wrapper']['src']) && !empty($constructor['images']['wrapper']['src'])) {
    $wrapper_bg = "background-image: url('{$template_uri}/{$constructor['images']['wrapper']['src']}');\n"
	            . "background-repeat: {$constructor['images']['wrapper']['repeat']};\n"
	            . "background-position: {$constructor['images']['wrapper']['pos']};\n";
} else { $wrapper_bg = null; }

if (isset($constructor['images']['header']['src']) && !empty($constructor['images']['header']['src'])) {
    $header_bg = "background-image: url('{$template_uri}/{$constructor['images']['header']['src']}');\n"
               . "background-repeat: {$constructor['images']['header']['repeat']};\n"
               . "background-position: {$constructor['images']['header']['pos']};\n";
} else { $header_bg = null; }

if (isset($constructor['images']['sidebar']['src']) && !empty($constructor['images']['sidebar']['src'])) {
    $sidebar_bg = "background-image: url('{$template_uri}/{$constructor['images']['sidebar']['src']}');\n"
                . "background-repeat: {$constructor['images']['sidebar']['repeat']};\n"
                . "background-position: {$constructor['images']['sidebar']['pos']};\n";
} else { $sidebar_bg = null; }

if (isset($constructor['images']['extrabar']['src']) && !empty($constructor['images']['extrabar']['src'])) {
    $extrabar_bg = "background-image: url('{$template_uri}/{$constructor['images']['extrabar']['src']}');\n"
                 . "background-repeat: {$constructor['images']['extrabar']['repeat']};\n"
                 . "background-position: {$constructor['images']['extrabar']['pos']};\n";
} else { $extrabar_bg = null; }

if (isset($constructor['images']['footer']['src']) && !empty($constructor['images']['footer']['src'])) {
    $footer_bg = "background-image: url('{$template_uri}/{$constructor['images']['footer']['src']}');\n"
               . "background-repeat: {$constructor['images']['footer']['repeat']};\n"
               . "background-position: {$constructor['images']['footer']['pos']};\n";
} else { $footer_bg = null; }

/* Wrappers */

if (isset($constructor['images']['wrapheader']['src']) && !empty($constructor['images']['wrapheader']['src'])) {
    $wrapheader_bg = "background-image: url('{$template_uri}/{$constructor['images']['wrapheader']['src']}');\n"
                   . "background-repeat: {$constructor['images']['wrapheader']['repeat']};\n"
                   . "background-position: {$constructor['images']['wrapheader']['pos']};\n";
} else { $wrapheader_bg = null; }

if (isset($constructor['images']['wrapcontent']['src']) && !empty($constructor['images']['wrapcontent']['src'])) {
    $wrapcontent_bg = "background-image: url('{$template_uri}/{$constructor['images']['wrapcontent']['src']}');\n"
                    . "background-repeat: {$constructor['images']['wrapcontent']['repeat']};\n"
                    . "background-position: {$constructor['images']['wrapcontent']['pos']};\n";
} else { $wrapcontent_bg = null; }

if (isset($constructor['images']['wrapfooter']['src']) && !empty($constructor['images']['wrapfooter']['src'])) {
    $wrapfooter_bg = "background-image: url('{$template_uri}/{$constructor['images']['wrapfooter']['src']}');\n"
                   . "background-repeat: {$constructor['images']['wrapfooter']['repeat']};\n"
                   . "background-position: {$constructor['images']['wrapfooter']['pos']};\n";
} else { $wrapfooter_bg = null; }


/* Comments */
switch ($constructor['comments']['avatar']['pos']) {
    case 'left':
        $avatar_pos = "float: left;\margin: 0 10px 10px 0;";
        break;
    case 'right':
    default:
        $avatar_pos = "float: right;\margin: 0 0 10px 10px;";
        break;
}

/* Header */
if ($constructor['title']['hidden']) {
    $title = <<<CSS
#header #name a, #header #description {
    font-size:0;
    text-indent:-9000px;
}
#header #name a {
    display:block;
    height:100%;
}
CSS;
} else {
    $title = '';
}


/* Output CSS */
echo <<<CSS
{$font_face}
body {
    background-color:{$color_bg};
    {$content_font}
    {$body_bg}
}

body,
a { color:{$color_text} }

hr { color: {$color1}; background-color: {$color1} }

h1,h2,h3,h4,h5,h6 {{$header_font}}

h1,
h2 { color:{$color1} }
h3,
h4 { color:{$color2} }
h5,
h6 { color:{$color3} }

pre {{$content_font}}

a:hover { color:{$color1} }
table caption {
    color:{$color2};
}
table th {
    color:{$color_text};
    background-color:{$color3};
    border-color:{$color_border}
}
table td {
    border-color:{$color_border}
}
/*Colors*/
/* text colors */
.color0 { color:{$color_opacity} }

.color1 { color:{$color1} }
.color2 { color:{$color2} }
.color3 { color:{$color3} }

.color4 { color:{$color_text} }
.color5 { color:{$color_text2} }

.color6 { color:{$color_bg}  }
.color7 { color:{$color_bg2} }

.color8 { color:{$color_border}  }
.color9 { color:{$color_border2} }

/* borders colors */
.bcolor0 { border-color:{$color_opacity} }

.bcolor1 { border-color:{$color1} }
.bcolor2 { border-color:{$color2} }
.bcolor3 { border-color:{$color3} }

.bcolor4 { border-color:{$color_text} }
.bcolor5 { border-color:{$color_text2} }

.bcolor6 { border-color:{$color_bg}  }
.bcolor7 { border-color:{$color_bg2} }

.bcolor8 { border-color:{$color_border}  }
.bcolor9 { border-color:{$color_border2} }

/* background colors */
.bgcolor0 { background-color:{$color_opacity} }

.bgcolor1 { background-color:{$color1} }
.bgcolor2 { background-color:{$color2} }
.bgcolor3 { background-color:{$color3} }

.bgcolor4 { background-color:{$color_text} }
.bgcolor5 { background-color:{$color_text2} }

.bgcolor6 { background-color:{$color_bg}  }
.bgcolor7 { background-color:{$color_bg2} }

.bgcolor8 { background-color:{$color_border}  }
.bgcolor9 { background-color:{$color_border2} }
/*/Colors*/

/*Form*/
input, select, textarea {
    color:{$color_text};
    border-color: {$color_border};
    background-color:{$color_bg}
}

input:active, select:active, textarea:active {
    border-color:{$color3};
    background-color:{$color_bg2}
}

input:focus, select:focus, textarea:focus {
    border-color:{$color3};
    background-color:{$color_bg2}
}

fieldset{
    border-color: {$color_border}
}
/*/Form*/
/*CSS3*/
::selection {
    background: {$color1};
    color:{$color_bg};
}
::-moz-selection {
    background: {$color1};
    color:{$color_bg};
}
{$opacity}
{$shadow}
{$box}
/*/CSS3*/
/*Layout*/
#body {
    {$wrap_bg}
}
#wrapheader {
    {$wrapheader_bg}
}
    #header {
        {$header_bg}
    }

#wrapcontent {
    {$wrapcontent_bg}
}
    #content {
        {$wrapper_bg}
    }

#header,#content,#footer{
    {$layout_fluid}
}

{$layout}
{$layout_alt}
    .layout-full #container {
        border:0;
        margin:0;
        width:{$width}px !important
    }

#sidebar{
    width:{$sidebar2}px;
    {$sidebar_bg}
}
#extra {
    width:{$extra2}px;
    {$extrabar_bg}
}

#wrapfooter{
    {$wrapfooter_bg}
}
    #footer{
        width:{$width}px;
        {$footer_bg}
    }
/*/Layout*/
/*Header*/
#header {
	height: {$constructor['layout']['header']}px;
	text-align: {$constructor['title']['pos']}
}
#header #name a { $title_font }
#header #description { $description_font }
{$title}
#header #title {
    {$title_align}
}

#menu { {$menu} border-color: {$color_border} }
    #menu ul {  border-color: {$color_border} }
    #menu li {  border-color: {$color_border} }
    #menu li li { background-color:{$color_bg}  }
    #menu li:hover { background-color:{$color_bg2} }
    
    #menu .current_page_item a,
    #menu .current-cat a{
        color:{$color1}
    }
    #menu .current_page_item li a,
    #menu .current-cat li a {
        color: {$color_text}
    }
/*/Header*/
/*Slideshow*/
.wp-sl img{
    border-color: {$color_border};
}
#content .wp-sl {
    border-width:0 0 1px 0;
    border-style:solid;
    border-color:{$color_border};
}
/*/Slideshow*/
/*Images*/
.wp-caption {
   color:{$color_text};
   border: 1px solid {$color_border};
   background-color: {$color_bg2};
}
/*/Images*/
/*Calendar*/
#wp-calendar th {
    border-bottom:1px solid {$color_border2}
}
#wp-calendar tbody {
   color:{$color_text2};
   border-bottom:1px solid {$color_border2}
}
#wp-calendar tbody a {
   color:{$color_text};
}
#wp-calendar tbody a:hover {
   background-color: {$color3};
}
#wp-calendar #today {    
   color:{$color1};
   background-color: {$color_bg2};
}
/*/Calendar*/
/*Post*/
.hentry .title a,
.hentry .title span{
    /*border-bottom:3px dotted {$color3}*/
}
.hentry .entry a,
.hentry .footer a{
    border-bottom:1px dotted {$color_text}
}
.hentry .entry a:hover,
.hentry .footer a:hover{
    border-bottom:1px solid {$color1}
}
.hentry .entry .crop,
.hentry .entry img {
    border-color:{$color_border}
}
.list .title {
   border-color:{$color_border};
   background-color: {$color3};
}
.list .title h2 a{
   color: {$color_bg};
}
.list .title h2 a:hover{
   color: {$color_bg2};
}
.list .title .date{
   color: {$color_bg2};
}
/*/Post*/
/*Author*/
.author dt, .author dd {
    border-color:{$color_bg2}
}
/*/Author*/
/*Archive*/
#posts .archive table td{
    color:{$color_text2}
}
#posts .archive table a{
    padding:4px;
    color:{$color_text}
}
#posts .archive table a:hover{
    background-color: {$color2};
}
/*/Archive*/
/*Sidebar*/    
.sidebar .current_page_item a,
.sidebar .current-cat a{
    font-weight:900;
    border-color:{$color_text}
}
.sidebar .current_page_item li a,
.sidebar .current-cat li a{
    font-weight:500;
    border-color:{$color_border}
}
/*/Sidebar*/
/*Widgets*/
.widget_rss li .rsswidget {
    color:{$color1}
}
/*/Widgets*/
/*Content Widgets*/
#content-widget {
    background-color: {$color_bg2};
}
/*/Content Widgets*/
/*Comments*/
.thread-even, .even {
    background-color: {$color_bg};
    border: 1px solid {$color_border}
}
.alt {
    background-color: {$color_bg};
}
.thread-odd, .odd {
    background-color: {$color_bg2};
    border: 1px solid {$color_border2}
}
/*
.depth-2, .depth-4 {
    border-left:3px dotted {$color_border}
}
*/
.commentlist li .avatar {
    {$avatar_pos};
    border-color: {$color_border2};
}
.commentlist a {
    border-bottom:1px dotted {$color_text}
}
.commentlist a:hover {
    border-bottom:1px solid {$color1}
}
.comment-meta a{
    color:{$color_text2}
}
/*/Comments*/
/*Footer*/
#footer .copy{
    color:{$color_text2}
}
/*/Footer*/
/*Buttons*/
.button, .button:visited {
	background-color: {$color1};
	color: {$color_bg};
}
.button:hover { 
	background-color: {$color2};
	color: {$color_bg2};
}
/*/Buttons*/
/*Plugins:wp-pagenavi*/
.wp-pagenavi a, .wp-pagenavi span {
    border:1px solid {$color_border} !important;
}
.wp-pagenavi a:hover, .wp-pagenavi span.current {
    border-color:{$color_border2} !important;
}
CSS;
?>