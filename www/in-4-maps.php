<!DOCTYPE html>
<html>
    <head>
        <title>Google Maps</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="initial-scale=6.0, user-scalable=no">
        <script type="text/javascript" src="inc/jquery-2.1.1.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&language=sv"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=weather"></script>
        
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
      
#googlemaps {
    position:absolute;
    top: 4%;
    left: 4%;
    height: 90%;
    width: 90%;
    max-height: 512px;
    border-radius:50%;
    -moz-border-radius:50%;
    background-color: black;
    z-index: 0;
    visibility: hidden;  
}

#instrument
{
    position: relative;
    border: 0;
    width: 100%;
    z-index: 10;
}

#main {
    position: relative;
    height: 100%;
    z-index: 0;
}

#logpanel
{
    position:relative;
    bottom: 0px;
    left: 16%;
    font-size: 1.3em;
}
        </style>
        
        <script>
        
var ut = 0;

var target = 0;
var update = 1000;

var debug = false;
var connection = true;
var map;
var marker;


function setWindowSize(){
   
    var W = window.innerWidth;
    
    W=W>512?512:W;
    
    document.getElementsByTagName('body')[0].style.height = W + "px";
    document.getElementsByTagName('body')[0].style.width = W + "px";
}

$(document).ready(function()
{ 
    window.onresize=setWindowSize;
	setWindowSize();  
});

function do_update()
{
    if (connection) {
        send(Cmd.GoogleMapFeed);
    } else {
        window.clearInterval(ut);
        reconnect();
    }

    if (target == "Exp" || valid != Cmd.GoogleMapFeed) return;
    
    window.clearInterval(ut);
    

    var val = JSON.parse(target);
    
    var lap = val.N == "S"? "-":"";
    var lop = val.E == "W"? "-":"";

    
    var nmap = new google.maps.LatLng(lap+val.la, lop+val.lo);
    
    map.setCenter(nmap, 5);   
    marker.setPosition(nmap);
    map.setZoom(parseInt(val.zoom));
   
    marker.setOptions({
        icon: { 
                path: google.maps.SymbolPath.FORWARD_OPEN_ARROW,
                scale: 6,
                rotation: round_number(val.A,0)   
            }
    });
    
    ut = setInterval(function () {do_update();}, parseInt(val.updt)*1000);
}

function initialize() {
    
    var myLatlng = new google.maps.LatLng("51.47879", "-0.010677"); // Greenwich
    //var myLatlng = new google.maps.LatLng("59.4605333", "018.277273"); // Svinninge

    var mapOptions = {
        zoom: 12,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.SATELLITE,
        disableDefaultUI: true
    };
  
    map = new google.maps.Map(document.getElementById('googlemaps'), mapOptions);

    marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        icon: {
                path: google.maps.SymbolPath.FORWARD_OPEN_ARROW,
                scale: 6,
                rotation: 0,
        }
    });
    
    var weatherLayer = new google.maps.weather.WeatherLayer({
        temperatureUnits: google.maps.weather.TemperatureUnit.CELSCIUS
    });
    weatherLayer.setMap(map);

    var cloudLayer = new google.maps.weather.CloudLayer();
    cloudLayer.setMap(map);
    
    google.maps.event.addListener(map, 'tilesloaded', function(){
        document.getElementById('googlemaps').style.position = 'absolute';
        document.getElementById('googlemaps').style.backgroundColor = 'black';
        document.getElementById('googlemaps').style.zIndex = '0';
        document.getElementById('googlemaps').style.visibility = 'visible';
    });

}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
        
    </head>
    <body onload="init()">
        <div id="main">
            <div id="googlemaps"></div>
            <img id="instrument" src="img/empty.png" alt="instrument">
        </div>        
        <div id="logpanel"></div>
        <script type="text/javascript" src="inc/wsClient.js.php"></script>  
    </body>
</html>


