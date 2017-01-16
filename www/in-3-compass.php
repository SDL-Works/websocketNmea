<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Compass</title>
        <script type="text/javascript" src="inc/jquery-2.1.1.min.js"></script> 
        <script type="text/javascript" src="inc/jQueryRotate.js"></script>
    <style>

html>body
{
    font-family: Tahoma, Helvetica, Geneva, Arial, sans-serif;
	font-size: 0.9em;
    margin: 0 0 0 0;
    width: 100%;
    min-width: 256px;
    max-width: 512px;
    margin-left:auto;
    margin-right:auto;
    overflow: hidden;
}

#instrument
{
    position:relative;
    border: 0;
    background-image: url('img/empty-solid-black.png');
    background-size: 100%;
    background-repeat:no-repeat;
}

#needle
{

/* ifdef safari
     width: 70%;
     //border: 1px solid black;
    position:relative;
    top: 15%;
    left: 0%;
    margin: 15%;
*/
    width: 80%;
    margin: 10%;

}

#main
{
    position:relative;
}

#logpanel
{
    position:relative;
    bottom: 0px;
    left: 30%;
    font-size: 1.3em;
}

#LEDpanel
{
    position:absolute;
    top: 41%;
    left: 35%;
    font-weight: bold;
    font-size: 5.2em;
	letter-spacing: 2px;
    text-align: center;
    width: 30%;
    z-index: 10;
}

    </style>
       
    <script type="text/javascript">
        
function resize()	// Set font relative to window width.
{
    var f_Factor=1;
    var W = window.innerWidth || document.body.clientWidth;

    W=W<256?256:W;
    W=W>512?512:W;
    
	P =  Math.floor (f_Factor*(2.5*W/96));
	document.body.style.fontSize=P + 'px';
}

$(document).ready(function() {
    var userAgent = navigator.userAgent.toLowerCase();
    if (userAgent.match(/android/) !=null && userAgent.match(/firefox/) != null) {
        $("#LEDpanel").css("top", "39%"); 
    } 
    window.onresize=resize;
	resize();
});

var pt = 0;
var ut = 0;

var target = 0;
var c_angle = 0;
var ticks = 800;
var update = 800;

var debug = false;
var connection = true;

function do_update()
{
    if (connection) {
        send(Cmd.CompassHeading);
        if (pt == 0)           
            pt = setInterval(function () {do_poll();}, ticks);
    } else {
        window.clearInterval(ut);
        reconnect();
    }
}

function do_poll()
{

    
    
    if (target == "Exp" || connection == false) {
        document.getElementById("needle").style.opacity = "0.5";
        document.getElementById("LEDpanel").innerHTML=" -- -- ";
        return;
    }
    
    if (valid != Cmd.CompassHeading) return;
    
    document.getElementById("needle").style.opacity = "100";
    
    var val = JSON.parse(target);

    var angle = round_number(val.angle,0);
    
    var rangle = 360 - angle;
    
    if (1) {
    if ((c_angle >= 180 && angle <= 180) || (c_angle <= 180  && angle >= 180)) {
        // document.getElementById("logpanel").innerHTML="DONT ROT TO "+angle;
        //$("#needle").rotate({animateTo:rangle,duration:4000,easing: $.easing.easeInQutSine, direction: false})
        $("#needle").rotate({animateTo:rangle,duration:1});
    } else {
        $("#needle").rotate({animateTo:rangle,duration:4000,easing: $.easing.easeInQutSine});
    }
    } else {
        rangle += 361;
         $("#needle").rotate({animateTo:rangle,duration:4000,easing: $.easing.easeInQutSine});
         document.getElementById("logpanel").innerHTML=rangle;
    }
     
    document.getElementById("LEDpanel").innerHTML=round_number(angle,0);
    
    c_angle = angle;

}
    </script>

    </head>
    <body onload="init()">
        <div id="main">
            <div id="LEDpanel"></div>
            <div id="instrument"><img src="img/crose.png" alt="" id="needle"></div>
        </div>
        <div id="logpanel"></div>
        <script type="text/javascript" src="inc/wsClient.js.php"></script>
    </body>  
</html>
