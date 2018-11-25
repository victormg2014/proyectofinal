<html>
<head>
	<style>
		body {background-color: coral;}
	</style>
</head>
<body>
<form method="get">
	Agregar: <input type="text" name="nombre">
	<input type="submit">
</form>
<?php
$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';

// Validar si el usuario que se va a agregar existe, si ya tiene una petición, o si ya es amigo.
if ($usuario != $_SESSION['username']){
	$comprobar = "SELECT * FROM cuenta WHERE usuario = '$usuario'";
	$result = $conexion->query($comprobar);
	$count = mysqli_num_rows($result);
	if ($count != null) {
		$comprobar = "SELECT * FROM amigos WHERE usuario = '" . $_SESSION['username'] . "' AND usuario2 = '$usuario'";
		$result = $conexion->query($comprobar);
		$count = mysqli_num_rows($result);
		if ($count != null) {
			echo "<div align='center'>Este usuario ya es tu amigo.</div>";
		}
		else {
			$comprobar = "SELECT * FROM solicitudes WHERE usuario = '" . $_SESSION['username'] . "' AND destino = '$usuario'";
			$result = $conexion->query($comprobar);
			$count = mysqli_num_rows($result);
			if ($count == 1) {
				echo "<div align='center'>Este usuario ya ha recibido una petici&oacute;n de amistad.</div>";
			}
			else{
				if ($usuario != null){
					$query = "INSERT INTO solicitudes (usuario, destino) VALUES ('". $_SESSION['username'] . "', '$usuario')";
					if ($conexion->query($query) === TRUE) {
						echo "<div align='center'>Se ha enviado correctamente la solicitud de amistad.</div>";
					}
					else {
						echo "<div align='center'>Error al enviar la solicitud de amistad.</div>";
					}
				}
			}
		}
	}
	else {
		echo "<div align='center'>El usuario $usuario no existe.</div>";
	}
}
else {
	echo "<div align='center'>No puedes agregarte a ti mismo.</div>";
}

// Mostrar lista de amigos
$query = "SELECT usuario2 FROM amigos WHERE usuario = '" . $_SESSION['username'] . "'";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);
if ($count != null) {
	if ($amigos = $conexion->query($query)) {
		echo "<table><tr><strong>Lista de amigos:</strong></tr>";
		while ($fila = $amigos->fetch_row()) {
	    	printf ("<tr><td>" . $fila[0] . "</td><td><form method='post' action='borrar.php'><input type='hidden' name='usuario' value='" . $fila[0] . "'><input type='submit' value='Borrar'></form></td><td><form method='post' action='chat/iniciar.php'><input type='hidden' name='destino' value='" . $fila[0] . "'><input type='submit' value='Chatear'></form></td></tr>");
		}
		echo "</table>";
	   	$amigos->close();
	}
}

// Mostrar peticiones de amistad recibidas
$query = "SELECT usuario, destino FROM solicitudes WHERE destino = '" . $_SESSION['username'] . "' AND respuesta IS NULL";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);

if ($count != null) {
	if ($amigos = $conexion->query($query)) {
		echo "<table>";
		echo "<tr><strong>Peticiones de amistad recibidas:</strong></tr>";
		while ($fila = $amigos->fetch_row()) {
	    	printf ("<tr><td>" . $fila[0] . "</td><td><form method='post' action='responder.php'><input type='hidden' name='aceptar' value='$fila[0]'><input type='submit' value='Aceptar'></form></td><td><form method='post' action='responder.php'><input type='hidden' name='rechazar' value='$fila[0]'><input type='submit' value='Cancelar'></form></td></tr>");
		}
		echo "</table>";
	   	$amigos->close();
	}
}

// Mostrar peticiones de amistad enviadas
$query = "SELECT usuario, destino FROM solicitudes WHERE usuario = '" . $_SESSION['username'] . "' AND respuesta IS NULL";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);

if ($count != null) {
	if ($amigos = $conexion->query($query)) {
		echo "<table>";
		echo "<tr><strong>Peticiones de amistad enviadas:</strong></tr>";
		while ($fila = $amigos->fetch_row()) {
	    	printf ("<tr><td>" . $fila[1] . "</td><td><form method='post' action='cancelar.php'><input type='hidden' name='nombre' value='$fila[1]'><input type='submit' value='Cancelar'></form></td></tr>");
		}
		echo "</table>";
	   	$amigos->close();
	}
}

?>
</body>
</html>