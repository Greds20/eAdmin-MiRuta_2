<!DOCTYPE html>
<html>
	<head>
		<title>{{ $msg['subject'] }}</title>
		<style type="text/css">
			.contend{
				font-family: Arial,Helvetica,sans-serif;
			}
		</style>
	</head>
	<body style="margin: 0px; width: 100%;">
		<div>
			<h1>MiRuta</h1>
			<h3>{{ $msg['subject'] }}</h3>
			<p>{{ $msg['alias'] }},</p>
			<p>{{ $msg['messagefirst'] }}</p>
			<p>Su nueva contraseña es: {{ $msg['pass'] }}</p>
			<p style="margin-bottom: 0px;">{{ $msg['messagelast']}}</p>
		</div>
	</body>
</html>