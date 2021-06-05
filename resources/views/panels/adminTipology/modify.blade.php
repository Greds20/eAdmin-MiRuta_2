<form method="POST" action="{{ route('tipologia.update') }}" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="id" id="id" required="" maxlength="2">
	<div class="rowsForm">
		<h3>Nombre</h3>
		<div class="divInputxButton">
			<input type="text" name="name" placeholder="Ingresar nombre del PoI" required="" maxlength="30" id="name" width="100%" autocomplete="off" class="inputSimple elementRM">
			<a href="#" onclick="showPanel('#searchPanel')"><img src="{{ asset("img/icons/searchIcon.png") }}"></a>
		</div>
	</div>
	<div class="rowsForm">
		<h3>Estado</h3>
		<div class="divCheckSpan"><input type="checkbox" id="stateV">&nbsp;<span id="stateText">Inactivo</span></div>
		<input type="hidden" name="state" id="state" required="" maxlength="1">
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