<script type="text/javascript">
	function fillCB_Town(){
		$.ajax({
			url: "{{route('getGRecords.getMunicipios')}}",
			type: 'GET',
			success: function(data){
				var cb = document.getElementById('town');
				for(var i=0; i<data.length;i++){
					var opt = document.createElement('option');
					opt.value = data[i].id_municipio;
					opt.innerHTML = data[i].nombre;
					cb.appendChild(opt);
				}
			}
		});	
	}
	fillCB_Town();
</script>