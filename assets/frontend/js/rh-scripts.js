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

	// Star ratings for comments
	$( '#rating' ).hide().before( '<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>' );

	$( 'body' )
		.on( 'click', '#respond p.stars a', function() {
			var $star   = $( this ),
				$rating = $( this ).closest( '#respond' ).find( '#rating' );

			$rating.val( $star.text() );
			$star.siblings( 'a' ).removeClass( 'active' );
			$star.addClass( 'active' );

			return false;
		});

}(jQuery));