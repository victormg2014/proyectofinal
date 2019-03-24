<link rel='stylesheet' href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="chat/style.css">

<?php
include("../connect.php");
session_start();
	///consultamos a la base
	$consulta = "SELECT * FROM chat WHERE (usuario = '" . $_SESSION['username'] . "' AND destino = '" . $_SESSION['destino'] . "') OR (usuario = '" . $_SESSION['destino'] . "' AND destino = '" . $_SESSION['username'] . "') ORDER BY id DESC";
	$ejecutar = $conexion->query($consulta); 
	echo "<table id='chat'>";
	while($fila = $ejecutar->fetch_array()) : 
		if($fila['usuario'] != $_SESSION['username']){
?>
		<div class="d-flex justify-content-start mb-4">
			<div class="img_cont_msg">
				<?php
				echo "<img src='img/perfiles/" . $fila['usuario'] . "/" . $fila['usuario'] . ".jpg' class='rounded-circle user_img_msg'>";
				?>
			</div>
			<div class="msg_cotainer" style="min-width: 100px; max-width: 80%;">
				<?php 
				$algoritmo = MCRYPT_BLOWFISH;
				$modo = MCRYPT_MODE_CBC;
				$vector = 12121212;
				$datos_encriptados = base64_decode($fila['mensaje']);
				$clave = $_SESSION['destino'] . "|" . $_SESSION['username'];
				$desencriptado = mcrypt_decrypt($algoritmo, $clave, $datos_encriptados, $modo, $vector);
				echo $desencriptado;
				?>
			<span class="msg_time"><?php echo formatearFecha($fila['fecha']); ?></span>
			</div>
		</div>
		<?php
		} else {
			?>
			<div class="d-flex justify-content-end mb-4">
					<div class="msg_cotainer_send" style="min-width: 100px; max-width: 80%;">
						<?php
						$algoritmo = MCRYPT_BLOWFISH;
						$modo = MCRYPT_MODE_CBC;
						$vector = 12121212;
						$datos_encriptados = base64_decode($fila['mensaje']);
						$clave = $_SESSION['username'] . "|" . $_SESSION['destino'];
						$desencriptado = mcrypt_decrypt($algoritmo, $clave, $datos_encriptados, $modo, $vector);
						echo $desencriptado;
						?>
					<span class="msg_time_send"><?php echo formatearFecha($fila['fecha']); ?></span>
					</div>
					<div class="img_cont_msg">
						<?php
						echo "<img src='img/perfiles/" . $fila['usuario'] . "/" . $fila['usuario'] . ".jpg' class='rounded-circle user_img_msg'>";
						?>
					</div>
				</div>
			<?php
		}
		?>
		<?php endwhile; ?>