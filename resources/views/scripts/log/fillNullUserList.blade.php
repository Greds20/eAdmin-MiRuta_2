<script type="text/javascript">
	function fillNullUserList(){
		var term = $('#searchName').val();
		$.ajax({
			url: "{{route('logDynamic.searchUser')}}",
			data: {
				term: term
			},
			success: function(data){
				var ul = document.getElementById("listadoPois");
				ul.innerHTML = '';
				for(var i=0; i<data.length; i++){
					var li = document.createElement("li");
				    li.appendChild(document.createTextNode(data[i].alias));
				    ul.appendChild(li);
				}
				$("#listadoPois li").on("click", function () {
				    $("#listadoPois li").removeClass('itemSeleccionado');
				    $(this).attr('class', 'itemSeleccionado');
				    document.getElementById("name").value = $(this).text();
				    hidePanel('#searchPanel');
				});
			}
		});
	}
	fillNullUserList();
</script>