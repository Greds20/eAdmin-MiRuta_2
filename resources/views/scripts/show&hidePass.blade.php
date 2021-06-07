<script type="text/javascript">
	var passInput = document.getElementById("pass");
	var showP = document.getElementById("showP");
	var hideP = document.getElementById("hideP");
	var passRInput = document.getElementById("passR");
	var showPR = document.getElementById("showPR");
	var hidePR = document.getElementById("hidePR");

	showP.onclick = function(){
		passInput.setAttribute("type","text");
		showP.style.display = "none";
		hideP.style.display = "block";
	}

	hideP.onclick = function(){
		passInput.setAttribute("type","password");
		hideP.style.display = "none";
		showP.style.display = "block";
	}

	showPR.onclick = function(){
		passRInput.setAttribute("type","text");
		showPR.style.display = "none";
		hidePR.style.display = "block";
	}

	hidePR.onclick = function(){
		passRInput.setAttribute("type","password");
		hidePR.style.display = "none";
		showPR.style.display = "block";
	}
</script>