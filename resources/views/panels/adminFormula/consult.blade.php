<form>
	<div class="rowsForm">
		<div class="monoDiv">
			<h3>Nombre fórmula</h3>
			<div class="divInputxButton">
				<input type="text" id="nameForm" readonly="" style="width: 93%;">
				<a href="#" onclick="showPanel('#itemShowPanel')"><img src="{{ asset("img/icons/searchIcon.png") }}"></a>
			</div>
		</div>
		<div class="monoDiv">
			<h3>Estado</h3>
			<div class="divCheckSpan"><input type="checkbox" id="stateForm" disabled="">&nbsp;<span id="stateText">Inactivo</span></div>
		</div>
	</div>
	<div class="rowsForm">
		<h3>Descripción</h3>
		<textarea class="textarea" style="height: 136px;" id="descForm" readonly=""></textarea>
	</div>
	<div class="monoDiv">
		<h3>Fórmula</h3>
		<textarea class="textarea" style="height: 60px;" id="form" readonly=""></textarea>
	</div>
	<div class="monoDiv"><h3>Factores</h3></div>
	<div class="monoDiv">
		<table id="factorTabla" cellspacing="0" cellpadding="0" class="tableStyle">
			<thead class="theadStyle">
			    <tr>
			      <th>Factor</th>
			      <th>Descripción</th>
			      <th>Valor min.</th>
			      <th>Valor max.</th>
			      <th>Peso</th>
			    </tr>
			</thead>
	      	<tbody class="tbodyStyle" id="factorReg">
	      	</tbody>
	    </table>
    </div>
    <div class="monoDiv"><h3>Variables</h3></div>
	<div class="monoDiv">
		<table id="variableTabla" cellspacing="0" cellpadding="0" class="tableStyle">
			<thead class="theadStyle">
			    <tr>
			      <th>Variable</th>
			      <th>Descripción</th>
			      <th>Valor máx.</th>
			    </tr>
			</thead>
	      	<tbody class="tbodyStyle" id="variableReg">
	      	</tbody>
	    </table>
    </div>
    <div class="monoDiv"><h3>Subfactores</h3></div>
	<div class="monoDiv">
		<table id="subfactorTabla" cellspacing="0" cellpadding="0" class="tableStyle">
			<thead class="theadStyle">
			    <tr>
			      <th>Variable</th>
			      <th>Subactor</th>
			      <th>Descripción</th>
			      <th>Valor min.</th>
			      <th>Valor max.</th>
			      <th>Peso</th>
			    </tr>
			</thead>
	      	<tbody class="tbodyStyle" id="subfactorReg">
	      	</tbody>
	    </table>
    </div>
</form>