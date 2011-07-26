<?php
/**
 * @package WordPress
 * @subpackage constructor
 */
__('List', 'constructor'); // requeried for correct translation
?>
<div id="content" class="box shadow opacity">
    <div id="container" >
    <?php get_constructor_slideshow(true) ?>
    <?php if (have_posts()) : $i = 0; ?>
        <div id="posts">
        <?php while (have_posts()) : the_post();  $i++; ?>
            <div <?php post_class('box list opacity shadow'); ?> id="post-<?php the_ID() ?>">
                <div class="title">
                    <h2>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'constructor'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
                    </h2>
    				<div class="date color2"><?php the_date() ?></div>
                </div>                
                <div class="entry clear">
                    <?php the_post_thumbnail( 'list-post-thumbnail', array('class' => 'thumb alignleft') ); ?>
    				<?php the_content(__('Read the rest of this entry &raquo;', 'constructor')); ?>
                </div>
                <div class="footer">
                    
                </div>
            </div>
        <?php get_constructor_content_widget($i) ?>
        <?php endwhile; ?>
        </div>
        <?php get_constructor_navigation(); ?>
    <?php endif; ?>
    </div>
    <?php get_constructor_sidebar(); ?>
</div><!-- id='content' -->