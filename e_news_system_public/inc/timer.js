var c = 180;
var t;
var timer_is_on=0;

function timedCount()
{
	document.getElementById('txt').value= Math.floor(c/60);
	document.getElementById('txt').value += ":";
	if (six(c) == 60)
		{
			document.getElementById('txt').value += "00";
		}
	else if (c >= 61)
	{
		document.getElementById('txt').value += six(c);
	}
	
	else {
		if (c < 60)
		{
			document.getElementById('txt').value += c;
		}
	}
	c=c-1;
	
	if (c != -1)
	{
		t=setTimeout("timedCount()",1000);
	}
	else
	{
		alert('timeup');
		//submit the form
		quizf.submit();
	}
}

function six(d)
{
	if (d > 60)
	{
		var e = d - 60;
		if (e > 60)
		{
			e = six(e);
		}
	}
	else
	{
		e = d;
	}
	return e;
}

function doTimer(c)
{
	if (!timer_is_on)
	{
		timer_is_on=1;
		timedCount();
	}
}
