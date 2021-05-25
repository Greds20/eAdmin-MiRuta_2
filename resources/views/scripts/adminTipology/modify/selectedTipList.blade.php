<script type="text/javascript">
	function selectedTip(){
		$("#listadoPois li").on("click", function () {
		    $("#listadoPois li").removeClass('itemSeleccionado');
		    $(this).attr('class', 'itemSeleccionado');
		   	$.ajax({
				url: "{{route('tipologiaDynamic.getSelectedTip')}}",
				type: 'GET',
				data: {
					id: $(this).attr('id')
				},
				success: function(data){
					document.getElementById("id").value = data[0].id_tipologia;
					document.getElementById("name").value = data[0].nombre;
					document.getElementById("description").innerHTML = data[0].descripcion;
					document.getElementById("state").value = (data[0].estado) ? '1' : '0';
					document.getElementById("stateV").checked = data[0].estado;
					document.getElementById("stateText").textContent = (data[0].estado) ? "Activo" : "Inactivo";
	
					hidePanel('#searchPanel');
				}
			});
		});
	}
</script>