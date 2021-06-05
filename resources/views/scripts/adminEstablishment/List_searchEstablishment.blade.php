<script type="text/javascript">
	$('#searchName').on('keyup', function () {
		List_searchEstablishment();
	});

	function List_searchEstablishment(){
		$.ajax({
			url: "{{route('establecimiento.searchEstablecimientos')}}",
			type: 'GET',
			data: {
				type: "Bas",
				all: ($("#showAll").is(":checked")) ? "1" : "0",
				term: document.getElementById("searchName").value
			},
			success: function(data){
				var ul = document.getElementById("listadoPois");
				ul.innerHTML = '';
				for(var i=0; i<data.length; i++){
					var li = document.createElement("li");
				    li.appendChild(document.createTextNode(data[i].nombre));
				    li.setAttribute("id", data[i].id_establecimiento);

				    $(li).on("click", function () {
					    $("#listado li").removeClass('itemSeleccionado');
					    $(this).attr('class', 'itemSeleccionado');
					   	$.ajax({
							url: "{{route('establecimiento.getEstablecimiento')}}",
							type: 'GET',
							data: {
								id: $(this).attr('id')
							},
							success: function(data){
								document.getElementById("id").value = data[0].ID_ESTABLECIMIENTO;
								document.getElementById("name").value = data[0].nombre;
								document.getElementById("cx").value = data[0].coordenadaX;
								document.getElementById("cy").value = data[0].coordenadaY;
								document.getElementById("description").innerHTML = data[0].descripcion;
								document.getElementById("state").value = (data[0].estado) ? '1' : '0';
								document.getElementById("stateV").checked = data[0].estado;
								document.getElementById("stateText").textContent = (data[0].estado) ? "Activo" : "Inactivo";
								document.getElementById('town').selectedIndex = data[0].FK_ID_MUNICIPIO-1;
								document.getElementById('type').selectedIndex = data[0].FK_ID_TIPO-1;
							}
						});
					});
				    ul.appendChild(li);
				}
			}
		});
	}
	List_searchEstablishment();
</script>