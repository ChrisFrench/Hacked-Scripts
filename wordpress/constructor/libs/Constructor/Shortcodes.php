<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
class Constructor_Shortcodes 
{
    
    /**
     * Return list of subpages
     * 
     * <code>
     * [subpages]
     * </code>
     */
    function subpages($attributes)
    {
    	global $post;
        return '<ul class="subpages-list">'.wp_list_pages('title_li=&echo=0&child_of='.$post->ID).'</ul>';
    }
    
    /**
     * Return widget
     * 
     * <code>
     * [widgets]
     * </code>
     */
    function widgets($attributes)
    {
        ob_start();
        dynamic_sidebar('incontent');
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    /**
     * Return list of attachments
     * 
     * <code>
     * [attachments]
     * [attachments type=image]
     * [attachments type=video preview=1]
     * </code>
     */
    function attachments($attributes)
    {
    	global $post;
    	
    	$mimetypes = array(
    	   'image', 'video', 'audio', 'application'
    	);
    	
    	if (isset($attributes['type']) && in_array($attributes['type'], $mimetypes)) {
    	    $mimetype = $attributes['type'];
    	} else {
    	    $mimetype = null;
    	}
    	
    	$args = array(
    		'post_type' => 'attachment',
    		'numberposts' => null,
    		'post_status' => null,
    		'post_parent' => $post->ID,
    		'post_mime_type' => $mimetype
    	);
    	$attachments = get_children($args);
    	
    	if (!is_array($attachments) or !sizeof($attachments)) {
    	    return '';
    	}
    	
    	if (isset($attributes['preview'])) {
    	    $output = '<ul class="attachment-list preview '.$mimetype.'">';
		    foreach ($attachments as $attachment) {
    			$output .= '<li>'.get_the_attachment_link($attachment->ID, false).'</li>';
    		}
    		$output .= '</ul>';
    	} else {
    	    $output = '<ul class="attachment-list '.$mimetype.'">';
    	    foreach ($attachments as $attachment) {
    			$output .= '<li><a title="'.$attachment->post_title.'" href="'.wp_get_attachment_url($attachment->ID).'">'. apply_filters('the_title', $attachment->post_title).'</a></li>';
    		}
    		$output .= '</ul>';
    	}
		
        return $output;
    }
}
add_shortcode('subpages',    array('Constructor_Shortcodes', 'subpages'));
add_shortcode('widgets',     array('Constructor_Shortcodes', 'widgets'));
add_shortcode('attachments', array('Constructor_Shortcodes', 'attachments'));