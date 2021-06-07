<script type="text/javascript">
    $.ajax({
		url: "{{route('logDynamic.fillLogElements')}}",
		type: 'GET',
		success: function(data){
			var select = document.getElementById('section');
			var opt = document.createElement('option');
			opt.value = 0;
			opt.innerHTML = '-';
			select.appendChild(opt);
			for(var i=0; i<data[3].length;i++){
				var opt = document.createElement('option');
				opt.value = (data[3])[i].ID_SECCION;
				opt.innerHTML = (data[3])[i].nombre;
				select.appendChild(opt);
			}

			var select = document.getElementById('event');
			var opt = document.createElement('option');
			opt.value = 0;
			opt.innerHTML = '-';
			select.appendChild(opt);
			for(var i=0; i<data[2].length;i++){
				var opt = document.createElement('option');
				opt.value = (data[2])[i].ID_EVENTO;
				opt.innerHTML = (data[2])[i].nombre;
				select.appendChild(opt);
			}
			document.getElementById('from').min = (data[0])[0].fecha;
			document.getElementById('from').max = (data[1])[0].fecha;
			document.getElementById('to').min = (data[0])[0].fecha;
			document.getElementById('to').max = (data[1])[0].fecha;
		}
	});
</script>