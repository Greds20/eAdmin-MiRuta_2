<script type="text/javascript">
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
		field.value = "Estado de conservación";
		field.required = "true";
		div.appendChild(field);

		var field = document.createElement('input');
		field.type = "hidden";
		field.name = "descriptionSF[]";
		field.value = "Estado en el que se encuentra el PoI";
		field.required = "true";
		div.appendChild(field);

		var field = document.createElement('input');
		field.type = "hidden";
		field.name = "vminSF[]";
		field.value = "1";
		field.required = "true";
		div.appendChild(field);

		var field = document.createElement('input');
		field.type = "hidden";
		field.name = "vmaxSF[]";
		field.value = "3";
		field.required = "true";
		div.appendChild(field);

		var field = document.createElement('input');
		field.type = "hidden";
		field.name = "weightSF[]";
		field.value = "10";
		field.required = "true";
		div.appendChild(field);

		var field = document.createElement('input');
		field.type = "hidden";
		field.name = "stateSF[]";
		field.value = "1";
		field.required = "true";
		div.appendChild(field);
	div.hidden = "true";

	var tbody = document.getElementById('variableReg');
	var rows = tbody.getElementsByTagName("tr");

	rows[0].appendChild(div);
</script>