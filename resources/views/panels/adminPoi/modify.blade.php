<form method="POST" action="{{ route('poiCrud.update') }}" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="id" id="id" required="" maxlength="3">
	<div class="rowsForm">
		<h3>Nombre</h3>
		<div class="divInputxButton">
			<input type="text" name="name" placeholder="Ingresar nombre del PoI" required="" maxlength="30" id="name" style="width: 90%;" autocomplete="off">
			<a href="#" onclick="showPanel('#searchPanel')"><img src="{{ asset("img/icons/searchIcon.png") }}"></a>
		</div>
	</div>
	<div class="rowsForm">
		<h3>Estado</h3>
		<div class="divCheckSpan"><input type="checkbox" id="stateV">&nbsp;<span id="stateText">Inactivo</span></div>
		<input type="hidden" name="state" id="state" required="" maxlength="1">
	</div>
	<div class="rowsForm">
		<h3>Tipologías</h3>
		<div class="divSecScroll">
			<ul class="encontrados" id="listadoTipo"></ul>
		</div>
	</div>
	<div class="rowsForm">
		<h3>Imágen del PoI</h3>
		<input type="file" name="image" accept=".jpg,.png,.jpeg" class="inputFile" onchange="loadImage(event)" id="image">
		<div class="divReviewerImg">
			<img id="review" style="height: 100%; width: 100%">
		</div>
	</div>
	<div class="rowsForm">
		<h3>Municipio</h3>
		<select name="town" class="select" id="town" required="">
		</select>
	</div>
	<div class="rowsForm">
		<h3>Tiempo de estancia</h3>
		<input type="text" class="inputSimple" name="time" placeholder="0 a 720 minutos" required="" maxlength="3" id="time" autocomplete="off">
	</div>
	<div class="monoDivSep">
		<h3>Coordenadas (decimales)</h3>
	</div>
	<div class="rowsForm">
		<input type="text" class="inputSimple" name="cx" maxlength="9" placeholder="Longitud" required="" id="cx" autocomplete="off">
	</div>
	<div class="rowsForm">
		<input type="text" class="inputSimple" name="cy" maxlength="9" placeholder="Latitud" required="" id="cy" autocomplete="off">
	</div>
	<div class="monoDiv">
		<h3>Descripción</h3>
		<textarea class="textarea" name="description" required="" maxlength="100" style="height: 100px;" id="description"></textarea>
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>