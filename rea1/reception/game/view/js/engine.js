
var keyLeft=37,keyUp=38,keyRight=39,keyDown=40,keyJ=74,keyK=75,keyW=87,keyA=65,keyD=68,keyS=83;
var left=1;down=0;right=2;up=3;

var basex=3;
var basey=2;
var viewx=7;//默认窗口7*5
var viewy=5;//

var msgY=425;//消息Y坐标
var okX=230;//okButton X坐标
var okY=455;//okButton y坐标
var cancelX=230;//取消X
var cancelY=485;//取消Y

var wCut=93;//主角动作图横切宽度
var hCut=100;//主角动作图纵切高度
var cellSize=100;//每个格子宽度
var actionSize=4;//一个方向动作数量
var mapW=30;//地图宽 格子数
var mapH=20;//地图高 格子数
var pen;
var map;
var canvas;
var barrier;
var role;
var bPause=false;

var imgGrassland;
var imgFlower;
var imgWater;
var imgStone;
var imgMessage;
var monsters = [["小草泥马",30,10,4],["小毛虫",15,20,5],["小剑魔",20,20,7],["小血魔",150,6,15],
				["中级草泥马",40,18,8],["中毛虫",30,20,10],["中剑魔",20,30,14],["中血魔",250,7,30],
				["高级草泥马",60,24,12],["大毛虫",40,30,15],["剑魔",22,35,20],["大血魔",500,8,60],
				["经验怪",1000,3,200],["BOSS",800,38,100]];
var noWar = false;//触发对话的时候,不触发战斗

var maxHp=[100,140,200,280,380,500,600,700,800,900,1000];
var maxAttack=[20,24,30,38,48,60,70,75,80,90,100];
var maxExp=[0,20,50,90,140,200,300,500,800,1200,2000];

