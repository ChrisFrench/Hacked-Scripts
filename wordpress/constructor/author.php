<?php
/**
 * @package WordPress
 * @subpackage constructor
 */
// load header.php
get_header();

if (isset($_GET['author_name'])) :
    $authordata = get_userdatabylogin($_GET['author_name']); // NOTE: 2.0 bug requires get_userdatabylogin(get_the_author_login());
else :
    $authordata = get_userdata(intval($author));
endif;

$author = get_the_author();
?>
<div id="content" class="box shadow opacity">
    <div id="container" >
        <div id="posts">
            <div <?php post_class('author'); ?>>
                <div class="title opacity box">
                    <h1>
                        <a href="#" rel="bookmark" title="<?php echo $author ?>"><?php echo $author; ?></a>
                        <a class="feed-icon right" href="<?php echo get_author_feed_link(get_the_author_meta('ID')) ?>" title="<?php _e("Author RSS Feed", 'constructor') ?>"><?php _e("RSS Feed", 'constructor') ?></a>
                    </h1>
                </div>
                <div class="entry opacity box">
                    <div class="wp-caption alignleft persona" style="width: 128px">
                        <?php echo get_avatar(get_the_author_meta('email'), 120)?>
                        <p class="wp-caption-text"><?php printf(__('%1$s %2$s', 'constructor'), get_the_author_meta('first_name'), get_the_author_meta('last_name'))?></p>
                    </div>
                    <dl class="left">
                        <dt><?php _e('Full Name', 'constructor') ?></dt>
                        <dd><?php printf(__('%1$s %2$s', 'constructor'), get_the_author_meta('first_name'), get_the_author_meta('last_name'))?></dd>

                        <?php if ($nickname = get_the_author_meta('nickname')) : ?>
                            <dt><?php _e('Nickname', 'constructor') ?></dt>
                            <dd><?php echo $nickname ?></dd>
                        <?php endif; ?>

                        <?php if ($url = get_the_author_meta('url')) : ?>
                            <dt><?php _e('Website', 'constructor') ?></dt>
                            <dd><a href="<?php echo $url ?>" title="<?php _e("Visit author website", 'constructor') ?>" rel="external"><?php echo $url ?></a></dd>
                        <?php endif; ?>

                        <?php if ($icq = get_the_author_meta('icq')) : ?>
                            <dt><?php _e('ICQ', 'constructor') ?></dt>
                            <dd><?php echo $icq ?></dd>
                        <?php endif; ?>

                        <?php if ($aim = get_the_author_meta('aim')) : ?>
                            <dt><?php _e('AIM', 'constructor') ?></dt>
                            <dd><?php echo $aim ?></dd>
                        <?php endif; ?>

                        <?php if ($yim = get_the_author_meta('yim')) : ?>
                            <dt><?php _e('Yahoo IM', 'constructor') ?></dt>
                            <dd><?php echo $yim ?></dd>
                        <?php endif; ?>

                        <?php if ($msn = get_the_author_meta('msn')) : ?>
                            <dt><?php _e('MSN', 'constructor') ?></dt>
                            <dd><?php echo $msn ?></dd>
                        <?php endif; ?>

                        <?php if ($description = get_the_author_meta('description')) : ?>
                            <dt><?php _e('About Me', 'constructor') ?></dt>
                            <dd><?php echo $description ?></dd>
                        <?php endif; ?>
                    </dl>
                </div>
            </div>
            <div <?php post_class(); ?>>
                <div class="title opacity box">
                    <h2><a href="#" rel="bookmark" title="<?php echo $author ?>"><?php printf(__('Latest posts by %s', 'constructor'), get_the_author_meta('nickname')); ?></a></h2>
                </div>
                <div class="entry">

                    <ul>
                    <!-- The Loop -->
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                       <li>
                          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'constructor'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a> | <?php the_date() ?>
                       </li>
                    <?php endwhile; else: ?>
                         <p><?php _e('No posts by this author.', 'constructor'); ?></p>
                    <?php endif; ?>
                    <!-- End Loop -->
                    </ul>
                </div>
                <div class="footer"></div>
            </div>        
        </div>
        <?php get_constructor_navigation(); ?>
    </div><!-- id='container' -->
    <?php get_constructor_sidebar(); ?>
</div><!-- id='content' -->
<?php get_footer(); ?>