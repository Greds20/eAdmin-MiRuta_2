<script type="text/javascript">
	$('#searchName').on('keyup', function () {
	    var term = $('#searchName').val();
		$.ajax({
			url: "{{route('poiDynamic.searchPoi')}}",
			data: {
				term: term
			},
			success: function(data){
				var ul = document.getElementById("listadoPois");
				ul.innerHTML = '';
				for(var i=0; i<data.length;i++){
					var li = document.createElement("li");
				    li.appendChild(document.createTextNode(data[i].label));
				    li.setAttribute("id", data[i].id);
				    ul.appendChild(li);
				}
				selectedPoi();
			}
		});
	});
</script>