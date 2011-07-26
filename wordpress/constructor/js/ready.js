/**
 * @package WordPress
 * @subpackage Constructor
 * 
 * @author   Anton Shevchuk <AntonShevchuk@gmail.com>
 * @link     http://anton.shevchuk.name
 */
(function($){
    $(document).ready(function(){

        // Header Drop-Down Menu
        if ($("#menu ul ul").length > 0) {
			
			$("#menu li:has(ul)").addClass('indicator');
			
			$("#menu li:has(ul)").hover(function(){
				$(this)
					.addClass('hover')
					.children('ul')
						.stop(true,true)
						.slideDown()
					;
				$(this).find('div.menu-header-menu-container')
					   .children('ul')
                           .stop(true,true)
                           .slideDown()
					;
			}, function(){
				$(this)
					.removeClass('hover')
					.children('ul')
					.slideUp()
					;
				$(this).find('div.menu-header-menu-container')
					   .children('ul').slideUp()
					;
			});
        }
		
		// Header Search Form
		$('#menusearchform .s').mouseenter(function(){
		    var $this = $(this);
		    if (!$this.data('expand')) {
		        $this.data('expand', true);
			    $this.animate({width:'+=32px',left:'-=16px'});
		    }
		}).mouseleave(function(){
		    var $this = $(this);
		    $this.data('expand', false);
            $this.animate({width:'-=32px',left:'+=16px'});
        });

        // Header Slideshow
		if ($('.wp-sl').length > 0) {
			var sl = $('.wp-sl').wpslideshow({
			    url:wpSl.slideshow,
				thumb: wpSl.thumb,
				thumbPath: wpSl.thumbPath,
				limit: 480,
				effectTime: 1000,
				timeout: 10000,
				play: true
			});
		}
		
		// No underline for a with img
		$('a:has(img)').css({border:0});
    });
})(jQuery);