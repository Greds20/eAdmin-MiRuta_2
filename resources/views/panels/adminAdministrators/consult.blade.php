<form>
	<div class="monoDiv">
		<h3>Alias</h3>
		<input type="text" class="inputSimple" placeholder="Ingresar alias o nombre de usuario" id="searchName" autocomplete="off">
	</div>
	<div class="dosColumnas">
		<div class="monoDiv">
			<h3>Estado</h3>
			<div class="divCheckSpan"><input type="checkbox" id="state" disabled="">&nbsp;<span id="stateText">Inactivo</span></div>
		</div>
		<div class="monoDiv">
			<h3>Rol</h3>
			<input type="text" class="inputSimple" id="rol" disabled="">
		</div>
		<div class="monoDiv">
			<h3>Nombre completo</h3>
			<textarea class="textarea" style="height: 60px;" id="name" disabled=""></textarea>
		</div>
		<div class="monoDiv">
			<h3>Correo eléctronico</h3>
			<textarea class="textarea" style="height: 60px;" id="email" disabled=""></textarea>
		</div>
	</div>
	<div class="dosColumnas">
		<div class="divScrollAll" style="height: 412px;">
			<ul class="encontrados" id="listadoUsers"></ul>
		</div>
	</div>
	<div class="monoDiv">
    	<input type="checkbox" id="showAll" onclick="fillNullUserList();"><h2>Mostrar todos</h2>
    </div>
</form>