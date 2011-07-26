/**
 * @package WordPress
 * @subpackage Constructor
 * 
 * @author   Anton Shevchuk <AntonShevchuk@gmail.com>
 * @link     http://anton.shevchuk.name
 * 
 * @version 0.4
 */
(function($){
    /**
     * Create a new instance of slideshow.
     *
     * @classDescription	This class creates a new slideshow and manipulate it
     *
     * @return {Object}	Returns a new slideshow object.
     * @constructor
     */
    $.fn.wpslideshow = function(options) {
        var defaults = {
            url:false,
            thumb:false,
            thumbPath:'/wp-content/themes/constructor/timthumb.php?src=',
            effect:'slide', // can be 'slide'
            effectTime:300,
            timeout:3000,
            play:true
            
        };
        var options  = $.extend({}, defaults, options);
        
        var slideshow = this;

        /**
         * external functions - append to $
         *
         * @param string title
         * @param string url
         * @param string img
         * @param string text
         */
        slideshow.addSlide = function(title, url, img, text){ 
            slideshow.each(function () { this.addSlide(title, url, img, text); })
        };
        
        /**
         * external functions - append to $
         */
        slideshow.nextSlide = function(){ 
            slideshow.each(function () { this.nextSlide(); })
        };
        
		/*
		 * Construct
		 */
		return this.each(function(){
            var _self = this;
            var $this = $(this);
            var counter = 0;
            var playId = null;
            
            $this.addClass('opacity');
            $this.append('<span class="prev opacity medium button">&laquo;</span>');
            $this.append('<span class="next opacity medium button">&raquo;</span>');
            $this.append('<div class="slides"></span>');
            
            $slides = $this.find('.slides');
            
            $this.find('> span.prev').click(function(){
                _self.prevSlide();
            });
            $this.find('> span.next').click(function(){
                _self.nextSlide();
            });
            
            /**
             * add slide to stack
             *
             * @param string title
             * @param string url
             * @param string img
             * @param string text
             */
            this.addSlide = function(title, url, img, text){                
//                if (text.length > options.limit) {
//                    text = text.substring(0, options.limit);
//                    text += '...';
//                }
                var domain = document.domain;
                    domain = domain.replace(/\./i,"\.");  // for strong check domain name

                var relocal = new RegExp("^((https?:\/\/"+domain+")|(?!http:\/\/))", "i");
                
                if (options.thumb && relocal.test(img))
                    img = options.thumbPath + escape(img) + '&h=' + $this.height() + '&w=' + Math.round($this.width()/2) + '&zc=1&q=95';
                
                
                $slides.append('<div><a href="'+url+'" title="'+title+'" class="title opacity shadow">'+title+'</a><p class="box shadow opacity">'+text+'</p></div>');
                
                var div = $slides.find('> div:last');
                
                div.css('background','url('+ img +') no-repeat');
                div.click(function(){
                    _self.stop();
                });
                
                if (counter!=0) {
                    div.hide();
                }
                counter++;
            };
            
            this.nextSlide = function(){
                
                if ($slides.find('> div').length == 1) return;
                
                var current = $slides.find('> div:visible');
                var next    = $slides.find('> div:visible').next('div');
                
                if (next.length == 0) {
                    next = $slides.find('> div:first');
                }
                
                current.css({});
                next.css({left:$this.width()}).show();
                
				current.stop(true, true);
				next.stop(true, true);
				
                current.animate({left:-$this.width()}, options.effectTime, function(){ $(this).hide()});
                next.animate({left:0}, options.effectTime);
                
                _self.stop();
                
                if (options.play) {
                    _self.play();
                }
            }
            this.prevSlide = function(){
                
                if ($slides.find('> div').length == 1) return;
                
                var current = $slides.find('> div:visible');
                var prev    = $slides.find('> div:visible').prev('div');
                
                if (prev.length == 0) {
                    prev = $slides.find('> div:last');
                }
                
                current.css({});
                prev.css({left:-$this.width()}).show();
                
				current.stop(true, true);
				prev.stop(true, true);
				
                current.animate({left:$this.width()}, options.effectTime, function(){ $(this).hide()});
                prev.animate({left:0}, options.effectTime);
                
                _self.stop();
                
                if (options.play) {
                    _self.play();
                }
            }
            
            this.play = function(){
                _self.playId = setTimeout(function(){
                    _self.nextSlide();
                }, options.timeout);
            }
            
            this.stop = function(){
                if (_self.playId)
                    clearTimeout(_self.playId);
            }

            this.load = function(){
    			$.ajax({
    				type: "GET",
    				url: options.url,
    				dataType: "xml",
    				success: function(data){
    					if ($('post', data).length == 0) {
    						$('#slideshow').hide();
    					};
    					$('post', data).each(function(){
    						var $xml = $(this);
    						_self.addSlide($xml.children('title').text(),
        								   $xml.find('permalink').text(),
        								   $xml.find('image').text(),
        							       $xml.find('content').text());
    					});
    				}
    			});  
            }
            
            this.load();
            
            if (options.play) {
                this.play();
            }
            return _self;
        });
    }
})(jQuery);