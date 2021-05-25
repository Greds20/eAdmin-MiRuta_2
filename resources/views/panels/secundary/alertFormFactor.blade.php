<div class="panelSecundario" id="alertFormFactor" hidden="" style="z-index: 4;">
	<div class="panelSecInterior">
		<div class="divRowUnico">
			<h3>¡Alerta!</h3>
		</div>
		<div class="divRowUnico">
			<div class="divSecScrollErrors">
				@if($errors->any())
				<script type="text/javascript">showPanel('#alertFormFactor');</script>
					<ul class="encontrados" >
			            @foreach($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
		        	</ul>
				@else
					@isset($errores)
					<script type="text/javascript">showPanel('#alertFormFactor');</script>
						<ul class="encontrados">
							@foreach($errores as $error)
						        <li>{{ $error }}</li>
							@endforeach
						</ul>
					@endif
				@endif
			</div>
		</div>
		<div class="monoDiv divBottomForm">
			<a href="#" class="atrasButton" onclick="hidePanel('#alertFormFactor')">Atras</a>
		</div>
	</div>
</div>