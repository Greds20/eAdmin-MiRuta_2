<script type="text/javascript">
	function fillNullUserList(){
		$.ajax({
			url: "{{route('administradoresDynamic.searchUser')}}",
			data: {
				term: $('#searchName').val(),
				state: ($("#showAll").is(":checked")) ? "1" : "0"
			},
			success: function(data){
				var ul = document.getElementById("listadoUsers");
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