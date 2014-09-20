
<?php
/*
 * 私有的js放到你的game view js下，共有的jq已经帮你引入
 * 私有的img放到game view images下
 * 私有的css放到game view css下
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'/>
<style type="text/css">
body{  margin:0pxauto;  text-align:center;  }


</style>
</head>
<body>
<canvas id="myCanvas" width="1220" height="560" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.</canvas>

<!--
<p id="info" />
-->
<script>
	//var session=window.sessionStorage;
	
	var c = document.getElementById("myCanvas");
	//var info = document.getElementById("info");
	if(!c.getContext){
		document.write("你的浏览器不支持html5");
	}
	var pen = c.getContext("2d");
	//session.setItem("key","value");
	//alert(session.getItem("name"));

	var img=new Image();
	img.src="images/home.jpg";
	var urls=[{name:"RPG找水1",url:"rpg.html"},
				{name:"RPG找水2",url:"rpg2.html"},
				{name:"RPG例子",url:"example.html"},
				{name:"贪吃蛇",url:"snake.html"},
				{name:"最短路径算法",url:"astart.html"},
				{name:"我是老司机",url:"jiashizheng.swf"}];
	
	function MyCanvas(canvas){
		this.canvas = canvas;
		this.pen = this.canvas.getContext("2d");
		this.pen.font="18px Arial";
		this.print=function(x,y){
			var w=this.canvas.width;
			var h = this.canvas.height;
			this.canvas.getContext("2d").drawImage(img,-x/10,-y/10,w+x/10,h+y/10);
			if(this.fs!=undefined){
				for(var i=0;i<this.fs.length;i++){
					this.pen.fillStyle="red";
					this.pen.fillText(this.fs[i].name,this.fs[i].x,this.fs[i].y);
					this.pen.beginPath();
					if(this.fs[i].select!=undefined&&this.fs[i].select){
						//alert("draw line");
						this.pen.moveTo(this.fs[i].x,this.fs[i].y-this.fs[i].yl/2);
						this.pen.lineTo(this.fs[i].x+this.fs[i].xl-10,this.fs[i].y);
						this.pen.stroke();
					}
					
				}
			}
		}
		this.addButton=function(txt,x,y,cal,xl,yl){
			if(this.fs==undefined){
				this.fs = [];
			}
			if(xl==undefined)
				xl=this.pen.measureText(txt).width+10;
			if(yl==undefined){
				yl=20;
			}
			var f={
				name:txt,
				x:x,
				y:y,
				xl:xl,
				yl:yl,
				cal:cal,
				select:false
			}
			this.fs.push(f);
			//this.print();
		}
		this.listenMouseDown=function(){
			if(this.canvas.onmousedown==undefined){
				var my=this;
				this.canvas.onmousedown=function(e){
					if(my.fs!=undefined){
						for(var i=0;i<my.fs.length;i++){
							var f=my.fs[i];
							if(my.fs[i].select){
								f.cal(e,i);
							}
						}
					}
				}
			}
			if(this.canvas.onmousemove==undefined){
				var my = this;
				this.canvas.onmousemove=function(e){
					//e=e || window.e; 
					//info.innerHTML=e.x+" "+this.offsetLeft+" | "+e.y+" "+this.offsetTop;
					var x=e.x-this.offsetLeft;
					var y=e.y-this.offsetTop;
					for(var i=0;i<my.fs.length;i++){
							var f=my.fs[i];
							if(x>f.x&&y>f.y-5&&x<f.x+f.xl&&y<f.y+f.yl-5){
								my.fs[i].select=true;
								//my.print(x);
								break;
							}else{
								if(f.select==true){
									f.select = false;
									//my.print(x);
								}
							}
						}
						my.print(x,y);
				}
			}
		}
		this.print(0,0);
	}
	var mc = new MyCanvas(c);
	var x=150;
	var y=100;
	for(var i=0;i<urls.length;i++){
		mc.addButton(urls[i].name,x+100*i,y+50*i,function(e,i){
			window.open(urls[i].url);
		});
	}

	mc.listenMouseDown();

	</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fab125eeb1febde63edd829c062ac6653' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>

</html>