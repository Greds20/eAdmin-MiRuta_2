<script type="text/javascript">
    $.ajax({
		url: "{{route('poiDynamic.fillAdminPoi')}}",
		type: 'GET',
		success: function(data){
			var ul = document.getElementById("listadoTipo");
			for(var i=0; i<(data[1]).length;i++){

				var checkbox = document.createElement('input');
			    checkbox.type = "checkbox";
			    checkbox.name = "tipo[]";
				checkbox.value = (data[1])[i].ID_TIPOLOGIA;
				checkbox.style.display = "none";

				var li = document.createElement("li");
			    li.appendChild(document.createTextNode((data[1])[i].nombre));
			    li.value = (data[1])[i].ID_TIPOLOGIA;
			    li.appendChild(checkbox);
			    ul.appendChild(li);
			}
			selectedTipo();
		}
	});
</script>