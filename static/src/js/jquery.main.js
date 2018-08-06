$(document).ready(function(){

	function scroll(scrollLink, speed){
		$('html, body').animate({
			scrollTop: scrollLink.offset().top
		}, speed);
		return false;
	}
	$('.anchor').click(function(e){
		e.preventDefault();
		scroll($( $(this).attr('href') ), 1500);
	});

	$("#home-last-reviews").owlCarousel({
		loop: true,
		margin: 15,
		nav: false,
		items: 1,
		dots: true,
		autoplay: false,
		autoplayTimeout: 3000,
		autoHeight: true,
		responsive: {
			768: {
				items: 2,
				autoHeight: false,
				dots: true,
			}
		}
	});

});	