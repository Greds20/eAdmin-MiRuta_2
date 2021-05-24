<script type="text/javascript">
	function saveSF(){
		var pos = document.getElementById('vSelect');
		var tbodyV = document.getElementById('variableReg');
		var filasV = tbodyV.getElementsByTagName("tr");
		var sFactores = filasV[pos.value].getElementsByTagName("div");

		var n = document.getElementById('nSFactorGet');
		var tbodySF = document.getElementById('subfactorReg');
		var filasSF = tbodySF.getElementsByTagName("tr");
		
		for(var i=0; i<n.value; i++){
			var inputsSF = sFactores[i].getElementsByTagName("input");
			var celdasSF = filasSF[i].getElementsByTagName("th");

			var inputTSF = celdasSF[0].getElementsByTagName("input");
				inputsSF[1].value = inputTSF[0].value;
			var inputTSF = celdasSF[1].getElementsByTagName("input");
				inputsSF[2].value = inputTSF[0].value;
			var inputTSF = celdasSF[2].getElementsByTagName("input");
				inputsSF[3].value = inputTSF[0].value;
			var inputTSF = celdasSF[3].getElementsByTagName("input");
				inputsSF[4].value = inputTSF[0].value;
			var inputTSF = celdasSF[4].getElementsByTagName("input");
				inputsSF[5].value = inputTSF[0].value;
			var inputTSF = celdasSF[5].getElementsByTagName("input");
				inputsSF[6].value = inputTSF[0].checked;
		}
		if(n.value<sFactores.length){
			for(var i=n.value; i<sFactores.length; i++){
				$(sFactores[i]).remove();
			}
		}
		for(var i=n.value; i<filasSF.length; i++){
			createSF(pos.value);
			var inputsSF = sFactores[i].getElementsByTagName("input");
			var celdasSF = filasSF[i].getElementsByTagName("th");

			var inputTSF = celdasSF[0].getElementsByTagName("input");
				inputsSF[1].value = inputTSF[0].value;
			var inputTSF = celdasSF[1].getElementsByTagName("input");
				inputsSF[2].value = inputTSF[0].value;
			var inputTSF = celdasSF[2].getElementsByTagName("input");
				inputsSF[3].value = inputTSF[0].value;
			var inputTSF = celdasSF[3].getElementsByTagName("input");
				inputsSF[4].value = inputTSF[0].value;
			var inputTSF = celdasSF[4].getElementsByTagName("input");
				inputsSF[5].value = inputTSF[0].value;
			var inputTSF = celdasSF[5].getElementsByTagName("input");
				inputsSF[6].value = inputTSF[0].checked;
		}
		filasV[pos.value].querySelector("[name='nSfactor[]']").value = sFactores.length;
	}
</script>