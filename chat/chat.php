<?php
include "../connect.php";
session_start();
$destino = isset($_POST['destino']) ? $_POST['destino'] : '';
if ($destino != null){
$_SESSION['destino'] = $destino;
}
echo "<div align='center'>" . $_SESSION['username'] . "-" . $_SESSION['destino'] . "</div><p/>";
?>
<!DOCTYPE html>
<html>
<head>
	<!--<link rel="stylesheet" type="text/css" href="estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">
	-->
	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}

			req.open('GET', 'chat2.php', true);
			req.send();
		}

		//linea que hace que se refreseque la pagina cada segundo
		setInterval(function(){ajax();}, 1000);
	</script>
</head>
<body onload="ajax();">

	<div id="contenedor">
		<div id="caja-chat">
			<div id="chat"></div>
		</div>

		<form method="POST" action="chat.php">		
			<textarea name="mensaje" placeholder="Ingresa tu mensaje"></textarea>
			<input type="submit" name="enviar" value="Enviar">
		</form>

		<?php
			if (isset($_POST['enviar'])) {
				
				$nombre = $_SESSION['username'];
				$mensaje = $_POST['mensaje'];


				$consulta = "INSERT INTO chat (usuario, destino, mensaje) VALUES ('$nombre', '" . $_SESSION['destino'] . "', '$mensaje');";

				$ejecutar = $conexion->query($consulta);

				if ($ejecutar) {
					echo "<embed loop='false' src='sonido.mp3' hidden='true' autoplay='true'>";
				}
			}

		?>
	</div>
	<form method='post' action='desconectar.php'><input type='submit' value='Salir del chat'></form>
</body>
</html>