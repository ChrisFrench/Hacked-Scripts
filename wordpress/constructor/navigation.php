<?php
/**
 * You can change navigation in this is file
 * 
 * @package WordPress
 * @subpackage constructor
 */
?>
<div class="navigation">
    <?php if (function_exists('wp_pagenavi')) : ?>
        <?php wp_pagenavi(); ?>
    <?php else: ?>
        <div class="alignleft"><?php next_posts_link(__('<span>&laquo;</span> Older Entries', 'constructor')) ?></div>
        <div class="alignright"><?php previous_posts_link(__('Newer Entries <span>&raquo;</span>', 'constructor')) ?></div>
    <?php endif; ?>
</div>