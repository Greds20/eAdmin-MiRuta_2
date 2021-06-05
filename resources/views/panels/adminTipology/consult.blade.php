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
			<h3>Descripción</h3>
			<textarea class="textarea" style="height: 100px;" id="description" readonly=""></textarea>
		</div>
	</div>
	<div class="dosColumnasR">
		<div class="monoDiv">
			<h3>Nombre</h3>
			<input type="text" class="inputSimple" placeholder="Ingrese el nombre de la tipología" id="searchName" autocomplete="off">
		</div>
		<div class="divScrollAll" style="height: 236px;">
			<ul class="encontrados" id="listado"></ul>
		</div>
	</div>
	<div class="monoDiv">
    	<input type="checkbox" id="showAll" onclick="fillNullTipList();"><h2>Mostrar todos</h2>
    </div>
</form>