<script type="text/javascript">
	function listenerSum(){
		
		var rowsSF = document.getElementById('subfactorReg').getElementsByTagName('tr');
		
		var prom = 0;
		
		for(var i=0; i<rowsSF.length; i++){
			var cells = rowsSF[i].getElementsByTagName('th');
			var checkboxs = (cells[5].getElementsByTagName('input'))[0];
			if(checkboxs.checked){
				prom = (cells[3].getElementsByTagName('input'))[0].value * (cells[4].getElementsByTagName('input'))[0].value + prom;
				
			}
		}

		$('#sumText').html(prom);
	}
</script>