<form method="POST" action="{{ route('tipologia.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="monoDiv">
		<h3>Nombre</h3>
		<input type="text" class="inputSimple" name="name" placeholder="Ingresar nombre de la tipología" required="" maxlength="30" autocomplete="off" value="{{ old('name') }}">
	</div>
	<div class="monoDiv">
		<h3>Descripción</h3>
		<textarea class="textarea" name="description" required="" maxlength="70" style="height: 100px;" id="description">{{ old('description') }}</textarea>
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>