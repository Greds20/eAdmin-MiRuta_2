<script type="text/javascript">
    var marcador;
	var map = L.map('map',{ zoomControl:true }).setView([4.343752163576473, -74.36196339964096],18);

	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> Contribuidores, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>,<a href="http://cloudmade.com">CloudMade</a>',
	}).addTo(map);

	map.on('click', function(e) { 
		if (marcador) {
		   map.removeLayer (marcador);
		}
		marcador=L.marker(e.latlng).addTo(map);
		var lng = (e.latlng.lng).toString();
		var lat = (e.latlng.lat).toString();
		document.getElementById("cx").value = (lng.length > 9) ? lng.substring(0, 9) : lng;
		document.getElementById("cy").value = (lat.length > 9) ? lat.substring(0, 9) : lat;
		hidePanel('#coordsMap');
	});
	document.getElementById("btnShowSetCoord").onclick = function(){
		setTimeout(function() {
	        map.invalidateSize();
		}, 100);
		showPanel('#coordsMap');
	}
</script>