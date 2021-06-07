<script type="text/javascript">
	function fillTables(idform){
	    $.ajax({
			url: "{!! route('formulaDynamic.fillTVarxFac') !!}",
			type: 'GET',
			data: {
				id: idform,
				all: $("#showAll").is(":checked")
			},
			success: function(data){
				//Llenar datos de formula
				document.getElementById("stateFormV").checked = (data[3].estado=="1") ? "true" : "false";
				document.getElementById("stateForm").value = data[3].estado;
				document.getElementById("stateText").textContent = (data[3].estado=="1") ? "Activo" : "Inactivo";
				document.getElementById("descForm").innerHTML = data[3].descripcion;

				//Llenar tabla de factores
				(document.getElementById('nFactorGet')).value = data[0].length;
				var tbody = document.getElementById('factorReg');
				$(tbody).empty();

				for(var i=0; i<data[0].length; i++){
					addRowF();
					var rows = tbody.getElementsByTagName("tr");
					var cell = rows[i].getElementsByTagName("th");

					var inputs = cell[0].getElementsByTagName("input");
						var fieldID = document.createElement('input');
						fieldID.type = "hidden";
						fieldID.name = "idF[]";
						fieldID.required = "true";
						fieldID.value = (data[0])[i].id_factor;
						cell[0].appendChild(fieldID);
					inputs[0].value = (data[0])[i].nombre;

					var input = cell[1].getElementsByTagName("input");
					input[0].value = (data[0])[i].descripcion;

					var input = cell[2].getElementsByTagName("input");
					input[0].value = (data[0])[i].valorminimo;

					var input = cell[3].getElementsByTagName("input");
					input[0].value = (data[0])[i].valormaximo;

					var input = cell[4].getElementsByTagName("input");
					input[0].value = (data[0])[i].peso;

					var inputs = cell[5].getElementsByTagName("input");
					$(inputs[0]).removeAttr('disabled');
					inputs[0].checked = ((data[0])[i].estado=="1") ? true : false; 
					inputs[1].value = (data[0])[i].estado;
				}

				//Llenar tabla de variables
				(document.getElementById('nVariableGet')).value = data[1].length;
				var tbody = document.getElementById('variableReg');
				$(tbody).empty();
				for(var i=0; i<data[1].length; i++){
					addRowV();
					var rows = tbody.getElementsByTagName("tr");
					var cont = 0;
					//Crear divs de Subfactores
					for (var j=0; j<data[2].length; j++) {
						if((data[2])[j].fk_id_variable == (data[1])[i].id_variable){
							createSF(i);
							var div = rows[i].getElementsByTagName("div");
							var input = div[cont].getElementsByTagName("input");
							input[0].value = (data[2])[j].id_factor;
							input[1].value = (data[2])[j].nombre;
							input[2].value = (data[2])[j].descripcion;
							input[3].value = (data[2])[j].valorminimo;
							input[4].value = (data[2])[j].valormaximo;
							input[5].value = (data[2])[j].peso;
							input[6].value = (data[2])[j].estado;
							cont++;
						}
					}

					rows[i].querySelector("[id='nSfactorReg']").value = cont;
					rows[i].querySelector("[name='nSfactor[]']").value = cont;

					var cell = rows[i].getElementsByTagName("th");
					var inputs = cell[0].getElementsByTagName("input");
						var fieldID = document.createElement('input');
						fieldID.type = "hidden";
						fieldID.name = "idV[]";
						fieldID.required = "true";
						fieldID.value = (data[1])[i].id_variable;
						cell[0].appendChild(fieldID);
					inputs[0].value = (data[1])[i].nombre;

					var input = cell[1].getElementsByTagName("input");
					input[0].value = (data[1])[i].descripcion;

					var input = cell[2].getElementsByTagName("input");
					input[0].value = (data[1])[i].valormaximo;

					var inputs = cell[4].getElementsByTagName("input");
					$(inputs[0]).removeAttr('disabled');
					inputs[0].checked = ((data[1])[i].estado == "1") ? true : false;
					inputs[1].value = (data[1])[i].estado;
				}
				hidePanel('#itemShowPanel');
				listenerProm();
			}
		});
	}
</script>