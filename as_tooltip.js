jQuery(document).ready( function($)
{
	$( '.ttip-div' ).hide().appendTo( $('body') );
	$( '.ttip-span' ).hover( function( e )
	{
		$( '#t'+$( this ).attr( 'id' ) ).
			css( 'top', e.pageY + 10 + 'px' ).
			css( 'left', e.pageX + 10 + 'px' ).
			fadeIn( 400 );
	}, function()
	{ 
		$( '#t'+$( this ).attr( 'id' ) ).fadeOut( 200 );
	});
	$( '.ttip-span' ).mousemove( function( e )
	{
		$( '#t'+$( this ).attr( 'id' ) ).
			css( 'top', e.pageY + 10 + 'px' ).
			css( 'left', e.pageX + 10 + 'px' );
	} );
} );