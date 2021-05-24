<script type="text/javascript">
	function addRowSF(){
		var tbody = document.getElementById('subfactorReg');
		var nextRow = tbody.getElementsByTagName("tr").length;
		var newRow = document.createElement('tr');

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.autocomplete = "off";
		field.maxLength = 30;
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.autocomplete = "off";
		field.maxLength = 70;
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.autocomplete = "off";
		field.required = "true";
		field.maxLength = 2;
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.autocomplete = "off";
		field.maxLength = 2;
		$(field).keyup(function() {
			listenerSum();
	    });
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var field = document.createElement('input');
		field.type = "text";
		field.autocomplete = "off";
		field.maxLength = 2;
		$(field).keyup(function() {
			listenerSum();
	    });
		newCell.appendChild(field);
		newRow.appendChild(newCell);

		var newCell = document.createElement('th');
		var checkbox = document.createElement('input');
		checkbox.type = "checkbox";
		checkbox.disabled = true;
		checkbox.checked = true;
		newCell.appendChild(checkbox);
		$(checkbox).click(function(){
			listenerSum();
	    });
		newRow.appendChild(newCell);

		tbody.appendChild(newRow);
	}

	function removeRowSF() {
		var tbody = document.getElementById('subfactorReg');
		var lastRow = (tbody.getElementsByTagName("tr").length)-1;
		if(($('#nSFactorGet').val())<=lastRow){
			(tbody.getElementsByTagName("tr"))[lastRow].remove();
		}
	}
</script>