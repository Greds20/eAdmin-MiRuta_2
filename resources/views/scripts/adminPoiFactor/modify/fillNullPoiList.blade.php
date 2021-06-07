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
					    document.getElementById("idpoi").value = $(this).attr('id');
				    	document.getElementById("name").value = $(this).text();
					   	$.ajax({
							url: "{{route('poiFactorDynamic.getFactoreSPoi')}}",
							type: 'GET',
							data: {
								id: $(this).attr('id')
							},
							success: function(data){
								var divList = document.getElementById("itemDivList");
								divList.innerHTML = '';

								var facTam = data.length;
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
										input.value = data[i].id_factor;
									var h3 = document.createElement("h3");
										h3.classList.add("overflowText");
										h3.innerText = data[i].nombre + " ("+data[i].formula+")";
									var select = document.createElement("select");
										select.name = "valor[]";
										select.required = "true";
										select.classList.add('select');
										var indexSel; 
										var cont = 0;
										for(var j=data[i].valorMinimo; j<=data[i].valorMaximo; j++){
											var opt = document.createElement('option');
											opt.value = j;
											opt.innerHTML = j;
											select.appendChild(opt);
											if(data[i].valor == j){ indexSel = cont; }
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

				    ul.appendChild(li);
				}
			}
		});
	}
	fillNullPoiList();
</script>