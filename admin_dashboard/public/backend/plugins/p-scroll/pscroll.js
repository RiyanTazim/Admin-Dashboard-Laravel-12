/* (function($) {
	"use strict";

	// For APP-SIDEBAR
	const ps = new PerfectScrollbar('.app-sidebar', {
	  useBothWheelAxes:true,
	  suppressScrollX:true,
	});

	// For Header Message dropdown
	const ps2 = new PerfectScrollbar('.message-menu', {
		useBothWheelAxes:true,
		suppressScrollX:true,
	});

	// For Header Notification dropdown
	const ps3 = new PerfectScrollbar('.notifications-menu', {
	useBothWheelAxes:true,
	suppressScrollX:true,
	});

	// For Header Cart dropdown
	const ps4 = new PerfectScrollbar('.cart-menu', {
	useBothWheelAxes:true,
	suppressScrollX:true,
	});

})(jQuery); */

(function($) {
	"use strict";

	// Helper function to safely init scrollbar
	function initScrollbar(selector, options) {
		var el = document.querySelector(selector);
		if (el) {
			new PerfectScrollbar(el, options);
		}
	}

	const options = {
		useBothWheelAxes: true,
		suppressScrollX: true,
	};

	// For APP-SIDEBAR
	initScrollbar('.app-sidebar', options);

	// For Header Message dropdown
	initScrollbar('.message-menu', options);

	// For Header Notification dropdown
	initScrollbar('.notifications-menu', options);

	// For Header Cart dropdown
	initScrollbar('.cart-menu', options);

})(jQuery);

