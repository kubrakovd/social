$(document).ready(function(){
	$('.second_step').hide();

	$('#next_step').on('click', function(event){
		event.preventDefault();
		$('.first_step').hide();
		$('.second_step').show();
		$(this).hide();
		$('.second_step').show();
	})
});
