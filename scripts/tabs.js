( function () {


	/**
	*	"Табы"
	*/
	function tabs( index, el ) {
		if ( window.screen.width  < 640 ) return;
		var $container = jQuery( el ),
				tag = $container.attr( 'data-heading' ),
				$children = $container.children(),
				$headings = jQuery( '<ul>', { 'class': 'tabs-heading' } ).appendTo( $container ),
				$tab;
		$children.each( function( index, el ) {
			if ( jQuery( el ).is( tag ) ) {
				$tab = jQuery( '<div>', { 'class': 'tab-section' } ).appendTo( $container );
				jQuery( '<li>', {
					'text': jQuery( el ).text(),
					'role': 'button'
				} ).click( function( e ) {
					var $btn = jQuery( this ),
							$container = $btn.parents( '.tabs' ),
							$sections = $container.find( '.tab-section' ),
							$items = $container.find( '.tabs-heading li' );
					if ( ! $btn.hasClass( 'active' ) ) {
						$items.removeClass( 'active' );
						$btn.addClass( 'active' );
						$sections.removeClass( 'active' );
						$sections.eq( $items.index( $btn ) ).addClass( 'active' );
					}
					return false;
				} ).appendTo( $headings );
				jQuery( el ).remove();
			} else {
				if ( undefined != $tab ) jQuery( el ).appendTo( $tab );
			}
		} );
		$headings.find( 'li' ).eq( 0 ).addClass( 'active' );
		$container.find( '.tab-section' ).eq( 0 ).addClass( 'active' );
	}



	/**
	 *	инициализация
	 */

	// jQuery( '.accordio' ).each( accordio );

	jQuery( '.tabs' ).each( tabs );


} )();