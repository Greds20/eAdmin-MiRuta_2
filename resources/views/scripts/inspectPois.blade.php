<script type="text/javascript">
    $.ajax({
		url: "{{route('inspectPvF.inspectPoivFactor')}}",
		type: 'GET',
		success: function(data){
			if(data == 1){
				$("#numWarnings").text("Existen PoI-Factores no emparejados.");
				$("#warning").show();
			}
		}
	});
</script>