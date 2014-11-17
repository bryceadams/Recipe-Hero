(function ( $ ) {
	"use strict";

	$(function () {

		// Select2
		$('.select2_select').select2();
		$('.select2_select_std').select2({
			allowClear: true,
		});

		// Tooltips
		var tiptip_args = {
			'attribute' : 'data-tip',
			'fadeIn' : 50,
			'fadeOut' : 50,
			'delay' : 200
		};
		$(".tips, .help_tip").tipTip( tiptip_args );

		// Add tiptip to parent element for widefat tables
		$(".parent-tips").each(function(){
			$(this).closest( 'a, th' ).attr( 'data-tip', $(this).data( 'tip' ) ).tipTip( tiptip_args ).css( 'cursor', 'help' );
		});

	});

}(jQuery));