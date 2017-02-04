var socket;
var retry = 0;
var valid;
var port = 9000;

var Cmd = {
    SpeedOverGround     : "100",
    SpeedThroughWater   : "101",
    DepthAndTemp        : "110",
    CompassHeading      : "120",
    GPS                 : "121",
    WindSpeedAndAngle   : "130",
    GoogleMapFeed       : "140",
    GoogleAisFeed       : "141",
    GoogleAisBuddy      : "142",
    SensorVolt          : "200",
    WaterMakerData      : "210",
    ServerPing          : "900",
    TimeOfDAy           : "901",
    UpdateSettings      : "910"
};

function init()
{
    var host = "ws://<?php echo preg_split("/:/", $_SERVER['HTTP_HOST'])[0]; ?>:"+port; // SET THIS TO YOUR SERVER
    connection = true;

    try {
        window.WebSocket = window.WebSocket || window.MozWebSocket;

        socket = new WebSocket(host,'nmea-parser-protocol');
        printlog('WebSocket - status '+socket.readyState);

        socket.onopen = function () {
            printlog("Open: OK");
        };

        socket.onerror = function () {
            printlog("Socket: Error");
            connection = false;
        };

        socket.onmessage = function (msg) {
            var a=msg.data.split("-");
            target = a[0];
            valid  = a[1];
            printlog("Received: "+msg.data);
            retry = 0;
        };
    }
	catch(ex) { 
		printlog(ex);
        connection = false; 
	}

    ut = setInterval(function () {do_update();}, update);  
}


function send(msg){
	if(!msg)
		return;
		
	try { 
	    if (retry > 10) {
	        connection = false;
	        target = "";
	        valid = "";
	        retry = 0;
	        return;
	    }
		socket.send(msg); 
		printlog('Sent: '+msg); 
		retry++;
	} catch(ex) { 
		printlog(ex);
		retry++; 
	}
}

function quit(){
	if (socket != null) {
		printlog("Goodbye!");
		socket.close();
		socket=null;
	}
}

function reconnect() {
	quit();
	init();
}


function printlog(msg)
{
    if (debug)
        document.getElementById("logpanel").innerHTML=msg;
}


function round_number(num, dec) {
    return Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
}


// Switch to next instrument in the list

var instruments = [<?php
    define('DOCROOT', dirname(__FILE__)); 
    $items = array();
    exec("cd ".DOCROOT."/../; ls -l in-*.php | awk '{ print \$NF }'", $items);
    $n = count($items);
    for ($i=0; $i<$n; $i++) {
        echo "'".$items[$i]."'";
        if ($i < $n-1) echo ',';
    } ?>];

var loc = window.location.pathname;
var ipath = loc.split("/").slice(0, -1).join("/")+"/";

var next = loc.split("-")[1];
next = next >= instruments.length? 0:next++;

function nextinstrument()
{
    window.location.replace('http://<?php echo $_SERVER['HTTP_HOST']; ?>'+ipath+instruments[next]);
}




