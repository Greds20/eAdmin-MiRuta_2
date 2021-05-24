<script type="text/javascript">
	function fillForm(){
	    $.ajax({
			url: "{{ route('formulaDynamic.getAllForm') }}",
			type: 'GET',
			success: function(data){
				var ul = document.getElementById("listadoItems");
				for(var i=0; i<data.length;i++){
					var li = document.createElement("li");
				    li.appendChild(document.createTextNode(data[i].nombre));
				    li.setAttribute("id", data[i].id_formula);

				    $(li).on("click", function () {
						$('#listadoItems li').removeClass('itemSeleccionado');
						$(this).attr('class', 'itemSeleccionado');
						$id = $(this).attr('id')
						$('#idform').val($id);
						$('#nameForm').val($(this).text());
						fillTables($id);
				    });
				    ul.appendChild(li);
				}
			}
		});
	}
	fillForm();
</script>