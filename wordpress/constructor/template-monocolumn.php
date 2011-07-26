<?php
/*
Template Name: Monocolumn
*/
/**
 * @package WordPress
 * @subpackage Constructor
 */

wp_enqueue_script( 'comment-reply' );

get_header(); ?>
<div id="content" class="box shadow opacity layout-full">
    <div id="container">
        <div id="posts">
        <?php while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID() ?>">
                <div class="title opacity box">
                    <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'constructor'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h1>
                </div>
                <div class="entry">
   
                    <?php the_content(__('Read the rest of this entry &raquo;', 'constructor')) ?>
                    <?php wp_link_pages(array('before' => '<p class="pages"><strong>'.__('Pages', 'constructor').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                </div>
                <div class="footer">
                    <div class="links">
                    <?php if($post->post_parent) : $parent_link = get_permalink($post->post_parent); ?>
                    <a href="<?php echo $parent_link; ?>"><?php _e('Back to Parent Page', 'constructor');?></a> |
                    <?php endif; ?>
                    <?php the_date() ?> |
                    <?php the_tags(__('Tags', 'constructor') . ': ', ', ', ' |'); ?>
                    <?php edit_post_link(__('Edit', 'constructor'), '', ' | '); ?>
                    <?php comments_popup_link(__('No Comments &#187;', 'constructor'), __('1 Comment &#187;', 'constructor'), __('% Comments &#187;', 'constructor'), 'comments-link', __('Comments Closed', 'constructor') ); ?>                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </div><!-- id='container' -->
</div><!-- id='content' -->
<?php get_footer(); ?>

                    