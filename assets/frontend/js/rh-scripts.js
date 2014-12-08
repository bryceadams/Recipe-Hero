(function ( $ ) {
	"use strict";

	// Strike through ingredient line when checkbox checked
	$('.ingredient-checkbox').click (function(){
		var thisCheck = $(this);

		if ( thisCheck.is(':checked') ) {
			$(this).nextAll('div').css('text-decoration', 'line-through');
		} else {
			$(this).nextAll('div').css('text-decoration', 'none');
		}

	});

}(jQuery));