var monster;
function regist(o){	
	if(o.viewStyle!=undefined){
		viewx=o.viewStyle.w;
		viewy=o.viewStyle.h;
		basex=(viewx-1)/2;
		basey=(viewy-1)/2;
	}
	if(o.pics!=undefined){
		var ps = o.pics;
		imgGrassland=ps.grassland;
		imgFlower =ps.flower;
		imgStone = ps.stone;
		imgWater = ps.water;
		imgMessage = ps.message;
	}
	if(o.role!=undefined){
		role=o.role;
	}
	if(o.barrier!=undefined){
		barrier=o.barrier;
	}
	if(o.pen!=undefined)
		pen=o.pen;
	if(o.map!=undefined)
		map=o.map;
	if(o.canvas!=undefined)
		canvas=o.canvas;
	if(o.mapStyle.w!=undefined)
		mapW=o.mapStyle.w;
	if(o.mapStyle.h!=undefined)
		mapH=o.mapStyle.h;
	if(o.viewStyle.mapSize!=undefined)
		cellSize=o.viewStyle.cellSize;
	if(o.button!=undefined){
		var m=o.button;
		if(m!=undefined){
			if(m.ok.x==0){
				okX=viewx*cellSize/2-20;
			}else{
				okX=m.ok.x;
			}
			if(m.ok.y==0){
				okY=viewy*cellSize-50;
			}else{
				okY=m.ok.y;
			}
			if(m.cancel.x==0){
				cancelX=viewx*cellSize/2-20;
			}else{
				cancelX=m.cancel.x;
			}
			if(m.cancel.y==0){
				cancelY=viewy*cellSize-25;
			}else{
				cancelY=m.cancel.y;
			}	
		}
	}
	if(o.actionSize!=undefined){
		actionSize=o.actionSize;
	}
	if(o.msgY!=undefined){
		msgY=o.msgY;
	}
	canvas.width=viewx*cellSize+20;
	canvas.height=viewy*cellSize+20;
}
function Npc(name,img,himg,x,y){
	this.name=name;
	this.headImg=himg;
	this.img=img;
	this.x=x;
	this.y=y;
}
function Map(grasslands,flowers,stones,waters,npcs){
	this.grasslands=grasslands;
	this.flowers=flowers;
	this.stones=stones;
	this.waters=waters;
	if(npcs!=undefined){
		this.npcs=npcs;
	}else{
		this.npcs=[];
	}
}
function Role(name,img,headImg,dir,action,x,y,lv){
	if(lv!=undefined){
		this.lv=lv;
		this.hp=maxHp[lv-1];
		this.atk=maxAttack[lv-1];
		this.exp=maxExp[lv-1];
	}
	this.name=name;
	this.img=img;
	this.headImg=headImg;
	this.x=x;
	this.y=y;
	this.dir=dir;
	this.action=action;
	this.changeAction = function(){
		if(this.action==undefined){
			this.action=0;
		}
		this.action++;
		this.action=this.action==actionSize?0:this.action;
	}
	this.walk=function(){	
		this.x=this.x<0?0:this.x;
		this.y=this.y<0?0:this.y;
		this.x=this.x>mapW-1?mapW-1:this.x;
		this.y=this.y>mapH-1?mapH-1:this.y;
	
		this.print();
		if(this.addTaskPoint!=undefined){
			this.addTaskPoint(this);
		}
		if(!noWar)
		if(Math.random()*100>>>0>95){
			if(this.createMonster!=undefined){
				monster=this.createMonster(monster);
			}else{
				monster=new Monster(Math.random()*monsters.length>>>0);
			}
			this.meetMonster();
		}
	}
	this.meetMonster=function(){
		pen.fillStyle='#eee';
		pen.fillRect(cellSize+10,10,(viewx-1)*cellSize-120,100);
		pen.fillStyle='#222';
		//for(var i=0;i<monster.length;i++){
		//	var t = "  "+monster[i].name +" HP:" +monster[i].hp;
		//	pen.fillText(t,110,monster.name,viewy*cellSize-100+i*20);
		//}
		pen.fillText("   怪物:"+monster.name,110,40);
		pen.fillText("   HP:" + monster.hp,110,70);
		this.print();
		var o =this;
		var temp = monster.hp;
		
		drawAttackText(function(){
			monster.hp-=o.atk/2+(Math.random()*o.atk/2>>>0);
			if(monster.hp<=0){
				resume();
				if(o.attackSuccess!=undefined)
					o.attackSuccess();
				o.exp+=monster.exp;
				this.attack=undefined;
				this.escape=undefined;
				return;
			}
			o.hp-=monster.atk/2+(Math.random()*monster.atk/2>>>0);
			o.printHead();
			if(o.hp<=0){
				if(o.attackFail!=undefined)
					o.attackFail();
				this.attack=undefined;
				this.escape=undefined;
				gameOver();
				return;
			}
			o.meetMonster();	
		});
		drawEscapeText(function(){
			var key = Math.random()*100>>>0;
			if(key>40){
				resume();
				this.attack=undefined;
				this.escape=undefined;
				return;
			}else{
				o.hp-=monster.atk/2+(Math.random()*monster.atk/2>>>0);
				if(o.hp<=0){
					this.attack=undefined;
					this.escape=undefined;
					gameOver();
					return;
				}
				o.printHead();
			}
		});
	}
	this.print=function(){
		if(!bPause){
			pen.shadowBlur = 0;
			pen.fillStyle='#222';
			pen.fillRect(0,0,viewx*cellSize+20,viewy*cellSize+20);
			pen.fillStyle='#fff';
			pen.fillRect(10,10,viewx*cellSize,viewy*cellSize);
			this.drawArray(map.grasslands,imgGrassland);
			this.drawArray(map.flowers,imgFlower);
			this.drawArray(map.stones,imgStone);
			this.drawArray(map.waters,imgWater);
			this.drawNpc(map.npcs);
			if(this.printMore!=undefined){
				this.printMore();
			}
			if(this.lv!=undefined){
				if(this.exp>=maxExp[this.lv]){
					this.lv++;
					drawMsgText(this,"等级提升为"+this.lv+"      [HP:"+maxHp[this.lv-1]+" ATk:"+maxAttack[this.lv-1]+"]").setOkBtn("继续");
					this.hp=maxHp[this.lv-1];
					this.atk=maxAttack[this.lv-1];
				}
			}
	
			pen.drawImage(this.img,this.action*wCut,this.dir*hCut,wCut,hCut,10+cellSize*basex,10+cellSize*basey,cellSize,cellSize);
			this.printSmallMap();
			this.printHead();
		}
	}
	this.printHead=function(){
		pen.drawImage(this.headImg,10,10,cellSize,cellSize);
		pen.fillStyle='#999';
		pen.fillRect(10,110,100,10);
		pen.fillStyle='#f00';
		var thp = this.hp/maxHp[this.lv-1]*100;
		pen.fillRect(10,110,thp,10);
		pen.fillStyle='#666';
		pen.fillText("Lv:"+this.lv+" Exp:"+this.exp,10,cellSize+10);
	}
	this.printSmallMap=function(){
		pen.fillStyle='#eee';
		pen.fillRect((basex*2+1)*cellSize-110,10,120,80);
		this.drawArray(map.grasslands,imgGrassland,true);
		this.drawArray(map.flowers,imgFlower,true);
		this.drawArray(map.stones,imgStone,true);
		this.drawArray(map.waters,imgWater,true);
		this.drawNpc(map.npcs,true);
		this.drawRole();
	}
	this.drawRole=function(){
		pen.drawImage(this.img,this.action*wCut,this.dir*hCut,wCut,hCut,(basex*2+1)*cellSize-110+4*this.x,10+4*this.y,4,5);
	}
	this.drawNpc=function(o,simple){
		for(var i=0;i<o.length;i++){
			this.drawXY(pen,o[i].x,o[i].y,o[i].img,simple);
		}	
	}
	this.drawArray = function(o,img,simple){
		for(var i=0;i<o.length;i++){
			this.drawXY(pen,o[i][0],o[i][1],img,simple);
		}
	}
	this.simpleDrawXY=function(pen,x,y,img){
		//if(x>this.x-3&&x<this.x+3&&y>this.y-3&&y<this.y+3){
			pen.drawImage(img,(basex*2+1)*cellSize-mapW*4+10+x*4,10+y*4,4,5);
		//}
	}
	this.drawXY=function(pen,x,y,img,simple){
		if(simple!=undefined){
			this.simpleDrawXY(pen,x,y,img);
		}else{
			if(x>this.x-(basex+1)&&x<(this.x+basex+1)&&y>this.y-(basey+1)&&y<this.y+(basey+1)){
				var cX=10+cellSize*(x-this.x+basex);
				var cY=10+cellSize*(y-this.y+basey);
				pen.drawImage(img,cX,cY,cellSize,cellSize);
			}
		}
	}
}
function drawAttackText(a){
	if(canvas.attack==undefined){
		drawText("攻击(J)",okX,okY);
		if(a!=undefined){
			canvas.attack=a;
		}
	}
}
function drawEscapeText(a){
	if(canvas.escape==undefined){
		drawText("逃跑(k)",cancelX,cancelY);
		if(a!=undefined){
			canvas.escape=a;
		}
	}
}
function drawOKText(t,a){
	if(t!=undefined){
		drawText(t+"(J)",okX,okY);
	}else{
		drawText("确定(J)",okX,okY);
	}
	if(a!=undefined){
		canvas.doOk=a;
	}else{
		canvas.doOk=function(){};
	}
}
function drawCancelText(t,a){
	if(t!=undefined){
		drawText(t+"(K)",cancelX,cancelY);
	}else{
		drawText("取消(K)",cancelX,cancelY);
	}
	if(a!=undefined){
		canvas.doCancel=a;
	}else{
		canvas.doCancel=function(){};
	}
}

