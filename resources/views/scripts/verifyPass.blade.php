<script type="text/javascript">
	var passInput = document.getElementById("pass");
	var passRInput = document.getElementById("passR");

	$(passRInput).keyup(function() {
		if(passRInput.value != passInput.value){
			passInput.style.border = "none";
			passRInput.style.border = "1px solid #F73838";
		}else{
			passInput.style.border = "1px solid #49AF41";
			passRInput.style.border = "1px solid #49AF41";
		}
	});
</script>