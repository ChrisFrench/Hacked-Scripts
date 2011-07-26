<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
?>
<?php get_header(); ?>
<div id="content" class="box shadow opacity">
    <div id="container" >
        <div id="posts">
            <div <?php post_class(); ?>>
                <div class="title opacity box">
                    <h1 class="center"><a href="#" title="<?php _e('Error 404 - Not Found', 'constructor'); ?>"><?php _e('Error 404 - Not Found', 'constructor'); ?></a></h1>
                </div>
                <div class="entry">
                    <p class="center"><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'constructor'); ?></p>
                    <p><?php get_search_form() ?></p>
                </div>
                <div class="footer">
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div><!-- id='container' -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>
    <?php get_constructor_sidebar(); ?>
</div><!-- id='content' -->
<?php get_footer(); ?>