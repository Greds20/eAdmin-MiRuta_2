<script type="text/javascript">
	function selectedUser(){
		$("#listadoUsers li").on("click", function () {
		    $("#listadoUsers li").removeClass('itemSeleccionado');
		    $(this).attr('class', 'itemSeleccionado');
		   	$.ajax({
				url: "{{route('administradoresDynamic.getAllSelectedUser')}}",
				type: 'GET',
				data: {
					id: $(this).attr('id')
				},
				success: function(data){
					document.getElementById("name").innerHTML = data[0].prnombre + " " +data[0].sgnombre + " " + data[0].prapellido + " " + data[0].sgapellido;
					document.getElementById("state").checked = data[0].estado;
					document.getElementById("stateText").textContent = (data[0].estado) ? "Activo" : "Inactivo";
					document.getElementById("email").value = data[0].correo;
					document.getElementById("rol").value = data[1].nombre;
				}
			});
		});
	}
</script>