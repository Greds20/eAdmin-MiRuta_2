<script type="text/javascript">
    $.ajax({
		url: "{{route('getGRecords.getMunicipio')}}",
		type: 'GET',
		success: function(data){
			move_TownsGet(data);
		}
	});		
</script>