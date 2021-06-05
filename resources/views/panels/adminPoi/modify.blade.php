<form method="POST" action="{{ route('poiCrud.update') }}" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="id" id="id" required="" maxlength="3">
	<div class="rowsForm">
		<h3>Nombre</h3>
		<div class="divInputxButton">
			<input type="text" name="name" placeholder="Ingresar nombre del PoI" required="" maxlength="30" width="100%" id="name" autocomplete="off" class="inputSimple elementRM">
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
			<img id="review" height="100%" width="100%">
		</div>
	</div>
	<div class="monoDiv">
		<h3>Municipio</h3>
		<select name="town" class="select" id="town" required="">
		</select>
	</div>
	<div class="rowsForm">
		<h3>Costo de entrada</h3>
		<input type="text" class="inputSimple" id="cost" name="cost" placeholder="0 a 999999 pesos" required="" maxlength="6" autocomplete="off">
	</div>
	<div class="rowsForm">
		<h3>Tiempo de estancia</h3>
		<input type="text" class="inputSimple" name="time" placeholder="0 a 720 minutos" required="" maxlength="3" id="time" autocomplete="off">
	</div>
	<div class="rowsForm">
		<h3>Coordenadas (decimales)</h3>
		<div class="div2InputxButton">
			<div style="width: 88%;" class="elementRM">
				<input type="text" class="inputSimple elementBM" id="cx" name="cx" maxlength="9" placeholder="Longitud" required="" autocomplete="off">
				<input type="text" class="inputSimple" id="cy" name="cy" maxlength="9" placeholder="Latitud" required="" autocomplete="off">
			</div>
			<div style="width: 12%">
				<a href="#" class="buttonBlue" id="btnShowSetCoord"><img src="{{ asset("img/icons/cordsIcon.png") }}" ></a>
			</div>
		</div>
	</div>
	<div class="rowsForm">
		<h3>Descripción</h3>
		<textarea class="textarea" name="description" required="" maxlength="100" style="height: 86px;" id="description"></textarea>
	</div>
	<input type="checkbox" id="showAll" hidden="" checked="">
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>