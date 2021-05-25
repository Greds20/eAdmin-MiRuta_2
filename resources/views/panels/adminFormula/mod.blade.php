<form method="POST" action="{{ route('formulaCrud.update') }}" enctype="multipart/form-data">
	@csrf
	<div class="rowsForm">
		<div class="monoDiv">
			<h3>Fórmula</h3>
			<div class="divInputxButton">
				<input type="hidden" id="idform" name="idform" required="" maxlength="20" required="">
				<input type="text" id="nameForm" name="nameForm" style="width: 93%;" autocomplete="off">
				<a href="#" onclick="showPanel('#itemShowPanel')"><img src="{{ asset("img/icons/searchIcon.png") }}"></a>
			</div>
		</div>
		<div class="monoDiv">
			<h3>Estado</h3>
			<div class="divCheckSpan"><input type="checkbox" id="stateFormV">&nbsp;<span id="stateText">Inactivo</span></div>
			<input type="hidden" name="stateForm" id="stateForm" required="" maxlength="1">
		</div>
	</div>
	<div class="rowsForm">
		<h3>Descripción</h3>
		<textarea class="textarea" name="descForm" required="" maxlength="70" style="height: 136px;" id="descForm"></textarea>
	</div>
	<div class="monoDiv">
		<div class="textH2Row"><h2>Sumatoria:&nbsp;</h2><h2 id="porcText"></h2><h2>%</h2></div>
	</div>
    <input type="hidden" id="nFactorGet">
    <div class="monoDiv"><h3>Factores</h3></div>
    <div class="monoDiv monoDiv_right">
		<ul class="addxDelet"><li><a href="#" onclick="addRowF()"><img src="{{ asset("img/icons/addIcon.png") }}"></a></li>
			<li><a href="#" onclick="removeRowF()"><img src="{{ asset("img/icons/removeIcon.png") }}"></a></li>
		</ul>
	</div>
	<div class="monoDiv">
		<table id="factorTabla" cellspacing="0" cellpadding="0" class="tableStyle">
			<thead class="theadStyle">
			    <tr>
			      <th>Factor</th>
			      <th>Descripción</th>
			      <th>Valor min.</th>
			      <th>Valor máx.</th>
			      <th>Peso</th>
			      <th>Estado</th>
			    </tr>
			</thead>
	      	<tbody class="tbodyStyle" id="factorReg">
	      	</tbody>
	    </table>
    </div>
    <input type="hidden" id="nVariableGet">
	<div class="monoDiv"><h3>Variables</h3></div>
	<div class="monoDiv monoDiv_right">
		<ul class="addxDelet"><li><a href="#" onclick="addRowV()"><img src="{{ asset("img/icons/addIcon.png") }}"></a></li>
			<li><a href="#" onclick="removeRowV()"><img src="{{ asset("img/icons/removeIcon.png") }}"></a></li>
		</ul>
	</div>
	<div class="monoDiv">
		<table id="variableTabla" cellspacing="0" cellpadding="0" class="tableStyle">
			<thead class="theadStyle">
			    <tr>
			      <th>Variable</th>
			      <th>Descripción</th>
			      <th>Valor máx.</th>
			      <th>Subfactores</th>
			      <th>Estado</th>
			    </tr>
			</thead>
	      	<tbody class="tbodyStyle" id="variableReg">
	      	</tbody>
	    </table>
    </div>
    <div class="monoDiv">
    	<input type="checkbox" id="showAll" name="all"><h2>Mostrar todos</h2>
    </div>
    <div class="monoDiv divBottomForm">
    	<button class="formAddPoiBtn" type="submit">Guardar</button>
    </div>
</form>