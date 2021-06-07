<form method="POST" action="{{ route('formulaCrud.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="rowsForm">
		<h3>Fórmula</h3>
		<input type="text" id="nameForm" name="nameForm" class="inputSimple" maxlength="20" required="" autocomplete="off">
	</div>
	<div class="rowsForm">
		<h3>Descripción</h3>
		<textarea class="textarea" name="descForm" required="" maxlength="70" style="height: 76px;" id="descForm"></textarea>
	</div>
	<div class="monoDiv">
		<div class="textH2Row"><h2>Sumatoria:&nbsp;</h2><h2 id="porcText"></h2><h2>%</h2></div>
	</div>
    <input type="hidden" id="nFactorGet" value="0">
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
	      		<tr>
			      <th><input type="text" name="nameF[]" autocomplete="off" required="" maxlength="30" value="Patrimonio nacional"></th>
			      <th><input type="text" name="descriptionF[]" autocomplete="off" required="" maxlength="70" value="Caracteristica puesta por una organización"></th>
			      <th><input type="text" name="vminF[]" autocomplete="off" required="" maxlength="2" value="0"></th>
			      <th><input type="text" name="vmaxF[]" autocomplete="off" required="" maxlength="2" value="1" onkeyup="listenerProm();"></th>
			      <th><input type="text" name="weightF[]" autocomplete="off" required="" maxlength="30" value="30" onkeyup="listenerProm();"></th>
			      <th><input type="checkbox" checked="true" disabled=""></th>
			    </tr>
	      		<tr>
			      <th><input type="text" name="nameF[]" autocomplete="off" required="" maxlength="30" value="Highligth"></th>
			      <th><input type="text" name="descriptionF[]" autocomplete="off" required="" maxlength="70" value="Calidad del PoI"></th>
			      <th><input type="text" name="vminF[]" autocomplete="off" required="" maxlength="2" value="1"></th>
			      <th><input type="text" name="vmaxF[]" autocomplete="off" required="" maxlength="2" value="5" onkeyup="listenerProm();"></th>
			      <th><input type="text" name="weightF[]" autocomplete="off" required="" maxlength="30" value="4" onkeyup="listenerProm();"></th>
			      <th><input type="checkbox" checked="true" disabled=""></th>
			    </tr>
	      	</tbody>
	    </table>
    </div>
    <input type="hidden" id="nVariableGet" value="0">
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
	      		<tr>
			      <th><input type="text" name="nameV[]" autocomplete="off" required="" maxlength="30" value="NTPxX"></th>
			      <th><input type="text" name="descriptionV[]" autocomplete="off" required="" maxlength="70" value="Multiplica tipologias de un poi por factores seleccionados"></th>
			      <th><input type="text" name="vmaxV[]" autocomplete="off" required="" maxlength="2" value="50" onkeyup="listenerProm();"></th>
			      <th>
			      	<a href="#" onclick="var pos = $(this).next(); fillTSF(pos[0].value); showPanel('#subFactorPanel');" class="linkInTable"><img src="{{ asset("img/icons/modVarIcon.png") }}" ></a>
			      	<input type="hidden" value="0">
			      </th>
			      <th>
			      	<input type="checkbox" value="v0" checked="true" disabled="">
			      	<input type="hidden" name="stateV[]" value="true" id="v0">
			      </th>
			      <input type="hidden" id="nSfactorReg" value="1">
			      <input type="hidden" name="nSfactor[]" required="" value="1">
			    </tr>
	      	</tbody>
	    </table>
    </div>
    <div class="monoDiv divBottomForm">
    	<button class="formAddPoiBtn" type="submit">Guardar</button>
    </div>
</form>