<script type="text/javascript">
    $.ajax({
		url: "{{route('getGRecords.getRoles')}}",
		type: 'GET',
		success: function(data){
			var select = document.getElementById('rol');
			for(var i=0; i<data.length;i++){
				var opt = document.createElement('option');
				opt.value = data[i].id_rol;
				opt.innerHTML = data[i].nombre;
				select.appendChild(opt);
			}
		}
	});
</script>