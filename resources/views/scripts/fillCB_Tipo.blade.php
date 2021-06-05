<script type="text/javascript">
	function fillCB_Tipo(){
	    $.ajax({
			url: "{{route('getGRecords.getTipos')}}",
			type: 'GET',
			success: function(data){
				var select = document.getElementById('type');
				for(var i=0; i<data.length;i++){
					var opt = document.createElement('option');
					opt.value = data[i].id_tipo;
					opt.innerHTML = data[i].nombre;
					select.appendChild(opt);
				}
			}
		});
	}
	fillCB_Tipo();
</script>