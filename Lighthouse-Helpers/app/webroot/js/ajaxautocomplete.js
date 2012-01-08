$(function() {
	$( "#helpername" ).autocomplete({
		source: '/people/search',
		minLength: 2,
		select: function( event, ui ) {
			$( "#PersonId" ).val( ui.item.id );
		}
	});
});

