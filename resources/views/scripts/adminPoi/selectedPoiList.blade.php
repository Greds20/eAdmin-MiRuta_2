<script type="text/javascript">
	function selectedPoi(){
		$("#listadoPois li").on("click", function () {
		    $("#listadoPois li").removeClass('itemSeleccionado');
		    $(this).attr('class', 'itemSeleccionado');
		    @if($section=="modificar")
		    	@include("scripts.adminPoi.selectedPoiList_Mod")
		    @else($section=="consultar")
		    	@include("scripts.adminPoi.selectedPoiList_Con")
		    @endif
		});
	}
</script>