$(function() {
	$( "#tabs" ).tabs({
		ajaxOptions: {
			error: function( xhr, status, index, anchor ) {
				$( anchor.hash ).html(
					"Couldn't load this tab. We'll try to fix this as soon as possible. ");
			}
		}
	});
	
});

$(function() {
	$("#ajaxtest").click(function(){
	    $("#tabs-5").load('/applications/test', {fred: "test", data2: 5} );
	});
});

