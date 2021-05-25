<form method="POST" action="{{ route('poiFactorCrud.update') }}" enctype="multipart/form-data">
	@csrf
	<input type="text" hidden="" name="id" id="id">
	<div class="monoDiv">
		<h3>Nombre</h3>
		<div class="divInputxButton">
			<input type="hidden" id="idpoi" name="idpoi" required="">
			<input type="text" id="name" style="width: 95%;" disabled="">
			<a href="#" onclick="showPanel('#searchPanel')"><img src="{{ asset("img/icons/searchIcon.png") }}"></a>
		</div>
	</div>
	<div id="itemDivList" class="twoColOneRow">
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>