<form>
	<div class="monoDiv">
		<h3>Nombre</h3>
		<input type="text" class="inputSimple" placeholder="Ingresar nombre del PoI" id="searchName" autocomplete="off">
	</div>
	<div class="dosColumnas">
		<div class="monoDiv">
			<h3>Estado</h3>
			<div class="divCheckSpan"><input type="checkbox" id="state" disabled="">&nbsp;<span id="stateText">Inactivo</span></div>
		</div>
		<div class="monoDiv">
			<h3>Tipologías</h3>
			<div class="divScroll">
				<ul class="encontrados" id="listadoTipo"></ul>
			</div>
		</div>
		<div class="monoDiv">
			<h3>Imágen del PoI</h3>
			<div class="divReviewerImg">
				<img id="review" style="height: 100%; width: 100%">
			</div>
		</div>
		<div class="monoDiv">
			<h3>Municipio</h3>
			<input type="text" class="inputSimple" id="town" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Tiempo de estancia</h3>
			<input type="text" class="inputSimple" id="time" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Coordenadas (decimales)</h3>
			<input type="text" class="inputSimple" id="cx" style="margin-bottom: 10px;" readonly="">
			<input type="text" class="inputSimple" id="cy" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Descripción</h3>
			<textarea class="textarea" style="height: 100px;" id="description" readonly=""></textarea>
		</div>
	</div>
	<div class="dosColumnas">
		<div class="divScrollAll">
			<ul class="encontrados" id="listadoPois"></ul>
		</div>
	</div>
	<div class="monoDiv">
    	<input type="checkbox" id="showAll" onclick="fillList();"><h2>Mostrar todos</h2>
    </div>
</form>