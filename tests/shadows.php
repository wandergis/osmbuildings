<!DOCTYPE html>
<html>
<head>
<title>OSM Buildings - Shadows</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<style type="text/css">
html, body {
  border: 0;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
#map {
  height: 100%;
}
</style>
<link rel="stylesheet" href="leaflet-0.7/leaflet.css">
<script src="leaflet-0.7/leaflet-src.js"></script>
<script src="scripts.js.php?engine=Leaflet"></script>
<style>
#controls {
  position:absolute;
  left:0;
  bottom:0;
  width:100%;
  height:30px;
  text-align:center;
  background-color:#ffffff;
}
#controls label {
  font-family:sans-serif;
  font-size:14px;
  height: 20px;
}
</style>
</head>

<body>
<div id="map"></div>
<div id="controls">
  <input id="date" type="range" min="1" max="12" step="1"><label for="date"></label>
  <input id="time" type="range" min="0" max="23" step="1"><label for="time"></label>
</div>
<script>
var map = new L.Map('map').setView([52.52179, 13.39503], 18); // Berlin Bodemuseum

new L.TileLayer('http://{s}.tiles.mapbox.com/v3/osmbuildings.gm744p3p/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);

var osmb = new OSMBuildings(map).setDate(new Date(2014, 1, 15, 10, 30)).loadData();

function changeDate() {
  var
    Y = now.getFullYear(),
    M = now.getMonth(),
    D = 15,
    h = now.getHours(),
    m = 0;

  timeRangeLabel.innerText = pad(h) + ':' + pad(m);
  dateRangeLabel.innerText = Y + '-' + pad(M+1);
  osmb.setDate(new Date(Y, M, D, h, m));
}

function pad(v) {
  return (v < 10 ? '0' : '') + v;
}

var date, time;
var timeRange = document.querySelector('#time');
var dateRange = document.querySelector('#date');
var timeRangeLabel = document.querySelector('label[for=time]');
var dateRangeLabel = document.querySelector('label[for=date]');

var now = new Date;
changeDate();

// init with day of year
var Jan1 = new Date(now.getFullYear(), 0, 1);
dateRange.value = now.getMonth()+1;

timeRange.value = now.getHours();

timeRange.addEventListener('change', function() {
  now.setHours(this.value);
  now.setMinutes(0);
  changeDate();
}, false);

dateRange.addEventListener('change', function() {
  now.setMonth(this.value-1);
  changeDate();
}, false);
</script>
</body>
</html>