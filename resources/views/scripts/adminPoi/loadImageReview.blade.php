<script type="text/javascript">
	/*Para mostrar la imagen seleccionada en el input file */
	var loadImage = function(event) {
		var image = document.getElementById('review');
		image.src = URL.createObjectURL(event.target.files[0]);
	};
</script>