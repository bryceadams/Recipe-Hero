(function ( $ ) {
	"use strict";

	$(function () {

		$(document).ready(function() {
			$('.steps-image-link').magnificPopup({ 
			  type: 'image',
			   gallery: {
				    // options for gallery
				    enabled: true
				  },
				  image: {
				    // options for image content type
				    titleSrc: 'title'
				  }
			});
			$('.recipe-gallery').magnificPopup({ 
			  type: 'image',
			   gallery: {
				    // options for gallery
				    enabled: true
				  },
				  image: {
				    // options for image content type
				    titleSrc: 'title'
				  }
			});
		});

	});

}(jQuery));