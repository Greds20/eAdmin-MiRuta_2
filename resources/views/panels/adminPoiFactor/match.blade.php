<form method="POST" action="{{ route('poiFactorCrud.match') }}" enctype="multipart/form-data">
	@csrf
	<div class="monoDiv">
		<h3>Nombre</h3>
		<input type="hidden" id="idpoi" name="idpoi" required="">
		<input type="text" class="inputSimple" id="name" disabled="">
	</div>
	<div class="dosColumnas">
		<div class="scrollFacPoi scrollFacPoih1" id="factorOfSPoi">
			<h1>PoI no seleccionado</h1>
		</div>
	</div>
	<div class="dosColumnas">
		<div class="divScrollAll">
			<ul class="encontrados" id="listadoPois"></ul>
		</div>
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>