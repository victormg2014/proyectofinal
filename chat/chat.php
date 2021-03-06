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

		<table style="width: 100%;"><form method="POST" action="chat.php">
			<tr><td><textarea name="mensaje" placeholder="Ingresa tu mensaje" style="width: 100%;" maxlength="150" required></textarea></td>
			<td><input type="submit" name="enviar" value="Enviar" style=" height: 50px;"></td></tr>
		</form></table>

		<div id="chat" style="overflow:scroll;height:300px;border:1px solid #337DFF;overflow-x: hidden;"></div>

		<?php
			if (isset($_POST['enviar'])) {

				$algoritmo = MCRYPT_BLOWFISH;
				$modo = MCRYPT_MODE_CBC;
				$nombre = $_SESSION['username'];
				$key = $nombre . '|' . $_SESSION['destino'];
				$mensaje = $_POST['mensaje'];
				$vector = 12121212;

				$datos_encriptados = mcrypt_encrypt($algoritmo, $key, $mensaje, $modo, $vector);
				$texto = base64_encode($datos_encriptados);
				
				$pdo = new PDO('mysql:host=localhost;dbname=usuarios', 'root', '');
				$insertar = "INSERT INTO chat (usuario, destino, mensaje) VALUES (?,?,?)";

				$stmt = $pdo->prepare($insertar);
				$stmt->bindValue(1, $nombre, PDO::PARAM_STR);
				$stmt->bindValue(2, $_SESSION['destino'], PDO::PARAM_STR);
				$stmt->bindValue(3, $texto, PDO::PARAM_STR);
				$stmt->execute();
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