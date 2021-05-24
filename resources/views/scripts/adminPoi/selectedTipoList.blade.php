<script type="text/javascript">
	function selectedTipo(){
		$("#listadoTipo li").on("click", function () {
			if($(this).hasClass('itemSeleccionado')){
				$(this).removeClass('itemSeleccionado');
				$(this).find("[type='checkbox']").prop('checked', false);
			}else{
				$(this).attr('class', 'itemSeleccionado');
				$(this).find("input[type='checkbox']").prop('checked', true);
			}
		});
	}
</script>