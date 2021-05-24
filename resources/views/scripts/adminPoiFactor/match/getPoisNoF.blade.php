<script type="text/javascript">
    $.ajax({
		url: "{{route('poiFactorDynamic.getPoisNoF')}}",
		type: 'GET',
		success: function(data){
			var ul = document.getElementById("listadoPois");
			ul.innerHTML = '';
			for(var i=0; i<data.length;i++){
				var li = document.createElement("li");
			    li.appendChild(document.createTextNode(data[i].nombre));
			    li.setAttribute("id", data[i].poi);
			    ul.appendChild(li);
			}
			selectedPoi();
		}
	});
</script>