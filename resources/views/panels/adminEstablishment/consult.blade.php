<form>
	<div class="dosColumnasL">
		<input type="hidden" id="id">
		<div class="monoDiv">
			<h3>Nombre</h3>
			<input type="text" class="inputSimple" id="name" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Estado</h3>
			<div class="divCheckSpan"><input type="checkbox" id="state" disabled="">&nbsp;<span id="stateText">Inactivo</span></div>
		</div>
		<div class="monoDiv">
			<h3>Coordenadas (decimales)</h3>
			<input type="text" class="inputSimple elementBM" id="cx" readonly="">
			<input type="text" class="inputSimple" id="cy" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Descripción</h3>
			<textarea class="textarea" style="height: 100px;" id="description" readonly=""></textarea>
		</div>
	</div>
	<div class="dosColumnasR">
		<div class="monoDiv">
			<h3>Nombre</h3>
			<input type="text" class="inputSimple" placeholder="Ingrese el nombre del establecimiento" id="searchName" autocomplete="off">
		</div>
		<div class="divScrollAll" style="height: 376px;">
			<ul class="encontrados" id="listadoPois"></ul>
		</div>
	</div>
	<div class="monoDiv">
    	<input type="checkbox" id="showAll" onclick="List_searchEstablishment();"><h2>Mostrar todos</h2>
    </div>
</form>