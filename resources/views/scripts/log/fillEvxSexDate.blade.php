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
			for(var i=0; i<data[1].length;i++){
				var opt = document.createElement('option');
				opt.value = (data[1])[i].id_seccion;
				opt.innerHTML = (data[1])[i].nombre;
				select.appendChild(opt);
			}

			var select = document.getElementById('event');
			var opt = document.createElement('option');
			opt.value = 0;
			opt.innerHTML = '-';
			select.appendChild(opt);
			for(var i=0; i<data[0].length;i++){
				var opt = document.createElement('option');
				opt.value = (data[0])[i].id_evento;
				opt.innerHTML = (data[0])[i].nombre;
				select.appendChild(opt);
			}
			document.getElementById('from').min = data.inicio;
			document.getElementById('from').max = data.fin;
			document.getElementById('to').min = data.inicio;
			document.getElementById('to').max = data.fin;
		}
	});
</script>