<script type="text/javascript">
	function fillNullUserList(){
		var term = $('#searchName').val();
		var estado = ($("#showAll").is(":checked")) ? "1" : "0";
		$.ajax({
			url: "{{route('administradoresDynamic.searchUser')}}",
			data: {
				term: term,
				state: estado
			},
			success: function(data){
				var ul = document.getElementById("listadoPois");
				ul.innerHTML = '';
				for(var i=0; i<data.length; i++){
					var li = document.createElement("li");
				    li.appendChild(document.createTextNode(data[i].label));
				    li.setAttribute("id", data[i].id);
				    ul.appendChild(li);
				}
				selectedUser();
			}
		});
	}
	fillNullUserList();
</script>