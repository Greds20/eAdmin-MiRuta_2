<script type="text/javascript">
    fillList();
    function fillList(){
    	if($("#showAll").is(":checked"))
			$all = "1";
		else
			$all= "0";
    	$.ajax({
			url: "{{ route('poiDynamic.getAllPois') }}",
			data: {
				quantity: $all
			},
			success: function(data){
				var ul = document.getElementById("listadoPois");
				ul.innerHTML = '';
				for(var i=0; i<data.length;i++){
					var li = document.createElement("li");
				    li.appendChild(document.createTextNode(data[i].nombre));
				    li.setAttribute("id", data[i].id_poi);
				    ul.appendChild(li);
				}
				selectedPoi();
			}
		});
    }
</script>