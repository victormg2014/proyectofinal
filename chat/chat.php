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

			req.open('GET', 'chat/chat2.php', true);
			req.send();
		}

		//linea que hace que se refreseque la pagina cada segundo
		setInterval(function(){ajax();}, 1000);
	</script>
</head>
<body onload="ajax();">
	<?php
		$destino = isset($_SESSION['destino']) ? $_SESSION['destino'] : '';
		if ($destino != null){
	?>
	<h2>Chat: <a style="color: blue"><?php echo $_SESSION['username'] . "-" . $_SESSION['destino'] ?></a></h2>
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
		<form method='post' action='chat/desconectar.php'><input type='submit' value='Salir del chat'></form>
	</div>
	<?php
	} else {
	?>
	<h2>No hay chats abiertos</h2>
	<?php
	}
	?>
</body>
</html>
<?php

?>