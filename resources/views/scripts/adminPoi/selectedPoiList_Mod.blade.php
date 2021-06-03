$.ajax({
	url: "{{route('poiDynamic.getSelectedPoi')}}",
	type: 'GET',
	data: {
		id: $(this).attr('id')
	},
	success: function(data){
		$("#listadoTipo li").removeClass('itemSeleccionado');
		$("#listadoTipo li [type='checkbox']").prop('checked', false);
		document.getElementById("id").value = (data[0])[0].id_poi;
		document.getElementById("name").value = (data[0])[0].nombre;
		document.getElementById("time").value = (data[0])[0].tiempoestancia;
		document.getElementById("description").innerHTML = (data[0])[0].descripcion;
		document.getElementById("cx").value = (data[0])[0].coordenadax;
		document.getElementById("cy").value = (data[0])[0].coordenaday;
		document.getElementById("cost").value = (data[0])[0].costo;
		document.getElementById("state").checked = (data[0])[0].estado;
		document.getElementById("stateV").checked = (data[0])[0].estado;
		document.getElementById("state").value = (data[0])[0].estado ? '1' : '0';
		document.getElementById("state").checked = true;
		document.getElementById("stateText").textContent = (data[0])[0].estado ? "Activo" : "Inactivo";
		
		document.getElementById('review').src = "{!! asset('storage/poiImages/') !!}"+"/"+(data[0])[0].imagen;

		document.getElementById('town').selectedIndex = (data[0])[0].fk_id_tipologia-1;

		var topList = document.getElementById("listadoTipo").getElementsByTagName("li");

		for(var i=0; i<topList.length;i++){
			for(var j=0; j<(data[1]).length;j++){
				if((topList[i].value)==((data[1])[j].fk_id_tipologia)){
					topList[i].classList.add("itemSeleccionado");
					$(topList[i]).find("[type='checkbox']").prop('checked', true);
				}
			}
		}
		hidePanel('#searchPanel');
	}
});