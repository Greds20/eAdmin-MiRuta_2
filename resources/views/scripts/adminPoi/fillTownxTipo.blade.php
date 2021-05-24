<script type="text/javascript">
    $.ajax({
		url: "{{route('poiDynamic.fillAdminPoi')}}",
		type: 'GET',
		success: function(data){
			var select = document.getElementById('town');
			for(var i=0; i<(data[0]).length;i++){
				var opt = document.createElement('option');
				opt.value = (data[0])[i].id_municipio;
				opt.innerHTML = (data[0])[i].nombre;
				select.appendChild(opt);
			}

			var ul = document.getElementById("listadoTipo");
			for(var i=0; i<(data[1]).length;i++){

				var checkbox = document.createElement('input');
			    checkbox.type = "checkbox";
			    checkbox.name = "tipo[]";
				checkbox.value = (data[1])[i].id_tipologia;
				checkbox.style.display = "none";

				var li = document.createElement("li");
			    li.appendChild(document.createTextNode((data[1])[i].nombre));
			    li.value = (data[1])[i].id_tipologia;
			    li.appendChild(checkbox);
			    ul.appendChild(li);
			}
			selectedTipo();
		}
	});
</script>