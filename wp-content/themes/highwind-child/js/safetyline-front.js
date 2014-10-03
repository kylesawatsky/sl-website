jQuery(document).ready(function() {
  if(jQuery('.flexslider').length > 0){
    jQuery('.flexslider').flexslider({
	  slideshow: true,
      animation: "slide",
	  pauseOnHover: true,
	  start: function (slider) {
			var curslide = jQuery('.flexslider li:eq(1)');
			slideIncomingAnimation(curslide);
		},
		before: function (slider) {
			var curslide = jQuery('.flexslider li:eq(' + (slider.currentSlide + 1) + ')');
			slideOutgoingAnimation(curslide);
		},
		after: function (slider) {
			var curslide = jQuery('.flexslider li:eq(' + (slider.currentSlide + 1) + ')');
			slideIncomingAnimation(curslide);
		}
    });
	
	var $flexiLi = jQuery('.flexslider li'),
    $flexiSlider = jQuery('.flexslider'),
    flecheIsHover = false,
    first = true;
	
	function slideIncomingAnimation(curslide) {
		if (first) {
			jQuery('.flex-direction-nav li a').hover(function () {
				flecheIsHover = true;
			}, function () {
				flecheIsHover = false;
			});
			first = false;
		} else {
			$flexiSlider.removeClass('sliding');
		}
		curslide.addClass('current-slide');
		curslide.find('.flex-caption.slide-one.caption-side').delay(100).animate({
			right: '0',
			opacity: 0.8
		}, 600);
		curslide.find('.flex-caption.slide-one.caption-top').delay(100).animate({
			top: '1em',
			opacity: 1
		}, 600);
		curslide.find('.flex-caption.slide-two, .flex-caption.slide-four').delay(100).animate({
			top: '1em',
			opacity: 1
		}, 600);
		curslide.find('.flex-caption.slide-three').delay(100).animate({
			left: '0',
			opacity: 0.8
		}, 600);
		curslide.find('.flex-illustration.slide-one, .flex-illustration.slide-two > img.first').animate({
			left: '0',
			opacity: 1
		}, 600);
		curslide.find('.flex-illustration.slide-one, .flex-illustration.slide-two > img.second').animate({
			bottom: '0',
			opacity: 1
		}, 600);
		curslide.find('.flex-illustration.slide-one, .flex-illustration.slide-two > img.third').animate({
			right: '0',
			opacity: 1
		}, 600);
		curslide.find('.flex-illustration.slide-three, .flex-illustration.slide-four').animate({
			right: '0',
			opacity: 1
		}, 600);
	}
	
	function slideOutgoingAnimation(curslide) {
		if (flecheIsHover === false) $flexiSlider.addClass('sliding');
		$flexiLi.removeClass('current-slide');
		var $otherslides = $flexiLi.not('.current-slide');
		$otherslides.find('.flex-caption.slide-one.caption-side').animate({
			opacity: 0
		}, 100, function () {
			jQuery(this).css('right', '-200px');
		});
		$otherslides.find('.flex-caption.slide-one.caption-top').animate({
			opacity: 0
		}, 100, function () {
			jQuery(this).css('top', '-200px');
		});
		$otherslides.find('.flex-caption.slide-two').animate({
			opacity: 0
		}, 100, function () {
			jQuery(this).css('top', '-200px');
		});
		$otherslides.find('.flex-caption.slide-two, .flex-caption.slide-four').animate({
			opacity: 0
		}, 100, function () {
			jQuery(this).css('top', '-200px');
		});
		$otherslides.find('.flex-caption.slide-three').animate({
			opacity: 0
		}, 100, function () {
			jQuery(this).css('left', '-200px');
		});
		$otherslides.find('.flex-illustration.slide-one, .flex-illustration.slide-two > img.first').animate({
			opacity: 0
		}, 100, function () {
			jQuery(this).css('left', '-200px');
		});
		$otherslides.find('.flex-illustration.slide-two > img.second').animate({
			opacity: 0
		}, 100, function () {
			jQuery(this).css('bottom', '-200px');
		});
		$otherslides.find('.flex-illustration.slide-three, .flex-illustration.slide-four, .flex-illustration.slide-two > img.third').animate({
			opacity: 0
		}, 100, function () {
			jQuery(this).css('right', '-200px');
		});
	}
	
	var smallImages = false;
	
	function checkForResize() {
		if(jQuery(window).width() < 769 && !smallImages) {
			jQuery(".slide-two.flex-illustration > .secondary").attr("src", function(i, val) {
				return val.replace("2-", "2-SMALL-");
			});
			smallImages = true;
		}
		if(jQuery(window).width() >= 769 && smallImages) {
			jQuery(".slide-two.flex-illustration > .secondary").attr("src", function(i, val) {
				return val.replace("2-SMALL-", "2-");
			});
			smallImages = false;
		}
	}
	
	checkForResize();
	
	jQuery(window).resize(function() {
		checkForResize();
	});
	
	jQuery('.flex-caption .caption-blue img').click(function(e){
		e.preventDefault();
		var tagID = "block-overview";
		var aTag = jQuery("#block-overview").closest('section');
		
		var navOffset = (jQuery('.toggle-container').height() > 0 ? 0 : jQuery('#navigation').outerHeight()) + jQuery(this).parent().parent().outerHeight();

		jQuery('html, body').animate({scrollTop: aTag.offset().top - navOffset}, 'slow');
	});
	
	jQuery('.flex-caption .caption-clear img').click(function(e){
		e.preventDefault();
		var tagID = "block-devices";
		var aTag = jQuery("#block-devices").closest('section');
		
		var navOffset = (jQuery('.toggle-container').height() > 0 ? 0 : jQuery('#navigation').outerHeight()) + jQuery(this).parent().parent().outerHeight();

		jQuery('html, body').animate({scrollTop: aTag.offset().top - navOffset}, 'slow');
	});
  }
});