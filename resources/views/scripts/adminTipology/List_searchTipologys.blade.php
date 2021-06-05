<script type="text/javascript">
	$('#searchName').on('keyup', function () {
		List_searchTipologys();
	});

	function List_searchTipologys(){
		$.ajax({
			url: "{{route('tipologia.searchTipologias')}}",
			type: 'GET',
			data: {
				type: "Bas",
				all: ($("#showAll").is(":checked")) ? "1" : "0",
				term: document.getElementById("searchName").value
			},
			success: function(data){
				var ul = document.getElementById("listado");
				ul.innerHTML = '';
				for(var i=0; i<data.length; i++){
					var li = document.createElement("li");
				    li.appendChild(document.createTextNode(data[i].nombre));
				    li.setAttribute("id", data[i].id_tipologia);

				    $(li).on("click", function () {
					    $("#listado li").removeClass('itemSeleccionado');
					    $(this).attr('class', 'itemSeleccionado');
					   	$.ajax({
							url: "{{route('tipologia.getTipologia')}}",
							type: 'GET',
							data: {
								id: $(this).attr('id')
							},
							success: function(data){
								document.getElementById("name").value = data[0].nombre;
								document.getElementById("description").innerHTML = data[0].descripcion;
								document.getElementById("state").checked = data[0].estado;
								document.getElementById("stateText").textContent = (data[0].estado) ? "Activo" : "Inactivo";
							}
						});
					});
				    ul.appendChild(li);
				}
			}
		});
	}
	List_searchTipologys();
</script>