<script type="text/javascript">
	function selectedPoi(){
		$("#listadoPois li").on("click", function () {
		    $("#listadoPois li").removeClass('itemSeleccionado');
		    $(this).attr('class', 'itemSeleccionado');
		   	$.ajax({
				url: "{{route('poiFactorDynamic.getFactoreSPoi')}}",
				type: 'GET',
				data: {
					id: $(this).attr('id'),
					name: $(this).text()
				},
				success: function(data){
					var divList = document.getElementById("itemDivList");
					divList.innerHTML = '';
					document.getElementById("idpoi").value = data[0];
					document.getElementById("name").value = data[1];

					var facTam = data[2].length;
					for (var i = 0; i < facTam; i++) {

						var div = document.createElement("div");
							if(i==facTam-1){
								if((facTam%2)==0){
									div.classList.add('rowsForm');
								}else{
									div.classList.add('monoDiv');
								}
							}else{
								div.classList.add('rowsForm');
							}
						var input = document.createElement("input");
							input.type = "hidden";
							input.name = "id[]";
							input.value = (data[2])[i].fk_id_formula;
						var h3 = document.createElement("h3");
							h3.innerText = (data[2])[i].nombre;
						var select = document.createElement("select");
							select.name = "valor[]";
							select.required = "true";
							select.classList.add('select');
							var indexSel; 
							var cont = 0;
							for(var j=(data[2])[i].valorminimo; j<=(data[2])[i].valormaximo; j++){
								var opt = document.createElement('option');
								opt.value = j;
								opt.innerHTML = j;
								select.appendChild(opt);
								if((data[2])[i].valor == j){ indexSel = cont; }
								cont++;
							}
							select.selectedIndex = indexSel;
						div.appendChild(h3);
						div.appendChild(select);
						div.appendChild(input);
						divList.appendChild(div);

					}	
					hidePanel('#searchPanel');
				}
			});
		});
	}
</script>