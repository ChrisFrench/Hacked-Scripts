<?php
/**
 * @package WordPress
 * @subpackage constructor
 */
__('Tile', 'constructor'); // requeried for correct translation
?>
<div id="content" class="box shadow opacity layout-full">
    <div id="container" >
    <?php get_constructor_slideshow(true) ?>
    <?php if (have_posts()) : ?>
        <div id="posts">
        <?php while (have_posts()) : the_post(); ?>
            <div <?php post_class('tile opacity shadow box'); ?> id="post-<?php the_ID() ?>">
                <div class="title opacity">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'constructor'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h2>
                </div>
                <div class="thumbnail">
                    <?php 
                        // try to found post thubmnail
                        if (!($thumb = get_the_post_thumbnail(NULL, 'tile-post-thumbnail'))) {
                            $thumb = get_constructor_noimage();
                        } 
                        echo $thumb;    
                    ?>
                </div>
                <div class="links opacity">
                    <div class="date"><?php the_date() ?></div>
                    <div class="comments"><?php comments_popup_link('0', '1', '%', 'button', '' ); ?></div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
        <?php get_constructor_navigation(); ?>
    <?php endif; ?>
    </div>
</div><!-- id='content' -->