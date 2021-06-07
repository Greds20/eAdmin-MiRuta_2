<script type="text/javascript">
	function fillTables(idform){
	    $.ajax({
			url: "{!! route('formulaDynamic.fillTVarxFacxSfac') !!}",
			type: 'GET',
			data: {
				id: idform
			},
			success: function(data){
				document.getElementById("stateForm").checked = (data[0].estado == "1") ? true : false;
				document.getElementById("stateText").textContent = (data[0].estado == "1") ? "Activo" : "Inactivo";
				document.getElementById("descForm").innerHTML = data[0].descripcion;

				var tbodyF = document.getElementById('factorReg');
				$(tbodyF).empty();
				var tbodyV = document.getElementById('variableReg');
				$(tbodyV).empty();
				var tbodySf = document.getElementById('subfactorReg');
				$(tbodySf).empty();

				var formula = "";

				//Llenar tabla factores
				for(var i=0; i<data[1].length; i++){
					var newRow = document.createElement('tr');

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[1])[i].nombre;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[1])[i].descripcion;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[1])[i].valorminimo;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[1])[i].valormaximo;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[1])[i].peso;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					tbodyF.appendChild(newRow);


					formula += (formula=="") ? (data[1])[i].peso + " * " + (data[1])[i].nombre : " + " + (data[1])[i].peso + " * " + (data[1])[i].nombre;
				}

				//Llenar tabla variables
				for(var i=0; i<data[2].length; i++){
					var newRow = document.createElement('tr');

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[2])[i].nombre;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[2])[i].descripcion;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[2])[i].valormaximo;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					tbodyV.appendChild(newRow);
				}

				var sf = [];
				var sfVmax = [];
				var sfForm = [];

				//Llenar tabla subfactores
				for(var i=0; i<data[3].length; i++){
					var newRow = document.createElement('tr');

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[3])[i].variable;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[3])[i].nombre;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[3])[i].descripcion;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[3])[i].valorminimo;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[3])[i].valormaximo;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					var newCell = document.createElement('th');
					var field = document.createElement('input');
					field.type = "text";
					field.value = (data[3])[i].peso;
					newCell.appendChild(field);
					newRow.appendChild(newCell);

					tbodySf.appendChild(newRow);

					var existe = false;
					for (var j = 0; j < sf.length; j++) {
						if(sf[j] == (data[3])[i].variable){
							sfForm[j] += " + " + (data[3])[i].nombre + " * " + (data[3])[i].peso;
							existe = true;
						}
					}
					if(!existe){
						sf.push((data[3])[i].variable);
						sfVmax.push((data[3])[i].valormaximoV);
						sfForm.push((data[3])[i].nombre + " * " + (data[3])[i].peso);
					}
					
				}
				for(var i = 0;i<sf.length;i++){
					formula+= " + (" + sfForm[i] + ") " + sf[i] + " (hasta " + sfVmax[i] + ")";
				}
				document.getElementById('form').innerHTML = formula;
				hidePanel('#itemShowPanel');
			}
		});
	}
</script>