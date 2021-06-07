<form>
	<div class="dosColumnasL">
		<div class="monoDiv">
			<h3>Log</h3>
			<textarea class="textarea" style="height: 427px;" id="log" readonly=""></textarea>
		</div>
		<div class="monoDiv monoDivButton">
			<a href="#" id="downloadLog" onclick="downloadLog()" class="downloadButton" download="log.txt"><img src="{{ asset("img/icons/downloadIcon.png") }}"></a>
		</div>
	</div>
	<div class="dosColumnasR">
		<div class="monoDiv">
			<h3>Alias</h3>
			<div class="divInputxButton">
				<input type="text" id="name" class="inputSimple elementRM" readonly="" autocomplete="off" width="100%">
				<a href="#" onclick="showPanel('#searchPanel')"><img src="{{ asset("img/icons/searchIcon.png") }}"></a>
			</div>
		</div>
		<div class="monoDiv">
			<h3>Sección</h3>
			<select class="select" id="section"></select>
		</div>
		<div class="monoDiv">
			<h3>Evento</h3>
			<select class="select" id="event"></select>
		</div>
		<div class="monoDiv">
			<h3>Desde</h3>
			<input type="date" id="from" class="dateStyle">
		</div>
		<div class="monoDiv">
			<h3>Hasta</h3>
			<input type="date" id="to" class="dateStyle">
		</div>
		<div class="monoDiv divBottomForm">
			<a class="AButtonwText" href="#" onclick="consultLog()">Consultar</a>
		</div>
	</div>
</form>