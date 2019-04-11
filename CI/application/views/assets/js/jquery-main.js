(function($){

$(document).ready(function(){
	//비쥬얼
	/*
	$("section.visual").addClass("active");
	var swiper = new Swiper('.visual .swiper-container', { 
		autoplay: {
		delay: 5000,
		disableOnInteraction: false,
		},
		loop:true,
		navigation: {
		nextEl: '.visual .swiper-button-next',
		prevEl: '.visual .swiper-button-prev',
		},
		allowTouchMove:true
	});
	*/
	//리얼후기
	var swiper = new Swiper('.review .swiper-container', { 
		/*autoplay: {
		delay: 3000,
		disableOnInteraction: false,
		},*/
		slidesPerView: 2,
		spaceBetween: 8,
		loop:true,
		pagination: {
			el: '.review .swiper-pagination',
		},
		allowTouchMove:true
	});
	//신규인기강사
	var swiper = new Swiper('.teacher .swiper-container', { 
		pagination: {
			el: '.swiper-pagination',
			type: 'fraction',
		},
		allowTouchMove:true
	});
	//과정소개 하단 수강후기
	$('.main-slick').slick({
		slidesToScroll: 1,
		slidesToShow: 2,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3000,
	});

});
})(jQuery)
