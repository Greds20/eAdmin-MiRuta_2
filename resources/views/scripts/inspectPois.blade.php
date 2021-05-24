<script type="text/javascript">
    $.ajax({
		url: "{{route('poiFactorDynamic.inspectPoi')}}",
		type: 'GET',
		success: function(data){
			if(data>0){
				$("#numWarnings").text(data+" advertencia/s.");
				$("#warning").show();
			}
		}
	});
</script>