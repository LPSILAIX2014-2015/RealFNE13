$(document).ready(function() {

	var mouseX;
	var mouseY;
	$('.imgLogo').mousemove( function(e) {
		mouseX = e.pageX - $('body').offset().left - $('.leftcol').offset().left + 100;
		mouseY = e.pageY - 225;
		$('.popUp').css({'top':mouseY,'left':mouseX})
	});

	$('.imgLogo').on('mouseenter', function(event){
		event.preventDefault();
		getInfo($(this).attr('data-id'));
	})

	$('.imgLogo').on('mouseleave', function(event) {
		event.preventDefault();
		hidePopUp();
	});



	function getInfo(idAsso){
		$.ajax({
			url: 'Ajax/getInfoLogo.php',
			type: 'POST',
			dataType: 'json',
			data: {idAsso: idAsso},
		})
		.done(function (data) {
			hidePopUp();
			showPopUp(data);
		})
		.fail(function() {

		})
		.always(function() {

		});
		
	}

	function showPopUp(data){
	  	$('.popUp').show();
		$('.popUp').append('<div><span class="nameAP">Nom de l\'association : </span>'+ data.NAME_ASSO +'</div>');
		$('.popUp').append('<div><span class="nameAP">Thème de l\'association : </span>'+ data.NAME_THEME +'</div>');
		$('.popUp').append('<div><span class="nameAP">Territoire de l\'association : </span>'+ data.NAME_TERRITORY +'</div>');
	}

	function hidePopUp(){
		$('.popUp').hide();
		$('.popUp').empty();
	}
});
			