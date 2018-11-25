<?php
include("../connect.php");
session_start();
	///consultamos a la base
	$consulta = "SELECT * FROM chat WHERE (usuario = '" . $_SESSION['username'] . "' AND destino = '" . $_SESSION['destino'] . "') OR (usuario = '" . $_SESSION['destino'] . "' AND destino = '" . $_SESSION['username'] . "') ORDER BY id DESC";
	$ejecutar = $conexion->query($consulta); 
	while($fila = $ejecutar->fetch_array()) : 
?>
	<div id="datos-chat">
		<span style="color: #1C62C4;"><?php echo $fila['usuario']; ?></span>
		<span style="color: #848484;"><?php echo $fila['mensaje']; ?></span>
		<span style="float: right;"><?php echo formatearFecha($fila['fecha']); ?></span>
	</div>
	
	<?php endwhile; ?>
