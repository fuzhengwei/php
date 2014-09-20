/* CSS Document */

	$(function(){
		$(".leftBottomDiv ul li span[id=openSpan]").toggle(function(){
			$(this).next("ul").show('slow');
		},function(){
			$(this).next("ul").hide('slow');
		});
		var dheight = $(document).height();
		$(".leftDiv").css("height",dheight-70);
		$(".leftBottomDiv").css("height",dheight-125);
		$("iframe").height(dheight-100);
	});