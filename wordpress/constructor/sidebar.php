<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
?>
<div id="sidebar" class="sidebar">
	<ul>
	    <?php 	    
	    // switch statement for widget place
	    switch (true) {
	        case (is_archive() && dynamic_sidebar('sidebar-categories')):
	            break;
	        case (is_page() && dynamic_sidebar('sidebar-pages')):
	            break;
	        case (is_single() && dynamic_sidebar('sidebar-posts')):
	            break;
            case (dynamic_sidebar('sidebar')):
	            break;
	        default:
	            ?>
	            <?php if (!is_404()) : ?>
        	    <li>
        			<?php get_search_form(); ?>
        		</li>
        		<?php endif; ?>
        		
        		<?php wp_list_pages('title_li=<h3>'.__('Pages', 'constructor').'</h3>' ); ?>
        
        		<?php wp_list_categories('show_count=1&title_li=<h3>'.__('Categories', 'constructor').'</h3>'); ?>
        		
                <li><h3><?php _e('Tags', 'constructor')?></h3>
            	    <?php if (function_exists('wp_tag_cloud')) { wp_tag_cloud('smallest=8&largest=18&number=40'); } ?>
        	    </li>
        
        		<?php /* If this is the frontpage */ if ( is_home() || is_page() ) : ?>
    			<li><h3><?php _e('Meta', 'constructor') ?></h3>
        			<ul>
        				<?php wp_register(); ?>
        				<li><?php wp_loginout(); ?></li>
        				<?php wp_meta(); ?>
        			</ul>
    			</li>
        		<?php endif; ?>
	            <?php
	            break;
	    }
	    ?>
	</ul>
</div>