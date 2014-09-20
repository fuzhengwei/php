// JavaScript Document
function ok()
{
	try
	{
		if($("#question_user").val()=="")
		{
			alert("未填写完整，请继续填写!");
			return false;
		}
		if($("#title").val()=="")
		{
			alert("未填写完整，请继续填写!");
			return false;
		}
		if($("#content").val()=="")
		{
			alert("未填写完整，请继续填写!");
			return false;
		}
	}catch (e)
	{
		alert(e);
	}
} 

function xml()
{
	try
	{
		if($("#version").val()!="")
		{
			
		}
		if()
	}
	catch(e)
	{
		alert(e);
		return false;
	}
}

function test()
{
	alert('test');
}
