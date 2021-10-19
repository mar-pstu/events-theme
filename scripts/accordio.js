( function () {


	/**
	*	"Аккордеоны"
	*/

		
	function toggle( e ) {
		e.preventDefault();
		var $heading = jQuery( this ),
			$section = $heading.parent( '.accordio__listitem' ),
			$content = $heading.siblings( '.listitem__content' );
		if ( $section.hasClass( 'active' ) ) {
			$section.removeClass( 'active' );
			$content.slideUp();
		} else {
			$section.addClass( 'active' );
			$content.slideDown();
		}

	}

	function add_section( el, image ) {
		var $panel,
			$content,
			$section;
		$section = jQuery( '<div>', { 'class': 'accordio__listitem listitem', 'role': 'listitem' } );
		$panel = jQuery( '<div>', { 'class': 'listitem__panel panel', click: toggle } );
		if ( image ) jQuery( '<div>', { 'class': 'thumbnail' } )
			.append( image.attr( 'class', 'lazy' ) )
			.appendTo( $panel );
		el.attr( 'class', 'title' ).appendTo( $panel );
		$content = jQuery( '<div>', { 'class': 'listitem__content content' } ).css( 'display', 'none' );
		$section.append( $panel );
		$section.append( $content );
		return $section;
	}


	function build( index, accordio ) {
		var $accordio = jQuery( accordio ),
			selector = $accordio.attr( 'data-heading' ),
			$section;
		$accordio.children().each( function( i, el ) {
			var  $el = jQuery( el );
			if ( $el.is( selector ) ) {
				$section = add_section( $el, false );
				$accordio.append( $section );
			} else {
				if ( $el.is( '.heading' ) && $el.find( selector ).length > 0 ) {
					$section = add_section( $el.find( '.title' ), $el.find( 'img.heading__thumbnail' ) );
					$accordio.append( $section );
				} else {
					if ( $section != undefined ) $el.appendTo( $section.children( '.content' ).eq( 0 ) );
				}
			}
		} );
	}

	jQuery( '.accordio[ data-heading ]' ).each( build );


} )();