<script type="text/javascript">
	function selectedEstab(){
		$("#listadoPois li").on("click", function () {
		    $("#listadoPois li").removeClass('itemSeleccionado');
		    $(this).attr('class', 'itemSeleccionado');
		   	$.ajax({
				url: "{{route('establecimientoDynamic.getSelectedEstab')}}",
				type: 'GET',
				data: {
					id: $(this).attr('id')
				},
				success: function(data){
					document.getElementById("description").innerHTML = data[0].descripcion;
					document.getElementById("state").checked = data[0].estado;
					document.getElementById("stateText").textContent = (data[0].estado) ? "Activo" : "Inactivo";
				}
			});
		});
	}
</script>