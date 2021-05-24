<script type="text/javascript">
	function addRowF(){
		var tbody = document.getElementById('factorReg');
		var nextRow = tbody.getElementsByTagName("tr").length;
		var newRow = document.createElement('tr');

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.name = "nameF[]";
		field.autocomplete = "off";
		field.required = "true";
		field.maxLength = 30;
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.required = "true";
		field.name = "descriptionF[]";
		field.autocomplete = "off";
		field.maxLength = 70;
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.required = "true";
		field.name = "vminF[]";
		field.autocomplete = "off";
		field.maxLength = 2;
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.name = "vmaxF[]";
		field.autocomplete = "off";
		field.required = "true";
		field.maxLength = 2;
		$(field).keyup(function() {
			listenerProm();
	    });
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.name = "weightF[]";
		field.required = "true";
		field.autocomplete = "off";
		field.maxLength = 2;
		$(field).keyup(function() {
			listenerProm();
	    });
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var checkboxV = document.createElement('input');
		checkboxV.type = "checkbox";
		checkboxV.checked = true;
		checkboxV.disabled = true;
			var checkbox = document.createElement('input');
			checkbox.type = "hidden";
			checkbox.name = "stateF[]";
			checkbox.value = true;
			checkbox.id = "f"+nextRow;
		checkboxV.value = "f"+nextRow;
		newCell.appendChild(checkboxV);
			newCell.appendChild(checkbox);
		$(checkboxV).click(function() {
			document.getElementById($(this).val()).value = $(this).is(":checked");
			listenerProm();
	    });
		newRow.appendChild(newCell);

		tbody.appendChild(newRow);
	}

	function removeRowF() {
		var tbody = document.getElementById('factorReg');
		var lastRow = (tbody.getElementsByTagName("tr").length)-1;
		if(($('#nFactorGet').val())<=lastRow){
			(tbody.getElementsByTagName("tr"))[lastRow].remove();
		}
	}
</script>