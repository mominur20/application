$('#student-search').keyup(function() {
	
	urlParams['name'] = $(this).val().trim();
	urlParams['ajax'] = 1;
	
	$.ajax({
		type: "GET",
		url: "index.php",
		data: urlParams
	}).done(function( msg ) {
		$('#students').html(msg);
	});
});
