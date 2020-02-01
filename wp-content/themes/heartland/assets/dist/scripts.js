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
		var menu = $('.menu');
		var body = $('body');

		$('> .menu-item-has-children > a', menu).click(function(e) {
	        e.preventDefault();

	        body.addClass('drawer-open');
	        $(this).parent().addClass('open');
	    });

	    $('.back-menu a').click(function(e) {
	        body.removeClass('drawer-open');
	        $('> .menu-item', menu).removeClass('open');
	    });

	    $('.burger').click(function(e) {
			e.preventDefault();
	        e.stopImmediatePropagation();
	        body.toggleClass('menu-open');

	        if (body.hasClass('menu-open')) {
	            body.removeClass('drawer-open');
	            $('> .menu-item', menu).removeClass('open');
	        }
	    });

	    // $('> .menu-item:not(.menu-item-has-children):not(:last-child) > a', menu).click(function(e) {
	    //     body.removeClass('drawer-open');
	    //     body.removeClass('menu-open');
	    // });
	};

} ( window.megaMenu = window.megaMenu || {}, jQuery ) );
