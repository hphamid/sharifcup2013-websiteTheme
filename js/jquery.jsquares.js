(function($) {
		$.fn.jsquares = function(options){
		
		// General
		var main = this;
		var image_counter = 0;
		var dropin_int = 0;
		
		// Set up the default options
		var defaults = { 
		
			// Public 
			js_image: '.js-image', // target (div) holding info
			js_caption: '.js-small-caption', // target caption
			js_caption_overlay_spacing: 12, // caption overlay padding/spacing... sort of
			js_caption_width: 400, // caption overlay width
			js_caption_height:130, // caption overlay height
			js_fade_to: .3, // fade image/caption to what..
			js_fade_start: 1, // send image back to...
			js_fade_speed: 'fast', // int or string: anytime the fade effect is used, how fast should it be
			js_shuffle_in: true, // have the pictures all fade in on page load?
			js_shuffle_in_speed: 130, // how long to wait before we fade in the next image on page load
			js_fade_on_hover: true, // do we want the images to fade on hover or just change opacity?
			js_caption_slide_down: true, // do we want the caption to slide down or just appear?
			js_caption_slidedown_speed: 'normal', // how fast to slidedown the caption
			
			// Overwrite at your own risk! (more-so private)
			_fade_selectors_on_hover: 'img',
			_overlay_selector_class: 'js-caption-overlay'
			
		};
		
		// Now overwrite the default options with the ones passed in
		var options = $.extend(defaults, options);  
		
		// Cached vars for later
		var $js_image = $(options.js_image, main);
		var $js_image_children = $js_image.find(options._fade_selectors_on_hover);
		var $js_capt = $js_image.find(options.js_caption);
		var window_width = $(window).width();
		
		// Adjust the var is people resize!
		$(window).resize(function(){
			window_width = $(window).width();
		});
			
		// Custom functions called on the hover events
		var revealBinds = function(e, i, evt){
			caption(i);
			fadeInOutImage('in', options.js_fade_to, i);
		}
		
		// Functions called from the binds
		var fadeInOutImage = function(in_out, opacity_val, i){
			
			if(in_out == 'in'){
				var chain = $js_image.not(':eq(' + i + ')').find(options._fade_selectors_on_hover);
				var capt = $js_image.not(':eq(' + i + ')').find(options.js_caption);
			}
			else {
				var chain = $js_image_children;
				var capt = $js_capt;
			}
			
			//if(options.js_fade_on_hover){
			//	$(chain).fadeTo(options.js_fade_speed, opacity_val);
			//	$(capt).fadeTo(options.js_fade_speed, opacity_val);
			//}
			//else {
			//	$(chain).css('opacity', opacity_val);
			//	$(capt).css('opacity', opacity_val);
			//}	
		
		}
		
		// Display the caption!
		var caption = function(index){
			
			$('.' + options._overlay_selector_class).remove(); // remove any stray captions
			var $current_image = $(options.js_image + ':eq(' + index + ')', main);
			var overlay_sett = getCaptionSettings($current_image);
			var contents = $current_image.find('.js-overlay-caption-content').html() || '';
			var caption_options = (options.js_caption_slide_down) ? { display: 'none' } : {};
			
			// wrap it appropriately with an image etc.
			if(contents){
				
				var conts = contents;
				var img = $current_image.find('img');
				var wrap_a_start = '';
				var wrap_a_end = '';
				
				// if the image is wrapped in an anchor, link the image on the overlay as well!
				if(a = img.parent().attr('href')){
					wrap_a_start = '<a href="' + a + '">';
					wrap_a_end = '</a>';
				}
				
				contents = wrap_a_start + '<img src="' + img.attr('src')  + '" class="js-overlay-image" />' + wrap_a_end;
				contents += '<div class="js-overlay-html">' + conts + '</div><div style="clear:both"></div>';
				
			}
			
			var caption_options = $.extend({
				top: overlay_sett.y,
				left: overlay_sett.x,
				width: overlay_sett.width,
				height: overlay_sett.height
			}, caption_options); 
			
			// draw the caption	
			$('<div id="js-overlay-id-' + index + '">' + contents + '</div>')
			.css(caption_options)
			.addClass(options._overlay_selector_class)
			.appendTo('body')
			.hover(
				function(){}, 
				function(){
					fadeInOutImage('out', options.js_fade_start)
					$('#js-overlay-id-' + index).remove();
				}
			);
			
			if(options.js_caption_slide_down){
				$('#js-overlay-id-' + index).fadeIn(options.js_caption_slidedown_speed)
			}
			
		}
		
		// Return an object that contains where the caption should be positioned etc.
		var getCaptionSettings = function(image){
			
			var loc = elementLocation($(image));
			var loc_x = loc.x - options.js_caption_overlay_spacing;
			var loc_y = loc.y - options.js_caption_overlay_spacing;
			
			var img_height = options.js_caption_height + (options.js_caption_overlay_spacing * 2);
			var img_width = options.js_caption_width + (options.js_caption_overlay_spacing * 2); 
			
			var check_window_width = loc_x + img_width + (options.js_caption_overlay_spacing * 2);
			
			// Do we need to open the overlay in the opposite direction?
			if(check_window_width >= window_width){
				var hard_img_width = $(image).outerWidth();
				loc_x = loc_x - (options.js_caption_width + (options.js_caption_overlay_spacing * 2)) + hard_img_width;
			}
			
			return { x: loc_x, y: loc_y, width: img_width, height: img_height }; 
			
		}
		
		// If they chose to have the effect slide down, run it here
		var setImageTimeoutSlideDown = function(images){
			
			images = shuffle(images);
			
			dropin_int = setInterval(function(){
				
				if(image_counter == images.length){
					clearInterval(dropin_int);
					return false;
				}
				
				var $img = $(options.js_image + ':eq(' + images[image_counter] + ')', main)
				var img_height = $img.height();
				$img.fadeIn(options.js_fade_speed);
				image_counter++
				
			}, options.js_shuffle_in_speed);
			
			
		}
		
		// Get the location of the element on the page
		var elementLocation = function(obj){
		
			var curleft = 0;
			var curtop = 0;
			  
			do {
				curleft += obj.attr('offsetLeft');
				curtop += obj.attr('offsetTop');
				obj = obj.offsetParent();
			} while ( obj.attr('tagName') != 'BODY' );

			return { x:curleft, y:curtop };
			
		}
		
		// Give an array a random order
		var shuffle = function(v){
		    for(var j, x, i = v.length; i; j = parseInt(Math.random() * i), x = v[--i], v[i] = v[j], v[j] = x);
		    return v;
		};
		
		
		// Run the process of revealing/hiding captions
		return this.each(function() {
			
			// Hide all the images off the start and push them into an array
    		var images = [];
    		$js_image.each(function(i){ $(this).hide(); images.push(i); });
    		
    		// Run the effect of sliding down?
    		(options.js_shuffle_in) ? setImageTimeoutSlideDown(images) : $js_image.show();
    		
    		// Add hover action for each image 
    		$js_image.each(function(i){
    			
    			$(this).hoverIntent(
    				function(evt){ revealBinds(this, i, evt); }, 
    				function(evt){  }
    			);
    			
    		});
    		
		});
		
		
	};
	
})(jQuery);

/**

*/
if(typeof $.fn.hoverIntent != 'function'){
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY;};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev]);}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev]);};var handleHover=function(e){var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(p&&p!=this){try{p=p.parentNode;}catch(e){p=this;}}if(p==this){return false;}var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);}if(e.type=="mouseover"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob);},cfg.timeout);}}};return this.mouseover(handleHover).mouseout(handleHover);};})(jQuery);
}