<script type="text/javascript">
	function selectedPoi(){
		$("#listadoPois li").on("click", function () {
		    $("#listadoPois li").removeClass('itemSeleccionado');
		    $(this).attr('class', 'itemSeleccionado');
		   	$.ajax({
				url: "{{route('poiFactorDynamic.getSPoiNoF')}}",
				type: 'GET',
				data: {
					id: $(this).attr('id'),
					name: $(this).text()
				},
				success: function(data){
					var factorOfSPoi = document.getElementById("factorOfSPoi");
					factorOfSPoi.innerHTML = '';
					factorOfSPoi.classList.remove('scrollFacPoih1');
					var idpoi = document.getElementById("idpoi"); 
					idpoi.value = data[0];
					idpoi.required = "true";
					document.getElementById("name").value = data[1];
					for(var i=2; i<data.length;i++){
						var div = document.createElement("div");
						div.classList.add('monoDiv');
						var h3 = document.createElement("h3");
						h3.innerHTML = (data[i])[1];
						div.appendChild(h3);
						var select = document.createElement("select");
						select.name = "valor[]";
						select.required = "true";
						select.classList.add('select');
						var factorid = document.createElement("input");
						factorid.type = "hidden";
						factorid.name = "id[]";
						factorid.value = (data[i])[0];
						factorid.required = "true";
						for(var j=(data[i])[2]; j<=(data[i])[3]; j++){
							var opt = document.createElement('option');
							opt.value = j;
							opt.innerHTML = j;
							select.appendChild(opt);
						}
						div.appendChild(select);
						div.appendChild(factorid);
						factorOfSPoi.appendChild(div);
					}
				}
			});
		});
	}
</script>