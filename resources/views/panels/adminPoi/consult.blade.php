<form>
	<div class="dosColumnasL">
		<div class="monoDiv">
			<h3>Nombre</h3>
			<input type="text" class="inputSimple" id="name" readonly="">
		</div>
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
				<img id="review" height= "100%" width= "100%">
			</div>
		</div>
		<div class="monoDiv">
			<h3>Municipio</h3>
			<input type="text" class="inputSimple" id="town" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Costo de entrada</h3>
			<input type="text" class="inputSimple" id="cost" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Tiempo de estancia</h3>
			<input type="text" class="inputSimple" id="time" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Coordenadas (decimales)</h3>
			<input type="text" class="inputSimple elementBM" id="cx" readonly="">
			<input type="text" class="inputSimple" id="cy" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Descripción</h3>
			<textarea class="textarea" height="100px" id="description" readonly=""></textarea>
		</div>
	</div>
	<div class="dosColumnasR">
		<div class="monoDiv">
			<h3>Buscar punto de interés</h3>
			<input type="text" class="inputSimple" placeholder="Ingrese el nombre del punto de interés" id="searchName" autocomplete="off">
		</div>
		<div class="divScrollAll" style="height: 1079px;">
			<ul class="encontrados listScrollAll" id="listadoPois"></ul>
		</div>
	</div>
	<div class="monoDiv">
    	<input type="checkbox" id="showAll" onclick="fillList();"><h2>Mostrar todos</h2>
    </div>
</form>