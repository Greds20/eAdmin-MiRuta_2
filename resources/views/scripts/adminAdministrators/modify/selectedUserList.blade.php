<script type="text/javascript">
	function selectedUser(){
		$("#listadoPois li").on("click", function () {
		    $("#listadoPois li").removeClass('itemSeleccionado');
		    $(this).attr('class', 'itemSeleccionado');
		   	$.ajax({
				url: "{{route('administradoresDynamic.getSelectedUser')}}",
				type: 'GET',
				data: {
					id: $(this).attr('id')
				},
				success: function(data){
					document.getElementById("id").value = data[0].id_administrador;
					document.getElementById("alias").value = data[0].alias;
					document.getElementById("stateV").checked = data[0].estado;
					document.getElementById("state").checked = true;
					document.getElementById("state").value = (data[0].estado) ? "1" : "0";
					document.getElementById("stateText").textContent = (data[0].estado) ? "Activo" : "Inactivo";
					document.getElementById("email").value = data[0].correo;
					hidePanel('#searchPanel');
				}
			});
		});
	}
</script>