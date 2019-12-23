/**
 * Main JS file - put all your custom js here
 */

// Foundation
jQuery( window ).on( 'load', function( $ ) {
	'use strict';

	// Bootstrap
	megaMenu.init();
} );

( function( megaMenu, $, undefined ) {
	'use strict';

	megaMenu.init = function() {
		var burger = $('#menu .burger');
		var body = $('body');

		burger.click(function() {
			body.toggleClass('menu-open');
		});
	};

} ( window.megaMenu = window.megaMenu || {}, jQuery ) );
