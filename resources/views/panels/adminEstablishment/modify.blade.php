<form method="POST" action="{{ route('establecimiento.update') }}" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="id" id="id" required="" maxlength="2">
	<div class="rowsForm">
		<h3>Nombre</h3>
		<div class="divInputxButton">
			<input type="text" name="name" placeholder="Ingresar nombre del establecimiento" required="" maxlength="30" id="name" width="100%" autocomplete="off" class="inputSimple elementRM">
			<a href="#" onclick="showPanel('#searchPanel')"><img src="{{ asset("img/icons/searchIcon.png") }}"></a>
		</div>
	</div>
	<div class="rowsForm">
		<h3>Estado</h3>
		<div class="divCheckSpan"><input type="checkbox" id="stateV">&nbsp;<span id="stateText">Inactivo</span></div>
		<input type="hidden" name="state" id="state" required="" maxlength="1">
	</div>
	<div class="rowsForm">
		<h3>Tipo</h3>
		<select name="type" class="select" id="type" required="">
		</select>
	</div>
	<div class="rowsForm">
		<h3>Municipio</h3>
		<select name="town" class="select" id="town" required="">
		</select>
	</div>
	<div class="monoDivSep">
		<h3>Coordenadas (decimales)</h3>
	</div>
	<div class="rowsForm">
		<input type="text" class="inputSimple" name="cx" id="cx" maxlength="9" placeholder="Longitud" required="" autocomplete="off">
	</div>
	<div class="divInputxButton rowsForm">
		<input type="text" class="inputSimple elementRM" name="cy" id="cy" maxlength="9" placeholder="Latitud" required="" autocomplete="off">
		<a href="#" class="buttonBlue" id="btnShowSetCoord"><img src="{{ asset("img/icons/cordsIcon.png") }}"></a>
	</div>
	<div class="monoDiv">
		<h3>Descripción</h3>
		<textarea class="textarea" name="description" required="" maxlength="100" style="height: 100px;" id="description"></textarea>
	</div>
	<input type="checkbox" id="showAll" hidden="" checked="">
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>