<script type="text/javascript">
	function consultLog(){
		$.ajax({
			url: "{{route('logDynamic.consultLog')}}",
			data: {
				alias: $('#name').val(),
				seccion: $('#section').val(),
				evento: $('#event').val(),
				desde: $('#from').val(),
				hasta: $('#to').val()
			},
			success: function(data){
				var log = "";
				for (var i = 0; i < data.length; i++) {
					log += "["+data[i].fecha+" "+data[i].hora+"]{\r\nAlias: "+data[i].alias+"\r\nEvento: "+data[i].evento+"\r\nSeccion: "+data[i].seccion+" }\r\n";
				}
				document.getElementById('log').innerHTML = log;
			}
		});
	}
</script>