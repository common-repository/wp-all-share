jQuery(document).ready(function($){
	var winTop = (screen.height / 2) - 260;
	var winLeft = (screen.width / 2) - 225;
	
	$(document).on('click','.wpas-social',function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		window.open(url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + (screen.width / 2) + ',height=' + (screen.height / 2) );
	});

	/*
	
	*/
});