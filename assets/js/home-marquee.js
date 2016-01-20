/* Written by Enzo Martin
 *
 * GitHub: https://github.com/EnzoMartin78/
 * Twitter: EnzoMartin
 */

;(function($, window, undefined) {

	"use strict";

	/**
	 * Simple Banner constructor
	 * @param element
	 * @param options
	 * @constructor
	 */
	var Simplebanner = function(element, options) {
		this.element = element;
		this._paused = false;
		this._timer = {};
		this._currentBanner = {};
		this._newBanner = {};
		this._bannerWidth = 0;
		this._bannerHeight = 0;
		this._bannerCount = 0;
		this.options = $.extend({
			arrows: true,
			indicators: true,
			pauseOnHover: true,
			autoRotate: true,
			rotateTimeout: 5000,
			animTime: 0
		}, options);
		this.init();
	};
	
	/**
     * Initializer
     */
	var Checker = false, tempNum = 0;
	Simplebanner.prototype.init = function() {
		var self = this;
		this._bannerCount = this.element.children('div.marquee_item').length;
		this._bannerWidth = this.element.children('div.marquee_item').outerWidth();
		this._bannerHeight = this.element.children('div.marquee_item').outerHeight();
		
		if(!this._bannerWidth){
			this._bannerWidth = this.element.width();
		}
		if(!this._bannerHeight){
			this._bannerHeight = this.element.height();
		}
		
		this._currentBanner = this.element.children('div.marquee_item:first-child');
		this.element.children('div.marquee_item').each( function() { $(this).fadeOut(0) } );
		this._currentBanner.delay(200).stop(false, true).fadeIn(1000);
		
		$('.marquee_nav_thumbnail', $('#marquee_nav_thumbnail_list')).each( function() { $(this).removeClass('marquee_nav_thumbnail_selected') } );
		$('.marquee_nav_thumbnail', $('#marquee_nav_thumbnail_list')).first().addClass('marquee_nav_thumbnail_selected');
		$('#marquee_nav_showtitle_box').text($('#marquee_nav_showtitles li').first().text());
		if(this._bannerCount > 1 && this.options.autoRotate){
			this.toggleTimer(false);
		}
		
		$('#marquee_nav_container').delay(1000).animate({top:'366'}, 200, function() {
			$('#marquee_nav_container').children('#marquee_nav_tip_arrow').delay(1000).addClass('marquee_nav_tip_arrow_up').removeClass('marquee_nav_tip_arrow_down');
		});
		
		$('#marquee_nav_container').on({
			'mouseenter': function() {
				$(this).stop(true, true).animate({top:'320'}, 200);
				$(this).children('#marquee_nav_tip_arrow').addClass('marquee_nav_tip_arrow_down').removeClass('marquee_nav_tip_arrow_up');
			},
			'mouseleave': function() {
				$(this).delay(1000).animate({top:'366'}, 200, function() {
					$(this).children('#marquee_nav_tip_arrow').addClass('marquee_nav_tip_arrow_up').removeClass('marquee_nav_tip_arrow_down');
				});
			}
			
		});
		
		$('#marquee_nav_thumbnail_list li').hover(function(){
			var numberOfChild = $("#marquee_nav_thumbnail_list li").index(this);
			$('#marquee_nav_showtitle_box').text($('#marquee_nav_showtitles li').parent().children(':eq(' + numberOfChild + ')').text());
			Checker = true;
		});
		
		$('#marquee_nav_thumbnail_list li').mouseout(function(){ 
			Checker = false;
			$('#marquee_nav_showtitle_box').text($('#marquee_nav_showtitles li').parent().children(':eq(' + tempNum + ')').text());
		});
		
		$('div.marquee_item').each( function() {
			$(this).on({
				'mouseenter': function() {
					$('.marquee_content', this).fadeIn("slow");
				},
				'mouseleave': function() {
					$('.marquee_content', this).fadeOut("slow");
				}
			})
												 
		});
		
		this.bindEvents();
		this.clickRightEvents();
		this.clickLeftEvents();
		this.videoEvents();
	};
	
	//left right arrow click
	Simplebanner.prototype.clickRightEvents = function() {
		var self = this;
		$('.marquee_right_arrow').on({
			'click': function(){
				var itemsNum = $('#marquee_nav_thumbnail_list li').length;
				self.toggleTimer(true);
				self._currentBanner.stop(false, true);
				var slideIndex = tempNum + 1;
				if(slideIndex >= itemsNum)
					slideIndex = 0;
				
				self._newBanner = self.element.children('div.marquee_item:eq(' + slideIndex + ')');
				self.goToBanner(slideIndex, true);
				return false;
			}
		});
	}
	
	Simplebanner.prototype.clickLeftEvents = function() {
		var self = this;
		$('.marquee_left_arrow').on({
			'click': function(){
				var itemsNum = $('#marquee_nav_thumbnail_list li').length;
				self.toggleTimer(true);
				self._currentBanner.stop(false, true);
				var slideIndex = tempNum - 1;
				if(slideIndex < 0)
					slideIndex = itemsNum - 1;
					
				self._newBanner = self.element.children('div.marquee_item:eq(' + slideIndex + ')');
				self.goToBanner(slideIndex, true);
				return false;
			}
		});
	}
	
	Simplebanner.prototype.videoEvents = function() {
		var self = this;
		
		$('div.marquee_video_play, div.marquee_video_play_flash').on({
			'click': function() {
				self.toggleTimer(true);
				var video_link = $(this).children('.marquee_video_link').html();
				var video_type = video_link.substr(video_link.length - 3);
				
				var marquee_container = $('#marquee_container');
				var player_top = (marquee_container.position()).top;
				var player_height = marquee_container.css('height');
					
				$("#marquee_video_player_container").addClass('modalPopup');
				$("#marquee_video_player_container").css( {top: player_top + 'px'} );
				$("#marquee_video_player_container").show();
			
				if (video_type == 'flv') {
					$("#marquee_video_player_playlist").flowplayer({
						playlist: [
							[
								{ flv:  video_link },
							]
						],
						engine: "flash",
						//key: "$325822610779515",	// LICENSE FOR HBOASIA.COM
						key: '$130388743137804',	// LICENSE FOR 127.0.0.1
						logo: 'http://127.0.0.1/assets/img/core/logo-hbo-flowplayer.png',
						//width: 661,
						//height: 350
						//ratio: 3/4 // video with 4:3 aspect ratio
					});
				} else {
					$("#marquee_video_player_playlist").flowplayer({
						playlist: [
							[
								{ mp4:  video_link },
							]
						],
						engine: "html5",
						//key: "$325822610779515",	// LICENSE FOR HBOASIA.COM
						key: '$130388743137804',	// LICENSE FOR 127.0.0.1
						logo: 'http://127.0.0.1/assets/img/core/logo-hbo-flowplayer.png',
						//width: 400,
						//height: 380
						//ratio: 1080/1920 // video with 4:3 aspect ratio
					});
				}
				
				var api = flowplayer($("#marquee_video_player_playlist"));
				api.bind('finish', function(e, api) {
					$("#marquee_video_player_container div.close_popup_video").click();
				});
				api.play(0);
				
				//return false;
			}
		});
		
		$("#marquee_video_player_container div.close_popup_video").on({
			'click': function() {
				$("#marquee_video_player_container").fadeOut("slow", function() {
					try {
						flowplayer($("#marquee_video_player_playlist")).stop(0);
						flowplayer($("#marquee_video_player_playlist")).unload();
					} catch(e) {
						//console.log(e);
					}
				});
				self.toggleTimer(false);
			}
		});
		
	}
	
	// This sets the basic events based off the options selected
	Simplebanner.prototype.bindEvents = function() {
		var self = this;
		$('#marquee_nav_thumbnail_list').children().each( function() {
			$(this).on({
				'click': function() {
					if (!$(this).hasClass('marquee_nav_thumbnail_selected')) {
						self.toggleTimer(true);
						self._currentBanner.stop(false, true)
						var slideIndex = $(this).index();
						self._newBanner = self.element.children('div.marquee_item:eq(' + slideIndex + ')');
						self.goToBanner(slideIndex, true);
						$("#marquee_video_player_container div.close_popup_video").click();
					}
					return false;
				},
				'mouseenter': function() {
					
				}
			})
		});
		
		if(self.options.pauseOnHover && self.options.autoRotate){
			self.element.on({
				"mouseenter": function() {
					self.toggleTimer(true);
				},
				"mouseleave": function() {
					var video_playing = false;
					try {
						video_playing = flowplayer($("#marquee_video_player_playlist")).playing;
					} catch(e) {
					}
					
					if (!video_playing) {
						self.toggleTimer(false);
					}
				}
			});
		}
		
	};
	
	// Goes to the next banner - loops back to the first banner
	Simplebanner.prototype.nextBanner = function() {
		if (this._currentBanner.next('div.marquee_item').length) {
			this._newBanner = this._currentBanner.next('div.marquee_item');
		} else {
			this._newBanner = this.element.children('div.marquee_item:first-child');
		}
		this.goToBanner(this._newBanner.index(), false);
	};

	// Goes to the previous banner - loops back to the last banner
	Simplebanner.prototype.previousBanner = function() {
		if (this._currentBanner.prev('div.marquee_item').length) {
			this._newBanner = this._currentBanner.prev('div.marquee_item');
		} else {
			this._newBanner = this.element.children('div.marquee_item:last-child');
		}
		this.goToBanner(this._newBanner.index(), false);
	};
	
	/**
     * Goes to a specific slide - This is called by both the Previous and Next methods as well as the Indicator buttons
     * @param slideIndex
     */
	Simplebanner.prototype.goToBanner = function(slideIndex, jumpTo) {
		var self = this;
		
		if (jumpTo) {
			self._currentBanner.fadeOut(10);
		} else {
			self._currentBanner.fadeOut(1000);
		}
		$('.marquee_nav_thumbnail', $('#marquee_nav_thumbnail_list')).parent().children(':eq(' + self._currentBanner.index() + ')').removeClass('marquee_nav_thumbnail_selected');
		self._currentBanner = self._newBanner;
		
		$('.marquee_nav_thumbnail', $('#marquee_nav_thumbnail_list')).parent().children(':eq(' + slideIndex + ')').addClass('marquee_nav_thumbnail_selected');
		
		if(!Checker){
			$('#marquee_nav_showtitle_box').text($('#marquee_nav_showtitles li').parent().children(':eq(' + slideIndex + ')').text());
		};
		
		if (jumpTo) {
			self._currentBanner.stop(false, true).fadeIn(300);
		} else {
			self._currentBanner.delay(1000).stop(false, true).fadeIn(4000);
		}
		tempNum = slideIndex;
		self.toggleTimer(false);
	};

	// Create the correct amount of indicators based off total banners
	Simplebanner.prototype.buildIndicators = function() {
		var self = this;
		var indicatorUl = self.element.find('.bannerIndicators ul');
		self.element.find('.marquee_list li').each(function(){
			indicatorUl.append('<li class="bannerIndicator"></li>');
		});
		indicatorUl.find('li:first').addClass('current');
	};

	/**
     * Starts or stops the timer for going to the next banner
     * @param timer
     */
	Simplebanner.prototype.toggleTimer = function(timer) {
		var self = this;
		clearTimeout(self._timer);
		if(!timer){
			self._timer = setTimeout(function(){
				self.nextBanner();
				self.toggleTimer(false);
			}, self._currentBanner.children('div.marquee_timer').html());
			//}, self.options.rotateTimeout);
		}
	};

	// jQuery wrapper method
	$.fn.simplebanner = function(options) {
		var method, args, ret = false;
		if (typeof options === "string") {
			args = [].slice.call(arguments, 0);
		}

		this.each(function() {
			var self = $(this);
			var instance = self.data("stickyInstance");
			
			if(!self.attr('id')){
				self.attr('id','simpleBanner-' + ($.fn.simplebanner._instances.length+1));
			}
			
			if (instance && options) {
				if (typeof options === "object") {
					ret = $.extend(instance.options, options);
				} else if (options === "options") {
					ret = instance.options;
				} else if (typeof instance[options] === "function") {
					ret = instance[options].apply(instance, args.slice(1));
				} else {
					throw new Error('Simple Banner has no option/method named "' + method + '"');
				}
			} else {
				instance = new Simplebanner(self, options || {});
				self.data("stickyInstance", instance);
				$.fn.simplebanner._instances.push(instance);
			}
		});
		
		return ret || this;
	};

	$.fn.simplebanner._instances = [];

	// Deathstar death beam
	$(document).on("pageleave", function () {
		$.each($.fn.simplebanner._instances, function() {
			this.children().off();
		});
		$.fn.simplebanner._instances = [];
	});
}($, window));