<script type="text/javascript">
	function listenerProm(){
		
		var rowsF = document.getElementById('factorReg').getElementsByTagName('tr');
		var rowsV = document.getElementById('variableReg').getElementsByTagName('tr');
		
		var prom = 0;
		
		for(var i=0; i<rowsF.length; i++){
			var cells = rowsF[i].getElementsByTagName('th');
			var checkboxs = (cells[5].getElementsByTagName('input'))[0];
			if(checkboxs.checked){
				prom = (cells[3].getElementsByTagName('input'))[0].value * (cells[4].getElementsByTagName('input'))[0].value + prom;
				
			}
		}

		for(var i=0; i<rowsV.length; i++){
			var cells = rowsV[i].getElementsByTagName('th');
			var checkboxs = (cells[4].getElementsByTagName('input'))[0];
			if(checkboxs.checked){
				prom = Number((cells[2].getElementsByTagName('input'))[0].value) + Number(prom);
			}
		}

		$('#porcText').html(prom);
	}
	listenerProm();
</script>