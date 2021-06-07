<form>
	<div class="dosColumnasL">
		<div class="monoDiv">
			<h3>Alias</h3>
			<input type="text" class="inputSimple" id="alias" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Estado</h3>
			<div class="divCheckSpan"><input type="checkbox" id="state" disabled="">&nbsp;<span id="stateText">Inactivo</span></div>
		</div>
		<div class="monoDiv">
			<h3>Rol</h3>
			<input type="text" class="inputSimple" id="rol" readonly="">
		</div>
		<div class="monoDiv">
			<h3>Nombre completo</h3>
			<textarea class="textarea" style="height: 60px;" id="name" readonly=""></textarea>
		</div>
		<div class="monoDiv">
			<h3>Correo eléctronico</h3>
			<textarea class="textarea" style="height: 60px;" id="email" readonly=""></textarea>
		</div>
	</div>
	<div class="dosColumnasR">
		<div class="monoDiv">
			<h3>Buscar alias</h3>
			<input type="text" class="inputSimple" placeholder="Ingrese alias del administrador" id="searchName" autocomplete="off">
		</div>
		<div class="divScrollAll" style="height: 412px;">
			<ul class="encontrados" id="listadoUsers"></ul>
		</div>
	</div>
	<div class="monoDiv">
    	<input type="checkbox" id="showAll" onclick="fillNullUserList();"><h2>Mostrar todos</h2>
    </div>
</form>