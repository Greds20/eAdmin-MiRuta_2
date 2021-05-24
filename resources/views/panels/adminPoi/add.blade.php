<form method="POST" action="{{ route('adminPoi.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="rowsForm">
		<h3>Nombre</h3>
		<input type="text" class="inputSimple" name="name" placeholder="Ingresar nombre del PoI" required="" maxlength="30" autocomplete="off" value="{{ old('name') }}">
	</div>
	<div class="rowsForm">
		<h3>Tiempo de estancia</h3>
		<input type="text" class="inputSimple" name="time" placeholder="0 a 250 minutos" required="" maxlength="3" autocomplete="off" value="{{ old('time') }}">
	</div>
	<div class="rowsForm">
		<h3>Tipologías</h3>
		<div class="divSecScroll">
			<ul class="encontrados" id="listadoTipo">  
			</ul>
		</div>
	</div>
	<div class="rowsForm">
		<h3>Imágen del PoI</h3>
		<input type="file" name="image" accept=".jpg,.png,.jpeg" class="inputFile" onchange="loadImage(event)" required="">
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
		<h3>Coordenadas (decimales)</h3>
		<div class="div2InputxButton">
			<div style="width: 85%; margin-right: 10px;">
				<input type="text" class="inputSimple" name="cx" maxlength="9" placeholder="Longitud" required="" style="margin-bottom: 10px;" autocomplete="off" value="{{ old('cx') }}">
				<input type="text" class="inputSimple" name="cy" maxlength="9" placeholder="Latitud" required="" autocomplete="off" value="{{ old('cy') }}">
			</div>
			<div style="width: 15%">
				<a href="#" onclick="" class="buttonBlue"><img src="{{ asset("img/icons/cordsIcon.png") }}"></a>
			</div>
		</div>
	</div>
	
	<div class="monoDiv">
		<h3>Descripción</h3>
		<textarea class="textarea" name="description" required="" maxlength="100" style="height: 100px;" id="description">{{ old('description') }}</textarea>
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>