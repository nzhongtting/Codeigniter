var tone =leave=pop_close=p_policy02=p_policy01=order=coupon=point=policy03=policy02=policy01=account=policy=share=teacher=null;
(function($){

$(document).ready(function(){
	//user height
	var windowHeight = $( window ).height() - 50;
	$('#user-wrap').css('min-height', windowHeight); 
	$(window).resize(function() { 
		$('#user-wrap').css('min-height', $(window).height()); 
	});
	//첨부파일
	var uploadFile = $('.file .uploadBtn');
	uploadFile.on('change', function(){
		if(window.FileReader){
			$(".file").addClass("added");
			var filename = $(this)[0].files[0].name;
		} else {
			var filename = $(this).val().split('/').pop().split('\\').pop();
		}
		$(this).siblings('.fileName').val(filename);
	});
	//수강후기 별점
	$('.review-rating a').click(function(){
		$(this).parent().children('a').removeClass('on');
		$(this).addClass('on').prevAll('a').addClass('on');
		return false;
	});
	// 비디오 스와이프
	var swiper = new Swiper('.video-swiper .swiper-container', { 
		autoplay: {
		delay: 3000,
		disableOnInteraction: false,
		},
		loop:false,
		navigation: {
		nextEl: '.video-swiper .swiper-button-next',
		prevEl: '.video-swiper .swiper-button-prev',
		}
	});

	//과정소개 비쥬얼
	setTimeout("tone()", 1000);

	// 교재상점 best
	var swiper = new Swiper('.best .swiper-container', { 
		/*autoplay: {
		delay: 3000,
		disableOnInteraction: false,
		},*/
		slidesPerView: 1,
		slidesPerGroup: 1,
		spaceBetween:0,
		loop:false,
		navigation: {
		nextEl: '.best .swiper-button-next',
		prevEl: '.best .swiper-button-prev',
		}
	});

	//과정소개 하단 수강후기
	$('.review-slick').slick({
		slidesToScroll: 1,
		slidesToShow: 2,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000,
	});
		
	var containerH = $( window ).height() - 155;
	$('div.terms div.box').css('height', containerH); 
	$(window).resize(function() { 
        $('div.terms div.box').css('height', containerH); 
    }); 

	$("div.board-view").css("min-height", windowHeight);
	var viewH = $("div.board-view").height();
	if(viewH > 457) {
		$("div.board-view").css("padding-bottom", "35px");
	}

});
//docu end

//팝업
teacher=function (){
	$("div.popup.teacher_list").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
share=function (){
	$("div.popup.share").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
policy=function (){
	$("div.popup.policy").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
account=function (){
	$("div.popup.account").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
policy01=function (){
	$("div.popup.policy01").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
policy02=function (){
	$("div.popup.policy02").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
policy03=function (){
	$("div.popup.policy03").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
point=function (){
	$("div.popup.point").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
coupon=function (){
	$("div.popup.coupon").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
order=function (){
	$("div.popup.order").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
p_policy01=function (){
	$("div.popup.p_policy01").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
p_policy02=function (){
	$("div.popup.p_policy02").css("display", "block");
	$("div.popup-bg").css("display", "block");
}
pop_close=function (){
	$("div.popup").css("display", "none");
	$("div.popup-bg").css("display", "none");
}

//tabs
$( function() {
	$( "#tabs" ).tabs();
});

//과정소개 비쥬얼
tone = function (){
	$('div.lecture div.visual div.tone-box .tone').addClass('on');
}


//차트
$(function() {
  $('.chart').easyPieChart({
    barColor: '#ed1e79',
    trackColor: '#e2e2e2',
    lineCap: 'round',
    lineWidth: 3,
    // Size of the pie chart in px. It will always be a square.
    size: 90,
    animate: 1000,
    // Callback function that is called at the start of any animation (only if animate is not false).
    onStart: $.noop,
    // Callback function that is called at the end of any animation (only if animate is not false).
    onStop: $.noop
  });
});

//tabs
 leave=function () {
	alert("회원탈퇴는 PC에서만 가능합니다.");
}
})(jQuery)
