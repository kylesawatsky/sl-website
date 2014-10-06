jQuery(window).load(function() {
	function preload(arrayOfImages) {
		jQuery(arrayOfImages).each(function(){
			jQuery('<img/>').load(function() { loadCommon(); if(typeof(loadWaypoints) === "function"){ loadWaypoints(); } })[0].src = this;
		});
	}

	preload([
		'/wp-content/uploads/2014/02/how-it-works-diagram.png'
	]);
});

function loadCommon() {
jQuery(document).ready(function() {
	//Note: This stuff is all dumb.
	//Initial fade for the content blocks
	/*
	jQuery(".article-content section.content-block").css("opacity", 0.6);
	jQuery(".post-760 .content-block").css("opacity", 1);

	//Fades in content blocks when scrolling down
	jQuery('.anchor').closest('section.content-block').waypoint(function(direction) {
		if(direction == "down") {
			var location = jQuery(this).find('.anchor').data("location");
			
			jQuery('#section-' + location).fadeTo('fast', 1);
			//jQuery('#section-' + (location - 1)).fadeTo('fast', 0.6);
		}
	}, {
		offset: '80%'
	});
	
	//Fades in content blocks when scrolling up
	jQuery('.anchor').closest('section.content-block').waypoint(function(direction) {
		if(direction == "up") {
			var location = jQuery(this).find('.anchor').data("location");
			
			jQuery('#section-' + location).fadeTo('fast', 1);
			//jQuery('#section-' + (location + 1)).fadeTo('fast', 0.6);
		}
	}, {
		offset: '20%'
	});
	
	jQuery('.custom-expand-section').customreadmore({
		speed: 600,
		maxHeight: 0,
		moreLink: '<div><img class="readmore-js-arrow" src="/wp-content/uploads/2014/02/arrow-LINE-black.png"></div>',
		lessLink: '',
		afterToggle: function(trigger, element, more) {
			jQuery.waypoints('refresh');
		}
	});*/
	
	//Inline colorbox implementation
	jQuery(".lightbox-popup").magnificPopup({
		focus: ".email",
		callbacks: {
			open: function() {
				jQuery("#mc_embed_signup .email").val(jQuery(".newsletter-signup .newsletter-email").val());
			}
		}
	});
	
	//Handle support for placeholder attribute
	if(!Modernizr.input.placeholder){

		jQuery('[placeholder]').focus(function() {
			  var input = jQuery(this);
			  if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			  }
			}).blur(function() {
			  var input = jQuery(this);
			  if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			  }
			}).blur();
			jQuery('[placeholder]').parents('form').submit(function() {
			  jQuery(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
				  input.val('');
				}
			  })
			});
	}
	
	//Search button for all pages
	jQuery('.search-button').click(function() {
		jQuery('.side-nav-search, .flexslider, .inner-wrap').toggle();
		jQuery('.search-button').toggleClass('fa-search fa-times');
	});
	
	jQuery.waypoints('refresh');

	//Properly animates the scroll when loading a new page with a scroll hash in the url
	setTimeout(function() {
		var hash = location.hash;
		if (hash.length) {
			if (hash == "#demo-form") {
				jQuery('#demo-button').click();
				return 0;
			}
			if (hash == "#cntctfrm_contact_form") {
				jQuery('#contact-button').click();
				return 0;
			}
			var navOffset = (jQuery('.toggle-container').height() > 0 ? 0 : jQuery('#navigation').outerHeight()) + jQuery(".sticky-nav").outerHeight();
			jQuery('html, body').animate({scrollTop: jQuery(hash).closest('section').offset().top - navOffset}, 'slow');
		}
	}, 100);
});
}