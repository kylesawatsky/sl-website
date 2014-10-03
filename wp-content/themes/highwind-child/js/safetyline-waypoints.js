function loadWaypoints() {
jQuery(document).ready(function() {
	//Sets the 'stuck' class on the sticky-nav elements when they hit the top of the page
	jQuery('.sticky-nav').waypoint('sticky', {
		offset: function() {
			if (jQuery('.toggle-container').height() > 0)
				return 0;
			else
				return jQuery('#navigation').outerHeight();
		}
	});
  
	//Sets the 'active' class on the sticky-nav items when the corresponding content block hits the top of the page
	jQuery('.anchor').closest('section').waypoint(function(direction) {
	var location = jQuery(this).find('.anchor').data("location");

	toggleIcon(jQuery('#block-nav-' + location + ', #block-nav-' + (location - 1)));
	}, {
	offset: function() {
		if (jQuery('.toggle-container').height() > 0)
			return 3;
		else
			return jQuery('#navigation').outerHeight() + 160;
	}
	});
  
	var smallImages = false;
	
	function toggleIcon($toggleElements) {
		$toggleElements.each(function(index) {
			jQuery(this).find("img").attr("src", function(i, val) {
				if(val.indexOf("w_") != -1)
					return val.replace("w_", "b_");
				else
					return val.replace("b_", "w_");
			});
		});
	}
	
	resizeIcons();

	jQuery(window).resize(function() {
		resizeIcons();
	});

	function resizeIcons() {
		if(jQuery(window).width() < 869 && !smallImages) {
			jQuery(".sticky-nav-item img").attr("src", function(i, val) {
				return val.replace("b_", "sb_").replace("w_", "sw_");
			});
			smallImages = true;
		}
		if(jQuery(window).width() >= 869 && smallImages) {
			jQuery(".sticky-nav-item img").attr("src", function(i, val) {
				return val.replace("sb_", "b_").replace("sw_", "w_");
			});
			smallImages = false;
		}
	}
  
	//Removes the 'stuck' class from a categories sticky-nav when the bottom of the category hits the top of the page
	jQuery('.content-category').waypoint(function(direction) {
	var category = jQuery(this).data("category");
	var height = jQuery('#sticky-nav-' + category).height();
	jQuery('#sticky-nav-' + category).toggleClass('stuck');
	jQuery('#sticky-nav-' + category).parent().css('height', height);
	}, {
	offset: function() {
		if (jQuery('.toggle-container').height() > 0)
			return jQuery(this).height();
		else
			return jQuery('#navigation').outerHeight() - jQuery(this).height() + 50;
	}
	});
  
	//Animates scroll down to corresponding content block when you click a sticky-nav item
	jQuery('.sticky-nav-item > a').click(function(e){
		e.preventDefault();
		var tagID = this.href;
		var aTag = jQuery(jQuery(this).attr('href'));

		var navOffset = (jQuery('.toggle-container').height() > 0 ? 0 : jQuery('#navigation').outerHeight()) + jQuery(this).parent().parent().outerHeight();

		jQuery('html, body').animate({scrollTop: aTag.closest('section').offset().top - navOffset}, 'slow');

		location.hash = jQuery(this).attr('href');
	});
});
}