$(document).ready(function() {
	
	$('.confirm_delete').click(function(){
		if(confirm("Are you sure you want to delete this transfer?") == true){
			return true;
		} else {
			return false;
		}
	});
	
	$('select.inst').change(function() {
		if ($(this).find(':selected').val() === 'other') {
			$('input.other-inst').show();
		} else {
			$('input.other-inst').hide();
		}
	});
});