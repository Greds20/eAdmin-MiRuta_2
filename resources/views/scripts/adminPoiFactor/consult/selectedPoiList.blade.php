<script type="text/javascript">
	function selectedPoi(){
		$("#listadoPois li").on("click", function () {
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
					for(var i=0; i<data[1].length;i++){
						var div = document.createElement("div");
						div.classList.add('monoDiv');
						var h3 = document.createElement("h3");
						h3.innerHTML = (data[1])[i].nombre;
						div.appendChild(h3);
						var input = document.createElement("input");
						input.disabled = "true";
						input.classList.add('inputSimple');
						input.value = (data[1])[i].valor;
						div.appendChild(input);
						factorOfSPoi.appendChild(div);
					}
				}
			});
		});
	}
</script>