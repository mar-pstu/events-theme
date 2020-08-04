jQuery( document ).ready( function () {

	wp.customize( 'title_404', function( value ) {
		value.bind( function( to ) {
			$( '#title_404' ).text( to );
		} );
	} ); 


	wp.customize( 'subtitle_404', function( value ) {
		value.bind( function( to ) {
			$( '#subtitle_404' ).text( to );
		} );
	} );

} );