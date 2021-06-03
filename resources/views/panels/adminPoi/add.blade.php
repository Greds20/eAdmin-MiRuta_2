<form method="POST" action="{{ route('poiCrud.store') }}" enctype="multipart/form-data">
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
			<img id="review" height="100%" width="100%">
		</div>
	</div>
	<div class="rowsForm">
		<h3>Municipio</h3>
		<select name="town" class="select" id="town" required="">
		</select>
	</div>
	<div class="rowsForm">
		<h3>Costo de entrada</h3>
		<input type="text" class="inputSimple" name="cost" placeholder="0 a 999999 pesos" required="" maxlength="6" autocomplete="off" value="0" value="{{ old('cost') }}">
	</div>
	<div class="monoDivSep">
		<h3>Coordenadas (decimales)</h3>
	</div>
	<div class="rowsForm">
		<input type="text" class="inputSimple" name="cx" maxlength="9" placeholder="Longitud" required="" id="cx" autocomplete="off" value="{{ old('cx') }}">
	</div>
	<div class="divInputxButton rowsForm">
		<input type="text" class="inputSimple elementRM" name="cy" maxlength="9" placeholder="Latitud" required="" id="cy" autocomplete="off" value="{{ old('cy') }}">
		<a href="#" class="buttonBlue" id="btnShowSetCoord"><img src="{{ asset("img/icons/cordsIcon.png") }}"></a>
	</div>
	
	<div class="monoDiv">
		<h3>Descripción</h3>
		<textarea class="textarea" name="description" required="" maxlength="100" style="height: 100px;" id="description">{{ old('description') }}</textarea>
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>