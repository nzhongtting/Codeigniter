var mypage=all_menu=null;
(function($){

$(document).ready(function(){
	// gnb start
	$("ul.gnb > li > a").click(function(){
		if($(this).hasClass("on") == false){
			$("ul.gnb > li > a").next('div').slideUp(200);
			$("ul.gnb > li > a").removeClass("on");
			$(this).addClass("on");
			$(this).next('div').slideDown(200);
		}else{
			$(this).next('div').slideUp(200);
			$(this).removeClass("on");
		}
	});
	//nav-이벤트
	if( $("nav a:last-child").hasClass("on") ){
		$("nav").scrollLeft(400);
	}
	$('a.top_btn').click(function () {
		$('html, body').animate({ scrollTop:0 }, 'slow');
		return false;
	});
	
	//패밀리사이트
	$("#fSite p").click(function () {
		$("#fSite ul").stop().slideToggle("slow");
		$("#fSite p").toggleClass("on");
	});

});
// document end


// all_menu start
all_menu= function (){
	$("#allmenu").toggleClass("on");
	$("header").addClass("fix");
	$("#mypage").removeClass("on");
	$("div.my-wrap").animate({"right":"-100%"}, 300);
	if($("#allmenu").hasClass("on")==true){
		$("div.gnb-wrap").animate({"left":"0"}, 300);
		$("div.gnb-wrap").css("top" , "55px");
		$(document.body).css({"min-height":"626px", "overflow":"hidden"});
	}else{
		$("div.gnb-wrap").animate({"left":"-100%"}, 300);
		$("header").removeClass("fix");
		$(document.body).css({"min-height":"auto", "overflow":"auto"});
		$("ul.gnb div").slideUp(200);
		$("ul.gnb > li > a").removeClass("on");
	}
}
// all_menu end
// mypage start
mypage = function (){
	$("#mypage").toggleClass("on");
	$("header").addClass("fix");
	$("#allmenu").removeClass("on");
	$("div.gnb-wrap").animate({"left":"-100%"}, 300);
	if($("#mypage").hasClass("on")==true){
		$("div.my-wrap").animate({"right":"0"}, 300);
		$("div.my-wrap").css("top" , "55px");
		$(document.body).css({"min-height":"626px", "overflow":"hidden"});
	}else{
		$("div.my-wrap").animate({"right":"-100%"}, 300);
		$("header").removeClass("fix");
		$(document.body).css({"min-height":"auto", "overflow":"auto"});
		$("ul.gnb div").slideUp(200);
		$("ul.gnb > li > a").removeClass("on");
	}
}
// mypage end




})(jQuery)
