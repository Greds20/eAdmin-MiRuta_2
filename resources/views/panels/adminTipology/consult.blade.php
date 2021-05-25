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
			<h3>Descripción</h3>
			<textarea class="textarea" style="height: 100px;" id="description" readonly=""></textarea>
		</div>
	</div>
	<div class="dosColumnas">
		<div class="divScrollAll" style="height: 236px;">
			<ul class="encontrados" id="listadoPois"></ul>
		</div>
	</div>
	<div class="monoDiv">
    	<input type="checkbox" id="showAll" onclick="fillNullTipList();"><h2>Mostrar todos</h2>
    </div>
</form>