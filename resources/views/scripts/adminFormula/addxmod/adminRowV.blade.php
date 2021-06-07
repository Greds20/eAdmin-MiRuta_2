<script type="text/javascript">
	function addRowV(){
		var $tbody = document.getElementById('variableReg');
		var nextRow = $tbody.getElementsByTagName("tr").length;
		var newRow = document.createElement('tr');

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.name = "nameV[]";
		field.autocomplete = "off";
		field.required = "true";
		field.maxLength = 30;
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.required = "true";
		field.name = "descriptionV[]";
		field.autocomplete = "off";
		field.maxLength = 70;
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.name = "vmaxV[]";
		field.autocomplete = "off";
		field.required = "true";
		field.maxLength = 2;
		$(field).keyup(function() {
			listenerProm();
	    });
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var a = document.createElement('a');
		a.href = "#";
		a.classList.add('linkInTable');
			var img = document.createElement('img');
			img.src = "{{ asset("img/icons/modVarIcon.png") }}";
			a.appendChild(img);
		var pos = document.createElement('input');
		pos.type = "hidden";
		pos.value = nextRow;
			$(a).click(function() {
				var pos = $(this).next();
				fillTSF(pos[0].value);
				showPanel("#subFactorPanel");
		    });
		newCell.appendChild(a);
		newCell.appendChild(pos);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var checkboxV = document.createElement('input');
		checkboxV.type = "checkbox";
		checkboxV.checked = true;
		checkboxV.disabled = true;
			var checkbox = document.createElement('input');
			checkbox.type = "hidden";
			checkbox.name = "stateV[]";
			checkbox.value = "1";
			checkbox.id = "v"+nextRow;
		checkboxV.value = "v"+nextRow;
		newCell.appendChild(checkboxV);
			newCell.appendChild(checkbox);
		$(checkboxV).click(function() {
			document.getElementById($(this).val()).value = ($(this).is(":checked")) ? "1" : "0";
			listenerProm();
	    });
		newRow.appendChild(newCell);

		var input = document.createElement('input');
		input.type = "hidden";
		input.id = "nSfactorReg";
		input.value = 0;
		newRow.appendChild(input);

		var input = document.createElement('input');
		input.type = "hidden";
		input.name = "nSfactor[]";
		input.required = "true";
		input.value = 0;
		newRow.appendChild(input);

		$tbody.appendChild(newRow);
	}

	function removeRowV(){
		var tbody = document.getElementById('variableReg');
		var lastRow = (tbody.getElementsByTagName("tr").length)-1;
		if(($('#nVariableGet').val())<=lastRow){
			(tbody.getElementsByTagName("tr"))[lastRow].remove();
		}
	}
</script>