<script type="text/javascript">
	function fillTSF(pos){
		var tbody = document.getElementById('subfactorReg');
		$(tbody).empty();

		var tbodyV = document.getElementById('variableReg');
		var filas = tbodyV.getElementsByTagName("tr");
		var divs = filas[pos].getElementsByTagName("div");

		var canSFReg = document.getElementById('nSFactorGet');
		canSFReg.value = filas[pos].querySelector("[name='nSfactor[]']").value;

		var inputVSelect = document.getElementById('vSelect');
		inputVSelect.value = pos;

		for(var i=0; i<divs.length; i++){
			addRowSF();
			var valores = divs[i].getElementsByTagName("input")
			var rows = tbody.getElementsByTagName("tr");
			var cell = rows[i].getElementsByTagName("th");

			var inputs = cell[0].getElementsByTagName("input");
			inputs[0].value = valores[1].value;

			var input = cell[1].getElementsByTagName("input");
			input[0].value = valores[2].value;

			var input = cell[2].getElementsByTagName("input");
			input[0].value = valores[3].value;

			var input = cell[3].getElementsByTagName("input");
			input[0].value = valores[4].value;

			var input = cell[4].getElementsByTagName("input");
			input[0].value = valores[5].value;

			var inputs = cell[5].getElementsByTagName("input");
			inputs[0].checked = (valores[6].value == "1") ? true : false; 
			if(i<canSFReg.value){
				$(inputs[0]).removeAttr('disabled');
			}
		}
		listenerSum();
	}
</script>