function drawMsgText(o,txt,okname,okc,canceln,cancelc){
	pause();
	noWar=true;//触发对话时,关闭战斗触发
	pen.drawImage(imgMessage,10,(basey*2)*cellSize,(basex*2+1)*cellSize,cellSize);
	if(o!=undefined){
		pen.drawImage(o.headImg,10,4*cellSize-40,cellSize+10,cellSize+10);
		txt=o.name+":"+txt;
	}
	var temp=pen.measureText(txt).width;
	//var temp=txt.length;
	if(temp>basex*cellSize){
		drawText(txt.substring(0,30),120,msgY);
		drawText(txt.substring(30),140,msgY+20);
	}else{
		drawText(txt,120,msgY);
	}
	if(okname!=undefined){
		if(c!=undefined)
			drawOKText(okname,okc);
		else
			drawOKText(okname);
	}
	if(canceln!=undefined){
		if(c!=undefined)
			drawCancelText(canceln,cancelc);
		else
			drawCancelText(canceln);
	}
	return canvas;
}

function drawText(txt,x,y){
	pen.font="18px Arial";
	pen.shadowBlur = 20;
	pen.fillStyle='#111';
	pen.fillText(txt,x,y);
	pen.shadowBlur = 0;
}
function checkRole(o){
	for(var i=0;i<barrier.length;i++){
		if(o.x==barrier[i][0]&&o.y==barrier[i][1]){
			for(var i=0;i<map.npcs.length;i++){
				if(o.x==map.npcs[i].x&&o.y==map.npcs[i].y){
					map.npcs[i].talk(role);
					noWar=true;
				}
			}
			return false;
		}
	}
	return true;
}
function addMouseKeyDown(){
	canvas.onmousedown=function(e){
		if(e.x>okX&&e.x<okX+100&&e.y>okY-20&&e.y<okY+20){
			if(this.doOk!=undefined){
				this.doOk();
				this.doOk=undefined;
				this.attack();
			}
		}
		if(e.x>cancelX&&e.x<cancelX+100&&e.y>cancelY&&e.y<cancelY+20){
			if(this.doCancel!=undefined){
				this.doCancel();
				this.doCancel=undefined;
				this.escape();
			}
		}
		if(role!=undefined)
			role.print();
	}
}
document.onkeydown=function(ev){
	var e = window.event||ev;
	//alert(e.keyCode);
	canvas.stop=true;//是否擦除btn和msg
	switch(e.keyCode){
			case keyJ:
			case keyJ+32:
			if(canvas.doOk!=undefined){
				canvas.doOk();
				if(canvas.stop){
					canvas.doOk=undefined;
					resume();
				}
			}
			if(canvas.attack!=undefined){
				canvas.attack();
			}
			noWar=false;
			break;
			case keyK:
			case keyK+32:
			if(canvas.doCancel!=undefined){
				if(canvas.stop){
					canvas.doOk=undefined;
				}
				canvas.doCancel();
				if(canvas.stop){
					canvas.doCancel=undefined;
					resume();
				}
			}
			if(canvas.escape!=undefined){
				canvas.escape();
			}
			noWar=false;
			break;
		}
		if(role.print!=undefined)
			role.print();
	if(!bPause){
		switch(e.keyCode){
			case keyLeft:
			case keyA:
			case keyA+32:
			role.dir=left;
			role.x--;
			if(!checkRole(role)){
				role.x++;
			}else{
				role.changeAction();
			}
			role.walk();
			break;
			case keyRight:
			case keyD:
			case keyD+32:
			role.dir=right;
			role.x++;
			if(!checkRole(role)){
				role.x--;
			}else{
				role.changeAction();
			}
			role.walk();
			break;
			case keyUp:
			case keyW:
			case keyW+32:
			role.dir=up;
			role.y--;
			if(!checkRole(role)){
				role.y++;
			}else{
				role.changeAction();
			}
			role.walk();
			break;
			case keyDown:
			case keyS:
			case keyS+32:
			role.dir=down;
			role.y++;
			if(!checkRole(role)){
				role.y--;
			}else{
				role.changeAction();
			}
			role.walk();
			break;
		}
	}
}
function createbarrierFromMap(o){
	barrier=new Array();
	for(var i=0;i<o.stones.length;i++){
		barrier[barrier.length]=o.stones[i];
	}
	for(var i=0;i<o.waters.length;i++){
		barrier[barrier.length]=o.waters[i];
	}
	for(var i=0;i<o.npcs.length;i++){
		barrier[barrier.length]=[o.npcs[i].x,o.npcs[i].y];
	}
	return barrier;
}
function config(c){
	canvas=c;
	canvas.setOkBtn=function(name,cal){
		drawOKText(name,cal);
		return this;
	}
	canvas.setCancelBtn=function(name,cal){
		drawCancelText(name,cal);
		return this;
	}
	pen=c.getContext("2d");
	pen.shadowBlur = 20;
	pen.shadowColor = "#0f0";
}
function start(){
	role.print();
}
function pause(){
	bPause = true;
}
function resume(){
	bPause = false;
}

function sleep(d){
  for(var t = Date.now();Date.now() - t <= d;);
}
function Monster(i){
	i=i%monsters.length;
	pause();
	var o=monsters[i];
	this.name=o[0];
	this.hp=o[1];
	this.atk=o[2];
	this.exp=o[3];
}

function gameOver(){
	drawMsgText(role,"游戏结束").setOkBtn("重新游戏",function(){
		task=0;
		role.lv=1;
		role.x=1;
		role.y=1;
		role.exp=0;
		role.hp=maxHp[role.lv-1];
		resume();
	});
}

