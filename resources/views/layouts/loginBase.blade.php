<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	@yield('title')
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="img/icons/pageImage.ico"/>
<!--===============================================================================================-->
	@yield('style')
</head>
<body>
	<div class="absoluteContend">
		<div class="divOscurecer" id="panelOsc" hidden="" style="z-index: 2;"></div>
		@yield('secundario')
		<div class="limiter">
			@yield('content')
		</div>
	</div>
</body>
</html >