<form method="POST" action="{{ route('establecimientoCrud.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="rowsForm">
		<h3>Nombre</h3>
		<input type="text" class="inputSimple" name="name" placeholder="Ingresar nombre del establecimiento" required="" maxlength="30" autocomplete="off" value="{{ old('name') }}">
	</div>
	<div class="rowsForm">
		<h3>Municipio</h3>
		<select name="town" class="select" id="town" required="">
		</select>
	</div>
	<div class="rowsForm">
		<h3>Descripción</h3>
		<textarea class="textarea" name="description" required="" maxlength="70" style="height: 86px;" id="description">{{ old('description') }}</textarea>
	</div>
	<div class="rowsForm">
		<h3>Coordenadas (decimales)</h3>
		<div class="div2InputxButton">
			<div style="width: 85%; margin-right: 10px;">
				<input type="text" class="inputSimple" id="cx" name="cx" maxlength="9" placeholder="Longitud" required="" style="margin-bottom: 10px;" autocomplete="off" value="{{ old('cx') }}">
				<input type="text" class="inputSimple" id="cy" name="cy" maxlength="9" placeholder="Latitud" required="" autocomplete="off" value="{{ old('cy') }}">
			</div>
			<div style="width: 15%">
				<a href="#" class="buttonBlue" id="btnShowSetCoord"><img src="{{ asset("img/icons/cordsIcon.png") }}"></a>
			</div>
		</div>
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>