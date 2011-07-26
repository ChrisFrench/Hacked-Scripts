<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
?>
<div id="extra" class="sidebar">
    <ul><?php 	    
	    // switch statement for widget place
	    switch (true) {
	        case (is_archive() && dynamic_sidebar('extra-categories')):
	            break;
	        case (is_page() && dynamic_sidebar('extra-pages')):
	            break;
	        case (is_single() && dynamic_sidebar('extra-posts')):
	            break;
            case (dynamic_sidebar('extra')):
	            break;
	        default:
	            wp_list_pages('title_li=<h2>'.__('Pages', 'constructor').'</h2>' );
	            wp_list_categories('show_count=1&title_li=<h3>'.__('Categories', 'constructor').'</h3>');
	            break;
	    }
	    ?>
    </ul>
</div>