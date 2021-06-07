<script type="text/javascript">
function fillNullPoiList(){
	var term = $('#searchName').val();
	$.ajax({
		url: "{{route('poiFactorDynamic.searchPois')}}",
		data: {
			term: term
		},
		success: function(data){
			var ul = document.getElementById("listadoPois");
			ul.innerHTML = '';
			for(var i=0; i<data.length;i++){
				var li = document.createElement("li");
			    li.appendChild(document.createTextNode(data[i].nombre));
			    li.setAttribute("id", data[i].id_poi);

			    $(li).on("click", function () {
				    $("#listadoPois li").removeClass('itemSeleccionado');
				    $(this).attr('class', 'itemSeleccionado');
				   	$.ajax({
						url: "{{route('poiFactorDynamic.getFacxsPoi')}}",
						type: 'GET',
						data: {
							id: $(this).attr('id')
						},
						success: function(data){
							var factorOfSPoi = document.getElementById("factorOfSPoi");
							factorOfSPoi.innerHTML = '';
							factorOfSPoi.classList.remove('scrollFacPoih1');
							for(var i=0; i<data.length;i++){
								var div = document.createElement("div");
								div.classList.add('monoDiv');
								var h3 = document.createElement("h3");
								h3.innerHTML = data[i].nombre + " ("+data[i].formula+")";
								div.appendChild(h3);
								var input = document.createElement("input");
								input.disabled = "true";
								input.classList.add('inputSimple');
								input.value = data[i].valor;
								div.appendChild(input);
								factorOfSPoi.appendChild(div);
							}
						}
					});
				});
			    ul.appendChild(li);
			}
		}
	});
}
fillNullPoiList();
$('#searchName').on('keyup', function () {
	fillNullPoiList();
});
</script>