<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
?>

<?php if ( post_password_required() ) : ?>
    <div id="comments">
        <p class="nopassword"><?php _e('This post is password protected. Enter the password to view comments.', 'constructor'); ?></p>
    </div>
    <?php return; ?>
<?php endif; ?>


<div id="comments">
<?php if ( have_comments() ) : ?>
	<h3><?php comments_number(__('No Responses', 'constructor'), __('One Response', 'constructor'), __('% Responses', 'constructor'));?> <?php printf(__('to &#8220;%s&#8221;', 'constructor'), the_title('', '', false)); ?></h3>

	<ol class="commentlist">
	    <?php wp_list_comments('avatar_size='.get_constructor_avatar_size());?>
	</ol>
    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
    <?php endif; ?>
<?php else: ?>
    <?php if (!comments_open() && !is_page()) : ?>
        <p class="nocomments"><?php _e('Comments are closed.', 'constructor'); ?></p>
    <?php endif; ?>
<?php endif; ?>
    <?php
        // This is stupid fields customization
        // I can't do it with CSS
        function constructor_comment_fields ($fields) {
            foreach ($fields as $name => $field) {
                $fields[$name] = preg_replace('/(<label(?:.*?)>(?:.*?)<\/label>)\s*(<span class="required">\*<\/span>)?\s*(<input(?:.*?)\/>)/', '\3\1\2',$field);
            }
            return $fields;
        }
        add_filter('comment_form_default_fields', 'constructor_comment_fields');
    ?>
<?php comment_form(); ?>
</div>