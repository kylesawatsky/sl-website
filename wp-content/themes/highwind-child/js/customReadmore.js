/*!
 * customReadmore.js jQuery plugin
 * Author: @jed_foster
 * Project home: jedfoster.github.io/customReadmore.js
 * Licensed under the MIT license
 */

;(function($) {

  var customreadmore = 'customreadmore',
      defaults = {
        speed: 100,
        maxHeight: 200,
        moreLink: '<a href="#">Read More</a>',
        lessLink: '<a href="#">Close</a>',
        embedCSS: true,
        sectionCSS: 'display: block; width: 100%;',

        // callbacks
        beforeToggle: function(){},
        afterToggle: function(){}
      },
      cssEmbedded = false;

  function customReadmore( element, options ) {
    this.element = element;

    this.options = $.extend( {}, defaults, options);

    $(this.element).data('max-height', this.options.maxHeight);

    delete(this.options.maxHeight);

    if(this.options.embedCSS && ! cssEmbedded) {
      var styles = '.readmore-js-toggle, .customreadmore-js-section { ' + this.options.sectionCSS + ' } .customreadmore-js-section { overflow: hidden; }';

      (function(d,u) {
        var css=d.createElement('style');
        css.type = 'text/css';
        if(css.styleSheet) {
            css.styleSheet.cssText = u;
        }
        else {
            css.appendChild(d.createTextNode(u));
        }
        d.getElementsByTagName("head")[0].appendChild(css);
      }(document, styles));

      cssEmbedded = true;
    }

    this._defaults = defaults;
    this._name = customreadmore;

    this.init();
  }

  customReadmore.prototype = {

    init: function() {
      var $this = this;

      $(this.element).each(function() {
        var current = $(this),
            maxHeight = (current.css('max-height').replace(/[^-\d\.]/g, '') > current.data('max-height')) ? current.css('max-height').replace(/[^-\d\.]/g, '') : current.data('max-height');

        current.addClass('customreadmore-js-section');

        if(current.css('max-height') != "none") {
          current.css("max-height", "none");
        }

        current.data("boxHeight", current.outerHeight(true));

        if(current.outerHeight(true) < maxHeight) {
          // The block is shorter than the limit, so there's no need to truncate it.
          return true;
        }
        else {
			current.closest("section").find(".info-image > div").append($($this.options.moreLink).on('click', function(event) { $this.toggleSlider(this, current, event) }).addClass('readmore-js-toggle'));
          //current.after($($this.options.moreLink).on('click', function(event) { $this.toggleSlider(this, current, event) }).addClass('customreadmore-js-toggle'));
        }

        current.data('sliderHeight', maxHeight);

        current.css({height: maxHeight});
      });
    },

    toggleSlider: function(trigger, element, event)
    {
      event.preventDefault();

      var $this = this,
          newHeight = newLink = '',
          more = false,
          sliderHeight = $(element).data('sliderHeight');

	  //This happens if it is not expanded
      if ($(element).height() == sliderHeight) {
        newHeight = $(element).data().boxHeight + "px";
        newLink = 'lessLink';
        more = true;
		
		var columnType = $(trigger).parent().attr("class");
		$(element).find("div").hide();
		$(element).find("div#" + columnType + "-text").show();
		
		$(trigger).parent().addClass("current-column");
      }

	  //This happens if it is expanded
      else {
        newHeight = sliderHeight;
        newLink = 'moreLink';
		
		var columnType = $(trigger).parent().attr("class");
		
		$(element).animate({"height": newHeight}, {duration: $this.options.speed, complete: function() {
			$(element).find("div").hide();
			$(element).find("div#" + columnType + "-text").show();
			$this.options.afterToggle(trigger, element, more)
		  } });
		$(".current-column").append($($this.options[newLink]).on('click', function(event) { 
			$this.toggleSlider(this, element, event);
	    }).addClass('readmore-js-toggle'));
		
		$(trigger).closest(".info-image").find("div").removeClass("current-column");
		$(trigger).parent().addClass("current-column");
		
		newHeight = $(element).data().boxHeight + "px";
		newLink = 'lessLink';
      }

      // Fire beforeToggle callback
      $this.options.beforeToggle(trigger, element, more);
	  
      $(trigger).replaceWith($($this.options[newLink]).on('click', function(event) { 
		$this.toggleSlider(this, element, event);
	  }).addClass('readmore-js-toggle'));

      $(element).animate({"height": newHeight}, {duration: $this.options.speed, complete: function() {$this.options.afterToggle(trigger, element, more)} });

      // Fire afterToggle callback
      //$this.options.afterToggle(trigger, element, more);
    }
  };

  $.fn[customreadmore] = function( options ) {
    var args = arguments;
    if (options === undefined || typeof options === 'object') {
      return this.each(function () {
        if (!$.data(this, 'plugin_' + customreadmore)) {
          $.data(this, 'plugin_' + customreadmore, new customReadmore( this, options ));
        }
      });
    } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
      return this.each(function () {
        var instance = $.data(this, 'plugin_' + customreadmore);
        if (instance instanceof customReadmore && typeof instance[options] === 'function') {
          instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
        }
      });
    }
  }
})(jQuery);