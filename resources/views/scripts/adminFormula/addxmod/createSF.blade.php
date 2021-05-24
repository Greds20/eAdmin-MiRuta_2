<script type="text/javascript">
	function createSF(pos){
		var div = document.createElement('div');

			var field = document.createElement('input');
			field.type = "hidden";
			field.name = "idSF[]";
			field.required = "true";
			field.value	= 0;
			div.appendChild(field);

			var field = document.createElement('input');
			field.type = "hidden";
			field.name = "nameSF[]";
			field.required = "true";
			div.appendChild(field);

			var field = document.createElement('input');
			field.type = "hidden";
			field.name = "descriptionSF[]";
			field.required = "true";
			div.appendChild(field);

			var field = document.createElement('input');
			field.type = "hidden";
			field.name = "vminSF[]";
			field.required = "true";
			div.appendChild(field);

			var field = document.createElement('input');
			field.type = "hidden";
			field.name = "vmaxSF[]";
			field.required = "true";
			div.appendChild(field);

			var field = document.createElement('input');
			field.type = "hidden";
			field.name = "weightSF[]";
			field.required = "true";
			div.appendChild(field);

			var field = document.createElement('input');
			field.type = "hidden";
			field.name = "stateSF[]";
			field.required = "true";
			div.appendChild(field);
		div.hidden = "true";

		var tbody = document.getElementById('variableReg');
		var rows = tbody.getElementsByTagName("tr");

		rows[pos].appendChild(div);
	}
</script>