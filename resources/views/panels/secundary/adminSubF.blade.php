<div class="panelSecundario" id="subFactorPanel" hidden="" style="z-index: 3;">
	<div class="panelSecInterior" style="width: 1000px;">
		<input type="hidden" id="vSelect">
		<input type="hidden" id="nSFactorGet">
		<div class="divRowUnico" style="width: 100%;">
			<h3 id="sfName">Subfactores</h3>
		</div>
		<div class="monoDiv monoDiv_between">
			<div class="textH2Row"><h2>Sumatoria subfactores:&nbsp;</h2><h2 id="sumText"></h2></div>
			<ul class="addxDelet"><li><a href="#" onclick="addRowSF()"><img src="{{ asset("img/icons/addIcon.png") }}"></a></li>
				<li><a href="#" onclick="removeRowSF()"><img src="{{ asset("img/icons/removeIcon.png") }}"></a></li>
			</ul>
		</div>
		<div class="monoDiv tableScroll">
			<table id="subfactorTabla" cellspacing="0" cellpadding="0" class="tableStyle" style="margin-bottom: 0px">
				<thead class="theadStyle">
				    <tr>
				      <th>Subfactor</th>
				      <th>Descripción</th>
				      <th>Valor min.</th>
				      <th>Valor máx.</th>
				      <th>Peso</th>
				      <th>Estado</th>
				    </tr>
				</thead>
		      	<tbody class="tbodyStyle" id="subfactorReg">
		      	</tbody>
		    </table>
	    </div>
		<div class="monoDiv div2BottomForm">
			<a href="#" class="secundaryButton" onclick="saveSF(); hidePanel('#subFactorPanel')" style="margin-right: 20px;">Guardar cambios</a>
			<a href="#" class="atrasButton" onclick="hidePanel('#subFactorPanel')">Atras</a>
		</div>
	</div>
</div>