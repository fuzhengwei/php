// JavaScript Document
$(function(){
	
	$(".cleftDiv").animate({
		left:"240px"
	},2000);
	
	$(".crightDiv").animate({
		right:"220px"
	},2000);
	
	
	$(".topDiv ul li a").hover(
			function(){
				$(this).animate({ 
					color:"#FFFFFF"
				  }, 1000);
			},
			function(){
				$(this).animate({ 
					color:"#6E6E6E"
				  }, 1000);
			}
		);
	
	//公司简介 公司理念动态切换
	$(".abtMessage div").click(function(){
			
			if("BGC" != $(this).attr("id")){
				$(".abtMessage div").removeAttr("id");
				
				$(this).attr("id","BGC");
				
				var ShowId = "#"+$(this).attr("class");
				
				$(".abtMessDetail").slideUp(1500);
				
				$(ShowId).slideDown(1500);
			}
			
		}
	);
	
	$(".centerDiv ul li div[class=openAndClose]").toggle(
		function(){
			$(this).text("关闭详情").next("div").slideDown("slow");
		},
		function(){
			$(this).text("展开详情").next("div").slideUp("slow");
		}
	);

	//展开产品介绍
	$(".ReadInfo").toggle(
			function(){
				$(this).parent("div").next("div[class=InfoDetail]").slideDown("slow");
			},
			function(){
				$(this).parent("div").next("div[class=InfoDetail]").slideUp("slow");
			}
		);
});