$.ajax({
	url: "{{route('poiDynamic.getAllSelectedPoi')}}",
	type: 'GET',
	data: {
		id: $(this).attr('id')
	},
	success: function(data){
		document.getElementById("name").value = (data[0])[0].nombre;
		document.getElementById("time").value = (data[0])[0].tiempoestancia;
		document.getElementById("cost").value = (data[0])[0].costo;
		document.getElementById("description").innerHTML = (data[0])[0].descripcion;
		document.getElementById("cx").value = (data[0])[0].coordenadax;
		document.getElementById("cy").value = (data[0])[0].coordenaday;
		document.getElementById("state").checked = (data[0])[0].estado;

		document.getElementById('review').src = "{!! asset('storage/poiImages/') !!}"+"/"+(data[0])[0].imagen;

		document.getElementById("stateText").textContent = (data[0])[0].estado ? "Activo" : "Inactivo";

		document.getElementById("town").value = (data[1])[0].nombre;

		var ul = document.getElementById("listadoTipo");
		ul.innerHTML = '';
		for(var i=0; i<data[2].length;i++){
			var li = document.createElement("li");
		    li.appendChild(document.createTextNode((data[2])[i].nombre));
		    ul.appendChild(li);
		}
	}
});