<?php
/*
Template Name: Archive
*/
/**
 * @package WordPress
 * @subpackage Constructor
 * @todo save archive to cache
 */
global $wpdb;

    $SQL = "
    SELECT
        ID
        ,post_title
        ,YEAR(post_date) AS `year`
        ,MONTH(post_date) AS `month`
    FROM {$wpdb->posts}
    WHERE post_type = 'post'
    AND post_status = 'publish'
    ORDER BY post_date DESC";

$AllPosts = $wpdb->get_results($SQL);

// all months
$MonthAbr   = array();
$MonthNames = array();

for ($i = 1; $i <= 12; $i++) {
    $MonthAbr[$i]   = ucfirst(strftime(__("%b",'constructor'), strtotime($i."/01/2001")));
    $MonthNames[$i] = ucfirst(strftime(__("%B",'constructor'), strtotime($i."/01/2001")));
}

// posts to our format
$Archive = array();
foreach ($AllPosts as $Post) {
    if (!isset($Archive[$Post->year][$Post->month])) $Archive[$Post->year][$Post->month] = array();

    $Archive[$Post->year][$Post->month][] = array('ID'=>$Post->ID, 'title'=>$Post->post_title);
}

get_header(); ?>
<div id="content" class="box shadow opacity">
    <div id="container" >
        <div id="posts">
        <?php while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID() ?>">
                <div class="title opacity box">
                    <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'constructor'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h1>
                </div>
                <div class="entry archive">
                    <?php the_content(__('Read the rest of this entry &raquo;', 'constructor')) ?>
                    <table>
                    <?php foreach ($Archive as $Year => $Month) : ?>
                        <tr>
                            <th><a href="#<?php echo $Year ?>"><?php echo $Year ?></a></th>
                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                            <td>
                                <?php if (isset($Archive[$Year][$i])): ?>
                                    <a href="#<?php echo $Year .'-'. $i?>"><?php echo $MonthAbr[$i] ?></a>
                                <?php else: ?>
                                    <span><?php echo $MonthAbr[$i] ?></span>
                                <?php endif;?>
                            </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                    
                    <?php foreach ($Archive as $Year => $Month) : ?>
                        <h2><a name="<?php echo $Year ?>" href="<?php echo get_year_link($Year)?>"><?php echo $Year ?></a></h2>
                        <?php for ($i = 12; $i >= 1; $i--) : ?>
                            <?php if (isset($Archive[$Year][$i])) : ?>
                                <h3><a name="<?php echo $Year.'-'.$i ?>" href="<?php echo get_month_link($Year, $i)?>"><?php echo $MonthNames[$i] ?></a></h3>
                                <ul>
                                <?php foreach ($Month[$i] as $Post) : ?>
                                    <li><a href="<?php echo get_permalink($Post['ID']) ?>"><?php echo strip_tags(apply_filters('the_title', $Post['title'])) ?></a></li>
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php endforeach; ?>
                </div>
                <div class="footer">
                    <div class="links">
                    <?php if($post->post_parent) : $parent_link = get_permalink($post->post_parent); ?>
                    <a href="<?php echo $parent_link; ?>"><?php _e('Back to Parent Page', 'constructor');?></a> |
                    <?php endif; ?>
                    <?php edit_post_link(__('Edit', 'constructor'), '', ' | '); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>

    </div><!-- id='container' -->
    <?php get_constructor_sidebar(); ?>
</div><!-- id='content' -->
<?php get_footer(); ?>

                    